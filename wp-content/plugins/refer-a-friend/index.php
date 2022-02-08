<?php
/*
Plugin Name: refer-a-friend
Plugin URI: ''
Description: This is plugin 
Version:     20160981
Author:      krish
Author URI:  ''
License:     GPL2
*/

add_action( 'admin_menu', 'my_menu' );

function my_menu(){

// add_menu_page( 'Referral List', 'Referral List', 'manage_options', 'refer-admin-page.php', 'refer_admin_page', 'dashicons-admin-users', 7  );
// add_submenu_page( 'refer-admin-page.php', 'List', 'Referral List', 'manage_options', 'refer-admin-list-page.php', 'refer_admin_sub_page');
// add_submenu_page( 'refer-admin-page.php', 'Referral List', null, 'manage_options', 'refer-admin-edit.php', 'refer_admin_edit_page'); 


/*add_submenu_page( 'mkenny-admin-page.php', 'Calendar Event', 'Calendar Event', 'manage_options', 'mkenny-admin-calendar-event.php', 'mkenny_admin_calendar_event_page'); 

remove_submenu_page( 'mkenny-admin-page.php', 'mkenny-admin-page.php' );
*/	
remove_submenu_page( 'refer-admin-page.php', 'refer-admin-page.php' );
}


function refer_admin_page(){
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	include('refer-admin-page.php');
	
}

function refer_admin_sub_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	include('refer-admin-list-page.php');
	
}

function refer_admin_edit_page(){
	if ( !current_user_can( 'manage_options' ) ){
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	
	//include('promo-admin-list-page.php');
	include('refer-admin-edit.php');
	
}

?>