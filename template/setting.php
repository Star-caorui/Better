<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
  echo 'Welcome to Better!';

  $key = new Typecho_Widget_Helper_Form_Element_Text('passcode', NULL, NULL, _t('您的许可证'), _t('在此处填入您的许可证，即可使用此主题。'));
  $form->addInput($key);

  $staticFiles = new Typecho_Widget_Helper_Form_Element_Radio('staticFiles', array(
    'staticFilesLocalhost' => '默认: 跟随域名',
    'staticFilesGithub' => 'Github',
    'staticFilesJsdelivr' => 'Jsdelivr(推荐)',
    'staticFilesObjectStorage' => '对象存储: 如果选择对象存储，请先保存后再编辑！'
    ), 'staticFilesLocalhost', _t('静态文件源'), _t('如果选择对象存储，请先保存后再编辑对象存储的路径！'));
  $form->addInput($staticFiles->multiMode());
  if (Helper::options()->staticFiles == 'staticFilesObjectStorage') {
    $key = new Typecho_Widget_Helper_Form_Element_Text('staticFilesObjectStorageUrl', NULL, NULL, _t('对象存储'), _t('示例格式:https://src.web-worker.com/'));
    $form->addInput($key);
  }

  $randomImg = new Typecho_Widget_Helper_Form_Element_Radio('randomImg', array(
    'randomImgLocalhost' => '默认: 跟随域名',
    'randomImgWebWorker' => 'Web-Worker API(开发中)',
    'randomImgGYMXBL' => '孤影墨香 API',
    'randomImgAPI' => '其他API(可能存在安全隐患): 如果选择其他API，请先保存后再编辑！'
    ), 'randomImgWebWorker', _t('随机图片源'), _t('如果您的文章，独立页面没有单独设置头图的话，则会调用此处的API。'));
  $form->addInput($randomImg->multiMode());
  if (Helper::options()->randomImg == 'randomImgAPI') {
    $key = new Typecho_Widget_Helper_Form_Element_Text('randomImgAPIUrl', NULL, NULL, _t('随机代码图API'), _t('示例格式:https://api.web-worker.com/?type=randomImg'));
    $form->addInput($key);
  }

  $footerInfoLeft = new Typecho_Widget_Helper_Form_Element_Checkbox('footerInfoLeft',
    array('showMail' => _t('邮箱'),
    'ShowOther1' => _t('待开发'),
    'ShowOther2' => _t('待开发')),
    array('showMail', 'ShowOther1', 'ShowOther2'), _t('页脚个人信息'));
  $form->addInput($footerInfoLeft->multiMode());
  if (!empty(Helper::options()->footerInfoLeft) && in_array('showMail', Helper::options()->footerInfoLeft)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('mailInfo', NULL, NULL, _t('邮箱'), _t('示例格式: Star_caorui@qq.com'));
    $form->addInput($key);
  }

  $footerInfoRight = new Typecho_Widget_Helper_Form_Element_Checkbox('footerInfoRight',
    array('showICPBeian' => _t('ICP备案'),
    'showBeian' => _t('公网安备案'),
    'showMoeBeian' => _t('萌国ICP备案'),
    'showCopyRight' => _t('版权信息')),
    array('showICPBeian', 'showBeian', 'showMoeBeian', 'showCopyRight'), _t('页脚更多信息'));
  $form->addInput($footerInfoRight->multiMode());
  if (!empty(Helper::options()->footerInfoRight) && in_array('showICPBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('icpBeian', NULL, NULL, _t('ICP备案'), _t('示例格式：&lt;a href="https://beian.miit.gov.cn/" target="_blank"&gt;蒙ICP备 xxxxxx&lt;/a&gt;&lt;br /&gt;'));
    $form->addInput($key);
  }
  if (!empty(Helper::options()->footerInfoRight) && in_array('showBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('beian', NULL, NULL, _t('公网安备案'), _t('示例格式：&lt;a href="http://www.beian.gov.cn" target="_blank"&gt;&lt;img src="https://web-worker.cn/usr/themes/Better/src/img/National Emblem of the People\'s Republic of China.png" alt="中华人民共和国国徽" style="vertical-align: middle;" width="20" height="20"&gt;蒙公网安备 暂未备案&lt;/a&gt;&lt;br /&gt;'));
    $form->addInput($key);
  }
  if (!empty(Helper::options()->footerInfoRight) && in_array('showMoeBeian', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('moeBeian', NULL, NULL, _t('萌国ICP备案'), _t('提示：萌国ICP备案并非法定备案！<br />示例格式：&lt;a href="https://icp.gov.moe/?keyword=20200411" target="_blank"&gt;20200411号&lt;/a&gt;&lt;br /&gt;'));
    $form->addInput($key);
  }
  if (!empty(Helper::options()->footerInfoRight) && in_array('showCopyRight', Helper::options()->footerInfoRight)) {
    $key = new Typecho_Widget_Helper_Form_Element_Text('copyRightInfo', NULL, NULL, _t('版权信息'), _t('我不允许你修改版权信息的哦！不要想屁吃啦！'));
    $form->addInput($key);
  }
}
