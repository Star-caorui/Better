<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 「友链」页面
 *
 * @author Stsr_caorui
 * @for Star-caorui/Better
 *
 * @package custom
 */

$this->need('template/header.php'); ?>
  <div class="better-blank"></div>
  <div class="mdui-card mdui-hoverable postCard">
    <div class="mdui-card-media">
      <div class="page-img">
        <img src="<?php _e(toolkit::randomImg()); ?>"/>
      </div>
      <div class="mdui-card-menu">
        <?php _e(genBtnTag(genIconTag('share'), 'mdui-btn-icon mdui-text-color-white')); ?>
      </div>
      <div class="mdui-card-media-covered">
        <div class="mdui-card-primary">
          <div class="mdui-card-primary-title mdui-text-truncate"><?php $this->title() ?></div>
        </div>
      </div>
    </div>
    <div class="article-page mdui-typo"><?php $this->content(); $this->links("SHOW_MIX"); ?></div>
  </div>
  <div class="better-blank"></div>
  <?php $this->need('template/comments.php'); ?>
<?php $this->need('template/footer.php'); ?>
