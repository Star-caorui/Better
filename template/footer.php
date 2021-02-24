<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div>
  </div>
</div>
<div class='better-save-white'></div>
<footer class="better-center-flow">
  <div class="footer-left mdui-col-xs-3 mdui-valign">
    <div class="mdui-center">
      <?php if (!empty($this->options->footerInfoLeft) && in_array('showMail', $this->options->footerInfoLeft)): ?>
        <a href="mailto:<?php print_r($this->options->mailInfo); ?>" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '<?php _e("电子邮箱"); ?>'}" target="_blank"><i class="mdui-icon material-icons info-icon">mail_outline</i></a>
      <?php endif; ?>
    </div>
  </div>
  <div class="footer-center mdui-col-xs-6 mdui-valign">
     <div class="mdui-center">
       <div class="mdui-text-center">
         Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
       </div>
       <br />
       <div id="RunTime" class="mdui-text-center"></div>
     </div>
   </div>
   <div class="footer-right mdui-col-xs-3 mdui-valign">
     <div class="mdui-center">
       <div>
         <?php 
           if (!empty($this->options->footerInfoRight)) {
             if (in_array('showICPBeian', $this->options->footerInfoRight)) {
               print_r($this->options->icpBeian.PHP_EOL);
             }
             if (in_array('showBeian', $this->options->footerInfoRight)) {
               print_r('         '.$this->options->beian.PHP_EOL);
             }
             if (in_array('showBeian', $this->options->footerInfoRight)) {
               print_r('         '.'<a href="https://icp.gov.moe" target="_blank"><img src="https://icp.gov.moe/images/ico64.png" alt="萌ICP备案的Logo" style="vertical-align: middle;" width="20" height="20">萌ICP备 </a>'.PHP_EOL);
               print_r('         '.$this->options->moeBeian.PHP_EOL);
             }
           }
         ?>
       </div>
       <div>
         Powered by <a href="http://typecho.org/" target="_blank">Typecho</a>
       </div>
       <div>
         Theme <a href="https://web-worker.cn/Project/Better.html" target="_blank">Better</a> By <a href="https://web-worker.cn" target="_blank">Star_caorui</a><br />
       </div>
     </div>
   </div>
</footer>
<div class='better-save-white'></div>

<!-- JavaScript -->
<script
  src="<?php print_r(defaultStaticFiles('js/mdui.min.js?'.MDUI_VERSION)); ?>"
  crossorigin="anonymous"
  integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"
></script>
<script
  src="<?php print_r(defaultStaticFiles('js/highlight.min.js?'.HIGHLIGHT_VERSION)); ?>"
  crossorigin="anonymous"
  integrity="sha384-w8gmmdGHCqDJR/Bc+rE9AXKciU5qx2pqcVux6l4pSU26xoMsNz+Q3zoty8OFJG11"
></script>
<script src="<?php print_r(defaultStaticFiles('js/Better.js?').THEME_VERSION); ?>"></script>

<?php $this->footer(); ?>
</body>
</html>
