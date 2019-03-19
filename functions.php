<?php
add_action( 'after_setup_theme', 'first_base_setup' );
function first_base_setup()
{
  load_theme_textdomain( 'first_base', get_template_directory() . '/languages' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  register_nav_menus(
    array( 'main-menu' => __( 'Main Menu', 'first_base' ), 'footer-menu' => __( 'Footer Menu', 'first_base' ) )
  );
}

# Enqueue Styles & Scripts
function my_assets() {
    wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1.0.0' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'app', get_template_directory_uri() . '/js/app.js', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'my_assets' );

# Page slug body class
function add_slug_body_class( $classes ) {
global $post;
if ( isset( $post ) ) {
  $classes[] = $post->post_type . '-' . $post->post_name;
}
  return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

# Buttons shortcode
function shortcodeButton($atts, $content = null) {
   extract(shortcode_atts(array('link' => '#'), $atts));
   return '<a class="button" href="'.$link.'">' . do_shortcode($content) . '</a>';
}
add_shortcode('button', 'shortcodeButton');
