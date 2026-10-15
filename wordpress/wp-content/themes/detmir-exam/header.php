<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head><body <?php body_class(); ?>><?php wp_body_open(); ?>
<header class="site-header"><div class="container header-inner">
  <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo detmir_asset('лого.png'); ?>" alt="Логотип Детский мир"><span>Детский мир</span></a>
  <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false">☰</button>
  <nav id="main-nav" class="main-nav" aria-label="Главное меню">
    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a><a href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Каталог</a><a href="<?php echo esc_url(home_url('/#about')); ?>">О компании</a><a href="<?php echo esc_url(home_url('/#contact')); ?>">Напишите нам</a>
    <?php if(function_exists('wc_get_cart_url')): ?><a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">Корзина <span><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span></a><?php endif; ?>
  </nav>
</div></header>
