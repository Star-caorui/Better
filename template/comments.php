<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options)
{
  $commentClass = '';
  if ($comments->authorId) {
    if ($comments->authorId == $comments->ownerId) {
      $commentClass .= ' comment-by-author';
    } else {
      $commentClass .= ' comment-by-user';
    }
  }
  $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
?>
  <div class="better-blank"></div>
  <div class="mdui-card mdui-hoverable postCard">
    <div id="<?php $comments->theId(); ?>" class="mdui-card">
      <div class="mdui-card-header">
        <img class="mdui-card-header-avatar" src="<?php echo toolkit::getAvatar($comments->mail);  ?>" loading="lazy" onerror="this.onerror=null;this.src='<?php echo toolkit::getAvatar($comments->mail, true); ?>';">
        <div class="mdui-card-header-title mdui-typo"><?php echo toolkit::getNickname($comments->author, $comments->mail); ?></div>
        <div class="mdui-card-header-subtitle"><?php echo "正在热修复.jpg"; //UserAgent_Plugin::render($comments->agent);
                                                ?></div>
      </div>
      <div class="mdui-card-content mdui-typo"><?php $comments->content(); ?></div>
      <div class="mdui-card-actions">
        <span>
          <i class="mdui-icon material-icons mdui-text-color-theme-icon"> access_time</i>
          <?php $comments->date('Y-m-d H:i'); ?>
        </span>
        <button class="mdui-btn mdui-ripple mdui-float-right mdui-typo"><?php $comments->reply(); ?></button>
      </div>
    </div>
    <?php if ($comments->children) {
      $comments->threadedComments($options);
    } ?>
  </div><?php } ?>

<div><?php $this->comments()->to($comments); ?><?php if ($this->allow('comment')) : ?>

  <div id="<?php $this->respondId(); ?>" class="mdui-card mdui-hoverable postCard">
    <div class="mdui-card-primary">
      <div class="mdui-card-menu">
        <div class="cancel-comment-reply">
          <button class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons mdui-text-color-theme-icon"><?php $comments->cancelReply('close'); ?></i></button>
        </div>
      </div>
      <div class="mdui-card-primary-title"><?php _e('添加新评论'); ?></div>
      <form id="comment-form" class="mdui-p-a-2" role="form" method="post" action="<?php $this->commentUrl() ?>"><?php if ($this->user->hasLogin()) : ?>

          <div class="mdui-typo"><?php _e('登录身份: '); ?>
            <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>
            <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?></a>
          </div><?php else : ?>

          <div class="mdui-row">
            <div class="mdui-textfield mdui-col-sm-6">
              <label for="author" class="mdui-textfield-label"><?php _e('昵称'); ?></label>
              <input id="author" class="mdui-textfield-input" name="author" type="text" value="<?php $this->remember('author'); ?>" required />
              <div class="mdui-textfield-error">您没有输入昵称，昵称不能是空哦～</div>
            </div>
            <div class="mdui-textfield mdui-col-sm-6">
              <label for="mail" class="mdui-textfield-label"><?php _e('Email'); ?></label>
              <input id="mail" class="mdui-textfield-input" name="mail" type="email" value="<?php $this->remember('mail'); ?>" <?php if ($this->options->commentsRequireMail) : ?> required<?php endif; ?> />
              <div class="mdui-textfield-error">您的邮箱地址格式不正确哦～</div>
            </div>
          </div>
          <div class="mdui-textfield">
            <label for="url" class="mdui-textfield-label"><?php _e('网站'); ?></label>
            <input type="url" name="url" id="url" class="mdui-textfield-input" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
            <div class="mdui-textfield-error">您没有输入网址，网址不能是空哦～</div>
          </div><?php endif; ?>

        <div class="mdui-textfield">
          <label for="textarea" class="mdui-textfield-label"><?php _e('内容'); ?></label>
          <textarea id="textarea" class="mdui-textfield-input" name="text" type="text" rows="4" required><?php $this->remember('text'); ?></textarea>
          <div class="mdui-textfield-error">您没有输入评论，评论不能是空哦～</div>
        </div>
        <button type="submit" class="mdui-btn mdui-btn-block mdui-ripple mdui-text-color-theme"><?php _e('提交评论'); ?></button>
      </form>
    </div>
  </div>
  <div class="better-blank"></div><?php else : ?>

  <div class="mdui-card mdui-hoverable postCard">
    <div class="mdui-card-primary">
      <div class="mdui-card-primary-title"><?php _e('评论已关闭'); ?></div>
    </div>
  </div><?php endif; ?><?php if ($comments->have()) : ?>

  <div class="mdui-card mdui-hoverable postCard">
    <div class="mdui-card-primary">
      <div class="mdui-card-primary-title"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></div>
    </div>
  </div>
<?php $comments->listComments(array(
                            'before'        =>  '<ol class="comment-list">',
                            'after'         =>  '</ol>',
                            'beforeAuthor'  =>  '',
                            'afterAuthor'   =>  '',
                            'beforeDate'    =>  '',
                            'afterDate'     =>  '',
                            'replyWord'     =>  _t('回复'),
                            'commentStatus' =>  _t('您的评论正等待审核!'),
                            'avatarSize'    =>  32,
                            'defaultAvatar' =>  NULL
                          ));

                          print_r("<div class='better-blank'></div>");
                          $comments->pageNav(
                            '上一页',
                            '下一页',
                            '3',
                            '...',
                            array(
                              'wrapTag'      => 'div',
                              'wrapClass'    => 'better-center-flow mdui-text-center mdui-typo',
                              'itemTag'      => 'button',
                              'textTag'      => 'span class"mdui-text-color-theme-text"',
                              'currentClass' => 'current',
                              'prevClass'    => 'mdui-float-left',
                              'nextClass'    => 'mdui-float-right'
                            )
                          );
                        endif;
?>

</div>
