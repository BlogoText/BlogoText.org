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
 * this file build the homepage of blogotext.org
 */


// change some config
ignore_user_abort(true);
set_time_limit(3600);
ini_set('memory_limit','64M');

// set header
header("HTTP/1.1 200 OK");
header("Content-Length: 0");
header("Connection: Close");

// send response
ob_start();
ob_end_flush();
flush();

// with fastCGI
fastcgi_finish_request();


// run end of the script


include 'config.php';
include 'functions.php';

if (!boot()) {
    exit('false');
}

// run cron
echo (build_home() !== false) ? 'true' : 'false';

// if debug, show datas
if (isset($_GET['debug'])) {
    var_dump($datas);
}
