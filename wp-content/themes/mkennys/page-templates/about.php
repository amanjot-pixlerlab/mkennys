<?php
/**
 * Template Name: About
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */
get_header(); 
?>

<div class="about_banner">
    <div class="container">
        <h1>Your Personal Custom Tailor</h1>
    </div>
</div>
<div class="aboutDesc">
    <div class="container">
        <div class="ADContent">
            <?php if (have_posts()) : 
				while (have_posts()) : the_post(); ?>   
					<?php the_content(); ?>
				<?php endwhile; ?>
			<?php endif; ?>
        </div>
    </div>
</div>
<div class="customerService clearfix">
    <div class="CS_img"> <img src="<?php echo get_template_directory_uri();?>/images/true_fitted_illustration.jpg"> </div>
    <div class="CS_text">
        <h2>Our Philosophy</h2>
        <p><?php the_cfc_field('about', 'customer-service'); ?></p>
    </div>
</div>
<div class="i_selection">
    <div class="container">
        <div class="IS_title">
            <h3>Our Roots</h3>
        </div>
        <div class="IS_text">
        	<p><?php the_cfc_field('about', 'inimitable-selections'); ?></p>
        </div>
    </div>
</div>
<div class="partnerSection">
	<div class="split-section">
	
		<div class="container">
			<figure class="modern">
			  <img src="<?php echo get_template_directory_uri();?>/images/kenny-pic.jpg"" alt="Kenny with Erika Slezak Davies, TV Serial: One Life to Live" width="304" height="228">
			  <figcaption>Kenny with Erika Slezak Davies, TV Serial: One Life to Live</figcaption>
			</figure>
		</div>
		
		<div class="container middle">
			<div class="SSContent">
				<p><b>Affiliate Partners</b></p>
				<ul class="clearfix partner-logos">
					<?php /* <li><img src="<php echo get_template_directory_uri();>/images/bk-enterprises.png"></li> */ ?>
					<li><img src="<?php echo get_template_directory_uri();?>/images/hong-kong.png"></li>
				</ul>
			</div>
		</div>
	</div>    
</div>
<!-- <div class="aboutGallery">
    <ul class="unstyled-list clearfix">
        <li><img src="<?php echo get_template_directory_uri();?>/images/a-s-img-1.jpg" class="img-responsive"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/a-s-img-2.jpg" class="img-responsive"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/a-s-img-3.jpg" class="img-responsive"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/a-s-img-4.jpg" class="img-responsive"></li>
    </ul>    
</div> -->
<?php
get_footer(); 
?>
