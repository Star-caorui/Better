<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';  //如果是文章作者的评论添加 .comment-by-author 样式
        } else {
            $commentClass .= ' comment-by-user';  //如果是评论作者的添加 .comment-by-user 样式
        }
    }
    $commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';  //评论层数大于0为子级，否则是父级
?>
            <div class="better-save-white"></div>
            <div class="mdui-card mdui-hoverable postCard">
              <div id="<?php $comments->theId(); ?>" class="mdui-card">
                <div class="mdui-card-header">
                  <img class="mdui-card-header-avatar" src="<?php echo getCommentAvatar($comments->mail); ?>" loading="lazy">
                  <div class="mdui-card-header-title mdui-typo"><?php echo (getQQNickname($comments->mail)&&$comments->author!==getQQNickname($comments->mail)) ? $comments->author().' (QQ昵称:'.getQQNickname($comments->mail).')' : $comments->author(); ?></div>
                  <div class="mdui-card-header-subtitle">[设备型号] [系统版本] [浏览器版本]</div>
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
              <?php if ($comments->children) { $comments->threadedComments($options); } ?>
            </div><?php } ?>
            
<div><?php $this->comments()->to($comments); ?><?php if($this->allow('comment')): ?>

          <div id="<?php $this->respondId(); ?>" class="mdui-card mdui-hoverable postCard">
            <div class="mdui-card-primary">
              <div class="mdui-card-menu">
                <div class="cancel-comment-reply">
                  <button class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons mdui-text-color-theme-icon"><?php $comments->cancelReply('close'); ?></i></button>
                </div>
              </div>
              <div class="mdui-card-primary-title"><?php _e('添加新评论'); ?></div>
                <form id="comment-form" class="mdui-p-a-2" role="form" method="post" action="<?php $this->commentUrl() ?>"><?php if($this->options->commentAvatar === 'priorityUseQQAvatar') : ?><div>Better隐私保护：当前站点正通过QQ邮箱获取您的QQ头像，但QQ头像会泄露您的QQ号，建议使用其他邮箱来保护您的隐私。</div><br/><?php endif; if($this->user->hasLogin()): ?>

                  <div class="mdui-typo"><?php _e('登录身份: '); ?>
                    <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>
                    <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?></a>
                  </div><?php else: ?>

                  <div class="mdui-row">
                    <div class="mdui-textfield mdui-col-sm-6">
                      <label for="author" class="mdui-textfield-label"><?php _e('昵称'); ?></label>
                      <input id="author" class="mdui-textfield-input" name="author" type="text" value="<?php $this->remember('author'); ?>" required/>
                      <div class="mdui-textfield-error">您尚未输入昵称，昵称不能是空哦～</div>
                    </div>
                    <div class="mdui-textfield mdui-col-sm-6">
                      <label for="mail" class="mdui-textfield-label"><?php _e('Email'); ?></label>
                      <input id="mail" class="mdui-textfield-input" name="mail" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>/>
                      <div class="mdui-textfield-error">您输入的不是一个合法邮箱地址哦～</div>
                    </div>
                  </div>
                  <div class="mdui-textfield">
                    <label for="url" class="mdui-textfield-label"><?php _e('网站'); ?></label>
                    <input type="url" name="url" id="url" class="mdui-textfield-input" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?>/>
                    <div class="mdui-textfield-error">您尚未输入网址，网址不能是空哦～</div>
                  </div><?php endif; ?>

                  <div class="mdui-textfield">
                    <label for="textarea" class="mdui-textfield-label"><?php _e('内容'); ?></label>
                    <textarea id="textarea" class="mdui-textfield-input" name="text" type="text" rows="4" required><?php $this->remember('text'); ?></textarea>
                    <div class="mdui-textfield-error">您尚未输入评论，评论不能是空哦～</div>
                  </div>
                  <button type="submit" class="mdui-btn mdui-btn-block mdui-ripple mdui-text-color-theme"><?php _e('提交评论'); ?></button>
                </form>
              </div>
            </div>
            <div class="better-save-white"></div><?php else: ?>

            <div class="mdui-card mdui-hoverable postCard">
              <div class="mdui-card-primary">
                <div class="mdui-card-primary-title"><?php _e('评论已关闭'); ?></div>
              </div>
            </div><?php endif; ?><?php if ($comments->have()): ?>

            <div class="mdui-card mdui-hoverable postCard">
              <div class="mdui-card-primary">
                <div class="mdui-card-primary-title"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></div>
              </div>
            </div><?php $comments->listComments(); $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); endif; ?>

          </div>
