<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeFields($form) {
  $timeoutCheck = new Typecho_Widget_Helper_Form_Element_Select('timeoutCheck', array(
    'enable' => '启用',
    'disable' => '禁用'
    ), 'enable', _t('文章时效性检查'), _t('默认为启用。如果不需要在这篇文章提示文章时效性，可以将此项设置为禁用。'));
  $form->addItem($timeoutCheck);
}