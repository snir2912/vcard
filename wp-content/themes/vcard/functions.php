<?php
// טעינת סקריפטים ועיצובים
function vcard_enqueue_scripts() {
    // טעינת הפונט Alef מגוגל
    wp_enqueue_style('google-fonts-alef', 'https://fonts.googleapis.com/css2?family=Alef:wght@400;700&display=swap', [], null);
    
    // טעינת ספריית האייקונים (FontAwesome 6)
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', [], '6.4.0');

    // טעינת CSS ראשי
    // שים לב: וידאתי שהנתיב הוא assets/css לפי מה שעשינו קודם. אם שינית ל-css רגיל, תחזיר ל-css.
    wp_enqueue_style('vcard-main-style', get_template_directory_uri() . '/css/main.css', [], time());

    // טעינת JS ראשי
    wp_enqueue_script('vcard-main-js', get_template_directory_uri() . '/js/main.js', ['jquery'], '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'vcard_enqueue_scripts');

// הגדלת נפח העלאה מקסימלי דרך הקוד
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

// כפיית תמיכה ב-PNG וקבצים נוספים
function vcard_allow_mime_types($mimes) {
    $mimes['png'] = 'image/png';
    $mimes['jpg|jpeg|jpe'] = 'image/jpeg';
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'vcard_allow_mime_types');

// רישום Post Type לכרטיסי ביקור
function register_my_card_cpt() {
    $args = array(
        'labels' => array(
            'name' => 'כרטיסי ביקור',
            'singular_name' => 'כרטיס ביקור'
        ),
        'public' => true,
        'has_archive' => false,
        'rewrite' => array('slug' => 'my-card'),
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-id'
    );
    register_post_type('my-card', $args);
}
add_action('init', 'register_my_card_cpt');

// תמיכה ב-Title Tag ו-Thumbnails
add_theme_support('title-tag');
add_theme_support('post-thumbnails');

// רישום תפריטי ניווט
function vcard_register_menus() {
    register_nav_menus(array(
        'primary_menu' => 'תפריט ראשי (המבורגר)',
        'footer_menu'  => 'תפריט פוטר (קישורים)'
    ));
}
add_action('init', 'vcard_register_menus');