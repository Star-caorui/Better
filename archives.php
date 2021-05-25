<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Archives
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
        <img src="<?php echo randomImg(); ?>"/>
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
    <div class="article-page mdui-typo">
      <?php $this->content();
        $this->widget('Widget_Contents_Post_Recent', 'pageSize=256000')->to($archives);
        $year=0; $mon=0;
        $output = '<div id="archives">';
        while($archives->next()) {
          $year_tmp = date('Y',$archives->created);
          $mon_tmp = date('m',$archives->created);
          if($mon != $mon_tmp && $mon > 0) {
            $output .= '</ul></li>';
          }
          if($year != $year_tmp && $year > 0) {
            $output .= '</ul>';
          }
          if($year != $year_tmp) {
            $year = $year_tmp;
            $output .= '<h3>'. $year .' 年</h3><ul>';
          }
          if($mon != $mon_tmp) {
            $mon = $mon_tmp;
            $output .= '<li><h4 class="al_mon">'. $mon .' 月</h4><ul class="al_post_list">';
          }
          $output .= '<li>'.date('d日：',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a>  </li>';
        }
        $output .= '</ul></li></ul></div>';
        echo $output; ?>  
    </div>
  </div>
  <div class="better-save-white"></div>
  <?php $this->need('template/comments.php'); ?>
</div>
<?php $this->need('template/footer.php'); ?>
