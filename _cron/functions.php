<?php
/**
 * This file is used by blogotext.org
 *
 * https://github.com/BlogoText/blogotext/
 * https://github.com/BlogoText/blogotext-addons/
 *
 *
 * we use this script to generate some pages of the website.
 * You can use it, modify it under the terms of the MIT / X11 Licence.
 *
 * Enjoy ! RemRem
 */

/**
 * boot
 * check some stuff
 * make other stuff
 */
function boot()
{
    global $file_get_contents_context, $datas, $file_get_contents_options, $config;

    // check the cron key
    if (!isset($_GET['key'])
     || md5($_GET['key']) != md5($config['cron-key'])
    ) {
        exit('false');
    }

    // datas threw functions
    $datas = array();

    // create context for file_get_contents()
    if (!empty($config['github-token'])) {
        $file_get_contents_options['http']['header'][] = 'Authorization: Basic '. base64_encode($config['github-token']);
    }
    $file_get_contents_context = stream_context_create($file_get_contents_options);

    return true;
}

/**
 * get github issues from a repos
 */
function github_issues($repos)
{
    global $file_get_contents_context, $datas;

    if (!isset($datas[$repos]['issues'])) {
        $source = file_get_contents('https://api.github.com/repos/'.$repos.'/issues', false, $file_get_contents_context);
        if (!$source) {
            return false;
        }

        $issues = json_decode($source, true);
        if (!is_array($issues)) {
            return false;
        }

        $datas[$repos]['issues'] = $issues;
    }

    return $datas[$repos]['issues'];
}

/**
 * count issues from a repos
 */
function github_issues_counter($repos)
{
    $issues = github_issues($repos);
    if (!$issues) {
        return false;
    }

    return count($issues);
}

/**
 * count folder inside a repos
 */
function bt_addons_counter($repos)
{
    $list = bt_list_addons($repos);
    if (!$list) {
        return false;
    }
    return count($list);
}

/**
 * list addons (folders, first level) inside a repos
 */
function bt_list_addons($repos)
{
    global $file_get_contents_context, $datas;

    if (!isset($datas[$repos]['contents'])) {
        $content = file_get_contents('https://api.github.com/repos/'.$repos.'/contents/', false, $file_get_contents_context);
        if (!$content) {
            return false;
        }

        $contents = json_decode($content, true);
        if (!is_array($contents)) {
            return false;
        }

        $datas[$repos]['contents'] = $contents;
    }

    $addons = array();
    foreach ($contents as $c){
        if ($c['type'] == 'dir') {
            $addons[] = $c['name'];
        }
    }

    return $addons;
}

/**
 * get datas for the last release
 */
function github_lastest_release($repos)
{
    global $file_get_contents_context, $datas;

    if (!isset($datas[$repos]['release'])) {
        $content = file_get_contents('https://api.github.com/repos/'.$repos.'/releases/latest', false, $file_get_contents_context);
        if (!$content) {
            return false;
        }

        $contents = json_decode($content, true);
        if (!is_array($contents)) {
            return false;
        }

        $datas[$repos]['release'] = $contents;
    }

    return $datas[$repos]['release'];
}

/**
 * build index.html
 */
function build_home()
{
    // load template
    $template = file_get_contents('model.php');
    if (!$template) {
        return false;
    }

    global $config;

    $release = github_lastest_release($config['github']['BlogoText/blogotext']['repos']);

    // set release infos
    if ($release !== false) {
        if (isset($release['tag_name'])) {
            $config['tags']['{{version}}'] = 'v'.$release['tag_name'];
        }
        if (isset($release['zipball_url'])) {
            $config['tags']['{{release-zip}}'] = '<a class="btn" href="'.$release['zipball_url'].'">.zip</a>';
        }
        if (isset($release['tarball_url'])) {
            $config['tags']['{{release-tar}}'] = '<a class="btn" href="'.$release['tarball_url'].'">.tar</a>';
        }
    }

    // set counters
    if (($t = github_issues_counter($config['github']['BlogoText/blogotext']['repos'])) !== false) {
        if ($t > 1) {
            $config['tags']['{{main-issues-ct}}'] = '<li><strong>'. $t .'</strong> issues ouvertes concernant {{name}}</li>';
        } else {
            $config['tags']['{{main-issues-ct}}'] = '<li><strong>1</strong> issue ouverte concernant {{name}}</li>';
        }
    }
    if (($t = github_issues_counter($config['github']['BlogoText/blogotext-addons']['repos'])) !== false) {
        if ($t > 1) {
            $config['tags']['{{addon-issues-ct}}'] = '<li><strong>'. $t .'</strong> issues ouvertes concernant les addons</li>';
        } else {
            $config['tags']['{{addon-issues-ct}}'] = '<li><strong>1</strong> issue ouverte concernant les addons</li>';
        }
    }
    if (($t = bt_addons_counter($config['github']['BlogoText/blogotext-addons']['repos'])) !== false) {
        if ($t > 1) {
            $config['tags']['{{addon-ct}}'] = '<li><strong>'. $t .'</strong> addons disponibles</li>';
        } else {
            $config['tags']['{{addon-ct}}'] = '<li><strong>1</strong> addon disponible</li>';
        }
    }

    // replace tags
    $html = str_replace(array_keys($config['tags']), $config['tags'], $template);

    // compress
    $html = str_replace(array("\r", "\n"), '', $html);
    while (strpos($html, '  ') !== false) {
        $html = str_replace('  ', ' ', $html);
    }

    // write the file
    return file_put_contents('../index.html', $html, LOCK_EX);
}
