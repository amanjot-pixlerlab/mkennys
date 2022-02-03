<?php
/*
Plugin Name: giftcard
Plugin URI: ''
Description: Gift card managment
Version:     24081992
Author:      krish
Author URI:  ''
License:     GPL2
*/

add_action( 'admin_menu', 'gift_menu' );

function gift_menu(){

add_menu_page( 'Giftcard', 'Giftcard', 'manage_options', 'gift-admin-page.php', 'gift_admin_page', 'dashicons-admin-page', 9  );
add_submenu_page( 'gift-admin-page.php', 'Giftcard', 'All Giftcards', 'manage_options', 'gift-admin-list-page.php', 'gift_admin_sub_page'); 
add_submenu_page( 'gift-admin-page.php', 'Giftcard', null, 'manage_options', 'gift-admin-edit.php', 'gift_admin_edit_page'); 


remove_submenu_page( 'gift-admin-page.php', 'gift-admin-page.php');
//remove_submenu_page( 'promo-admin-edit.php', 'promo-admin-edit.php');
}
//add_action('apromo-admin-edit.php', 'hide_customize');
/*function hide_customize(){
    echo '<style>#customize-current-theme-link{display:none;}</style>';
}*/

function gift_admin_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include('gift-admin-page.php');
	
}

function gift_admin_sub_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	include('gift-admin-list-page.php');
	//include('promo-admin-edit.php');
	
}

function gift_admin_edit_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	//include('promo-admin-list-page.php');
	include('gift-admin-edit.php');
	
}



?>