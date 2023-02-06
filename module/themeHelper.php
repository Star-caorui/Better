<?php

/**
 * 生成任意标签
 *
 * @access public
 * @param string $tag 标签名
 * @param bool $self_close 自闭合
 * @param array $attr 属性
 * @param string $content 内容
 * @return string 返回一个标签
 */
function genTAG(string $tag, bool $self_close = false, array $attr = array(), string $content = '') {
  $html = "<$tag";
  foreach ($attr as $key => $value) {
    if ($key !== 'attr') {
      $html .= " $key=\"$value\"";
    } else {
      $html .= " $value";
    }
  }
  if (!$self_close) {
    $html .= ">$content</$tag>";
  } else {
    $html .= ' />';
  }
  return $html . PHP_EOL;
}

/**
 * 加载资源文件
 *
 * @access public
 * @param string $rel 加载类型
 * @param string $href 资源地址
 * @param string $crossorigin 跨域设置
 * @param string $as 资源类型
 * @param string $integrity 校验值
 * @param string $local_attr 其他属性
 * @return string 直接返回资源标签
 */
function genLinkTag(string $rel, string $href, string $crossorigin = '', string $as = '', string $integrity = '', string $local_attr = '') : string {
  $attr['rel'] = $rel;
  $attr['href'] = $href;
  if (!empty($crossorigin)) $attr['crossorigin'] = $crossorigin;
  if (!empty($as)) $attr['as'] = $as;
  if (!empty($integrity)) $attr['integrity'] = $integrity;
  if (!empty($local_attr)) $attr['attr'] = $local_attr;

  return genTAG('link', true, $attr);
}

/**
 * 生成图标标签
 *
 * @access public
 * @param string $icon 图标名称
 * @param ?string $css_class css 类名
 * @return string 图标标签
 */
function genIconTag(string $icon, ?string $css_class = 'material-icons') : string {
  $css_class = 'mdui-icon ' . $css_class;
  return genTAG('i', false, ['class' => $css_class], $icon);
}

/**
 * 生成按钮标签
 *
 * @access public
 * @param string $text 按钮内部内容
 * @param ?string $css_class css 类名
 * @param ?string $type 类型
 * @param ?string $attr 其他参数
 * @return string 图标标签
 */
function genBtnTag(string $text, ?string $css_class = '', ?string $type = 'button' ,?string $attr = '') {
  $css_class = 'mdui-btn mdui-ripple ' . $css_class;
  return genTAG('button', false, ['class' => $css_class, 'type' => $type, 'attr' => $attr], _t($text));
}

/**
 * 生成版权信息所需的 span 标签
 *
 * @access public
 * @param string $text 内容
 * @return string span 标签
 */
function genCopyrightSpanTag(string $text) : string {
  return genTAG('span', false, ['class' => 'mdui-text-color-theme-text'], _t($text)) . genTAG('br', true);
}

/**
 * 生成超链接标签
 *
 * @access public
 * @param string $text 文本内容
 * @param string $url 链接地址
 * @param ?string $css_class css 类名
 * @param ?string $local_attr 其他参数
 * @return string 超链接标签
 */
function genATag(string $text, string $url, ?string $css_class = '', ?string $local_attr = '') : string {
  $attr['href'] = $url;
  if (!empty($css_class)) $attr['class'] = $css_class;
  if (!empty($local_attr)) $attr['attr'] = $local_attr;
  return genTAG('a', false, $attr, _t($text));
}
