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

$config = array(
    'cron-key' => '',
    // personal token, see https://github.com/settings/tokens/
    // must be like 'user:token'
    'github-token' => '',
    'github-webhook-secret' => '',
    'github' => array(
        'BlogoText/blogotext' => array(
            'repos' => 'BlogoText/blogotext',
            'version' => 'https://raw.githubusercontent.com/BlogoText/blogotext/dev/VERSION'
        ),
        'BlogoText/blogotext-addons' => array(
            'repos' => 'BlogoText/blogotext-addons',
        ),
    ),
    'tags' => array(
        '{{main-issues-ct}}' => '',
        '{{addon-issues-ct}}' => '',
        '{{addon-ct}}' => '',
        '{{theme-ct}}' => '',
        '{{name}}' => 'BlogoText',
        '{{version}}' => '',
        '{{description}}' => '',
        '{{release-zip}}' => '',
        '{{release-tar}}' => '',
    ),
);

$file_get_contents_options = array(
    'http' => array(
        'method' => 'GET',
        'header' => array(
                    'User-Agent: BlogoText'
                )
    )
);