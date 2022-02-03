<?php
/**
 * Template Name: Suits 
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fourteen 1.0
 */

get_header(); 
?>
<link href="<?php echo get_template_directory_uri(); ?>/css/lightgallery.min.css" rel="stylesheet" type="text/css">

<div class="pagebanner suitBanner">
    <div class="PBContent">
        <h1>Custom - A <span class="color">Personalized</span> Approach </h1>
        <ul class="clearfix listStyle4 unstyled-list">
            <li>5,000+ Fabrics</li>
            <li>Multiple Jacket Styles</li>
            <li>Fully Canvased Construction</li>
            <li>8+ Pant Styles</li>
        </ul>
    </div>
</div>
<div class="suitSteps">
    <div class="container">
        <ul class="unstyled-list clearfix">
            <li>
                <a href="<?php echo esc_url(home_url());?>/suits/#construction">
                <div class="SStep">
                    <figure><img src="<?php echo get_template_directory_uri(); ?>/images/fabric.png"></figure>
                    <figcaption>Construction</figcaption>
                </div>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url());?>/suits/#swatches">
                <div class="SStep">
                    <figure><img src="<?php echo get_template_directory_uri(); ?>/images/swatches.png"></figure>
                    <figcaption>Swatches</figcaption>
                </div>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url());?>/suits/#styles">
                <div class="SStep">
                    <figure><img src="<?php echo get_template_directory_uri(); ?>/images/style.png"></figure>
                    <figcaption>Styles</figcaption>
                </div>
                </a>
            </li>
            <li>
                <div class="SStep">
                    <figure><img src="<?php echo get_template_directory_uri(); ?>/images/thread.png"></figure>
                    <figcaption><a href="<?php echo esc_url(home_url());?>/tour-schedules/" class="btn">Meet a Tailor</a></figcaption>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="suitCustomStyle clearfix">
    <div class="container">
        <div id="construction" class="headingStyle">
            <h3>Handmade From Cloth to Finish</h3>
            <p>Each garment is hand cut with each seam sewn by a master tailor, individually prepared to your unique specifications. Completed with full lining and fully canvassed construction to create a smooth overall drape.</p>
        </div>
    </div>
    <div  class="SuitBoxStyle">
        <ul class="unstyled-list">
            <li>
                <div class="styleDesc">
                    <h5>Completely Customizable</h5>
                    <p>Since your garments are made entirely from scratch, the scope for customization is almost limitless. Provide our tailors with your subtle details and express your personal style with a suit that’s meant only for you.</p>
                </div>
            </li>
        </ul>
        <ul class="box2 unstyled-list">
            <li>
                <figure> 
                	<img src="<?php echo get_template_directory_uri();?>/images/suit-1.jpg"> 
                    <img src="<?php echo get_template_directory_uri();?>/images/suit-1-hover.png"> 
                </figure>
                <figcaption>CONTRAST BUTTON HOLES</figcaption>
            </li>
            <li>
                <figure> 
                	<img src="<?php echo get_template_directory_uri();?>/images/suit-2.jpg"> 
                    <img src="<?php echo get_template_directory_uri();?>/images/suit-2-hover.png">
                </figure>
                <figcaption>HANDPICKED STITCHING</figcaption>
            </li>
        </ul>
        <ul class="box2 unstyled-list">
            <li>
                <figure> 
                	<img src="<?php echo get_template_directory_uri();?>/images/suit-3.jpg"> 
                    <img src="<?php echo get_template_directory_uri();?>/images/suit-3-hover.png"> 
                </figure>
                <figcaption>CUSTOM LININGS</figcaption>
            </li>
            <li>
                <figure> 
                	<img src="<?php echo get_template_directory_uri();?>/images/suit-4.jpg">
                    <img src="<?php echo get_template_directory_uri();?>/images/suit-4-hover.png"> 
                </figure>
                <figcaption>SIDE EXTENSION TABS</figcaption>
            </li>
        </ul>
        <ul class="unstyled-list">
            <li>
                <figure> 
                	<img src="<?php echo get_template_directory_uri();?>/images/suit-5.jpg"> 
                    <img src="<?php echo get_template_directory_uri();?>/images/suit-5-hover.png"> 
                </figure>
                <figcaption>PEAK / NOTCH LAPELS</figcaption>
            </li>
        </ul>
    </div>
</div>


<div id="swatches"  class="fabricSection">
    <h5>The Devil is in the ... Fabrics</h5>
    <p>It all starts with the fabric – the essential component of any suit. Our traveling tailors will guide you through our range of over 5,000 fabrics from the world’s finest and most renowned mills. Narrow down by luxury mills and/or fabric types ranging from worsted wools, super 100s to 170s, mohair’s, and flannels. </p>
    <figure><img src="<?php echo get_template_directory_uri();?>/images/logos.jpg" class="img-responsive"></figure>
    <div class="note">Custom Suits ranging from $695 to $2,799. Custom Jacketing ranging from $539 to $1,899. Fabric is the only variable affecting price.</div>
</div>


<div id="styles" class="featureLook">
    <div class="container">
        <h5>Featured Looks</h5>
        <div class="suitListContainer">
            <div class="suitList">
                <ul class="clearfix unstyled-list" id="lightgallery">
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-01-a-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-01-a.jpg">
                    </li>
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-01-b-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-01-b.jpg">
                    </li>
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-01-c-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-01-c.jpg">
                    </li>
                </ul>
                <h6><span>Essential Medium Gray</span></h6>
            </div>
            <div class="suitList">
                <ul class="clearfix unstyled-list" id="lightgallery2">
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-02-a-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-02-a.jpg">
                    </li>
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-02-b-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-02-b.jpg">
                    </li>
                    <li href="<?php echo get_template_directory_uri();?>/images/suit-02-c-big.jpg">
                        <img src="<?php echo get_template_directory_uri();?>/images/suit-02-c.jpg">
                    </li>
                </ul>
                <h6><span>Royale</span></h6>
            </div>
            <div class="suitList">
            <ul class="clearfix unstyled-list" id="lightgallery3">
            <li href="<?php echo get_template_directory_uri();?>/images/suit-03-a-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-03-a.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-03-b-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-03-b.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-03-c-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-03-c.jpg">
            </li>
        </ul>
                <h6><span>Summer Linen DB</span></h6>
            </div>
            <div class="suitList">
            <ul class="clearfix unstyled-list" id="lightgallery4">
            <li href="<?php echo get_template_directory_uri();?>/images/suit-04-a-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-04-a.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-04-b-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-04-b.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-04-c-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-04-c.jpg">
            </li>
        </ul>
                <h6><span>English Brown Tweed</span></h6>
            </div>
            <div class="suitList">
            <ul class="clearfix unstyled-list" id="lightgallery5">
            <li href="<?php echo get_template_directory_uri();?>/images/suit-05-a-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-05-a.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-05-b-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-05-b.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-05-c-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-05-c.jpg">
            </li>
        </ul>
                <h6><span>Navy Power Window-Pane</span></h6>
            </div>
            <div class="suitList">
            <ul class="clearfix unstyled-list" id="lightgallery6">
            <li href="<?php echo get_template_directory_uri();?>/images/suit-06-a-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-06-a.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-06-b-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-06-b.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-06-c-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-06-c.jpg">
            </li>
        </ul>
                <h6><span>Classic Muted Black Pinstripe</span></h6>
            </div>
            <div class="suitList">
            <ul class="clearfix unstyled-list" id="lightgallery7">
            <li href="<?php echo get_template_directory_uri();?>/images/suit-07-a-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-07-a.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-07-b-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-07-b.jpg">
            </li>
            <li href="<?php echo get_template_directory_uri();?>/images/suit-07-c-big.jpg">
                <img src="<?php echo get_template_directory_uri();?>/images/suit-07-c.jpg">
            </li>
        </ul>
                <h6><span>Cobalt Blue Blazer</span></h6>
            </div>
        </div>
        <div class="clearfix"><a href="javascript:;" class="btnSeeMore">See More</a></div>
    </div>
</div>




<script src="<?php echo get_template_directory_uri(); ?>/js/lightgallery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lg-hash.min.js"></script>
<script>
    jQuery(document).ready(function() {
        jQuery("#lightgallery").lightGallery({download: false, hideBarsDelay:200000});
        jQuery("#lightgallery2").lightGallery({download: false, hideBarsDelay:200000}); 
        jQuery("#lightgallery3").lightGallery({download: false, hideBarsDelay:200000}); 
        jQuery("#lightgallery4").lightGallery({download: false, hideBarsDelay:200000}); 
        jQuery("#lightgallery5").lightGallery({download: false, hideBarsDelay:200000}); 
        jQuery("#lightgallery6").lightGallery({download: false, hideBarsDelay:200000}); 
        jQuery("#lightgallery7").lightGallery({download: false, hideBarsDelay:200000}); 
    });
</script>
<script>
$('.btnSeeMore').click(function() { 
	$(this).hide();
	$('.suitListContainer').addClass('active');
})

jQuery(document).ready(function(e) {

    

        setTimeout(function(){
            var hash = window.location.hash;
            if(hash!=""){
                $(window).scrollTop($(hash).position().top - 50);
            }
        },100);



    jQuery('.suitList').click(function() { 
	//alert("hello");
		jQuery('.suitList').removeClass('active');
		jQuery(this).addClass('active');
	});
	
	jQuery(document).click(function(e) { 
		var target = jQuery(e.target);
		if(target.hasClass('suitListContainer') || target.parents().hasClass('suitListContainer')){ }
		else { 
			jQuery('.suitList').removeClass('active');
		}
	})

     jQuery(document).on("contextmenu",'.lg-image',function(){
               return false;
            }); 
});
	
</script>
<?php
get_footer(); 
?>
