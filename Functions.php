<?php



function theme_enqueue_styles() {

    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );

}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



function avada_lang_setup() {

	$lang = get_stylesheet_directory() . '/languages';

	load_child_theme_textdomain( 'Avada', $lang );

}

add_action( 'after_setup_theme', 'avada_lang_setup' );




/* How to Fix HTTP Error When Uploading Images akTE Start */
add_filter( 'wp_image_editors', 'change_graphic_lib' );

function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}

/* Awadhesh Create Custom Post type for steel_technology Start*/

add_action( 'init', 'create_posttype_steel_technology' );
function create_posttype_steel_technology() {

	register_post_type( 'steel_technology',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Steel Technology' ),
				'singular_name' => __( 'Steel Technology' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'steel_technology'),
			 'supports' => array( 'title', 'editor', 'thumbnail')
		)
	);
}
add_action( 'init', 'create_steel_cat_taxonomies', 0 );
function create_steel_cat_taxonomies() {
    register_taxonomy(
        'steel_cat',
        'steel_technology',
        array(
            'labels' => array(
                'name' => 'Steel Category',
                'add_new_item' => 'Add New Steel Category',
                'new_item_name' => "New Steel Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}


/* Awadhesh Create Custom Post type for create_posttype_pdf Start*/

add_action( 'init', 'create_posttype_pdf' );
function create_posttype_pdf() {

	register_post_type( 'pdf',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'PDF' ),
				'singular_name' => __( 'PDF' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'pdf'),
			 'supports' => array( 'title', 'editor', 'thumbnail')
		)
	);
}


/* Awadhesh Create Custom Post type for Construction Start*/
add_action( 'init', 'create_posttype_construction' );
function create_posttype_construction() {

	register_post_type( 'construction',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Construction' ),
				'singular_name' => __( 'Construction' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'construction'),
			 'supports' => array( 'title', 'editor', 'thumbnail')
		)
	);
}
add_action( 'init', 'create_construction_cat_taxonomies', 0 );
function create_construction_cat_taxonomies() {
    register_taxonomy(
        'construction_cat',
        'construction',
        array(
            'labels' => array(
                'name' => 'Construction Category',
                'add_new_item' => 'Add New Construction Category',
                'new_item_name' => "New Construction Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}


/* Awadhesh Create Custom Post type for Events Start*/
add_action( 'init', 'create_posttype_events' );
function create_posttype_events() {

	register_post_type( 'events',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Events' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'events'),
			 'supports' => array( 'title', 'editor', 'thumbnail')
		)
	);
}
add_action( 'init', 'create_events_cat_taxonomies', 0 );
function create_events_cat_taxonomies() {
    register_taxonomy(
        'events_cat',
        'events',
        array(
            'labels' => array(
                'name' => 'Events Category',
                'add_new_item' => 'Add New Events Category',
                'new_item_name' => "New Events Category"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}


add_shortcode('shortcode_steel_technology','get_steel_technology');
function get_steel_technology(){
  				$args = array(
				'post_type' => 'steel_technology',
				'post_status' => 'publish',
				'posts_per_page'	=> ''
			);
			$args = array(
						'orderby'           => 'name', 
						'order'             => 'ASC',
						'hide_empty'        => true, 
						'exclude'           => array(), 
						'exclude_tree'      => array(), 
						'include'           => array(),
						'number'            => 8, 
						'fields'            => 'all', 
						'slug'              => '',
						'parent'            => '',
						'hierarchical'      => true, 
						'child_of'          => 0,
						'childless'         => false,
						'get'               => '', 
						'name__like'        => '',
						'description__like' => '',
						'pad_counts'        => false, 
						'offset'            => '', 
						'search'            => '', 
						'cache_domain'      => 'core'
					); 
					
					$terms = get_terms('steel_cat', $args);
					$aks= '<div class="steel-item">';
					foreach( $terms as $term) {
						$term_link = get_term_link( $term );
						$aks .='<a href="' . esc_url( $term_link ) . '" class="custom-block-link">';
						$aks .='<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">';
					    $aks .= do_shortcode(sprintf('[wp_custom_image_category term_id="%s"]',$term->term_id));
					    $aks .='<h4>' . $term->name . '</h4>';
					    $aks .='<span>'.category_description($term->term_id).'</span>';
					    $aks .='</div>';
						$aks .='</a>';
						
					}
					$aks.= '</div>';
					wp_reset_postdata();
					return $aks;
  }

add_shortcode('shortcode_light_gauge_steel','get_light_gauge_steel');
function get_light_gauge_steel(){
	$results = NULL;
	ob_start();
	global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM wp_posts WHERE `post_type` = 'steel_technology' ORDER BY `ID` ASC LIMIT 5");
    foreach ($results as $result) {
    	$post_id = $result->ID; 
    	?>
    	<a href="<?php echo get_the_permalink($post_id); ?>" class="custom-block-link service-item">
    	<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">
    	<?php 
    		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
    		//echo $image[0];
    	//echo get_post_thumbnail_id($post_id); ?>
        <img class="img-responsive center-block" src="<?php echo $image[0]; ?>">
        <h1><?php echo $result->post_title; ?></h1>
        <h2 class="m_title"><?php echo get_post_meta( $post_id, 'material_thickness', true );?></h2>
    	</div>
    </a>
    <?php }
    $post_id;
    $nextresults = $wpdb->get_results("SELECT * FROM wp_posts WHERE `post_type` = 'steel_technology' AND `ID` > $post_id ORDER BY `ID` ASC LIMIT 5"); ?>
    	
    	<h1 data-fontsize="33" data-lineheight="47" style="text-align: center;">Robot Machines for Heavy Gauge Steel Framing</h1>
    <?php foreach ($nextresults as $nextresult) {
    	$post_id = $nextresult->ID; 
    	?>
    	<a href="<?php echo get_the_permalink($post_id); ?>" class="custom-block-link service-item">
    	<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">
    	<?php 
    		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
    		//echo $image[0];
    	//echo get_post_thumbnail_id($post_id); ?>
        <img class="img-responsive center-block" src="<?php echo $image[0]; ?>">
        <h1><?php echo $nextresult->post_title; ?></h1>
        <h2 class="m_title"><?php echo get_post_meta( $post_id, 'material_thickness', true );?></h2>
    	</div>
    </a><?php 
    }
    $results = ob_get_clean();
    return $results;
}





/* particilar Applications for Residential Construction wise display this post */
add_shortcode('display_residential_construction','create_custom_residential_construction');
function create_custom_residential_construction(){
	$results = NULL;
	ob_start();
	$args = array(
    	'tax_query' => array(
        	array(
            	'taxonomy' => 'construction_cat',
            	'field' => 'slug',
            	'terms' => array( 'residential-construction' )
        	),
    	),
    'post_type' => 'construction'
	); 

	$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post(); ?>
			<a href="<?php the_permalink(); ?>#<?php echo get_the_id(); ?>" class="custom-block-link service-item">
		    	<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'thumbnail', array('class' => 'img-responsive center-block')); ?>
			        <h1><?php the_title(); ?></h1>
			        <h2 class="m_title" style="text-align: center !important;float: left;width: 100% !important;"><?php echo get_post_meta( get_the_id(), 'levels', true );?></h2>
		    	</div>
		    </a>
		<?php endwhile; 
		$results = ob_get_clean();
    return $results;
}

/* particilar Applications for Industrial Construction wise display this post */
add_shortcode('display_industrial_construction','create_custom_industrial_construction');
function create_custom_industrial_construction(){
	$results = NULL;
	ob_start();
	$args = array(
    	'tax_query' => array(
        	array(
            	'taxonomy' => 'construction_cat',
            	'field' => 'slug',
            	'terms' => array( 'industrial-construction' )
        	),
    	),
    'post_type' => 'construction'
	); 
	$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post(); ?>
			<a href="<?php the_permalink(); ?>#<?php echo get_the_id(); ?>" class="custom-block-link service-item">
		    	<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'thumbnail', array('class' => 'img-responsive center-block')); ?>
			        <h1><?php the_title(); ?></h1>
			        <h2 class="m_title"><?php echo get_post_meta( get_the_id(), 'levels', true );?></h2>
		    	</div>
		    </a>
		<?php endwhile; 
		$results = ob_get_clean();
    return $results;
}


/* Create Custom Shortcode for Events post in home-page */
add_shortcode('display_homepage_events','create_custom_homepage_events');
function create_custom_homepage_events(){
	$results = NULL;
	ob_start();
		$args = array( 'post_type' => 'events', 'posts_per_page' => 5 );
	$query = new WP_Query( $args );
		while ( $query->have_posts() ) : $query->the_post(); ?>
			<a href="<?php the_permalink(); ?>#<?php echo get_the_id(); ?>" class="custom-block-link service-item">
		    	<div class="col-sm-6 col-md-1-5 text-center img-hover-zoom">
		    	<h1><?php the_title(); ?></h1>
		        <?php echo get_the_post_thumbnail(get_the_id(), 'thumbnail', array('class' => 'img-responsive center-block')); ?>
		        <h2 class="m_title"><?php the_content(); ?></h2>
		    	</div>
		    </a>
		<?php endwhile; 
	$results = ob_get_clean();
    return $results;
}


function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'.';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}
/* display the pinnaclesframer Page Shortcode */
add_shortcode('display_pinnaclesframer','create_custom_pinnaclesframer');
function create_custom_pinnaclesframer(){
	$results = NULL;
	ob_start();
	$args = array(
    	'tax_query' => array(
        	array(
            	'taxonomy' => 'steel_cat',
            	'field' => 'slug',
            	'terms' => array( 'pinnacleframer' )
        	),
    	),
    'post_type' => 'steel_technology'
	); 
	$query = new WP_Query( $args );
		$results.= '<div class="table-view">';
		while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="row-1 row">
			<?php if ($query->current_post % 2 == 0): ?>
		       <a href="<?php echo the_permalink(); ?>">
		       	<div class="row-img col-md-6">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('class' => 'img-responsive center-block')); ?>
		    	</div>
		    	</a>
		    	<a href="<?php echo the_permalink(); ?>">
		        <div class="row-txt col-md-6 still_listing">
		            <h1><?php the_title(); ?></h2>
		            <h2><?php echo excerpt(32); ?></h3>
		        </div>
		        </a>  
		    <?php else: ?>
		        <a href="<?php echo the_permalink(); ?>">
		        <div class="row-txt col-md-6 still_listing">
		            <h1><?php the_title(); ?></h2>
		            <h2><?php echo excerpt(32); ?></h3>
		        </div>
		        </a>  
		        <a href="<?php echo the_permalink(); ?>">
		       	<div class="row-img col-md-6">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('class' => 'img-responsive center-block')); ?>
		    	</div>
		    	</a>
		    <?php endif ?>
			</div>
		<?php endwhile; 
		$results.='</div>';
		$results = ob_get_clean();
    return $results;
}

/* Create Custom Shortcode for Top pinnaclesframer Page */
add_shortcode('display_top_pinnaclesframer','create_custom_top_pinnaclesframer');
function create_custom_top_pinnaclesframer(){
	$results = NULL;
	ob_start();
		$args = array( 'post_type' => 'steel_technology', 'posts_per_page' => 10 );
		$query = new WP_Query( $args ); ?>
	    <div class="row ten-cols five-cols">
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>
			<a href="<?php echo get_the_permalink(); ?>" class="col-md-1 col-sm-2 col-xs-6 top-custom-block-link">
		    	<div class="img-hover-zoom">
		        <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('class' => 'top_pinnaclesframer')); ?>
		        <h5 class="steel_title"><?php the_title(); ?></h5>
		    	</div>
		    </a>
		<?php endwhile; ?>
		</div>
	<?php $results = ob_get_clean();
    return $results;
}




/* display the Building Application Page Shortcode */
add_shortcode('display_building_application','create_custom_building_application');
function create_custom_building_application(){
	$results = NULL;
	ob_start();
	$args = array(
    	'tax_query' => array(
        	array(
            	'taxonomy' => 'construction_cat',
            	'field' => 'slug',
            	'order' => 'ASC',
            	'terms' => array('residential-construction', 'industrial-construction' )
        	),
    	),
    'post_type' => 'construction'
	); 
	$query = new WP_Query( $args );
		$results.= '<div class="table-view">';
		while ( $query->have_posts() ) : $query->the_post(); ?>
			<div class="row-1 row">
			<?php if ($query->current_post % 2 == 0): ?>
		       <a href="#">
		       	<div class="row-img col-md-6">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('class' => 'img-responsive center-block')); ?>
		    	</div>
		    	</a>
		    	<a href="#">
		        <div class="row-txt col-md-6 still_listing">
		            <h1><?php the_title(); ?></h2>
		            <h2><?php the_content(); ?></h3>
		        </div>
		        </a>  
		    <?php else: ?>
		        <a href="#">
		        <div class="row-txt col-md-6 still_listing">
		            <h1><?php the_title(); ?></h2>
		            <h2><?php the_content(); ?></h3>
		        </div>
		        </a>  
		        <a href="#">
		       	<div class="row-img col-md-6">
			        <?php echo get_the_post_thumbnail(get_the_id(), 'large', array('class' => 'img-responsive center-block')); ?>
		    	</div>
		    	</a>
		    <?php endif ?>
			</div>
		<?php endwhile; 
		$results.='</div>';
		$results = ob_get_clean();
    return $results;
}

