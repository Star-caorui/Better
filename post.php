<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('template/header.php'); ?>
        <div class="post">
          <div class="better-save-white"></div>
          <div class="mdui-card mdui-hoverable postCard">
            <div class="mdui-card-media">
              <div class="page-img">
                <img src="<?php print_r(randomImg().'?'); echo rand(0,10000); ?>">
              </div>
              <div class="mdui-card-menu">
                <button class="mdui-btn mdui-btn-icon mdui-text-color-white">
                  <i class="mdui-icon material-icons">share</i>
                </button>
              </div>
              <div class="mdui-card-media-covered">
                <div class="mdui-card-primary">
                  <div class="mdui-card-primary-title mdui-text-truncate"><?php $this->title() ?></div>
                  <div class="mdui-card-primary-subtitle">
                    <?php _e('作者'); ?> <a class='mdui-text-color-theme-accent' href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> |
                    <?php _e('时间'); ?> <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                  </div>
                </div>
              </div>
            </div>
            <div class="article-page mdui-typo"><?php $this->content(); ?></div>

            <!-- 翻页器开始: 目前不完善，尚未适配小尺寸设备。 -->
            <!--<div class="better-center-box mdui-center">
            <div class='mdui-btn mdui-ripple mdui-shadow-5 mdui-float-left'>
            上一篇：<?php $this->thePrev('%s','沒有了'); ?>
            </div>
            <div class='mdui-btn mdui-ripple mdui-shadow-5 mdui-float-right'>
            下一篇：<?php $this->theNext('%s','没有了'); ?>
            </div>
          </div>
            <div class="better-save-white"></div>-->
            <!-- 翻页器结束 -->
            <?php //$this->tags(', ', true, 'none'); ?>

          </div>
          <div class="better-save-white"></div>
          <?php $this->need('template/comments.php'); ?>
        </div>
<?php $this->need('template/footer.php'); ?>
