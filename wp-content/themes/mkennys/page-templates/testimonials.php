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
			<div class="testimonalBox-inner">
				<div class="container">
					<div class="testimonalBox-card">
						<div class="card-inner-box card-left">
							<div class="card-box-image">
								<img src="<?php echo get_template_directory_uri();?>/images/customer-image.jpg" alt="">
								
							</div>
							<div class="card-box-body">
								<div class="card-box-inner">
									<div class="card-text">
										<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 160 160" style="enable-background:new 0 0 160 160;" xml:space="preserve">
												<style type="text/css">
													.st0{fill:#FFFFFF;}
												</style>
												<g transform="matrix(1, 0, 0, 1, 0, 0)">
													<rect id="Rectangle-2" class="st0" width="160" height="160"></rect>
												</g>
												<g>
													<path d="M57.5,33.6h20.2L56.9,77.3c8,3.9,14.9,12.5,14.9,23.5c0,14-11.3,25.6-25.6,25.6c-14.3,0-25.6-11.6-25.6-25.6
														c0-5.7,1.8-11.3,4.8-16.1L57.5,33.6z M119.1,33.6h20.2l-20.8,43.8c8,3.9,14.9,12.5,14.9,23.5c0,14-11.3,25.6-25.6,25.6
														c-14.3,0-25.6-11.6-25.6-25.6c0-5.7,1.8-11.3,4.8-16.1L119.1,33.6z"></path>
												</g>
												</svg>
												<p>M Kenny has been my custom clothing maker for years. If you have never tried fitted clothing, you are in for a treat. As a former 
													financial, advisor, it was important for me to wear suits and ties. M Kenny made all of my suits, sport coats and shirts. One of the real
													traits is to walk into a place with clothes that cannot be bought off the rack like my custom tux or pink linen sport coat. Heartily 
													recommend you spend the time to talk to them about your casual and dress clothes.</p>
												<div class="client-name">Scott Balsam</div>
											<div>
										</div>
									</div>
								</div>
							</div>
						</div>		
					<div class="card-inner-box card-right">
						<div class="card-box-body">
							<div class="card-box-inner">
								<div class="card-text">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 160 160" style="enable-background:new 0 0 160 160;" xml:space="preserve">
										<style type="text/css">
											.st0{fill:#FFFFFF;}
										</style>
											<g transform="matrix(1, 0, 0, 1, 0, 0)">
												<rect id="Rectangle-2" class="st0" width="160" height="160"></rect>
											</g>
											<g>
												<path d="M57.5,33.6h20.2L56.9,77.3c8,3.9,14.9,12.5,14.9,23.5c0,14-11.3,25.6-25.6,25.6c-14.3,0-25.6-11.6-25.6-25.6
													c0-5.7,1.8-11.3,4.8-16.1L57.5,33.6z M119.1,33.6h20.2l-20.8,43.8c8,3.9,14.9,12.5,14.9,23.5c0,14-11.3,25.6-25.6,25.6
													c-14.3,0-25.6-11.6-25.6-25.6c0-5.7,1.8-11.3,4.8-16.1L119.1,33.6z"></path>
											</g>
										</svg>
											<p>M Kenny has been my custom clothing maker for years. If you have never tried fitted clothing, you are in for a treat. As a former financial, 
												advisor, it was important for me to wear suits and ties. M Kenny made all of my suits, sport coats and shirts. One of the real traits is to
												 walk into a place with clothes that cannot be bought off the rack like my custom tux or pink linen sport coat. Heartily recommend you spend 
												 the time to talk to them about your casual and dress clothes.</p>
											<div class="client-name">Scott Balsam</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
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