<?php
!defined('DEBUG') AND exit('Access Denied.');

if($method == 'GET') {
	
	$setting['ass_pp_token'] = setting_get('ass_pp_token');
	$setting['ass_pp_group'] = setting_get('ass_pp_group');
	$setting['ass_siteurl'] = setting_get('ass_siteurl');
	$setting['ass_bd_token'] = setting_get('ass_bd_token');
	$setting['ass_op_pp'] = setting_get('ass_op_pp');
	$setting['ass_op_bd'] = setting_get('ass_op_bd');
	
	include _include(APP_PATH.'plugin/ass_push/setting.htm');
	
} else {

	setting_set('ass_pp_token', param('ass_pp_token', '', FALSE));
	setting_set('ass_pp_group', param('ass_pp_group', '', FALSE));
	setting_set('ass_siteurl', param('ass_siteurl', '', FALSE));
	setting_set('ass_bd_token', param('ass_bd_token', '', FALSE));
	setting_set('ass_op_pp', param('ass_op_pp', '', FALSE));
	setting_set('ass_op_bd', param('ass_op_bd', '', FALSE));
	
	message(0, '修改成功');
}
	
?>