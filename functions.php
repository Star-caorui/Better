<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once("template/setting.php");

define("AUTHOR_NAME", "Star-caorui");
define("THEME_NAME", "Better");
define("THEME_BRANCH", "alpha");
define("THEME_VERSION", "0.0.1.t".time());
define("MDUI_VERSION", "1.0.1");
define("HIGHLIGHT_VERSION", "10.6.0");

function defaultStaticFiles($str) {
  $setting = Helper::options()->staticFiles;
  $settingObjectStorage = Helper::options()->staticFilesObjectStorageUrl;
  switch ($setting) {
    case 'staticFilesLocalhost':
      return Helper::options()->themeUrl . '/src/' . $str;
      break;  
    case 'staticFilesGithub':
      return 'https://raw.githubusercontent.com/' . AUTHOR_NAME . '/' . THEME_NAME . '/' . THEME_BRANCH . '/src/' . $str;
      break;
    case 'staticFilesJsdelivr':
      return 'https://cdn.jsdelivr.net/gh/' . AUTHOR_NAME . '/' . THEME_NAME . '@' . THEME_BRANCH . '/src/' . $str;
      break;
    case 'staticFilesObjectStorage':
      return $settingObjectStorage.$str;
  }
}

function randomImg() {
  $setting = Helper::options()->randomImg;
  $settingObjectStorage = Helper::options()->randomImgAPIUrl;
  switch ($setting) {
    case 'randomImgLocalhost':
      return '此处为源站的URL';
      break;  
    case 'randomImgWebWorker':
      return '此处为Web-Worker API的URL';
      break;
    case 'randomImgGYMXBL':
      return 'https://api.gymxbl.com/images/';
      break;
    case 'randomImgAPI':
      return $settingObjectStorage;
  }
}
