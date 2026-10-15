<?php
defined('ABSPATH') || exit;
get_header();
$current = is_product_category() ? get_queried_object() : null;
$default_category = get_term_by('slug', get_option('default_product_cat', 'uncategorized'), 'product_cat');
$categories = get_terms([
    'taxonomy' => 'product_cat', 'hide_empty' => false, 'parent' => 0,
    'exclude' => $default_category ? [(int)$default_category->term_id] : [],
]);
?>
<main class="site-main catalog-page"><div class="container">
  <?php woocommerce_breadcrumb(); ?>
  <header class="catalog-heading"><span class="eyebrow">Каталог</span><h1><?php woocommerce_page_title(); ?></h1><?php do_action('woocommerce_archive_description'); ?></header>
  <div class="catalog-layout">
    <aside class="catalog-sidebar" aria-label="Категории товаров">
      <h2>Категории</h2>
      <nav class="category-filter">
        <a class="<?php echo is_shop() ? 'active' : ''; ?>" href="<?php echo esc_url(get_post_type_archive_link('product')); ?>"><span>Все товары</span><small><?php echo esc_html(wp_count_posts('product')->publish); ?></small></a>
        <?php if (!is_wp_error($categories)) : foreach ($categories as $category) : ?>
          <a class="<?php echo $current && (int)$current->term_id === (int)$category->term_id ? 'active' : ''; ?>" href="<?php echo esc_url(get_term_link($category)); ?>"><span><?php echo esc_html($category->name); ?></span><small><?php echo esc_html($category->count); ?></small></a>
        <?php endforeach; endif; ?>
      </nav>
    </aside>
    <section class="catalog-products" aria-label="Товары">
      <?php if (woocommerce_product_loop()) : ?>
        <div class="catalog-toolbar"><?php do_action('woocommerce_before_shop_loop'); ?></div>
        <?php woocommerce_product_loop_start(); while (have_posts()) : the_post(); wc_get_template_part('content', 'product'); endwhile; woocommerce_product_loop_end(); ?>
        <?php do_action('woocommerce_after_shop_loop'); ?>
      <?php else : do_action('woocommerce_no_products_found'); endif; ?>
    </section>
  </div>
</div></main>
<?php get_footer(); ?>
