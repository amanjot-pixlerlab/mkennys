<?php
/*
Plugin Name: promocode
Plugin URI: ''
Description: Add Promo Code for Some extra discount on purchase 
Version:     17062017
Author:      krish
Author URI:  ''
License:     GPL2
*/

add_action( 'admin_menu', 'promo_menu' );

function promo_menu(){

add_menu_page( 'Promocode', 'Promocode', 'manage_options', 'promo-admin-page.php', 'promo_admin_page', 'dashicons-tickets', 8  );
add_submenu_page( 'promo-admin-page.php', 'Promo Code', 'Add Code', 'manage_options', 'promo-admin-add-page.php', 'promo_admin_add_page'); 
add_submenu_page( 'promo-admin-page.php', 'Promo Code', 'List Promo Codes', 'manage_options', 'promo-admin-list-page.php', 'promo_admin_sub_page'); 

add_submenu_page( 'promo-admin-page.php', 'Promo Code', null, 'manage_options', 'promo-admin-edit.php', 'promo_admin_edit_page'); 


remove_submenu_page( 'promo-admin-page.php', 'promo-admin-page.php');
//remove_submenu_page( 'promo-admin-edit.php', 'promo-admin-edit.php');
}
add_action('apromo-admin-edit.php', 'hide_customize');
function hide_customize(){
    echo '<style>#customize-current-theme-link{display:none;}</style>';
}

function promo_admin_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include('promo-admin-page.php');
	
}

function promo_admin_sub_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	include('promo-admin-list-page.php');
	//include('promo-admin-edit.php');
	
}

function promo_admin_edit_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	//include('promo-admin-list-page.php');
	include('promo-admin-edit.php');
	
}

function promo_admin_add_page(){
	if ( !current_user_can( 'manage_options' ) ){
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	include('promo-admin-add-page.php');
}


?>