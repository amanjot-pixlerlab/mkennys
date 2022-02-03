<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">
<link href="<?php echo get_template_directory_uri(); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<?php wp_head(); ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/css/minor.css" rel="stylesheet" type="text/css">
</head>

<body <?php body_class(); ?>>
<div class="wrapper">
<header class="header clearfix">
    <div class="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img  src="<?php echo get_template_directory_uri(); ?>/images/logo.png" class="responsive" alt="Mkennys"> </a> </div>
    <nav class="mainMenu">
        <?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'menu_class'     => 'clearfix',
			'container' => null,
		 ) ); 
		?>
    </nav>
    <div class="headerRight">
        <ul class="clearfix menuRight">
            <li class="contactNumber">
            	<a href="javascript:;"><i class="fa fa-phone"></i></a>
            	<ul class="clearfix">
                	<li><b><i class="fa fa-phone"></i> US Toll Free</b> 800-220-8469</li>
                    <li><b><i class="fa fa-phone"></i> International</b> + 1 714 573 2199</li>
                </ul>
            </li>
            <li><a href="mailto:info@mkennys.com"><i class="fa fa-envelope"></i></a></li>
            <li class="contactBtn"><a href="<?php echo esc_url(home_url());?>/contact">Contact Us</a></li>
            <li class="getFittedBtn"><a href="<?php echo esc_url(home_url());?>/tour-schedule">Get Fitted <i class="fa fa-chevron-right"></i></a></li>
        </ul>
    </div>
    
		
    <div class="mobileMenu">
    	<div class="mobileMenuOverlay"></div>
            <div class="mobileMainMenu">
                <?php wp_nav_menu( array(
                'theme_location' => 'primary',
                'menu_class'     => 'clearfix',
                'container' => null,
                 ) ); 
                ?>
                <ul>
                    <li><a href="<?php echo esc_url(home_url());?>/tour-schedule">Get Fitted</a></li>
                    <li><a href="<?php echo esc_url(home_url());?>/contact">Contact Us</a></li>
                    <li><a href="javascript:;"><i class="fa fa-phone"></i><b>US Toll Free</b> <p>800-220-8469</p></a></li>
                    <li><a href="javascript:;"><i class="fa fa-phone"></i><b>International</b> <p>+ 1 714 573 2199</p></a></li>
                	<li><a href="mailto:info@mkennys.com"><i class="fa fa-envelope"></i>info@mkennys.com</a></li>    
                </ul>
            </div>
        
        <div class="mobileTopMenu">
        	<ul class="clearfix">
                <li>
                	<a href="javascript:;" class="mobileMenuBtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </li>
            </ul>
        </div>
        
    </div>    
        
</header>


<script>
	$(document).ready(function(e) {
        $('.mobileMenuBtn').click(function() { 
			$('.mobileMenuOverlay').toggleClass('active');
		})
		$('.mobileMenuOverlay').click(function() { 
			$(this).removeClass('active');
		})
    });
</script>