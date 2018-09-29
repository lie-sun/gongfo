<?php

//��ĪԴ�� �ṩ www.0516city.com
if (!defined('IN_IA')) {
    die('Access Denied');
}
define('SHANGFO_DEBUG', false);
!defined('SHANGFO_PATH') && define('SHANGFO_PATH', IA_ROOT . '/addons/we7_shangfo_mini/');
!defined('SHANGFO_CORE') && define('SHANGFO_CORE', SHANGFO_PATH . 'core/');
!defined('SHANGFO_PLUGIN') && define('SHANGFO_PLUGIN', SHANGFO_PATH . 'plugin/');
!defined('SHANGFO_INC') && define('SHANGFO_INC', SHANGFO_CORE . 'inc/');
!defined('SHANGFO_URL') && define('SHANGFO_URL', $_W['siteroot'] . 'addons/we7_shangfo_mini/');
!defined('SHANGFO_STATIC') && define('SHANGFO_STATIC', SHANGFO_URL . 'static/');
!defined('SHANGFO_PREFIX') && define('SHANGFO_PREFIX', 'we7_shangfo_mini_');
