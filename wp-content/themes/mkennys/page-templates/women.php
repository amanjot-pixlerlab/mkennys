<?php
/**
 * Template Name: Women 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$bgImg = $backgroundImg[0] ?: '';
?>


<?php
    if( $bgImg ){ ?>
        <div class="pagebanner womenBanner" style="background-image: url('<?php echo $bgImg ?>'); background-repeat:no-repeat; background-size: cover; background-position: right center;">
    <?php }
    else {  ?>
        <div class="pagebanner womenBanner">
    <?php }
?>
    <div class="PBContent">
        <h1>FASHION MEETS</h1>
        <h2><span class="color textSize">SOPHISTICATION</span></h2>
    </div>
</div>

<div class="womenDecs">
	<div class="womenDecsInner">
    	<h4>Elegant, authoritative and <strong>bold</strong> styling options for every woman</h4>
    </div>
</div>

<div class="womenRows">
	<div class="WRow WRow_1">
    	<div class="container">
        	<div class="WRContent">
            	<p>Since each exquisite style is customized to meet our customer's individual preferences, each woman is presented with a wide variety of options.</p>
            </div>
        </div>
    </div>
    
    <div class="WRow WRow_2">
    	<div class="container">
        	<div class="WRContent">
            	<p>Classic outfits can be altered to add a hint of elegance or to bring about new and fresh looks, unlike anything that can be found in department stores.</p>
            </div>
        </div>
    </div>
    
    <div class="WRow WRow_3">
    	<div class="container">
        	<div class="WRContent">
            	<p>With our exceptional offers, the experience of such personal and detailed customization can only be found with the custom tailors at
M. Kenny's.</p>
            </div>
        </div>
    </div>
</div>

<div class="customPriceRange">
	<div class="CPRInner">
    	<p>Custom blouses range from $119 to $245. Handcrafted skirts/pants/suits range from $695 to $1895. Fabric is the only variable effecting price.</p>
    </div>
</div>


<?php get_footer(); ?>
