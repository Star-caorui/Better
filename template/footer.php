<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div>
</div>
</div>
<div class='better-blank'></div>
<footer class="better-center-flow">
  <div class="footer-left mdui-col-xs-3 mdui-valign">
    <div class="mdui-center">
      <?php if (!empty($this->options->footerInfoLeft) && in_array('showMail', $this->options->footerInfoLeft)) : ?>
        <a href="mailto:<?php print_r($this->options->mailInfo); ?>" class="mdui-btn mdui-btn-icon mdui-ripple" mdui-tooltip="{content: '<?php _e("电子邮箱"); ?>'}" target="_blank"><i class="mdui-icon material-icons info-icon">mail_outline</i></a>
      <?php endif; ?>
    </div>
  </div>
  <div class="footer-center mdui-col-xs-6 mdui-valign">
    <div class="mdui-center">
      <div id="RunTime" class="mdui-text-center" birthday="<?php if (!empty($this->options->siteBirthday)) print_r($this->options->siteBirthday); ?>"></div>
      <br />
      <div class="mdui-text-center">
        Copyright &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
      </div>
    </div>
  </div>
  <div class="footer-right mdui-col-xs-3 mdui-valign">
    <div class="mdui-center">
      <div>
        <?php
        $codeAlignment = '         ';
        if (!empty($this->options->footerInfoRight)) :
          if (in_array('showICPBeian', $this->options->footerInfoRight)) :
            if (isset($this->options->icpBeian)) {
              print_r('<a href="https://beian.miit.gov.cn/" target="_blank" rel="nofollow">' . $this->options->icpBeian . '</a>' . '<br/>' . PHP_EOL);
            }
          endif;
          if (in_array('showBeian', $this->options->footerInfoRight)) :
            if (isset($this->options->beian)) {
              print_r($codeAlignment . '<a href="https://www.beian.gov.cn/portal/registerSystemInfo?recordcode=' . $this->options->beian . '" target="_blank" rel="nofollow"><img src="https://blog.inetech.fun/usr/themes/Better/src/img/National Emblem of the People\'s Republic of China.png" alt="中华人民共和国国徽" style="vertical-align: middle;" width="20" height="20">蒙公网安备 ' . $this->options->beian . '</a><br/>' . PHP_EOL);
            }
          endif;
          if (in_array('showMoeBeian', $this->options->footerInfoRight)) :
            if (isset($this->options->moeBeian)) {
              print_r($codeAlignment . '<a href="https://icp.gov.moe" target="_blank" rel="nofollow"><img src="' . toolkit::staticFiles('img/moeICP.png') . '" alt="“萌ICP备”的Logo" style="vertical-align: middle;" width="20" height="20" loading="lazy">萌ICP备</a>' . PHP_EOL);
              print_r($codeAlignment . '<a href="https://icp.gov.moe/?keyword=' . $this->options->moeBeian . '" target="_blank" rel="nofollow">' . $this->options->moeBeian . '号</a>' . '<br/>' . PHP_EOL);
            }
          endif;
        endif;
        ?>
      </div>
      <div>
        Powered by <a href="http://typecho.org/" target="_blank" rel="nofollow">Typecho</a>
      </div>
      <div>
        Theme <a href="https://blog.inetech.fun/Project/Better.html" target="_blank" rel="nofollow">Better</a> By <a href="https://blog.inetech.fun" target="_blank">Star_caorui</a><br />
      </div>
    </div>
  </div>
</footer>
<div class='better-blank'></div>

<!-- JavaScript -->
<script src="<?php print_r(toolkit::staticFiles('js/mdui.min.js?' . MDUI_VERSION)); ?>" crossorigin="anonymous" integrity="sha384-gCMZcshYKOGRX9r6wbDrvF+TcCCswSHFucUzUPwka+Gr+uHgjlYvkABr95TCOz3A"></script>
<script src="<?php print_r(toolkit::staticFiles('js/Better.js?') . __THEME_VERSION__); ?>" crossorigin="anonymous" integrity=""></script>
<?php if (filesize(dirname(dirname(__FILE__)) . '/src/js/custom.js') > 0) : ?>
  <script src="<?php $this->options->themeUrl('csr/js/custom.js'); ?>"></script>
<?php endif; ?>
<?php if ($this->is('post') | $this->is('page')) : ?>
  <script src="<?php print_r(toolkit::staticFiles('js/highlight.min.js?' . HIGHLIGHT_VERSION)); ?>" crossorigin="anonymous" integrity="sha384-BfWQ0T8CPeH2bEHmKrLhDzVuVyiYckfg88VybFIvosSawQKFtIpl9XZu6i4Ut9T1"></script>
  <script>
    hljs.highlightAll();
  </script>
  <script>
    var tables = document.getElementsByTagName('table');
    for (var i = 0; i < tables.length; i++) {
      tables[i].setAttribute('class', 'mdui-table mdui-table-hoverable');
    }
  </script>
<?php endif; ?>
<?php $this->footer(); ?>
<script>
  if ('serviceWorker' in navigator) {
    window.addEventListener('load', async () => {
      navigator.serviceWorker.register(`<?php $this->options->themeUrl(); ?>src/js/sw.js?time=${new Date().getTime()}`, {
          scope: '/'
        })
        .then(async reg => {
          if (window.localStorage.getItem('sw_installed') != 'true') {
            window.localStorage.setItem('sw_installed', 'true');
            setTimeout(() => {
              window.location.search = `?time=${new Date().getTime()}`
            }, 1000)
          }
        })
    });
  }
</script>
</body>

</html>
