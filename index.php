<?php
/**
 * 道阻且长,行则将至。
 *
 * @package Better
 * @author Star_caorui
 * @version 0.1
 * @link https://web-worker.cn/Project/Better.html
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
  $this->need('template/header.php'); ?>
      <div class="postList"><?php while($this->next()): ?>

        <div class='better-save-white'></div>
        <div class="mdui-card mdui-hoverable postCard">
          <div class="postCard-left">
            <div class="mdui-card-media">
              <div class="postCard-img">
                <img src="<?php print_r(randomImg().'?'); echo rand(0,10000); ?>" loading="lazy" />
              </div>
              <div class="mdui-card-media-covered postTitle-Small">
                <div class="mdui-card-primary">
                  <div class="mdui-card-primary-title">
                    <a class="mdui-card-primary-title mdui-text-color-theme-accent" href="<?php $this->permalink() ?>"><?php $this->sticky(); echo '['; $this->category(',', false); echo ']'; $this->title(); ?></a>
                  </div>
                  <div class="mdui-card-primary-subtitle">
                    <?php _e('作者'); ?> <a class='mdui-text-color-theme-accent' href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> |
                    <?php _e('时间'); ?> <time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date(); ?></time>
                  </div>
                </div>
              </div>
            </div>
            <div class="mdui-card-menu">
              <button class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons mdui-text-color-theme-icon">share</i></button>
            </div>
          </div>
          <div class="postCard-right">
            <div class="postTitle-and-postContent">
              <div class="mdui-card-primary postTitle">
                <a class="mdui-card-primary-title mdui-text-color-theme-accent" href="<?php $this->permalink() ?>"><?php $this->sticky(); echo '['; $this->category(',', false); echo ']'; $this->title(); ?></a>
              </div>
              <div class="mdui-card-content mdui-p-t-0 postContent"><?php $this->excerpt(60, '...'); ?></div>
            </div>
            <div class="mdui-card-actions postActions">
              <div class="mdui-divider underline"></div>
              <div class="widget">
                <i class="mdui-icon material-icons mdui-text-color-theme-icon">comment</i>
                <a class="mdui-text-color-theme-text" href="<?php $this->permalink() ?>#comments"><?php $this->commentsNum('%d'); ?></a>&nbsp;&nbsp;
                <i class="mdui-icon material-icons mdui-text-color-theme-icon">access_time</i>
                <span class="mdui-text-color-theme-text"><?php $this->date(); ?></span>
              </div>
              <a class="mdui-btn mdui-ripple mdui-float-right mdui-text-color-theme-accent read-more" href="<?php $this->permalink() ?>"><?php _e('阅读')?></a>
              <br />
            </div>
          </div>
        </div><?php endwhile; ?>

        <div class='better-save-white'></div>
      </div>
  <?php $this->need('template/pageTurner.php'); $this->need('template/footer.php'); ?>
