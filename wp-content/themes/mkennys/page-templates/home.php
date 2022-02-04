<?php

/**

 * Template Name: Home Page

 *

 * @package WordPress

 * @subpackage Twenty_Fifteen

 * @since Twenty Fourteen 1.0

 */

$homeId ='';
$homeId = get_the_ID();
get_header(); 

 

?>

<div class="position-relative commonSection">
    <div class="home-carousel owl-carousel owl-theme">
        <?php foreach( get_cfc_meta( 'main_slider' ) as $key => $value ){ ?>
        <div class="item">
            <div class="mainBanner selected <?php the_cfc_field( 'main_slider','light-text', false, $key );?>  <?php the_cfc_field( 'main_slider','aligned', false, $key );?>" style="background-image: url('<?php echo the_cfc_field( 'main_slider','image', false, $key );?>')">
                <div class="container">
                    <div class="bannerContent">
                        <h1 class="text-uppercase"><?php echo the_cfc_field( 'main_slider','sub-title', false, $key );?></h1>
                        <h2 class="text-uppercase"><?php echo the_cfc_field( 'main_slider','title', false, $key );?></h2>
                        
                        <a class="fittedBtn"><?php echo the_cfc_field( 'main_slider','button-text', false, $key );?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php  } ?> 
    </div>
    <img src="<?php echo get_template_directory_uri(); ?>/images/arrow.png" class="home_begning">
</div>

<div class="homeTagLine commonSection">
    <!-- <p>A fully handmade custom garment designed and commissioned by you, and created specifically just for you. 
    </p> -->
</div>
<div class="ho_pe_ex specialists-clothing">
    <div class="container">
        <h3>Specialists in handcrafted custom clothing</h3>
        <p>Select fabrics from the world’s finest mills and design all the little subtleties’ for a refined look</p>
        <div class="ho_cu_de">
            <div class="designSuit designBox">
                <p><b>Design Your Own Suit</b></p>
                <ul class="unstyled-list">
                    <li>5,000+ Fabrics</li>
                    <li>Fully Canvased Construction</li>
                    <li>Your custom style elements</li>
                    <li>The Right Fit</li>
                    <!-- <li>Multiple Jacket Styles</li>
                    <li>8+ Pant Styles</li> -->
                </ul>
                <p class="suit_price">Suits from $689</p>
                <p class="use_tapered">
                Use a tapered suit from online and make
                <br>
                it half grayed just like how you have it here
                </p>
            </div>
            <div class="suitIllustration"> <img src="<?php echo get_template_directory_uri();?>/images/illustration.png"> </div>
            <div class="designShirt designBox">
                <p><b>Design Your Own Shirt</b></p>
                <ul class="unstyled-list">
                    <li>15 Different Collars</li>
                    <li>4 Pocket Styles</li>
                    <li>Placket/Pleat Options</li>
                    <li>9 Different Cuffs</li>
                    <li>10 Monogram Styles</li>
                    <li>The Right Fit</li>
                </ul>
                <p class="suit_price">Shirts from $95</p>
               
                <p><a href="<?php echo esc_url(home_url());?>/tour-schedules/" class="startBtn">Start Now <i class="fa fa-chevron-right"></i></a></p>
            </div>
        </div>
    </div>
</div>
<div class="ho_HIT clearfix">
    <div class="ho_HIT_left">
        <h4>How it<br>
            works</h4>
        <p>Meet with a traveling tailor in your city to be fitted for your next custom suit/shirt. Locate a tailor by viewing our <a href="<?php echo site_url();?>/tour-schedules">tour schedule.</a></p>
    </div>
    <div class="ho_HIT_right">
        <ul class="unstyled-list">
            <li>
                <figure><img src="<?php echo get_template_directory_uri();?>/images/icon-01.png"></figure>
                <figcaption>Locate an MK Representative</figcaption>
                <a class="unstyled-anchor" href="<?php echo site_url();?>/tour-schedules">Tell me more</a>
            </li>
            <li>
                <figure><img src="<?php echo get_template_directory_uri();?>/images/icon-02.png"></figure>
                <figcaption>Measurement Consultation</figcaption>
                <a class="unstyled-anchor" href="<?php echo site_url();?>/custom-experience">Tell me more</a>

            </li>
            <li>
                <figure><img src="<?php echo get_template_directory_uri();?>/images/icon-03.png"></figure>
                <figcaption>Handmade Custom Construction</figcaption>
                <a class="unstyled-anchor" href="<?php echo site_url();?>/custom-experience">Tell me more</a>

            </li>
            <li>
                <figure><img src="<?php echo get_template_directory_uri();?>/images/icon-04.png"></figure>
                <figcaption>5-7 Week Delivery</figcaption>
                <a class="unstyled-anchor" href="<?php echo site_url();?>/faq/#faq_118">Tell me more</a>

            </li>
            <li>
                <figure><img src="<?php echo get_template_directory_uri();?>/images/icon-05.png"></figure>
                <figcaption>Ensure Fit With Us</figcaption>
                <a class="unstyled-anchor" href="<?php echo site_url();?>/custom-experience">Tell me more</a>

            </li>
        </ul>
    </div>
</div>
<div class="homeBlock clearfix">
    <div class="HB_visit">
        <h3>Visit us in your city</h3>
        <?php echo do_shortcode( '[foobar]' ) ; ?>
        <p><a href="<?php echo site_url();?>/tour-schedules/#cityMap" class="btnBig">Don't see your city above? See our FULL road tour <i class="fa fa-chevron-right"></i></a></p>
    </div>
    <div class="HB_refer">
        <div class="HBR_content">
            <h3>Refer A Friend</h3>
            <p>Love Your Suit/Shirt? Refer-A-Friend and receive a complimentary custom shirt on us. </p>
            <a class="RF_btn viewDetail">REFER A FRIEND</a> </div>
    </div>
</div>
<div class="testimonials_home">
    <div class="testimonial" id="testimonials">
        <?php 

            $args = array( 'post_type' => 'testimonials', 'posts_per_page' => -1 );

            $the_query = new WP_Query( $args );

            while ( $the_query->have_posts() ) {

                $the_query->the_post();

                $post_id = get_the_ID();

                $given_by = get_post_meta($post_id, 'given_by');    

                $designation = get_post_meta($post_id, 'designation');  

                $testimonial = get_post_meta($post_id, 'testimonial');

                $social_site = get_post_meta($post_id, 'social-site');

                $post_link = get_post_meta($post_id, 'post-link');          

            ?>
        <div>
            <div>
                <?php 

                            if (has_post_thumbnail( $post_id ) ){

                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 

                            ?>
                <div class="SStep">
                    <figure>
                        <?php if($social_site[0] != 'None'){ ?>
                        <a target="blank" href="<?php echo 'http://'.$post_link[0]; ?>"> <img src="<?php echo $image[0]; ?>" > </a>
                        <?php }else { ?>
                        <img src="<?php echo $image[0]; ?>" >
                        <?php } ?>
                    </figure>
                </div>
                <?php } else{ ?>
                <div class="SStep">
                    <figure>
                        <img src="<?php echo get_template_directory_uri();?>/images/default-picture-bigger.png" />
                    </figure>
                </div>
                <?php } ?>
                <p><?php echo $testimonial[0]; ?></p>
                <div class="TPosted">
                    <p><b><?php echo $given_by[0]; ?></b></p>
                    <p> <small><?php echo $designation[0]; ?></small> </p>
                    <p>
                        <?php if($social_site[0] != 'None'){ ?>
                        <small><a target="blank" href="<?php echo 'http://'.$post_link[0]; ?>"><?php echo $social_site[0]; ?></a></small>
                        <?php } ?>
                    </p>
                </div>
            </div>
        </div>
        <?php } 

            wp_reset_postdata();

        ?>
    </div>
    <a href="<?php echo site_url();?>/clientreviews/" class="fitted_btn">View more review</a>

    
</div>

<!-- <div class="styleSection">
    <div class="container">
        <div class="SSContent">
            <p><b>Suiting America</b></p>
            <h5>for over 20 years</h5>
        </div>
    </div>
</div> -->

<?php 
$oneTime=false;


$fctime = '';
$query = new WP_Query(array('post_type' => 'mkennypopup'));
while ( $query->have_posts() ) :
$query->the_post();  
$post_id=get_the_ID();
$pageId = get_post_meta($post_id,'page-id') ;

if($homeId==$pageId['0']){
	$title = get_post_meta($post_id,'popup-title');
	$description = get_post_meta($post_id,'popup-description') ;
	$status = get_post_meta($post_id,'popup-status') ;
	$time = get_post_meta($post_id,'popup-time') ;	
	$home_img = get_post_meta( $post_id, 'popup-image',true);
	$home_img = wp_get_attachment_image_src( $home_img, 'full' );		
	$success_message = get_post_meta($post_id,'popup-message');
	$fctime=$time['0'];

	if($status['0']=='enable'){

		
		$page_title= get_the_title($homeId);		
		if(isset($page_title)){
			$ip_address=get_user_ip();
			$oneTime=checkIpAddress($page_title,$ip_address['ipAddress']);
		}
		
		
		if($oneTime){
		
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('body').addClass('bodyFixed');

                jQuery('.FCclosePopup').click(function(){
                    jQuery('body').removeClass('bodyFixed');
                });

            });
        </script>
        

        <?php

		echo '<div class="firstComePopup">';
		
			echo '<div class="FCpopup_inner">';
			echo '<div class="FCpopup_element">';
					echo '<div class="FCpopup_content FPR_box" style="background-image:url('.$home_img[0].')">';
						echo '<button class="FCclosePopup">+</button>';
						echo'<p><img src="'.get_template_directory_uri().'/images/logo-white.png"></p>';
                        echo '<h2 class="FCpopup_title">'.$title[0].'</h2>';
                        echo '<div class="FCpopup_description">'.$description[0].'</div>';
						echo'<div class="popupOptions">';
						echo'<button class="home_pop yesGreen" value="ok">Yes, I want to look my best</button>'; 
                        echo'<button class="home_pop nocolor" value="not">No I don’t care about my appearance </button>';
						echo'</div>';
                        echo '<div class="FCpopup_message ">';
							echo '<p>We want to get you fitted, but first provide us with a few details:</p>';
							echo do_shortcode('[wysija_form id="4"]');
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		
		echo '<div class="customPopOverlay">';
			echo '<div class="CPO_inner">';
				echo '<p>'.$success_message['0'].'</p>';
				echo '<button class="CPO_close">Close</button>';
			echo '</div>';
	    echo '</div>';
		
		
	 }	
		
	}
}
  
endwhile;

wp_reset_query();



?>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.js"></script> 
<script>
jQuery('#testimonials').owlCarousel({ 
	singleItem: true,
	autoPlay : true,
	pagination: false
});

// slider
jQuery('.home-carousel').owlCarousel({
        loop: true,
		singleItem: true,
		autoPlay: 8000,
        pagination: true,
        navigation : true,
        navigationText:['<i class="fa fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-chevron-right" aria-hidden="true"></i>']
    });
    
jQuery('.fittedBtn').click(function(){
    window.location = 'http://mkennys.com/tour-schedules/'
})

jQuery(document).ready(function(){ 

	// Feedback Form hide/show
	
		jQuery('.feedBackBtn').click(function() { 
			jQuery('.feedBackform').toggleClass('active')
		})	
	
	
	
	

	var fctime = '<?php echo $fctime ?>';
	fctime = fctime*1000;
	setTimeout(function() { 
		jQuery('.firstComePopup').fadeIn();
	},fctime)
	
	jQuery('.FCclosePopup').click(function() {  
		jQuery('.firstComePopup').fadeOut();
	});

    jQuery('.footerPrefix .wysija-submit').click(function() { 
        jQuery('.customPopOverlay').html('');
        jQuery('.customPopOverlay').css('position','relative');
    })


});	


jQuery('.popupOptions .home_pop').click(function(){  
  
  var myVal = jQuery(this).attr('value');
  
  
  if(myVal === 'ok'){  
	jQuery(this).parents('.popupOptions').hide();
	jQuery('.FCpopup_message').show();
  }
  else { 
	//console.log(myVal);
	jQuery('.firstComePopup').hide();
  }
})	


	
</script>
<style>
	.FCpopup_message{  
		display: none;
	}
</style>
<?php
get_footer();
?>
