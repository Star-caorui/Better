<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Links
 *
 * @author Stsr_caorui
 * @for Star-caorui/Better
 *
 * @package custom
 */

$this->need('template/header.php'); ?>
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
        </div>
      </div>
    </div>
    <div class="article-page mdui-typo"><?php $this->content(); ?><?php $this->links("SHOW_MIX"); ?></div>
  </div>
  <div class="better-save-white"></div>
  <?php $this->need('template/comments.php'); ?>
</div>
<?php $this->need('template/footer.php'); ?>
