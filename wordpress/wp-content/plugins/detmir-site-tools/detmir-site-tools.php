<?php
/*
Plugin Name: Детский мир — формы и социальные сети
Description: Форма обратной связи и ссылки на социальные сети для экзаменационного проекта.
Version: 1.0.0
*/
defined('ABSPATH') || exit;

add_shortcode('detmir_socials', function(){
 return '<a href="http://www.facebook.com" target="_blank" rel="noopener" aria-label="Facebook">f</a><a href="http://www.twitter.com" target="_blank" rel="noopener" aria-label="Twitter">𝕏</a><a href="http://www.youtube.com" target="_blank" rel="noopener" aria-label="YouTube">▶</a>';
});

add_shortcode('detmir_contact_form', function(){
 $ok = isset($_GET['sent']) && $_GET['sent']==='1' ? '<div class="form-message">Спасибо! Сообщение отправлено.</div>' : '';
 return $ok.'<form method="post" action="'.esc_url(admin_url('admin-post.php')).'"><input type="hidden" name="action" value="detmir_contact">'.wp_nonce_field('detmir_contact','detmir_nonce',true,false).'<div class="form-grid"><div class="field"><label for="dm-name">Имя</label><input id="dm-name" name="name" required></div><div class="field"><label for="dm-email">Адрес электронной почты</label><input id="dm-email" type="email" name="email" required></div><div class="field"><label for="dm-phone">Номер телефона</label><input id="dm-phone" type="tel" name="phone" required></div><div class="field"><label for="dm-channel">Способ получения сообщений</label><select id="dm-channel" name="channel"><option>Почта</option><option>SMS</option><option>WhatsApp-сообщение</option></select></div><div class="field full"><label for="dm-message">Сообщение</label><textarea id="dm-message" name="message" required></textarea></div><div class="field full"><button type="submit">Отправить сообщение</button></div></div></form>';
});
function detmir_contact_submit(){
 if(!isset($_POST['detmir_nonce'])||!wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['detmir_nonce'])),'detmir_contact')) wp_die('Ошибка проверки формы.');
 $data=['post_title'=>'Обращение: '.sanitize_text_field(wp_unslash($_POST['name']??'')),'post_content'=>sanitize_textarea_field(wp_unslash($_POST['message']??'')),'post_status'=>'private','post_type'=>'detmir_message']; $id=wp_insert_post($data);
 if($id){ foreach(['email','phone','channel'] as $k) update_post_meta($id,$k,sanitize_text_field(wp_unslash($_POST[$k]??''))); }
 wp_safe_redirect(add_query_arg('sent','1',wp_get_referer()?:home_url('/#contact'))); exit;
}
add_action('admin_post_nopriv_detmir_contact','detmir_contact_submit'); add_action('admin_post_detmir_contact','detmir_contact_submit');
add_action('init',function(){register_post_type('detmir_message',['labels'=>['name'=>'Обращения','singular_name'=>'Обращение'],'public'=>false,'show_ui'=>true,'menu_icon'=>'dashicons-email','supports'=>['title','editor']]);});
