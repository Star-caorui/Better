<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div><?php $this->comments()->to($comments); ?><?php if($this->allow('comment')): ?>

          <div id="<?php $this->respondId(); ?>" class="mdui-card mdui-hoverable postCard">
            <div class="mdui-card-primary">
              <!-- 此处代码我也不知道干啥的 -->
              <div class="cancel-comment-reply">
                <?php $comments->cancelReply(); ?>
              </div>
              <!-- 此处代码我也不知道干啥的 -->
              <div class="mdui-card-primary-title"><?php _e('添加新评论'); ?></div>
                <form id="comment-form" class="mdui-p-a-2" role="form" method="post" action="<?php $this->commentUrl() ?>"><?php if($this->user->hasLogin()): ?>

                  <div><?php _e('登录身份: '); ?>
                    <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>
                    <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?></a>
                  </div><?php else: ?>

                  <div class="mdui-textfield">
                    <label for="author" class="mdui-textfield-label"><?php _e('昵称'); ?></label>
                    <input id="author" class="mdui-textfield-input" name="author" type="text" value="<?php $this->remember('author'); ?>" required/>
                    <div class="mdui-textfield-error">您尚未输入昵称，昵称不能是空哦～</div>
                  </div>
                  <div class="mdui-textfield">
                    <label for="mail" class="mdui-textfield-label"><?php _e('Email'); ?></label>
                    <input id="mail" class="mdui-textfield-input" name="mail" type="email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?>/>
                    <div class="mdui-textfield-error">您输入的不是一个合法邮箱地址哦～</div>
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
                <div class="article-page mdui-typo">
                <?php $comments->listComments(); ?>
                <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
                </div>
              </div>
            </div><?php endif; ?>

          </div>
