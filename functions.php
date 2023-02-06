<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

\Widget\Themes\Rows::alloc()->to($themes);
\Utils\Helper::options()->to($options);

define('__THEME_NAME__', $themes->name);
define('__THEME_AUTHOR__', $themes->author);
define('__THEME_VERSION__', explode('-', $themes->version)['1']);
define('__THEME_BRANCH__', explode('-', $themes->version)['0']);
define('__THEME_HOMEPAGE__', $themes->homepage);
define('__THEME_DESCRIPTION__', $themes->description);

define('__GITLAB_URL__', 'https://gitlab.com/');
define('__GITLAB_AUTHOR_NAME__', 'Star_caorui');
define('__GITLAB_AUTHOR_URL__', __GITLAB_URL__ . __GITLAB_AUTHOR_NAME__);
define('__GITLAB_REPO__', __GITLAB_AUTHOR_URL__ . '/' . __THEME_NAME__);

define('__GITHUB_URL__', 'https://github.com/');
define('__GITHUB_AUTHOR_NAME__', 'Star-caorui');
define('__GITHUB_AUTHOR_URL__', __GITHUB_URL__ . __GITHUB_AUTHOR_NAME__);
define('__GITHUB_REPO__', __GITHUB_AUTHOR_URL__ . '/' . __THEME_NAME__);

require_once('module/version.php');
require_once('module/toolkit.php');
require_once('module/themeHelper.php');
require_once('module/api.php');
require_once('module/themeConfig.php');
require_once('module/themeFields.php');
