<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
  $_lastPage = ceil($this->getTotal() / $this->parameter->pageSize);
  function getButton(string $direction, string $status = '') {
    if ($direction === 'left') $icon_name = 'navigate_before';
    if ($direction === 'right') $icon_name = 'navigate_next';
    return genBtnTag(genIconTag($icon_name), 'mdui-btn-icon mdui-color-theme-accent mdui-shadow-5 mdui-btn-raised mdui-float-'.$direction, 'button', $status);
  }
?>

<div class="better-center-flow mdui-text-center">
  <?php ($this->_currentPage > 1) ? $this->pageLink(getButton('left'),'prev') : _e(getButton('left', 'disabled'));
    _e(genBtnTag($this->_currentPage . '/' . $_lastPage, 'mdui-text-center'));
    ($this->_currentPage < $_lastPage) ? $this->pageLink(getButton('right'),'next') : _e(getButton('right', 'disabled')); ?>
</div>
