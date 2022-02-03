<?php
/*
Plugin Name: Notify
Plugin URI: ''
Description: Get Notification for tour schedule
Version:     240892
Author:      Krish
Author URI:  ''
License:     GPL2
*/

add_action( 'admin_menu', 'notify_menu' );

function notify_menu(){

add_menu_page( 'Notify', 'Notify', 'manage_options', 'notify-admin-page.php', 'notify_admin_page', 'dashicons-format-status', 10  );
add_submenu_page( 'notify-admin-page.php', 'Notify', 'All Notification', 'manage_options', 'notify-admin-list-page.php', 'notify_admin_sub_page'); 

add_submenu_page( 'notify-admin-page.php', 'Notify', null, 'manage_options', 'notify-admin-sub.php', 'notify_admin_sub'); 

add_submenu_page( 'notify-admin-page.php', 'Notify', null, 'manage_options', 'notify-admin-mail.php', 'notify_admin_mail'); 


remove_submenu_page( 'notify-admin-page.php', 'notify-admin-page.php');

}

function notify_admin_sub(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	//include('promo-admin-list-page.php');
	include('notify-admin-sub.php');
	
}

function notify_admin_mail(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	//include('promo-admin-list-page.php');
	include('notify-admin-mail.php');
	
}

function notify_admin_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include('notify-admin-page.php');
	
}

function notify_admin_sub_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	include('notify-admin-list-page.php');
	
	
}





?>