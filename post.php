<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('template/header.php'); ?>
        <div class="post">
          <div class="better-save-white"></div>
          <div class="mdui-card mdui-hoverable postCard">
            <div class="mdui-card-media">
              <div class="page-img">
                <img src="<?php print_r(randomImg()); ?>"/>
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
                    <?php _e('浏览量'); ?> <?php get_post_view($this) ?> |                  </div>
                </div>
              </div>
            </div>
            <div class="article-page mdui-typo">
            <?php $modified = intval((time() - $this->modified) / 86400); $created = intval((time() - $this->created) / 86400); if ($this->fields->timeoutCheck() !== 'disable' && $modified > 30) : echo "<blockquote class='mdui-text-color-theme-accent'>请注意，本文编写于<span class='mdui-text-color-red-accent'> {$created} </span>天前，最后修改于<span class='mdui-text-color-red-accent'> {$modified} </span>天前，其中某些信息可能已经过时。</blockquote><hr/>"; endif; $this->content(); ?>

              <div class="article-copy mdui-text-color-theme-accent">
                版权所属<span class="mdui-text-color-black">：<a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></span><br/>
                本文作者<span class="mdui-text-color-black">：<a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a></span><br/>
                本文链接<span class="mdui-text-color-black">：<a href="<?php $this->permalink() ?>"><?php $this->permalink() ?></a></span><br/>
                版权声明<span class="mdui-text-color-black">：<?php if (empty($this->options->articleCopy)) : echo "本文版权由本文作者独占，禁止出于任何目的去使用，修改，和分享。"; else : $this->options->articleCopy(); endif; ?></span>
              </div>
            </div>

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
