<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
  echo '<h1>欢迎使用「'.THEME_NAME.'」主题</h1>';
  echo '<h3>基本状态</h3>';
  echo '<h4>项目地址：<a href="https://github.com/Star-caorui/Better">Better</a> (求Star～)</h4>';
  echo '<h4>项目作者：<a href="https://github.com/Star-caorui/">Star_caorui</a> (欢迎follow我～)</h4>';
  echo '<h4>开源协议：GPL-3.0</h4>';
  echo '<h4>更新通道：'.THEME_BRANCH.'</h4>';
  echo '<h4>版本号：'.THEME_VERSION.themeCheckUpdate().'</h4>';

  echo '<hr/>';

  $key = new Typecho_Widget_Helper_Form_Element_Text('sitebarLogo', NULL, NULL, _t('侧边栏头像'), _t('请填写超链接'));
  $form->addInput($key);

  $key = new Typecho_Widget_Helper_Form_Element_Text('articleCopy', NULL, NULL, _t('文章许可协议'), _t('提示：如不填写将默认由文章作者独占版权，禁止出于任何目的去使用，修改，和分享。<br/>示例格式：&lt;a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="nofollow"&gt;知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议&lt;/a&gt;'));
  $form->addInput($key);

  $staticFiles = new Typecho_Widget_Helper_Form_Element_Select('staticFiles', array(
    'staticFilesLocalhost' => '本地',
    'staticFilesGithub' => 'Github',
    'staticFilesJsDelivr' => 'JsDelivr',
    'staticFilesObjectStorage' => '对象存储'
    ), 'staticFilesLocalhost', _t('静态文件源'), _t('推荐选择【JsDelivr】源，如果您需要自定义修改，或使用全站CDN，请使用【本地】源。<br/>注：如果选择【对象存储】，请先保存后再编辑对象存储的路径！'));
  $form->addInput($staticFiles->multiMode());
  if (Helper::options()->staticFiles == 'staticFilesObjectStorage') {
    $key = new Typecho_Widget_Helper_Form_Element_Text('staticFilesObjectStorageUrl', NULL, NULL, _t('对象存储'), _t('示例格式:https://src.web-worker.com/'));
    $form->addInput($key);
  }

  $randomImg = new Typecho_Widget_Helper_Form_Element_Select('randomImg', array(
    'randomImgLocalhost' => '本地',
    'randomImgWebWorker' => 'Web-Worker API(开发中)',
    'randomImgGYMXBL' => '孤影墨香 API',
    'randomImgAPI' => '其他图片API(可能存在安全隐患)'
    ), 'randomImgGYMXBL', _t('随机图片源'), _t('推荐选择【Web-Worker API】<br/>如果您的文章，独立页面没有单独设置头图的话，则会调用此处的API。<br/>如果选择【其他API】，请先保存后再编辑！'));
  $form->addInput($randomImg->multiMode());
  if (Helper::options()->randomImg == 'randomImgAPI') {
    $key = new Typecho_Widget_Helper_Form_Element_Text('randomImgAPIUrl', NULL, NULL, _t('随机代码图API'), _t('示例格式:https://api.web-worker.com/?type=randomImg'));
    $form->addInput($key);
  }

  $commentAvatar = new Typecho_Widget_Helper_Form_Element_Select('commentAvatar', array(
    'default' => '默认',
    'priorityUseQQAvatar' => '优先使用QQ头像'
    ), 'default', _t('评论头像源'), _t('推荐选择【优先使用QQ头像】<br/>如果选择【默认】Better将不会再次处理评论头像源，将使用Typecho默认的算法获取头像源。<br/>如果选择【优先使用QQ头像】Better将尝试获取QQ头像，将会优先使用QQ头像，如获取失败将尝试回退Gravatar头像。'));
  $form->addInput($commentAvatar->multiMode());

  $gravatarUrl = new Typecho_Widget_Helper_Form_Element_Select('gravatarUrl', array(
    'gravatarUrlWebWorker' => 'Web-Worker Gravatar 加速服务 (开发中)',
    'gravatarUrlGeekzu' => '极客族 Gravatar 加速服务',
    'gravatarUrlGYMXBL' => '孤影墨香 Gravatar 加速服务',
    'gravatarUrlTypechoConfigFile' => 'Typecho配置文件的 "__TYPECHO_GRAVATAR_PREFIX__"',
    'gravatarUrlAPI' => '其他Gravatar 加速服务(可能存在安全隐患)'
    ), 'gravatarUrlGeekzu', _t('Gravatar 镜像加速服务'), _t('推荐选择【Web-Worker API】<br/>推荐选择一个稳定的头像服务器，例如【极客族】<br/>如果选择【其他API】，请先保存后再编辑！'));
  $form->addInput($gravatarUrl->multiMode());
  if (Helper::options()->gravatarUrl == 'gravatarUrlAPI') {
    $key = new Typecho_Widget_Helper_Form_Element_Text('gravatarAPI', NULL, NULL, _t('自定义 Gravatar 镜像加速服务'), _t('示例格式:https://api.web-worker.com/gravatar/'));
    $form->addInput($key);
  }

  $footerInfoLeft = new Typecho_Widget_Helper_Form_Element_Checkbox('footerInfoLeft',
    array(
    'showMail' => _t('邮箱'),
    'ShowOther' => _t('待开发')),
    array('showMail', 'ShowOther'), _t('页脚个人信息'));
  $form->addInput($footerInfoLeft->multiMode());
  if (!empty(Helper::options()->footerInfoLeft) && in_array('showMail', Helper::options()->footerInfoLeft)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('mailInfo', NULL, NULL, _t('邮箱'));
    $form->addInput($key);
  }



  $footerInfoRight = new Typecho_Widget_Helper_Form_Element_Checkbox('footerInfoRight',
    array('showICPBeian' => _t('ICP备案'),
    'showBeian' => _t('公网安备案'),
    'showMoeBeian' => _t('萌国ICP备案')),
    array('showICPBeian', 'showBeian', 'showMoeBeian'), _t('页脚备案信息'));
  $form->addInput($footerInfoRight->multiMode());
  if (!empty(Helper::options()->footerInfoRight) && in_array('showICPBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('icpBeian', NULL, NULL, _t('ICP备案'), _t('示例格式：蒙ICP备 xxxxxxxx号'));
    $form->addInput($key);
  }
  if (!empty(Helper::options()->footerInfoRight) && in_array('showBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('公网安备案'), _t('无需输入a标签，只需填写公网安备案的备案号即可。'));
    $form->addInput($key);
  }
  if (!empty(Helper::options()->footerInfoRight) && in_array('showMoeBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('moeBeian', NULL, NULL, _t('萌国ICP备案'), _t('无需输入a标签，只需填写萌号即可。'));
    $form->addInput($key);
  }
}
