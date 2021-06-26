<?php
add_action( 'wp_enqueue_scripts', 'pr_enqueue_styles' );
function pr_enqueue_styles() {
    $parenthandle = 'twenty-twenty-style';
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css',
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}

add_action( 'wp_enqueue_scripts', 'pr_add_lightbox' );
function pr_add_lightbox() {
  wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/lightbox.js');
}

add_action( 'customize_register', 'pr_2020_child_customize_register');

function pr_2020_child_customize_register( $wp_customize) {
    $wp_customize->remove_control('custom_logo');
    $wp_customize->remove_section('colors');
}
