<?php
/**
Template Name: About-Us Page
**/

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    

    <div class="about_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 wow fadeIn">
                    <div class="aboutusLeft">
                        <h2>About Us</h2>
                        <h3>If you are going to use a passage of Lorem Ipsum.</h3>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum,</p>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don’t look even slightly believable. If you are going to use a passage of Lorem Ipsum,</p>
                        
                    </div>
                </div>
                <div class="col-lg-5 wow fadeIn">
                    <div class="aboutusRight">
                        <ul>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/sign.png" alt="" />
                                <h3>Our Strategy</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae ipsam enim expedita, facilis.</p>
                            </li>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/wallet.png" alt="" />
                                <h3>Company Analysis</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae ipsam enim expedita, facilis.</p>
                            </li>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/structure.png" alt="" />
                                <h3>Team Organization</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae ipsam enim expedita, facilis.</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="our_team">
                <h2>Meet the team</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="team_list">
                            <figure>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/team-1.jpg" alt="" />
                                <figcaption>
                                    <ul>
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </figcaption>
                            </figure>
                            <h4>Team Member Name</h4>
                            <h5>Designation</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="team_list">
                            <figure>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/team-2.jpg" alt="" />
                                <figcaption>
                                    <ul>
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </figcaption>
                            </figure>
                            <h4>Team Member Name</h4>
                            <h5>Designation</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="team_list">
                            <figure>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/team-3.jpg" alt="" />
                                <figcaption>
                                    <ul>
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </figcaption>
                            </figure>
                            <h4>Team Member Name</h4>
                            <h5>Designation</h5>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="team_list">
                            <figure>
                                <img src="<?php echo get_stylesheet_directory_uri();?>/images/team-4.jpg" alt="" />
                                <figcaption>
                                    <ul>
                                        <li><a href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </figcaption>
                            </figure>
                             <h4>Team Member Name</h4>
                            <h5>Designation</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="our_partner">
                <h2>Meet the Partners</h2>
                <div class="owl-carousel owl-theme" id="partners_slid">
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                    <div class="item">
                        <div class="ptnrs_slid">
                            <img src="<?php echo get_stylesheet_directory_uri();?>/images/partner.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endwhile; 
endif; ?>

<script>
    $('#partners_slid').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:5,
            nav:true,
            loop:true
        }
    }
})
</script>

<?php get_footer();
