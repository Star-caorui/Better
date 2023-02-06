<div class="postList">
  <?php if ($this->is('archive')) : ?>
    <div class='better-blank'></div>
    <div class="mdui-card mdui-hoverable postCard">
      <div class="mdui-card-primary">
        <h1 class="mdui-card-primary-title mdui-text-center"><?php toolkit::title_prefix($this); ?></h1>
      </div>
    </div>
  <?php endif; if ($this->have()) : while ($this->next()) : ?>
    <div class='better-blank'></div>
    <div class="mdui-card mdui-hoverable postCard">
      <div class="postCard-left">
        <div class="mdui-card-media">
          <div class="postCard-img">
            <img src="<?php _e(toolkit::randomImg()); ?>" loading="lazy" alt="封面图" />
          </div>
          <div class="mdui-card-media-covered">
            <div class="mdui-card-primary">
              <div class="mdui-card-primary-title">
                <a class="mdui-card-primary-title mdui-text-color-theme-accent" href="<?php $this->permalink() ?>">
                  [<?php $this->category(',', false); ?>]
                  <?php $this->title(); ?>
                </a>
              </div>
              <div class="mdui-card-primary-subtitle">
                <?php _e('作者'); ?> <a class='mdui-text-color-theme-accent' href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> |
                <?php _e('浏览量'); ?> <?php _e(toolkit::getViews($this)); ?> |
              </div>
            </div>
          </div>
        </div>
        <!-- // TODO 分享按钮
        <div class="mdui-card-menu">
          <?php _e(genBtnTag(genIconTag('share', 'material-icons mdui-text-color-theme-icon'), 'mdui-btn-icon')); ?>
        </div>
        -->
      </div>
      <div class="postCard-right">
        <div class="postTitle-and-postContent">
          <div class="mdui-card-content mdui-p-t-0 postContent"><?php $this->excerpt(110, '...'); ?></div>
        </div>
        <div class="mdui-card-actions postActions">
          <div class="mdui-divider underline"></div>
          <div class="widget">
            <span class="mdui-text-color-theme-text">
              <?php _e(genIconTag('access_time', 'material-icons mdui-text-color-theme-icon'));
              $this->date(); ?>
            </span>
            <a class="mdui-btn mdui-btn-dense mdui-ripple mdui-text-color-theme-text" href="<?php $this->permalink() ?>#comments">
              <?php _e(genIconTag('comment', 'material-icons mdui-text-color-theme-icon'));
              $this->commentsNum('%d'); ?>
            </a>
          </div>
          <a class="mdui-btn mdui-ripple mdui-float-right mdui-text-color-theme-accent read-more" href="<?php $this->permalink() ?>"><?php _e('阅读') ?></a>
          <br />
        </div>
      </div>
    </div><?php endwhile; ?><?php else : ?>
    <div class='better-blank'></div>
    <div class="mdui-card mdui-hoverable postCard">
      <div class="mdui-card-primary">
        <h1 class="mdui-card-primary-title mdui-text-center">很抱歉，暂无搜索结果。</h1>
      </div>
    </div><?php endif; ?>

    <div class='better-blank'></div>
</div>
