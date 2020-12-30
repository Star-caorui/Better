<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; $this->need('template/header.php'); ?>
        <div class="better-save-white"></div>
        <div class="mdui-card mdui-hoverable post postCard">
          <div class="mdui-card-primary">
            <h1 class="mdui-card-primary-title mdui-text-center">404 - <?php _e('页面没找到'); ?></h1>
            <h3><?php _e('你想查看的页面已被转移或删除了, 要不要搜索看看: '); ?></h3>
            <form method="post">
              <div class="mdui-textfield mdui-textfield-floating-label">
                <label for="textarea"  class="mdui-textfield-label"><?php _e('输入关键字搜索'); ?></label>
                <input name="s" id="textarea" class="mdui-textfield-input"/>
              </div>
              <button type="submit" class="mdui-btn mdui-btn-block mdui-ripple mdui-text-color-theme"><?php _e('搜索'); ?></button>
            </form>
          </div>
        </div>
        <div class="better-save-white"></div>
<?php $this->need('template/footer.php'); ?>
