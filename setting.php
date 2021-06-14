<?php
!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	$setting['ass_token'] = setting_get('ass_token');
	$setting['ass_group'] = setting_get('ass_group');
	$setting['ass_siteurl'] = setting_get('ass_siteurl');
	
	include _include(APP_PATH.'plugin/ass_push/setting.htm');
	
} else {

	setting_set('ass_token', param('ass_token', '', FALSE));
	setting_set('ass_group', param('ass_group', '', FALSE));
	setting_set('ass_siteurl', param('ass_siteurl', '', FALSE));
	
	message(0, '修改成功');
}
	
?>