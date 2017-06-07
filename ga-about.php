<?php

/*
Plugin Name: 2SEO Geo Advert
Plugin URI: http://2seo.pro
Description: Определяет откуда пришел пользователь на сайт. Если из Украины - меняет указанные скрипты на другие.
Version: 1.0
Author: servitpol (2dev.pro)
Author URI: http://2dev.pro/
Domain Path: localization/
*/

require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
// активация плагина
function ga_activation() {
    global $wpdb;
	$charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";
    $table_name = $wpdb->prefix . "twoseo_ga";
    $sql = "CREATE TABLE " . $table_name . " (
        id int(11) NOT NULL AUTO_INCREMENT,
        short_name varchar(254) NOT NULL,
        script_in text NULL,
        script_out text NOT NULL,
        UNIQUE KEY(short_name),
        PRIMARY KEY(id)){$charset_collate};";
    dbDelta($sql);
}
register_activation_hook( __FILE__, 'ga_activation' );

// деактивация плагина
function ga_deactivation() {
}
register_deactivation_hook( __FILE__, 'ga_deactivation' );

// удаление плагина
function ga_uninstall(){
}
register_uninstall_hook(__FILE__, 'ga_uninstall');

// Подключение стилей и js
add_action( 'admin_enqueue_scripts', 'theme_name_scripts' );
function theme_name_scripts() {
   
   if(get_current_screen()->id == 'settings_page_2seo-geo-advert/ga-admin'){
      wp_enqueue_script( 'bootstrap-jquery', plugins_url() . '/2seo-geo-advert/bootstrap/js/jquery-3.2.1.js', array() );   
      wp_enqueue_script( 'bootstrap', plugins_url() . '/2seo-geo-advert/bootstrap/js/bootstrap.js', array() );   
      wp_enqueue_script( 'script', plugins_url() . '/2seo-geo-advert/js/script.js', array('bootstrap-jquery') );
      wp_enqueue_style( 'style-css', plugins_url() . '/2seo-geo-advert/css/style.css', array() );
      wp_enqueue_style( 'bootstrap-style-css', plugins_url() . '/2seo-geo-advert/bootstrap/css/bootstrap.css', array() );
   }
   
}

include_once('ga-admin.php');
include_once('ga-functions.php');