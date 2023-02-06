<div class="better-blank"></div>
<div class="mdui-card mdui-hoverable postCard">
  <div class="mdui-card-media">
    <div class="page-img">
      <img src="<?php _e(toolkit::randomImg()); ?>" />
    </div>
    <!-- // TODO 分享按钮
    <div class="mdui-card-menu">
      <?php _e(genBtnTag(genIconTag('share'), 'mdui-btn-icon mdui-text-color-white')); ?>
    </div>
    -->
    <div class="mdui-card-media-covered">
      <div class="mdui-card-primary">
        <div class="mdui-card-primary-title mdui-text-truncate"><?php $this->title() ?></div>
        <?php if ($this->is('post')) : ?>
          <div class="mdui-card-primary-subtitle">
            <?php _e('作者'); ?> <a class='mdui-text-color-theme-accent' href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> |
            <?php _e('浏览量'); ?> <?php _e(toolkit::getViews($this)) ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <div class="article-page mdui-typo">
    <?php
      if ($this->is('post')) {
        toolkit::time_warning($this->fields->timeoutCheck, $this->created, $this->modified);
      }
      $this->content();
      if ($this->is('post')) {
        toolkit::copyInfo($this->permalink, $this->author, $this->author);
      }
    ?>
  </div>
</div>
<div class="better-blank"></div>
