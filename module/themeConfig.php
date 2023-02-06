<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
class themeConfig {
  /**
   * 版本检查
   *
   * @access public
   * @return string 输出版本检查结果
   */
  public static function versionCheck() : string {
    switch (__THEME_BRANCH__) {
      case 'main':
        $branch = '正式版';
        $cloud_version = file_get_contents('https://blog.inetech.fun?api=main');
        break;
      case 'dev':
        $branch = '测试版';
        $cloud_version = file_get_contents('https://blog.inetech.fun?api=version');
        break;
    }

    $return = array();

    if (__THEME_VERSION__ == $cloud_version) {
      $return['status'] = 'normal';
      $return['msg'] = '此版本已是最新版本';
    }

    if (__THEME_VERSION__ < $cloud_version) {
      $return['status'] = 'update';
      $return['msg'] = '发现新的可用更新：' . __THEME_BRANCH__ . '-' . $cloud_version;
    }

    if (__THEME_VERSION__ > $cloud_version) {
      $return['status'] = 'insider';
      $return['msg'] = '警告：您正在使用的是: ' . $branch . '，但您的版本号高于最新版本！';
    }

    if (__THEME_BRANCH__ == 'dev' && $return['status'] == 'insider') {
      $return['msg'] = '特别感谢敢于使用最新内测版的您！';
    }

    return $return['msg'];
  }

  /**
   * 顶部信息栏
   *
   * @access public
   * @return void 直接输出顶部信息栏
   */
  public static function status_bar() : void {
    echo '<h1>欢迎使用「' . __THEME_NAME__. '」主题</h1>';
    echo '<h3>基本状态</h3>';
    echo '<h4>项目地址：<a href="' . __GITLAB_REPO__ . '">' . __THEME_NAME__ . '</a></h4>';
    echo '<h4>项目作者：<a href="' . __GITLAB_AUTHOR_URL__ . '">' . __THEME_AUTHOR__ . '</a></h4>';
    echo '<h4>开源协议：GPL-3.0</h4>';
    echo '<h4>更新通道：' . __THEME_BRANCH__ . '</h4>';
    echo '<h4>版本检测：' . __THEME_VERSION__ . ' (' . self::versionCheck() . ')</h4>';

    echo '<hr/>';
  }
}


function themeConfig($form) {
  \Utils\Helper::options()->to($options);

  themeConfig::status_bar();

  $key = new Typecho\Widget\Helper\Form\Element\Text('sitebarLogo', NULL, NULL, _t('侧边栏头像'), _t('请输入头像的图片链接地址'));
  $form->addInput($key);

  $key = new Typecho\Widget\Helper\Form\Element\Text('articleCopy', NULL, NULL, _t('文章许可协议'), _t('提示：如不填写将默认由文章作者独占版权，禁止出于任何目的去使用，修改，和分享。
  <br/>示例格式：&lt;a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.zh" target="_blank" rel="nofollow"&gt;知识共享署名-非商业性使用-相同方式共享 4.0 国际许可协议&lt;/a&gt;'));
  $form->addInput($key);

  $staticFiles = new Typecho\Widget\Helper\Form\Element\Select('staticFiles', array(
    'local' => '本地',
    'jsdelivr' => 'JsDelivr (支持智能加速)',
    'custom' => '自定义'
    ), 'local', _t('静态文件源'), _t('推荐使用【JsDelivr】。通过前端 Service Worker 实现同时向多个 JsDelivr 镜像发起请求，当有最快的节点返回全部内容后，自动中止其他无用请求。<br />如果您需要自定义修改源码，或使用全站CDN，请使用【本地】源。<br />注：如果选择【自定义】，请先保存后再编辑自定义路径！'));
  $form->addInput($staticFiles->multiMode());

  if ($options->staticFiles == 'custom') {
    $key = new Typecho\Widget\Helper\Form\Element\Text('staticFilesCustom', NULL, NULL, _t('自定义'), _t('示例格式:https://src.inetech.fun/'));
    $form->addInput($key);
  }

  $randomImg = new Typecho\Widget\Helper\Form\Element\Select('randomImg', array(
    'randomImgLocal' => '本地',
    'randomImgINETECH' => 'iNetech API',
    'randomImgGYMXBL' => '孤影墨香 API',
    'randomImgAPI' => '自定义图片 API(可能存在 XSS 安全隐患)'
    ), 'randomImgINETECH', _t('随机图片源'), _t('推荐选择【iNetech API】<br/>如果您的文章，独立页面没有单独设置头图的话，则会调用此处的API。<br/>如果选择【自定义图片 API】，请先保存后再编辑！'));
  $form->addInput($randomImg->multiMode());

  if ($options->randomImg == 'randomImgAPI') {
    $key = new Typecho\Widget\Helper\Form\Element\Text('randomImgAPI', NULL, NULL, _t('自定义图片 API'), _t('示例格式: https://api.inetech.fun/acg?identity=other&origin=inetech&orientation=width&return=raw&random='));
    $form->addInput($key);
  }

  $avatarInterface = new Typecho\Widget\Helper\Form\Element\Checkbox('avatarInterface',
    array('gravatar' => _t('Gravatar'),
          'qqavatar' => _t('QQ 头像')),
    array('gravatar', 'qqavatar'), _t('评论头像源'));
  $form->addInput($avatarInterface->multiMode());


  $qqavatar_privacy_protection = new Typecho\Widget\Helper\Form\Element\Radio('qqavatar_privacy_protection',
    array('Enable' => _t('启用'),
          'Disable' => _t('禁用')),
          'Disable',   _t('QQ 头像隐私保护'), _t('默认状态禁用。 QQ 头像接口会暴露评论者的 QQ 帐号。<br />如果启用隐私保护将会通过反向代理并 Base64 编码头像来保护隐私，如果禁用隐私保护将会把头像直连传递给前端，这将导致评论者 QQ 号被暴露到前端！'));
  $form->addInput($qqavatar_privacy_protection);

  $commentAvatar = new Typecho\Widget\Helper\Form\Element\Select('commentAvatar', array(
    'priorityUseGravatar' => '优先使用 Gravatar 头像',
    'priorityUseQQAvatar' => '优先使用 QQ 头像'
    ), 'priorityUseQQAvatar', _t('评论头像优先级'), _t('推荐选择【优先使用QQ头像】'));
  $form->addInput($commentAvatar->multiMode());

  $gravatarUrl = new Typecho\Widget\Helper\Form\Element\Select('gravatarUrl', array(
    'gravatar_Url_Geekzu' => '极客族 Gravatar 加速服务',
    'gravatar_Url_GYMXBL' => '孤影墨香 Gravatar 加速服务',
    'gravatar_Url_API' => '自定义 Gravatar 加速源 (可能存在 XSS 安全隐患)'
    ), 'gravatar_Url_Geekzu', _t('Gravatar 镜像加速服务'), _t('推荐选择一个稳定的头像服务器，例如【极客族】<br/>如果选择【自定义 API】，请先保存后再编辑！'));
  $form->addInput($gravatarUrl->multiMode());
  if ($options->gravatarUrl == 'gravatarUrlAPI') {
    $key = new Typecho\Widget\Helper\Form\Element\Text('gravatarAPI', NULL, NULL, _t('自定义 Gravatar 镜像加速服务'), _t('示例格式:https://sdn.geekzu.org/avatar/gravatar/'));
    $form->addInput($key);
  }

  $footerInfoLeft = new Typecho\Widget\Helper\Form\Element\Checkbox('footerInfoLeft',
    array(
    'showMail' => _t('邮箱'),
    'ShowOther' => _t('待开发')),
    array('showMail', 'ShowOther'), _t('页脚个人信息'));
  $form->addInput($footerInfoLeft->multiMode());
  if (!empty($options->footerInfoLeft) && in_array('showMail', $options->footerInfoLeft)) {
    $key = new Typecho\Widget\Helper\Form\Element\Text('mailInfo', NULL, NULL, _t('邮箱'));
    $form->addInput($key);
  }

  $key = new Typecho\Widget\Helper\Form\Element\Text('siteBirthday', NULL, NULL, _t('站点诞生日'), _t('示例格式: 31/12/2020 00:00:00'));
  $form->addInput($key);

  $footerInfoRight = new Typecho\Widget\Helper\Form\Element\Checkbox('footerInfoRight',
    array('showICPBeian' => _t('ICP备案'),
    'showBeian' => _t('公网安备案'),
    'showMoeBeian' => _t('萌国ICP备案')),
    array('showICPBeian', 'showBeian', 'showMoeBeian'), _t('页脚备案信息'));
  $form->addInput($footerInfoRight->multiMode());
  if (!empty($options->footerInfoRight) && in_array('showICPBeian', $options->footerInfoRight)) {
    $key = new Typecho\Widget\Helper\Form\Element\Text('icpBeian', NULL, NULL, _t('ICP备案'), _t('示例格式：蒙ICP备 xxxxxxxx号'));
    $form->addInput($key);
  }
  if (!empty($options->footerInfoRight) && in_array('showBeian', $options->footerInfoRight)) {
    $key = new Typecho\Widget\Helper\Form\Element\Text('beian', NULL, NULL, _t('公网安备案'), _t('示例格式：XXXXXXXXXXXXXX号'));
    $form->addInput($key);
  }
  if (!empty($options->footerInfoRight) && in_array('showMoeBeian', $options->footerInfoRight)) {
    $key = new Typecho\Widget\Helper\Form\Element\Text('moeBeian', NULL, NULL, _t('萌国ICP备案'), _t('示例格式：XXXXXXXX号'));
    $form->addInput($key);
  }
}
