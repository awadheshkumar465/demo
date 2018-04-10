<?php
/**
Template Name: Contact Page
**/

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <div class="contactus_page">
        <div class="container">
            <div class="col-md-12">
                <div class="contact_dtls">
                    <h2>Contact Information</h2>
                    <div class="row">
                            <?php 
                                if( have_rows('contact_info') ):
                                    while( have_rows('contact_info') ) : the_row();
                                    $location = get_sub_field('contact_map'); ?>
                                        <div class="col-md-4">
                                            <div class="info_dtl">
                                                <span class="fa fa-map-o"></span>
                                                <h4><?php the_sub_field('country_name'); ?></h4>
                                                <p><i class="fa fa-map-marker"></i> <?php the_sub_field('address'); ?></p>
                                                <p><a href="tel:<?php the_sub_field('phone_number'); ?>"><i class="fa fa-phone"></i> <?php the_sub_field('phone_number'); ?></a></p>
                                                <p><a href="mailto:<?php the_sub_field('email_address'); ?>"><i class="fa fa-envelope"></i><?php the_sub_field('email_address'); ?></a></p>
                                                <div class="map">
                                                    <iframe width="600" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?center=<?php echo $location['address']; ?>&q=<?php echo $location['address']; ?>&z=14&size=600x450&output=embed&iwloc=near"></iframe>
                                                </div>
                                            </div>
                                        </div>
                                        <?php   
                                    endwhile;
                                endif; 
                                ?>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="contact_filds">
                    <h2>Get In Touch</h2>
                    <?php echo do_shortcode('[contact-form-7 id="177" title="Contact form"]'); ?>
                    <!-- <form>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-6">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>Email address</label>
                                <input type="email" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-6 col-sm-6">
                                <label>Phone</label>
                                <input type="text" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12">
                                <label>Phone</label>
                                <textarea class="form-control" rows="6" placeholder=""></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-default">Submit</button>
                            </div>
                        </div>
                    </form> -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="contact_media">
                    <h2>Social Media</h2>    
                    <ul>
                        <!-- <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li> -->
                         <?php dynamic_sidebar('social-link'); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; 
endif; ?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBf7jc6C53gWaqtdSwGNUHYiXfSjkI0-lQ&callback=initMap" async defer></script>


<?php get_footer();
