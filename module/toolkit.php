<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class toolkit {
  /**
   * 通过邮箱解析 QQ 号码
   *
   * @access public
   * @param string $email 需要解析的邮箱
   * @return int 返回 QQ 号码
   */
  public static function getQQNumber(string $email) : ?int {
    $QQ_Mail_Prefix = (substr($email,-7) === '@qq.com') ? str_replace('@qq.com','',$email) : NULL;
    return (is_numeric($QQ_Mail_Prefix)) ? $QQ_Mail_Prefix : NULL;
  }

  /**
   * 通过 QQ 号码解析 QQ 昵称
   *
   * @access public
   * @param int $qqnumber 需要解析的 QQ 号码
   * @return string 返回 QQ 昵称
   */
  public static function getQQNickname(int $qqnumber) : string {
    return json_decode(str_replace('portraitCallBack(', '', rtrim(iconv('GB18030', 'UTF-8', file_get_contents('https://r.qzone.qq.com/fcg-bin/cgi_get_portrait.fcg?uins=' . $qqnumber)), ')')), TRUE)["$qqnumber"]['6'];
  }

  /**
   * 通过 QQ 号码解析 QQ 头像
   *
   * @access public
   * @param int $qqnumber 需要解析的邮箱
   * @param boolean $privacy_protection 隐私保护
   * @return string 返回 QQ 头像 URL
   */
  public static function getQQAvatar(int $qqnumber, bool $privacy_protection = true) : ?string {
    if (is_numeric($qqnumber)) {
      $url = 'https://thirdqq.qlogo.cn/headimg_dl?bs=qq&spec=640&dst_uin=' . $qqnumber;
      if ($privacy_protection) {
        // TODO 隐私保护需要被重写，以便于更好的性能
        $url = 'data:' . get_headers($url, true)['Content-Type'] . ';base64,' . base64_encode(file_get_contents($url));
      }
      return $url;
    } else {
      return NULL;
    }
  }

  /**
   * 获取 Gravatar 头像
   *
   * @access public
   * @param string $email 需要解析的邮箱
   * @return string 返回 Gravatar 头像 URL
   */
  public static function getGravatar(string $email) : ?string {
    \Utils\Helper::options()->to($options);
    switch ($options->gravatarUrl) {
      case 'gravatar_Url_API':
        $url = $options->gravatarAPI;
        break;
      case 'gravatar_Url_Geekzu':
        $url = '//sdn.geekzu.org/avatar/';
        break;
      case 'gravatar_Url_GYMXBL':
        $url = '//i.ilolita.cn/avatar/';
        break;
      default:
        // 这种写法只是规避 VS Code 的警告
        if (!defined('__TYPECHO_GRAVATAR_PREFIX__')) {
          define('__TYPECHO_GRAVATAR_PREFIX__', '//sdn.geekzu.org/avatar/');
        }
        $url = __TYPECHO_GRAVATAR_PREFIX__;
        break;
    }

    $avatarUrl = $url . strtolower(md5($email));
    return $avatarUrl;
  }

  /**
   * 获取 用户 头像
   *
   * @access public
   * @param string $email 需要解析的邮箱
   * @param bool $fallback 是否使用后备头像源
   * @return string 返回 用户头像 URL
   */
  public static function getAvatar(string $email, bool $fallback = false) : ?string {
    \Utils\Helper::options()->to($options);

    if (in_array('gravatar', $options->avatarInterface) && !$fallback) {
      $gravatar_url = self::getGravatar($email);
      if (!empty($gravatar_url) && $options->commentAvatar === 'priorityUseGravatar') {
        return $gravatar_url . '?d=404';
      }
    }

    if (in_array('qqavatar', $options->avatarInterface)) {
      if (is_numeric(self::getQQNumber($email))) {
        $qqavatar_url = self::getQQAvatar(self::getQQNumber($email), ($options->qqavatar_privacy_protection === 'Enable'));
        if (!empty($qqavatar_url)) {
          return $qqavatar_url;
        }
      }
    }

    if ($fallback) {
      return $options->themeUrl . '/src/img/unknown_avatar.png';
    } else {
      return $gravatar_url . '?d=404';
    }
  }

  /**
   * 获取昵称
   *
   * @access public
   * @param string $nickname 来自数据库的用户昵称
   * @param string $email 来自数据库的用户邮箱
   * @return string 返回昵称
   */
  public static function getNickname(string $nickname, string $email) : string {
    $qqnumber = self::getQQNumber($email);
    if (!empty($qqnumber)) {
      $qqnickname = self::getQQNickname($qqnumber);
      if ($nickname !== $qqnickname) {
        $nickname .= ' (QQ昵称:' . $qqnickname . ')';
      }
    }

    return $nickname;
  }

  /**
   * 获取资源文件 URL 地址
   *
   * @access public
   * @param string $file 用于引用的文件名
   * @return string 返回资源文件 URL 地址
   */
  public static function staticFiles(string $file) : string {
    \Utils\Helper::options()->to($options);
    $setting = $options->staticFiles;
    $settingCustom = $options->staticFilesCustom;

    switch ($setting) {
      case 'local':
        $url = $options->themeUrl . '/src/' . $file;
        break;
      case 'jsdelivr':
        $url = 'https://cdn.jsdelivr.net/gh/' . __GITHUB_AUTHOR_NAME__ . '/' . __THEME_NAME__ . '@' . __THEME_BRANCH__ . '/src/' . $file;
        break;
      case 'custom':
        $url = $settingCustom . $file;
      default:
        $url = $options->themeUrl . '/src/' . $file;
        break;
    }

    return $url;
  }

  /**
   * 从本地随机输出图片
   *
   * @access private
   * @return string 返回图片 URL 地址
   */
  private static function randomImgLocal() : string {
    \Utils\Helper::options()->to($options);

    $basedir = '/src/img/random/';
    $files = glob('.'.$basedir . '*');
    $file = $files[array_rand($files)];
    unset ($files);

    return $options->themeUrl . $basedir . $file;
  }

  /**
   * 随机图片接口
   *
   * @access public
   * @return string 返回图片 URL 地址
   */
  public static function randomImg() : string {
    \Utils\Helper::options()->to($options);

    $setting = $options->randomImg;
    $settingCustomAPI = $options->randomImgAPI;

    $random_str = uniqid('?', true);

    switch ($setting) {
      case 'randomImgLocal':
        $url = self::randomImgLocal() . $random_str;
        break;
      case 'randomImgINETECH':
        $url = 'https://api.inetech.fun/acg?origin=typecho-theme-better&orientation=horizontal&return=redirect&random=' . $random_str;
        break;
      case 'randomImgGYMXBL':
        $url = 'https://api.gymxbl.com/images/' . $random_str;
        break;
      case 'randomImgAPI':
        $url = $settingCustomAPI . $random_str;
      default:
        $url = 'https://api.inetech.fun/acg?origin=typecho-theme-better&orientation=horizontal&return=redirect&random=' . $random_str;
        break;
    }
    return $url;
  }

  /**
   * 文章/页面浏览量统计
   *
   * @access public
   * @param mixed $archive 当前文章/页面的 $this
   * @return ?int 返回浏览量
   *
   * * 原始作者：布好
   * * 这段代码基于 Cuckoo 二开, 感谢布好！
   * @link https://github.com/bhaoo/Cuckoo/blob/master/functions.php#L205
   */
  public static function getViews(mixed $archive) : ?int {
    // 过滤掉除 index/archive/post/page 的输出
    if (!($archive->is('index') || $archive->is('archive') || $archive->is('single'))) {
      return NULL;
    }

    // 准备连接数据库获取浏览量数据
    $cid = $archive->cid;
    $db = Typecho\Db::get();

    // 如果数据库未初始化，则返回 0
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
      $db->query('ALTER TABLE `' . $db->getPrefix() . 'contents` ADD `views` INT(10) DEFAULT 0;');
      return 0;
    }

    // 获取文章/页面的浏览量及用户访问过的页面
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    $views = Typecho\Cookie::get('extend_contents_views');
    $views =  (empty($views)) ? array() : explode(',', $views);

    // 如果用户访问过，则不更新浏览量
    if (in_array($cid, $views)) {
      return $row['views'];
    }

    // 否则更新浏览量并记录用户访问过的页面，然后返回浏览量
    $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
    array_push($views, $cid);
    $views = implode(',', $views);
    Typecho\Cookie::set('extend_contents_views', $views);
    return $row['views'];
  }

  /**
   * 标题前缀
   *
   * @access public
   * @param mixed $archive 当前文章/页面的 $this
   * @param string $end 标题前缀的后缀
   * @return void 直接打印输出标题前缀
   */
  public static function title_prefix(mixed $_this, string $end = '') : void {
    $_this->archiveTitle(array(
      'category' => _t('分类 %s 下的文章'),
      'search' => _t('包含关键字 %s 的文章'),
      'tag' => _t('标签 %s 下的文章'),
      'author' => _t('%s 发布的文章')
    ), '', $end);
  }

  /**
   * 时效性警告
   *
   * @access public
   * @param ?string $status 配置项状态
   * @param int $created 创建时间
   * @param int $modified 修改时间
   * @param int $timeout_day 超时时间
   * @return void 直接打印输出时效性警告的 HTML
   */
  public static function time_warning(?string $status, int $created, int $modified, int $timeout_day = 30) : void {
    $modified = intval((time() - $modified) / 86400);
    $created  = intval((time() - $created) / 86400);

    if ($status !== 'disable' && $modified > $timeout_day) {
      // TODO 在未来，此处样式将会被更新
      _e("<div class='mdui-text-center mdui-text-color-theme-accent better-blank'>请注意，本文编写于<span class='mdui-text-color-red-accent'> $created </span>天前，最后修改于<span class='mdui-text-color-red-accent'> $modified </span>天前，其中某些信息可能已经过时。</div><br/>");
    }
  }

  /**
   * 版权信息
   *
   * @access public
   * @param string $permalink 本文链接
   * @param mixed $author 本文作者信息
   * @return void 直接打印输出版权信息 HTML
   */
  public static function copyInfo(string $permalink, mixed $author) : void {
    \Utils\Helper::options()->to($options);
    $license = !empty($options->articleCopy) ? $options->articleCopy : '本文版权由本文作者独占，禁止出于任何目的去使用，修改，和分享。';

    _e('<div class="postCopyright article-copy mdui-text-color-theme-accent">');
    _e('版权所属' . genCopyrightSpanTag('：'. genATag($options->title, $options->siteUrl)));
    _e('本文作者' . genCopyrightSpanTag('：'. genATag($author->{'screenName'}, $author->permalink, '', 'rel="author"')));
    _e('本文链接' . genCopyrightSpanTag('：'. genATag($permalink, $permalink)));
    _e('版权声明' . genCopyrightSpanTag('：'. $license));
    _e('</div>');
  }
}
