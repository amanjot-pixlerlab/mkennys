<?php
/**
 * Template Name: Custom Experience
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>




<div class="CE_banner">
    <div class="container">
    	<div class="CEB_content">
            <h1>Custom Experience</h1>
            <?php if (have_posts()) : 
                while (have_posts()) : the_post(); ?>   
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
    <a href="javascript:;" id="moveDown"></a>
</div>

<div class="CE_container">
    <?php $i = 0; ?>
	<?php foreach( get_cfc_meta( 'experience' ) as $key => $value ){ ?>

    
		<div id ="cus<?php echo $i; ?>" class="CE_row clearfix" style="background-image:url(<?php the_cfc_field( 'experience','experience-image', false, $key ); ?>)">
            <div class="CER_desc">
                <?php the_cfc_field( 'experience','experience-description', false, $key ); ?>
            </div>		
	    </div>
     <?php   $i++; ?>
    <?php }  ?>
</div>

<div class="styleSection">
    <div class="container">
        <div class="SSContent">
            <figure><img src="<?php echo get_template_directory_uri();?>/images/coat.png"></figure>
            <figcaption>
            	<p><b>Ensure Fit</b></p>
                <p>Our traveling tailors work until expectations are met, period. </p>
            	<p><a href="<?php echo esc_url(home_url());?>/tour-schedules/" class="fitted_btn">Get Fitted <i class="fa fa-chevron-right"></i></a></p>
            </figcaption>
        </div>
    </div>
</div>



<script>
            $(document).ready(function(e) {
                
            setTimeout(function(){
                var hash = window.location.hash;
                if(hash!=""){
                    $(window).scrollTop($(hash).position().top - 120);
                }
            },100);
        });
        
    </script>

<?php get_footer(); ?>
