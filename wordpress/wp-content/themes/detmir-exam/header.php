<!doctype html><html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width,initial-scale=1"><?php wp_head(); ?></head><body <?php body_class(); ?>><?php wp_body_open(); ?>
<header class="site-header"><div class="container header-inner">
  <a class="brand" href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo detmir_asset('лого.png'); ?>" alt="Логотип Детский мир"><span>Детский мир</span></a>
  <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false">☰</button>
  <nav id="main-nav" class="main-nav" aria-label="Главное меню">
    <a href="<?php echo esc_url(home_url('/')); ?>">Главная</a>
    <div class="nav-catalog">
      <a class="nav-catalog-link" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Каталог <span aria-hidden="true">⌄</span></a>
      <div class="nav-catalog-menu">
        <?php $nav_categories = get_terms(['taxonomy'=>'product_cat','hide_empty'=>false,'parent'=>0]); if (!is_wp_error($nav_categories)) : foreach ($nav_categories as $nav_category) : if ($nav_category->slug === get_option('default_product_cat','uncategorized')) continue; ?>
          <a href="<?php echo esc_url(get_term_link($nav_category)); ?>"><span><?php echo esc_html($nav_category->name); ?></span><small><?php echo esc_html($nav_category->count); ?></small></a>
        <?php endforeach; endif; ?>
        <a class="all-products" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>">Все товары →</a>
      </div>
    </div>
    <a href="<?php echo esc_url(home_url('/#about')); ?>">О компании</a><a href="<?php echo esc_url(home_url('/#contact')); ?>">Напишите нам</a>
    <?php if(function_exists('wc_get_cart_url')): ?><a class="cart-link" href="<?php echo esc_url(wc_get_cart_url()); ?>">Корзина <span><?php echo WC()->cart ? WC()->cart->get_cart_contents_count() : 0; ?></span></a><?php endif; ?>
  </nav>
</div></header>
