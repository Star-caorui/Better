<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
  <!-- 分页器开始 基于 ohmyga 开发的 Castle 二改 -->
  <div class="better-center-flow mdui-text-center">
    <?php if ($this->_currentPage>1){ ?>
      <?php $this->pageLink('<button class="mdui-btn mdui-btn-icon mdui-ripple mdui-color-theme-accent mdui-shadow-5 mdui-float-left"><i class="mdui-icon material-icons">navigate_before</i></button>','prev'); ?>
    <?php }else{ ?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple mdui-color-theme-accent mdui-shadow-5 mdui-btn-raised mdui-float-left" disabled><i class="mdui-icon material-icons">navigate_before</i></button>
    <?php } ?>
    <button class="mdui-btn mdui-text-center"><?php if($this->_currentPage>1) echo $this->_currentPage;  else echo 1;?> / <?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?></button>
    <?php if ($this->_currentPage<ceil($this->getTotal()/$this->parameter->pageSize)){ ?>
      <?php $this->pageLink('<button class="mdui-btn mdui-btn-icon mdui-ripple mdui-color-theme-accent mdui-shadow-5 mdui-float-right"><i class="mdui-icon material-icons">navigate_next</i></button>','next'); ?>
    <?php } else { ?>
      <button class="mdui-btn mdui-btn-icon mdui-ripple mdui-color-theme-accent mdui-btn-raised mdui-shadow-5 mdui-float-right" disabled><i class="mdui-icon material-icons">navigate_next</i></button>
    <?php } ?>
  </div>
  <!-- 分页器结束 -->
