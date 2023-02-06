<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html lang="zh-cmn-Hans">
<head>
<meta charset="<?php $this->options->charset(); ?>" />
<meta name="renderer" content="webkit" />
<meta name="force-rendering" content="webkit" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />
<link rel="manifest" href="<?php $this->options->themeUrl('src/manifest.json'); ?>" />
<?php if ($this->is('post')) : ?>
<meta property="og:locale" content="zh_CN">
<meta property="og:type" content="article" />
<meta property="article:published_time" content="<?php _e(date('c', $this->created)); ?>" />
<meta property="article:modified_time" content="<?php _e(date('c', $this->modified)); ?>" />
<meta property="article:author" content="<?php $this->author(); ?>" />
<meta property="article:published_first" content="<?php $this->options->title() ?>, <?php $this->permalink() ?>" />
<meta property="og:title" content="<?php $this->title() ?>" />
<meta property="og:url" content="<?php $this->permalink() ?>" />
<?php endif; $this->header('pingback=&xmlrpc=&wlw=&rss2=&rss1='); if ($this->is('single')) _e(PHP_EOL); ?>
<title><?php toolkit::title_prefix($this, ' - '); $this->options->title(); ?></title>
<?php
  function preconnect($url) {
    _e(genLinkTag('dns-prefetch', $url));
    _e(genLinkTag('preconnect', $url, 'anonymous'));
  }

  preconnect('https://api.inetech.fun');

  switch ($this->options->staticFiles) {
    case 'jsdelivr':
      preconnect('//cdn.jsdelivr.net');
      break;
    case 'github':
      preconnect('//raw.githubusercontent.com');
      break;
  }

  // 预加载静态资源
  _e(genLinkTag('preload', toolkit::staticFiles('css/mdui.min.css?') . MDUI_VERSION, 'anonymous', 'style', 'sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw'));
  _e(genLinkTag('preload', toolkit::staticFiles('css/md2.css?') . __THEME_VERSION__, 'anonymous', 'style'));
  _e(genLinkTag('preload', toolkit::staticFiles('css/Better.css?') . __THEME_VERSION__, 'anonymous', 'style'));
  if (filesize(dirname(dirname(__FILE__)) . '/src/css/custom.css') > 0) {
    _e(genLinkTag('preload', $this->options->themeUrl . '/src/css/custom.css', 'anonymous', 'style'));
  }

  // 加载静态资源
  _e(genLinkTag('stylesheet', toolkit::staticFiles('css/mdui.min.css?') . MDUI_VERSION, 'anonymous', '', 'sha384-cLRrMq39HOZdvE0j6yBojO4+1PrHfB7a9l5qLcmRm/fiWXYY+CndJPmyu5FV/9Tw'));
  _e(genLinkTag('stylesheet', toolkit::staticFiles('css/md2.css?') . __THEME_VERSION__, 'anonymous'));
  _e(genLinkTag('stylesheet', toolkit::staticFiles('css/Better.css?') . __THEME_VERSION__, 'anonymous'));
  if (filesize(dirname(dirname(__FILE__)) . '/src/css/custom.css') > 0) {
    _e(genLinkTag('stylesheet', $this->options->themeUrl . '/src/css/custom.css', 'anonymous'));
  }

  // 仅在 文章页面/独立页面 中加载 代码高亮 的 CSS 资源文件
  if ($this->is('single')) {
    _e(genLinkTag('stylesheet', toolkit::staticFiles('css/atom-one-light.min.css?') . HIGHLIGHT_VERSION, 'anonymous', '', 'sha384-c0jGChqOfkWMSoSFNGdcErdZrbpiGj6dlAQgb59KF6Gfv0MbdgjODDCuCKWuVwZ7'));
    _e(genLinkTag('stylesheet', toolkit::staticFiles('css/atom-one-dark.min.css?') . HIGHLIGHT_VERSION, 'anonymous', '', 'sha384-2mVv4U5XTQ0ho/MFZzqOUxDkbF3lvml7hD1lGfOXf3LqbpSPcBrg0Gic+c40NTem', 'media="(prefers-color-scheme: dark)"'));
  }
?>
<!--[if lte IE 9]>
  <div class="better-blank mdui-card postCard mdui-card-primary">
    <h1 class="mdui-card-primary-title mdui-text-center"><?php _e('当前网页 <strong>不兼容</strong> 你正在使用的浏览器。 <br /> 请 <a href="https://browsehappy.com/">升级你的浏览器</a> 获得更佳的浏览体验。'); ?></h1>
  </div>
<![endif]-->
</head>
