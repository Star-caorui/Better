<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeFields($form) {
  $timeoutCheck = new \Typecho\Widget\Helper\Form\Element\Select('timeoutCheck', array(
    'enable' => _t('启用'),
    'disable' => _t('禁用')
    ), 'enable', _t('文章时效性检查'));
  $form->addItem($timeoutCheck);
}
