<?php
/**
 * Template Name: Testimonial 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>
<div class="testimonialPage">
	<div class="">
		<div class="testimonialMain">			
			<!-- <h1><?php the_title(); ?></h1> -->

			<div class="imageTestimonialBox">
				<ul class="clearfix list-unstyled">
					<li><figure><img src="<?php echo get_template_directory_uri();?>/images/wedding-1-1.jpg" alt=""></figure></li>
					<li><h5>Hi Kenny, <br>Thanks again for helping to make our day a little more special and working closely with all of the groomsmen and my Dad!<br>-Tim Dlugos</h5></li>
					<li><figure><img src="<?php echo get_template_directory_uri();?>/images/wedding-1-2.jpg" alt=""></figure></li>
				</ul>
			</div>

			<?php 	
				$source_args = array( 
					'post_type' => 'testimonials', 
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
							'key'     => 'testimonial-type',
							'value'   => 2, //1 is for regular, 2 is for source
						)
					),
				);
				$source_query = new WP_Query( $source_args );
				
				while ( $source_query->have_posts() ) {
					
					$source_query->the_post();
					$post_id = get_the_ID();
					$given_by = get_post_meta($post_id, 'given_by');    
					$designation = get_post_meta($post_id, 'designation');  
					$testimonial = get_post_meta($post_id, 'testimonial');
					$social_site = get_post_meta($post_id, 'social-site');
					$post_link = get_post_meta($post_id, 'post-link'); 
			?>
			<div class="main_content">
				<span>
					<?php echo $testimonial[0]; ?>
				</span>
				<div>
				  	<?php 
				  		if (has_post_thumbnail( $post_id ) ){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
							?>
							 <img src="<?php echo $image[0]; ?>" >
						<?php } else { ?>
						<img src="<?php echo get_template_directory_uri();?>/images/default-picture-bigger.png" />
						<?php } ?>
					<div>
					<p><b><?php echo $given_by[0]; ?></b></p>
                    <p> <small><?php echo $designation[0]; ?></small> </p>
                	</div>
				</div>
			</div>

			<?php 
				} 
				wp_reset_query();
			?>

			<h1>Direct feedback from our clients:</h1>
			<?php 	
				$regular_args = array( 
					'post_type' => 'testimonials', 
					'posts_per_page' => -1,
					'meta_query' => array(
						array(
							'key'     => 'testimonial-type',
							'value'   => 2, //1 is for regular, 2 is for source
							'compare' => 'NOT EXISTS'
						)
					),
				);
				$regular_query = new WP_Query( $regular_args );
				
				while ( $regular_query->have_posts() ) {
					
					$regular_query->the_post();
					$post_id = get_the_ID();
					$given_by = get_post_meta($post_id, 'given_by');    
					$designation = get_post_meta($post_id, 'designation');  
					$testimonial = get_post_meta($post_id, 'testimonial');
					$social_site = get_post_meta($post_id, 'social-site');
					$post_link = get_post_meta($post_id, 'post-link'); 
			?>
			<div class="main_content">
				<span>
					<?php echo $testimonial[0]; ?>
				</span>
				<div>
				  	<?php 
				  		if (has_post_thumbnail( $post_id ) ){
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail' ); 
							?>
							 <img src="<?php echo $image[0]; ?>" >
						<?php } else { ?>
						<img src="<?php echo get_template_directory_uri();?>/images/default-picture-bigger.png" />
						<?php } ?>
					<div>
					<p><b><?php echo $given_by[0]; ?></b></p>
                    <p> <small><?php echo $designation[0]; ?></small> </p>
                	</div>
				</div>
			</div>

			<?php 
				} 
				wp_reset_query();
			?>

			<div class="imageTestimonialBox">
				<ul class="clearfix list-unstyled">
					<li><figure><img src="<?php echo get_template_directory_uri();?>/images/wedding-2-1.jpg" alt=""></figure></li>
					<li><h5>Mr. Kenny, the wedding was a smashing success this weekend and people were raving about the suits.  Thank you again.<br>-Herb Buchanan</h5></li>
					<li><figure><img src="<?php echo get_template_directory_uri();?>/images/wedding-2-2.jpg" alt=""></figure></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer();  ?>