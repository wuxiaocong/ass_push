function send_post($url,$post_data){
 $postdata = http_build_query($post_data);
 $options = array(
   'http' => array(
     'method' => 'POST',
     'header' => 'Content-type:application/x-www-form-urlencoded',
     'content' => $postdata,
     'timeout' => 15 * 60 // 超时时间（单位:s）
   )
 );
 $context = stream_context_create($options);
 $result = file_get_contents($url, false, $context);
 //return $result;
}
$content = preg_replace("/\[ttreply].*.\[\/ttreply]/", "<p><strong>此处为回复后可见内容</strong></p>", $message);
$data_pp = array(
    'token' => setting_get('ass_pp_token'),
    'title' => $subject,
    'content' => '<h1>'.$subject.'</h1><p>作者：'.thread_read_cache($tid)['user']['username'].'</p>'.$content.'<p>帖子地址：<a href="'.setting_get('ass_siteurl').'thread-'.$tid.'.htm">'.setting_get('ass_siteurl').'thread-'.$tid.'.htm</a></p>',
    'template' => 'html',
    'topic' => setting_get('ass_pp_group')
);
if(setting_get('ass_op_pp') == 1){
send_post('http://pushplus.hxtrip.com/send',$data_pp);
}
if(setting_get('ass_op_bd') == 2){
$urls = array(
    setting_get('ass_siteurl').'thread-'.$tid.'.htm',
);
$data = array(
  'url' => 'http://data.zz.baidu.com/urls?site='.substr(setting_get('ass_siteurl'), 0, -1).'&token='.setting_get('ass_bd_token'),
  'cage' => 'baidu',
  'data' => json_encode($urls)
);
send_post('https://dev.sjfn.com/post/',$data);
}
if(setting_get('ass_op_tg') == 2){
$datas = array(
  'chat_id' => setting_get('ass_tg_id'),
  'parse_mode' => 'HTML',
  'text' => '<a href="'.setting_get('ass_siteurl').'thread-'.$tid.'.htm">'.$subject.'</a>'
);
$data = array(
  'url' => 'https://api.telegram.org/bot'.setting_get('ass_tg_bot').'/sendMessage',
  'cage' => 'tg',
  'data' => json_encode($datas)
);
send_post('https://dev.sjfn.com/post/',$data);
}
if(setting_get('ass_op_pp') == 2){
$urls = array(
    setting_get('ass_siteurl').'thread-'.$tid.'.htm',
);
$data = array(
  'url' => 'http://pushplus.hxtrip.com/send',
  'cage' => 'pushplus',
  'data' => json_encode($data_pp)
);
send_post('https://dev.sjfn.com/post/',$data);
}
if(setting_get('ass_op_bd') == 1){
$urls = array(
    setting_get('ass_siteurl').'thread-'.$tid.'.htm',
);
$api = 'http://data.zz.baidu.com/urls?site='.substr(setting_get('ass_siteurl'), 0, -1).'&token='.setting_get('ass_bd_token');
$ch = curl_init();
$options =  array(
    CURLOPT_URL => $api,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => implode(",", $urls),
    CURLOPT_HTTPHEADER => array('Content-Type: text/plain'),
);
curl_setopt_array($ch, $options);
$result = curl_exec($ch);
}