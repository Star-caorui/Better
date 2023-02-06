<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; $this->need('module/head.php');
// TODO 此文件需要被重写
?>
<body class="mdui-appbar-with-toolbar mdui-theme-layout-auto mdui-theme-primary-white mdui-theme-accent-blue">
<div class="mdui-appbar mdui-appbar-fixed mdui-appbar-scroll-toolbar-hide mdui-appbar-inset">
  <div class="mdui-toolbar  mdui-color-theme titleBar">
    <a class="mdui-btn mdui-btn-icon mdui-hidden-md-up" mdui-drawer="{target: '#menu',overlay:true,swipe:true}">
      <?php _e(genIconTag('menu', 'material-icons mdui-text-color-theme-icon')); ?>
    </a>
    <a class="mdui-typo-title mdui-text-color-theme-text" href="<?php $this->options->siteUrl(); ?>" title="<?php $this->options->title() ?>"><?php $this->options->title() ?></a><?php $this->widget('Widget_Contents_Page_List')->to($pages); ?><?php while ($pages->next()): ?>

    <a class='mdui-typo-subheading mdui-text-color-theme-text mdui-hidden-sm-down' href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a><?php endwhile; ?>
    <div class="mdui-toolbar-spacer"></div>
    <!-- TODO: Search 待修改 -->
    <div class="mdui-textfield mdui-textfield-expandable mdui-float-right mdui-text-color-theme-text search">
      <form method="post" action="<?php $this->options->siteUrl(); ?>">
        <input class="mdui-textfield-input mdui-text-color-theme-text" type="text" name="s" aria-label="Search" placeholder="<?php _e('搜索'); ?>"/>
        <button type="submit" class="submit mdui-hidden"><?php _e('搜索'); ?></button>
      </form>
      <button class="mdui-textfield-icon mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons mdui-text-color-theme-icon">search</i></button>
      <button class="mdui-textfield-close mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons mdui-text-color-theme-icon">close</i></button>
    </div>
    <!-- TODO: Menu Button 待完善
    <button href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple mdui-hidden-xs">
      <i class="mdui-icon material-icons mdui-text-color-theme-icon">devices</i>
    </button>
    <button href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple mdui-hidden-xs">
      <i class="mdui-icon material-icons mdui-text-color-theme-icon">rss_feed</i>
    </button>
    <button href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple mdui-hidden-xs">
      <i class="mdui-icon material-icons mdui-text-color-theme-icon">color_lens</i>
    </button>
    <button class="mdui-btn mdui-btn-icon mdui-ripple mdui-hidden-sm-up" mdui-menu="{target: '#more-tools'}">
      <i class="mdui-icon material-icons mdui-text-color-theme-icon">more_vert</i>
    </button>
    -->
    <!-- TODO: Menu 待完善
    <ul class="mdui-menu" id="more-tools">
      <li class="mdui-menu-item">
        <a href="javascript:;" class="mdui-ripple mdui-text-color-theme-text">
          <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-theme-icon">devices</i>跨设备阅读
        </a>
      </li>
      <li class="mdui-menu-item">
        <a href="javascript:;" class="mdui-ripple mdui-text-color-theme-text">
          <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-theme-icon">rss_feed</i><?php _e('RSS 订阅'); ?>
        </a>
      </li>
      <li class="mdui-menu-item">
        <a href="javascript:;" class="mdui-ripple mdui-text-color-theme-text">
          <i class="mdui-menu-item-icon mdui-icon material-icons mdui-text-color-theme-icon">color_lens</i>更改配色
        </a>
      </li>
    </ul>
    -->
  </div>
</div>

<div class="mdui-drawer mdui-drawer-full-height mdui-drawer-close mdui-color-auto mdui-hidden-md-up" id="menu">
  <div class="mdui-list">
    <div class="mdui-card-header">
      <img class="mdui-card-header-avatar" src="<?php $this->options->sitebarLogo(); ?>" loading="lazy" alt="<?php _e('博主自行设置的头像'); ?>" />
      <div class="mdui-card-header-title mdui-text-color-theme-text"><?php $this->author() ?></div>
      <div class="mdui-card-header-subtitle mdui-text-color-theme-text"><?php $this->options->description() ?></div>
    </div>
    <div class="mdui-divider"></div>
    <a class="mdui-list-item mdui-ripple<?php if ($this->is('index')): ?> mdui-list-item-active mdui-color-theme-a100<?php endif; ?>" href="<?php $this->options->siteUrl(); ?>">
      <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-theme-icon">home</i>
      <div class="mdui-list-item-content mdui-text-color-theme-text"><?php _e('首页'); ?></div>
    </a>
  </div><?php $this->widget('Widget_Contents_Page_List')->to($pages); ?><?php while ($pages->next()): ?>
    <a class="mdui-list-item mdui-ripple<?php if($this->is('page', $pages->slug)): ?> mdui-list-item-active mdui-color-theme-a100<?php endif; ?>" href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>">
      <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-theme-icon"></i>
      <div class="mdui-list-item-content mdui-text-color-theme-text"><?php $pages->title(); ?></div>
    </a><?php endwhile; ?>
  </div>
</div>

<div id="body">
  <div class="mdui-container container">
    <div class="mdui-row">
