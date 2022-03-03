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

<?php

if($_SERVER['REQUEST_URI'] == '/mkennypopup/tour-schedule-popup/')

{

    header('location:http://'.$_SERVER['HTTP_HOST'].'/404');

    exit;

}



?>

<!DOCTYPE html>

<html <?php language_attributes(); ?> class="no-js">

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700" rel="stylesheet">

<link href="<?php echo get_template_directory_uri(); ?>/fonts/stylesheet.css" rel="stylesheet" type="text/css">

<link href="<?php echo get_template_directory_uri(); ?>/css/owl.carousel.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri(); ?>/css/owl.theme.css" rel="stylesheet" type="text/css">

<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<?php wp_head(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/style.css?5srdfdgd45ffgdfgfv223ff3342" rel="stylesheet" type="text/css">

<link href="<?php echo get_template_directory_uri(); ?>/css/minor.css" rel="stylesheet" type="text/css">


<!-- Facebook Pixel Code -->
<script>
  !function (f, b, e, v, n, t, s) {
    if (f.fbq) return; n = f.fbq = function () {
      n.callMethod ?
      n.callMethod.apply(n, arguments) : n.queue.push(arguments)
    };
    if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
    n.queue = []; t = b.createElement(e); t.async = !0;
    t.src = v; s = b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t, s)
  }(window, document, 'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '447629459300829');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" src="https://www.facebook.com/tr?id=447629459300829&ev=PageView&noscript=1" />
</noscript>
<!-- End Facebook Pixel Code -->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45658158-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45658158-1');
</script>



</head>



<body <?php body_class(); ?>>

<div class="wrapper">
<?php if(!is_page('323') && !is_page('325')){ ?>
<header class="header clearfix">

            <div class="top_part">
                <div class="row">
                    <div class="col-lg-4 col-md-3 col-sm-6 col-xs-5 ">
                        <ul class="head_topbar social-link-header">
                            <!-- <li class="active"><a href="<?= home_url(); ?>"> Men </a></li>
                            <li><a href="<?= home_url(); ?>/women"> Women </a></li> -->
                            <li><a href="javascript:void(0)"> <img  src="<?php echo get_template_directory_uri(); ?>/images/infinity-icon.svg" class="responsive" alt="Mkennys"> </a></li>
                            <li class="active"><a target="_blank" href="http://www.linkedin.com/in/mkenny"><img  src="<?php echo get_template_directory_uri(); ?>/images/linkdin.svg" class="responsive" alt=""> </a></li>                        
                        </ul>
                    </div>
                    <div class="col-lg-8 col-md-9 col-sm-6 col-xs-7 ">
                        <ul class="head_topbar right-Topbar">
                            <li class=""><a href="tel:800-220-8269>"> <i class="fa fa-phone" aria-hidden="true"></i> 800-220-8269</a></li>
                            <li><a href="info@mkennys.com"> <i class="fa fa-envelope" aria-hidden="true"></i> info@mkennys.com </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">
    <div class="header-inner">        
    <div class="logo"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"> <img  src="<?php echo get_template_directory_uri(); ?>/images/mkennys-logo.svg" class="responsive" alt="Mkennys"> </a> </div>
    <div class="menu-wrapper">
    <nav class="mainMenu">

        <!-- <?php wp_nav_menu( array(

			'theme_location' => 'primary',

			'menu_class'     => 'clearfix',

			'container' => null,

		 ) ); 

		?> -->

         <ul class="clearfix" id="menu-main-menu">

            <li><a href="<?php echo esc_url(home_url());?>/suits/">Custom Style</a>

                <ul class="sub-menu">

                    <li>

                        <div class="menuContainer bespokeMenu">

                            <div class="bespokeMenuLeft">

                                <p><b>Custom Style</b></p>

                                <ul>

                                    <li><a href="<?php echo esc_url(home_url());?>/suits/">Suits</a></li>

                                    <li><a href="<?php echo esc_url(home_url());?>/shirts/">Shirts</a></li>

                                    <li><a href="<?php echo esc_url(home_url());?>/women/">Women's Wear</a></li>

                                    <li><a href="<?php echo esc_url(home_url());?>/outerwear/">Outerwear</a></li>

                                </ul>

                            </div>

                            <div class="bespokeMenuRight">

                                <ul class="clearfix">

                                    <li> <a href="<?php echo esc_url(home_url());?>/suits/">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/suit.jpg">

                                            <figcaption>Suits <i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/shirts/">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/shirt.jpg">

                                            <figcaption>Shirts <i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/Jackets/">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/jacket.jpg">

                                            <figcaption>Jackets  <i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/outerwear/">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/outerwear.jpg">

                                            <figcaption>Outerwear <i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                </ul>

                            </div>

                        </div>

                    </li>

                </ul>

            </li>

            <li><a href="<?php echo esc_url(home_url());?>/custom-experience/">Custom Experience</a>

                <ul class="sub-menu">

                    <li>

                        <div class="menuContainer customExpMenu">

                            <div class="customExpMenuLeft">

                                <p><b>Custom Experience</b></p>

                                <p>Understanding our client’s fit preferences and unique tastes are our top priority. Our second and third generation tailors provide a level of experience and customer service that we take great pride in. </p>

                                <p><a href="<?php echo esc_url(home_url());?>/custom-experience/" class="menuBtn">Visit <i class="fa fa-chevron-right"></i></a></p>

                            </div>

                            <div class="customExpMenuRight">

                                <ul>

                                    <li> <a href="<?php echo esc_url(home_url());?>/custom-experience/#cus0">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/customep-1.jpg">

                                            <figcaption>QUALITY CRAFTSMANSHIP <i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/custom-experience/#cus1">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/customep-2.jpg">

                                            <figcaption>FITTINGS IN YOUR CITY<i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/custom-experience/#cus2">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/customep-3.jpg">

                                            <figcaption>PERSONALIZATION<i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                    <li> <a href="<?php echo esc_url(home_url());?>/custom-experience/#cus3">

                                        <figure> <img src="<?php echo get_template_directory_uri();?>/images/mega-menu/customep-4.jpg">

                                            <figcaption>HANDCRAFTED<i class="fa fa-chevron-right"></i></figcaption>

                                        </figure>

                                        </a> </li>

                                </ul>

                            </div>

                        </div>

                    </li>

                </ul>

            </li>

            <!-- <li><a href="<?php //echo esc_url(home_url());?>/tour-schedule/">Tour Schedule</a>

                <ul class="sub-menu">

                    <li>

                        <div class="menuContainer tourMenu">

                            <div class="tourMenuLeft">

                                <p><b>Tour Schedule</b></p>

                                <p>Our traveling tailors set up “trunk shows” in various cities throughout the United States quarterly. This gives our clients a window to personalize their garments and feel fabrics first hand.</p>

                                <p><a href="<?php //echo esc_url(home_url());?>/tour-schedule/" class="menuBtn">View Tour Schedule <i class="fa fa-chevron-right"></i></a></p>

                            </div>

                            <div class="tourMenuRight">

                                <ul>

                                    <li> 

                                        <figure><img src="<?php //echo get_template_directory_uri();?>/images/mega-menu/map.jpg"></figure>

                                    </li>

                                    <li>

                                        <div class="HB_visit">

                                            <p><b>UPCOMING CITIES</b></p>

                                            <?php //echo do_shortcode( '[foobar]' ) ; ?>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </li>

                </ul>

            </li> -->

            <li><a href="<?php echo esc_url(home_url());?>/about/">About</a>

                <ul class="sub-menu">

                    <li>

                        <div class="menuContainer aboutMenu">

                            <div class="aboutMenuLeft">

                                <p><b>About</b></p>

                                <p>We are custom tailors that pride ourselves on getting to know our clients and their personal style preferences. We strive to meet expectations and provide a personalized service to each of our valued clients.</p>

                                <p><a href="<?php echo esc_url(home_url());?>/about/" class="menuBtn">Learn More <i class="fa fa-chevron-right"></i></a></p>

                            </div>

                            <div class="aboutMenuRight">

                                <ul>

                                    <?php 



                                    $args = array( 'post_type' => 'testimonials', /*'order' => 'ASC',*/ 'posts_per_page' => 1 );

                                    $the_query = new WP_Query( $args );

                                    while ( $the_query->have_posts() ) {



                                        $the_query->the_post();

                                        $post_id = get_the_ID();

                                        $given_by = get_post_meta($post_id, 'given_by');    

                                        $designation = get_post_meta($post_id, 'designation');  

                                        $testimonial = get_post_meta($post_id, 'testimonial');

                                                



                                    ?>

                                    <li>

                                        <div class="menuReviews">

                                            <p><b>Reviews</b></p>

                                            <?php echo $testimonial[0]; ?>

                                            <div class="postedBy">

                                                <p><?php echo $given_by[0]; ?> <small><?php echo $designation[0]; ?></small></p>

                                                <p><a href="<?php echo esc_url(home_url());?>/clientreviews/" class="menuBtn">Read More <i class="fa fa-chevron-right"></i></a></p>

                                            </div>

                                        </div>

                                    </li>

                                    <?php } wp_reset_postdata();  ?>

                                    <li>

                                        <div class="footerBox">

                                            <p><b>Contact Us</b></p>

                                            <div class="addressBlock">

                                                <div class="phone">

                                                    <p><b>Phone</b></p>

                                                    <p>+ 1 714 573 2199</p>

                                                </div>

                                                <div class="email">

                                                    <p><b>Email</b></p>

                                                    <p><a href="mailto:info@mkennys.com">info@mkennys.com</a></p>

                                                </div>

                                                <div class="address">

                                                    <p><b>US Office</b></p>

                                                   <p>True Fitted by M. Kenny's<br>17601 17th Street, Suite 115<br>Tustin, CA. 92780</p>

                                                </div>

                                                <div class="address">

                                                    <p><b>Asia: Hong Kong</b></p>

                                                    <p>1203 Oriental Center<br>

                                                        67-70 Chatham Road<br>

                                                        Kowloon TST, Hong Kong</p>

                                                </div>

                                            </div>

                                        </div>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </li>

                </ul>

            </li>

        </ul>

    </nav>

    <div class="headerRight">

        <ul class="clearfix menuRight">

            <!--<li class="contactNumber">

            	<a href="javascript:;"><i class="fa fa-phone"></i></a>

            	<ul class="clearfix">

                	<li><b><i class="fa fa-phone"></i> US Toll Free</b> 800-220-8469</li>

                    <li><b><i class="fa fa-phone"></i> International</b> + 1 714 573 2199</li>

                </ul>

            </li>

            <li><a href="mailto:info@mkennys.com"><i class="fa fa-envelope"></i></a></li>

            <li class="contactBtn"><a href="<?php echo esc_url(home_url());?>/contact">Contact Us</a></li>-->
            
            <li class="getFittedBtn"><a href="<?= home_url() ?>/new-tour-schedule" style="cursor: pointer;">Get Fitted  <img src="<?php echo get_template_directory_uri(); ?>/images/right-arrow-header.svg" alt=""></a></li>

        </ul>

    </div>
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

            <li><a href="<?php echo esc_url(home_url());?>/new-tour-schedules">Get Fitted</a></li>

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
</div>   
                                    </div>

    

		

   

        

</header>
<?php }?>




<script>

	$(document).ready(function(e) {

        $('.mobileMenuBtn').click(function() { 

			$('.mobileMenuOverlay').toggleClass('active');

		})

		$('.mobileMenuOverlay').click(function() { 

			$(this).removeClass('active');

		})





        /* This code is prevent the user to go to Tour Schedule page */



        $(document).find('a').each(function(){
            if($(this).attr('href')){
                if($(this).attr('href').indexOf('tour-schedules') > 0 && this.id != 'outlook-event' && this.id !='create-event')

                {

                    var setHref = '<?php echo home_url(); ?>/contact';

                    $(this).attr('href',setHref);

                }

            }
        });

                 

        

        /*$('a').click(function(e){ 

            var get_fitted_href = $(this).attr('href'); 

            if(get_fitted_href.indexOf('tour-schedule') >= 0 ) {

                e.preventDefault();

                window.location =  '<?php //echo home_url() ?>/contact';

            }

        })*/

    });



    $(window).load(function(){

        var setHref = '<?php echo home_url(); ?>/contact';

        $('.footerPrefix .fitted_btn').attr('href',setHref); 

    });

    // jQuery('.getFittedBtn a').click(function(){
    //     window.location = 'http://mkennys.com/tour-schedules/'
    // })

</script>
