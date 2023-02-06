<?php
  if (!defined('__TYPECHO_ROOT_DIR__')) exit;
  $this->need('template/header.php'); ?>
  <div class="better-blank"></div>
  <div class="mdui-card mdui-hoverable post postCard">
    <div class="mdui-card-primary">
      <h1 class="mdui-card-primary-title mdui-text-center"><?php _e('非常抱歉，你要找的页面不见啦！'); ?></h1>
      <br>
      <h3><?php _e('如果你是访客：（可能原因）'); ?></h3>
      <p><?php _e('1、该页面被删除'); ?></p>
      <p><?php _e('2、该页面被转移'); ?></p>
      <p><?php _e('3、该页面不存在'); ?></p>
      <form method="post">
        <div class="mdui-textfield mdui-textfield-floating-label">
          <h3><?php _e('或许你可以尝试搜索一下？'); ?></h3>
          <label for="textarea" class="mdui-textfield-label"><?php _e('请在这里输入你想搜索的内容吧'); ?></label>
          <input name="s" id="textarea" class="mdui-textfield-input" />
        </div>
        <?php _e(genBtnTag('搜索', 'mdui-btn-block mdui-text-color-theme', 'submit')) ?>
      </form>
    </div>
  </div>
  <div class="better-blank"></div>
<?php $this->need('template/footer.php'); ?>
