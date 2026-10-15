<?php
/*
Plugin Name: GA Google Analytics — экзаменационная настройка
Description: Подключает заданный идентификатор Google Analytics.
Version: 1.0.0
*/
defined('ABSPATH') || exit;
add_action('wp_head', function(){ ?>
<!-- Google Analytics: UA-333438812-2 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-333438812-2"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','UA-333438812-2',{'anonymize_ip':true});</script>
<?php }, 2);
