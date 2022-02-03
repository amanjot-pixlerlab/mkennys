<?php
/**
 * Template Name: Footer
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */
?>
<?php
    // TO SHOW THE PAGE CONTENTS
    $wp_query = new WP_Query( 'pagename=Footer' );
    while ( $wp_query -> have_posts() ) : $wp_query -> the_post(); ?>
        <div class="vc-content-page">
            <?php the_content(); ?>
        </div>

    <?php
    endwhile;
    wp_reset_query();
?>
