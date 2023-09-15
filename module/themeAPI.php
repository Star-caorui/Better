<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

if (isset($_GET['api'])) {
  switch ($_GET['api']) {
    case 'theme':
      exit(__THEME_NAME__);
      break;
    case 'version':
      exit(__THEME_VERSION__);
      break;
    case 'branch':
      exit(__THEME_BRANCH__);
      break;
    case 'main':
      $version = explode('.', __THEME_VERSION__);
      exit(implode('.', array_slice($version, 0, 2)));
      break;
    default:
      // TODO 在未来，此处需要添加更多的 API
      break;
  }
}
