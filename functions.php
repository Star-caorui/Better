<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

define("AUTHOR_NAME", "Star-caorui");
define("THEME_NAME", "Better");
define("THEME_BRANCH", "alpha");
define("THEME_VERSION", "0.0.1");
define("CLOUD_VERSION", "0.0.1");
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

    case 'staticFilesJsDelivr':
      return 'https://cdn.jsdelivr.net/gh/' . AUTHOR_NAME . '/' . THEME_NAME . '@' . THEME_BRANCH . '/src/' . $str;
      break;

    case 'staticFilesObjectStorage':
      return $settingObjectStorage.$str;

    default:
      return 'https://cdn.jsdelivr.net/gh/' . AUTHOR_NAME . '/' . THEME_NAME . '@' . THEME_BRANCH . '/src/' . $str;
      break;
  }
}
function randomImgLocalhost() {
  $randomImgList = scandir(__DIR__ . '/src/img/random/');
  array_shift($randomImgList);
  array_shift($randomImgList);
  $randomNum = random_int(1, count($randomImgList))-1;
  return Helper::options()->themeUrl . '/src/img/random/' . $randomImgList["$randomNum"];
}

function randomImg() {
  $setting = Helper::options()->randomImg;
  $settingObjectStorage = Helper::options()->randomImgAPIUrl;
  $random_str = '?' . random_int(0, 2333);
  switch ($setting) {
    case 'randomImgLocalhost':
      return randomImgLocalhost() . $random_str;
      break;

    case 'randomImgWebWorker':
      return '此处为Web-Worker API的URL' . $random_str;
      break;

    case 'randomImgGYMXBL':
      return 'https://api.gymxbl.com/images/' . $random_str;
      break;

    case 'randomImgAPI':
      return $settingObjectStorage . $random_str;

    default:
      return 'https://api.gymxbl.com/images/' . $random_str;
      break;
  }
}

function themeCheckUpdate() {
  if (THEME_VERSION === CLOUD_VERSION) {
    return ' (当前版本已是最新版本)';
  } elseif (THEME_VERSION < CLOUD_VERSION) {
    return ' (发现新版本:'.CLOUD_VERSION.')';
  } elseif (THEME_VERSION > CLOUD_VERSION) {
    return ' (警告：本地版本过新！)';
  }
}

/* 这段代码来自于Cuckoo, 感谢布好！ */
function getPostView($archive){
  $cid = $archive->cid;
  $db = Typecho_Db::get();
  $prefix = $db->getPrefix();
  if(!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))){
    $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
    echo 0;
    return;
  }
  $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
  if($archive->is('single')){
    $views = Typecho_Cookie::get('extend_contents_views');
    if(empty($views)){
      $views = array();
    }else{
      $views = explode(',', $views);
    }
    if(!in_array($cid,$views)){
      $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
      array_push($views, $cid);
      $views = implode(',', $views);
      Typecho_Cookie::set('extend_contents_views', $views);
    }
  }
  echo $row['views'];
}

function getQQNumber($email) {
  $qqMailPrefix = (substr($email,-7) === '@qq.com') ? str_replace('@qq.com','',$email) : NULL;
  $qqNumber = is_numeric($qqMailPrefix) ? $qqMailPrefix : NULL;
  return $qqNumber;
}

function getQQNickname($email) {
  $qqInfoPrefix = 'https://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins=';
  $data = getQQNumber($email) ? json_decode(iconv('GB18030', 'UTF-8', str_replace('portraitCallBack(','',rtrim(file_get_contents($qqInfoPrefix.getQQNumber($email)),')'))))->{getQQNumber($email)}['6'] : NULL;
  
  return $data;
}
/* 这段代码基于Cuckoo二开, 感谢布好！ */
function getCommentAvatar($email) {
  $qqAvatarDomainPrefix = 'https://thirdqq.qlogo.cn/headimg_dl?bs=qq&spec=640&dst_uin=';
  $gravatarDomainPrefix = 'https://sdn.geekzu.org/avatar/';
  switch (Helper::options()->gravatarUrl) {
    case 'gravatarUrlWebWorker':
      $gravatarDomainPrefix = '此处为Web-Worker API的URL';
      break;

    case 'gravatarUrlGeekzu':
      $gravatarDomainPrefix = 'https://sdn.geekzu.org/avatar/';
      break;

    case 'gravatarUrlGYMXBL':
      $gravatarDomainPrefix = 'https://i.ilolita.cn/avatar/';
      break;

    case 'gravatarUrlTypechoConfigFile':
      $gravatarDomainPrefix = defined('__TYPECHO_GRAVATAR_PREFIX__') ? __TYPECHO_GRAVATAR_PREFIX__ : $gravatarDomainPrefix;
      break;

    case 'gravatarUrlAPI':
      $gravatarDomainPrefix = Helper::options()->gravatarAPI;
      break;

    default:
      $gravatarDomainPrefix = $gravatarDomainPrefix;
      break;
  }

  $defaultAvatar = $gravatarDomainPrefix . strtolower(md5($email) . '?d=mm');
  $priorityQQAvatar = getQQNumber($email) ? 'data:image/png;base64,'.base64_encode(file_get_contents($qqAvatarDomainPrefix.getQQNumber($email))) : $defaultAvatar; // 在泄露QQ号的bug修复之前不打算开放此功能

  switch (Helper::options()->commentAvatar) {
    case 'priorityUseQQAvatar':
      return $priorityQQAvatar;
      break;

    default:
      return $defaultAvatar;
      break;
  }
}

require_once("template/setting.php");
require_once("template/custom.php");
require_once("template/themeFields.php");