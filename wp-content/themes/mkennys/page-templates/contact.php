<?php

/**

 * Template Name: Contact

 *

 * @package WordPress

 * @subpackage Twenty_Fifteen

 * @since Twenty Fourteen 1.0

 */



get_header(); 

?>



<div class="contactUsPage">

    <div class="container">

    	<div class="contactLeft">

            <h1>Contact us</h1>

            <?php if (have_posts()) : 

                while (have_posts()) : the_post(); ?>   

                    <?php the_content(); ?>

                <?php endwhile; ?>

            <?php endif; ?>

                      

            <?php echo do_shortcode('[contact-form-7 id="36" title="Contact form - contact page"]');?>        

        </div>

        

        <div class="contactRight">

        	<div class="Contactaddress">

                <h3>Head Office</h3>

                <ul class="clearfix unstyled-list">

                    <li class="location">True Fitted by M. Kenny's<br>17601 17th Street, Suite 115<br>Tustin, CA. 92780</li>	

                    <li class="call_icon">US Toll Free: <br>800-220-8469</li>

                    <li class="call_icon">International: <br>+ 1 714 573 2199</li>

                    <li class="mail_info">Mon-Fri, 9 AM - 6 PM <br><a href="mailto:info@mkennys.com">info@mkennys.com</a> </li>

	            </ul>

            </div>

            

            <div class="upcomingSchdule">

            	<h3>Visit us in your city</h3>

				<?php echo do_shortcode( '[foobar page=contactus limit=7]' ) ; ?>				

              

                <p><a href="<?php echo site_url();?>/new-tour-schedule/" class="blankBlockBtn">See our Full road tour <i class="fa fa-chevron-right"></i></a></p>

            </div>

        </div>

    </div>

</div>

<?php get_footer(); ?>

