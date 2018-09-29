<?php
/**
 * 上佛模块微站定义
 *
 * @author 上佛
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT. '/addons/we7_shangfo_mini/defines.php';
//require IA_ROOT. '/addons/we7_shangfo/model.php';
require SHANGFO_INC.'function.php';
require SHANGFO_INC.'core.php';

class We7_shangfo_miniModuleSite extends core {
    public function doMobileIndexx() {

        require_once SHANGFO_CORE."mobile/indexx.php";
    }

	public function doMobileIndex() {

		require_once SHANGFO_CORE."mobile/index.php";
	}
	public function doMobileIndex3() {

		require_once SHANGFO_CORE."mobile/index3.php";
	}
	public function doMobileTribute() {

		require_once SHANGFO_CORE."mobile/tribute.php";
	}
	public function doMobileBack() {
		require_once SHANGFO_CORE."mobile/back.php";
	}
	public function doMobileBack2() {
		require_once SHANGFO_CORE."mobile/back2.php";
	}
	public function doMobileList1() {
		require_once SHANGFO_CORE."mobile/list1.php";
	}
	public function doMobileMy1() {
		require_once SHANGFO_CORE."mobile/my1.php";
	}

	public function doMobileMy2() {
		require_once SHANGFO_CORE."mobile/my2.php";
	}
	public function doMobileSend() {
		require_once SHANGFO_CORE."mobile/send.php";
	}
	public function doMobileSend1() {
		require_once SHANGFO_CORE."mobile/send1.php";
	}
	public function doWebRule1() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebGongpin() {

		require_once SHANGFO_CORE."web/gongpin.php";
	}
	public function doWebTest() {

		require_once SHANGFO_CORE."web/test.php";
	}
	public function doWebGongfo() {

		require_once SHANGFO_CORE."web/gongfo.php";
	}
	public function doWebCount() {

		require_once SHANGFO_CORE."web/count.php";
	}
	public function doWebSend() {

		require_once SHANGFO_CORE."web/send.php";
	}
	public function doWebNotice() {

		require_once SHANGFO_CORE."web/notice.php";
	}

	public function doWebPaiwei() {

		require_once SHANGFO_CORE."web/paiwei.php";
	}
	public function doWebLogininfo() {
		require_once SHANGFO_CORE."web/logininfo.php";
}
	public function doWebSetting() {
		require_once SHANGFO_CORE."web/setting.php";
	}
	public function doMobileWebsite1() {
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobileUser1() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doMobileShortcut1() {
		//这个操作被定义用来呈现 微站快捷功能导航
	}

}