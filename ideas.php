<?php
/**
Template Name: Our Ideas Page
**/

get_header(); 
$taxonomy = 'ideas_cat';
$terms = get_terms($taxonomy); // Get all terms of a taxonomy
if ( $terms && !is_wp_error( $terms ) ) : ?>
    <div class="col-xs-12 text-center container">
        <ul class="js-tile_filters filter_list nav nav-tabs">
            <li class="active btn btn-lg btn-tag"><a data-toggle="tab" href="#home">All</a></li>
            <?php foreach ( $terms as $term ) { ?>
                <li><a data-toggle="tab" href="#<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
                <?php
                $services = array(
                        'post_type' => 'ideas',
                        'posts_per_page'=>-1,
                        'order'=>'DESC',
                        ); 
                $services_query = new WP_Query( $services );
                while ( $services_query->have_posts() ) : $services_query->the_post(); ?> 
                <div id="home" class="tab-pane fade in active">
                    <div class="rt-course-box rt-ideas-box">
                            <div class="rtin-thumbnail hvr-bounce-to-right"> 
                                <?php the_post_thumbnail(); ?>
                                <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link" aria-hidden="true"></i></a>
                            </div>
                            <div class="rtin-content-wrap">
                                <div class="rtin-content">
                                    <h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                </div>      
                            </div>
                        </div>
                </div>
             <?php endwhile; ?>
            <?php foreach ( $terms as $term ) { $term_id = $term->term_id; ?>
                <?php
                $args = array(
                        'post_type' => 'ideas',
                        'tax_query' => array(
                            array(
                            'taxonomy' => 'ideas_cat',
                            'field' => 'term_id',
                            'terms' => $term_id
                             )
                          )
                        );
                    $query = new WP_Query( $args ); ?>
                    <?php //echo "<pre>"; print_r($query); echo "</pre>"; ?>
                <?php
                if ( $query->have_posts() ):
                while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div id="<?php echo $term->slug; ?>" class="tab-pane fade rtin-main-cols col-lg-4 col-md-4 col-sm-6 col-xs-12 wow fadeInDown animated">
                        <div class="rt-course-box rt-ideas-box">
                            <div class="rtin-thumbnail hvr-bounce-to-right"> 
                                <?php the_post_thumbnail(); ?>
                                <a href="<?php the_permalink(); ?>" title=""><i class="fa fa-link" aria-hidden="true"></i></a>
                            </div>
                            <div class="rtin-content-wrap">
                                <div class="rtin-content">
                                    <h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a></h3>
                                </div>      
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php } ?>
        </div>
<?php endif;?>
<!-- https://www.w3schools.com/bootstrap/tryit.asp?filename=trybs_ref_js_tab&stacked=h -->
<?php get_footer();
