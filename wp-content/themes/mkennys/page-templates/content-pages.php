<?php
/**
 * Template Name: Content Pages
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>

<div class="contentPage">
    <div class="container">
    	<h1><?php the_title(); ?></h1>
        <?php if (have_posts()) : 
			while (have_posts()) : the_post(); ?>   
				<?php the_content(); ?>
			<?php endwhile; ?>
		<?php endif; ?>        
    </div>
</div>
<?php get_footer(); ?>
