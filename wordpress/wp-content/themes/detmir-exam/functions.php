<?php
defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    register_nav_menus(['primary' => 'Главное меню']);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('detmir-style', get_stylesheet_uri(), [], '1.0.0');
    wp_enqueue_script('detmir-ui', get_template_directory_uri() . '/assets/site.js', [], '1.0.0', true);
});

add_filter('loop_shop_per_page', fn() => 4, 20);
add_filter('loop_shop_columns', fn() => 4);

add_action('pre_get_posts', function ($query) {
    if (!is_admin() && $query->is_main_query() && (is_post_type_archive('product') || is_tax('product_cat'))) {
        $query->set('posts_per_page', 4);
    }
});

function detmir_asset($name) {
    return esc_url(get_template_directory_uri() . '/assets/media/' . rawurlencode($name));
}

function detmir_product_card($product) {
    if (!$product) return;
    $image = wp_get_attachment_image_url($product->get_image_id(), 'woocommerce_thumbnail');
    echo '<article class="product-card">';
    echo '<a href="' . esc_url($product->get_permalink()) . '"><img src="' . esc_url($image ?: wc_placeholder_img_src()) . '" alt="' . esc_attr($product->get_name()) . '"></a>';
    echo '<h3><a href="' . esc_url($product->get_permalink()) . '">' . esc_html($product->get_name()) . '</a></h3>';
    echo '<p class="stock ' . ($product->is_in_stock() ? 'in-stock' : 'out-of-stock') . '">' . ($product->is_in_stock() ? 'В наличии' : 'Нет в наличии') . '</p>';
    echo '<div class="price">' . wp_kses_post($product->get_price_html()) . '</div>';
    echo '<a class="button add_to_cart_button ajax_add_to_cart" data-product_id="' . esc_attr($product->get_id()) . '" href="' . esc_url($product->add_to_cart_url()) . '">В корзину</a></article>';
}

add_action('after_switch_theme', 'detmir_seed_store');
add_action('init', 'detmir_seed_store', 30);
function detmir_seed_store() {
    if (!class_exists('WooCommerce') || get_option('detmir_seeded')) return;
    $pages = [
        'Главная' => '<!-- wp:paragraph --><p>Интернет-магазин товаров для детей.</p><!-- /wp:paragraph -->',
        'Напишите нам' => '[detmir_contact_form]',
    ];
    foreach ($pages as $title => $content) {
        if (!get_page_by_title($title)) wp_insert_post(['post_title'=>$title,'post_content'=>$content,'post_status'=>'publish','post_type'=>'page']);
    }
    $home = get_page_by_title('Главная'); if ($home) { update_option('show_on_front','page'); update_option('page_on_front',$home->ID); }
    $cats = ['Игрушки','Питание','Детская одежда','Детская обувь','Детская мебель','Косметика и гигиена'];
    foreach ($cats as $cat) if (!term_exists($cat,'product_cat')) wp_insert_term($cat,'product_cat');
    $products = [
      ['Конструктор развивающий','Игрушки','1299','конструктор1.jpg'],['Кукла игровая','Игрушки','899','кукла.jpg'],['Синтезатор детский','Игрушки','2499','синтезатор.jpg'],
      ['Пюре Бабушкино лукошко','Питание','89','Пюре Бабушкино лукошко яблоко-груша.jpg'],['Печенье Fleur Alpine','Питание','329','Печенье Fleur Alpine.jpg'],['Смесь PediaSure Малоежка','Питание','1599','Смесь PediaSure Малоежка.jpg'],
      ['Комбинезон для мальчика','Детская одежда','1799','КомбинезонМальчик5-8.jpg'],['Куртка для девочки','Детская одежда','2999','КурткаДевочка6-8.jpg'],
      ['Ботинки Jook','Детская обувь','2399','Ботинки Jook.jpg'],['Кеды Futurino','Детская обувь','1999','Кеды Futurino.jpg'],['Сапоги Tombi','Детская обувь','2699','Сапоги Tombi.jpg'],
      ['Кроватка Babyton','Детская мебель','12990','Детская кроватка Babyton.jpg'],['Комод пеленальный Alatoys','Детская мебель','10490','Комод пеленальный 4 ящика Alatoys.jpg'],['Стульчик-качели Babyton','Детская мебель','8990','Стульчик-качели Babyton.jpg'],
      ['Гель для купания Bubchen','Косметика и гигиена','499','Гель для купания Bubchen.jpg'],['Крем для младенцев Bubchen','Косметика и гигиена','389','Крем для младенцев Bubchen.jpg'],['Зубная паста Biorepair Junior','Косметика и гигиена','549','Зубная паста Biorepair Junior.jpg'],['Зубная щётка R.O.C.S. Baby','Косметика и гигиена','319','Зубная щётка R.O.C.S. Baby.jpg']
    ];
    foreach ($products as [$name,$cat,$price,$file]) {
      if (get_page_by_title($name,OBJECT,'product')) continue;
      $p = new WC_Product_Simple(); $p->set_name($name); $p->set_status('publish'); $p->set_regular_price($price); $p->set_manage_stock(true); $p->set_stock_quantity(12); $p->set_category_ids([(int)get_term_by('name',$cat,'product_cat')->term_id]); $id=$p->save();
      $src=get_template_directory().'/assets/media/'.$file;
      if (file_exists($src)) { $up=wp_upload_bits(basename($src),null,file_get_contents($src)); if(!$up['error']) { $aid=wp_insert_attachment(['post_mime_type'=>wp_check_filetype($up['file'])['type'],'post_title'=>$name,'post_status'=>'inherit'],$up['file'],$id); require_once ABSPATH.'wp-admin/includes/image.php'; wp_update_attachment_metadata($aid,wp_generate_attachment_metadata($aid,$up['file'])); set_post_thumbnail($id,$aid); } }
    }
    update_option('detmir_seeded', 1);
}
