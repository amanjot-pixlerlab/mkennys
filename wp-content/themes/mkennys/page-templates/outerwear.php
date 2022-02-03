<?php
/**
 * Template Name: Outerwear 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>

<div class="pagebanner outwearBanner">
    <div class="PBContent">
        <h1>Effortless</h1>
        <h2><span class="color">Layering</span></h2>
        <!-- <h1>Layered</h1>
        <h2><span class="color">STYLING</span></h2> -->
    </div>
</div>

<div class="outerwear_rows">
	<div class="OWRow OWRow_01">
    	<div class="container">
        	<div class="OWRContent">
            	<h4>Our overcoats, much like our suits, are crafted entirely by hand and epitomize style while providing a much needed added layer of armor.</h4>
                <p>As with all our garments, the scope for customization is has almost no bounds. Choose from:</p>
                <ul class="clearfix">
                	<li>Single Breasted vs. Double Breasted Coats</li>
                    <li>Notch / Peak / Shawl Collar Lapels</li>
                    <li>Regular Shoulder or Raglan Shoulder</li>
                    <li>Choice of Zip-in/Zip- out Lining</li>
                    <li>Full Length or ¾ Car Coat Lengths</li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="OWRow OWRow_02">
    	<div class="container">
        	<div class="OWRContent">
            	<h4><b>Our personal favorite</b></h4>
                <h5>Holland & Sherry Tweed</h5>
                <p>As with all our garments, the scope for customization is has almost no bounds. Choose from:</p>
                <ul class="clearfix">
                	<li>Fawn/Dark Olive Donegal with Red/Gold Knepps</li>
                    <li>¾ Car Coat Length</li>
                    <li>Versatile yet functional, this Holland & Sherry Tweed coat will safeguard you from the winter while upholding a clean and classic look.</li>
                </ul>
            </div>
        </div>
    </div>   
</div>

<div class="outerWearGallery">
	<h3>Additional Layered Styling options</h3>
	<ul class="clearfix unstyled-list">
    	<li><img src="<?php echo get_template_directory_uri();?>/images/outerwear-gal-01.jpg"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/outerwear-gal-02.jpg"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/outerwear-gal-03.jpg"></li>
        <li><img src="<?php echo get_template_directory_uri();?>/images/outerwear-gal-04.jpg"></li>
    </ul>
</div>


<?php
get_footer(); 
?>
