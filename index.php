<?php
/**
 * MyClass Class Doc Comment
 *
 * @category Class
 * @author   Ran Ping <ranping@gutou.com>
 * @license  http://www.epet.com.cn/
 * @link     http://www.epet.com.cn/
 */

define('APP_PATH', __DIR__.DIRECTORY_SEPARATOR);
define('APP_DEBUG', true);

// load core app file

require 'vendor/autoload.php';
$config = require APP_PATH.'/config/config.php';

$app = new vendor\App($config);
$app->run();