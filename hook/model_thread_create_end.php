function send_post($url, $post_data) {
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
 return $result;
};
$content = preg_replace("/\[ttreply].*.\[\/ttreply]/", "<p><strong>此处为回复后可见内容</strong></p>", $message);
$data = array(
    'token' => setting_get('ass_token'),
    'title' => $subject,
    'content' => '<h1>'.$subject.'</h1><p>作者：'.thread_read_cache($tid)['user']['username'].'</p>'.$content.'<p>帖子地址：<a href="'.setting_get('ass_siteurl').'thread-'.$tid.'.htm">'.setting_get('ass_siteurl').'thread-'.$tid.'.htm</a></p>',
    'template' => 'html',
    'topic' => setting_get('ass_group')
);
if(!empty($data['token'] && $data['topic'])){
send_post('http://pushplus.hxtrip.com/send',$data);
}