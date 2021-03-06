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


/* Insert Contact Information start */
add_action('wpcf7_before_send_mail', 'save_form' );

function save_form( $wpcf7 ) {
  global $wpdb;
  $submission = WPCF7_Submission::get_instance();
  if ( $submission ) {
      $submited = array();
      $submited['title'] = $wpcf7->title();
      $submited['posted_data'] = $submission->get_posted_data();
   }

   $post_id = wp_insert_post(array (
     'post_type' => 'allleads',
     'post_title' => $submited['posted_data']['title'],
     'post_status' => 'publish',
     'comment_status' => 'closed',   // if you prefer
     'ping_status' => 'closed',      // if you prefer
  ));
  if ($post_id) {
   // insert post meta
    add_post_meta($post_id, 'first_name', $submited['posted_data']['fname']);
    add_post_meta($post_id, 'last_name', $submited['posted_data']['lname']);
    add_post_meta($post_id, 'email', $submited['posted_data']['email']);
    add_post_meta($post_id, 'telephone', $submited['posted_data']['phone']);
    add_post_meta($post_id, 'organization', $submited['posted_data']['organization']);
    add_post_meta($post_id, 'business_name', $submited['posted_data']['Business']); 
  }
}

// Remove particular page editor function
add_action( 'admin_init', 'hide_editor' );
function hide_editor() {
  $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ; 
  if( !isset( $post_id ) ) return;
  $pagetitle = get_the_title($post_id);
  if($pagetitle == 'Home'){
    remove_post_type_support('page', 'editor');
  }
}

// First, create a function that includes the path to your favicon
function add_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/images/favicon.ico';
  echo '<link rel="shortcut icon" href="' . $favicon_url . '" />';
}
  
// Now, just make sure that function runs when you're on the login page and admin pages  
add_action('login_head', 'add_favicon');
add_action('admin_head', 'add_favicon');


===================================================================================
	
function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown-menu" /',$menu);        
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 



function wps_change_role_name() {
global $wp_roles;
if ( ! isset( $wp_roles ) )
$wp_roles = new WP_Roles();
$wp_roles->roles['editor']['name'] = 'Team Member';
$wp_roles->role_names['editor'] = 'Team Member';
}
add_action('init', 'wps_change_role_name');

=========================================================================================
	
	/* Create Post Meta */
function add_your_fields_meta_box() {
  add_meta_box(
    'your_fields_meta_box',
    'Your Fields',
    'show_your_fields_meta_box',
    'document',
    'normal',
    'high'
  );
}
add_action( 'add_meta_boxes', 'add_your_fields_meta_box' );

function show_your_fields_meta_box() {
  global $post;  
  $meta = get_post_meta( $post->ID, 'subscriber_user_id', true ); 
  $blogusers = get_users( 'role=subscriber' );
  //print_r($blogusers); ?>
  <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">
  <p>
    <label for="subscriber_user_id[select]">All User List</label>
    <br>
    <select name="subscriber_user_id" id="subscriber_user_id">
      <option value="<?php echo $meta; ?>">Select User</option>
      <?php 
      foreach ( $blogusers as $user ) { 
        if($meta == $user->ID){$selected ='selected';} else{ $selected ='';} ?>
        <option value="<?php echo $user->ID; ?>" <?php echo $selected; ?> ><?php echo esc_html( $user->user_email ); ?></option>
      <?php } ?>
    </select>
  </p>
<?php 
}
function save_your_fields_meta( $post_id ) {   
  if( isset($_POST['your_meta_box_nonce']) && !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
    return $post_id; 
  }
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return $post_id;
  }
  if (isset($_POST['document'])) { 
    if ( 'page' === $_POST['document'] ) {
      if ( !current_user_can( 'edit_page', $post_id ) ) {
        return $post_id;
      } 
      elseif ( !current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }  
    }
  }
  $old = get_post_meta( $post_id, 'subscriber_user_id', true );
    if (isset($_POST['subscriber_user_id'])) { 
      $new = $_POST['subscriber_user_id'];
      if ( $new && $new !== $old ) {
        
        /* 03-12-2018 */
        $user_id = $_POST['subscriber_user_id'];
        $user_info = get_userdata($user_id);
        $file  = get_field('add_documents');
        $url = $file['url'];
        $to = $user_info->user_email;
        $first_name = $user_info->first_name;
        //$to = "votivewp.awadhesh@gmail.com";
        $subject = "Your Documents";
        $message1 .= "<html><body style='font-family: 'open Sans';font-size: 14px; line-height:20px;'>";
        $message1 .= "<div style='padding: 0 10px;max-width: 670px;margin: 0 auto; background-color: #fff;'>";
        $message1 .= "<div style='max-width:670px;width:100%;margin:0 auto 30px;background: #fff;border:1px solid #ccc;'>";
        $message1 .= "<div style='background: #fff; padding: 15px 40px; margin-bottom: 0px;'>";
        $message1 .= "<div style='width: 88%;display:block;padding: 10px 0px 0px;background: #fff;'>";
        $site_url = site_url();
        $link_url = site_url('/my-documents/');
        $message1 .= "<p style='text-align: left; padding: 5px 0px; margin:0px;'><a href='".$site_url."' target='_blank' style='color: #fff; font-size: 14px; text-transform: uppercase; text-decoration: none;'>";
        $message1 .="<img src='".get_stylesheet_directory_uri()."/images/Advertrans_small.png' style='max-width: 100px;'/></a></p>";
        $message1 .= "</div>";
        $message1 .= "</div>";
        $message1 .= "<div style='background: #fff;'>";
        $message1 .= "<div style='padding: 0px 40px;'>";
        $message1 .= "<p><strong> Hello ".ucfirst($first_name)." Sir,</strong></p>";
        $message1 .= "<p>Our Team Members uploaded Digital Document for you, Please collect Document from below Link:</p>";
        $message1 .= "<p><strong style='text-align:center;'><a href=".$link_url.">Click Here</a></strong></p>";
        $message1 .= "<p></p>";
        $message1 .= "<p></p>";
        $message1 .= "<p></p>";
        $message1 .= "</div>";  
        $message1 .= "</div></div></div></body></html>";
        
        //$headers .= "MIME-Version: 1.0";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: info@votivejoomla.in";

        wp_mail($to,$subject,$message1,$headers);
      /* 03-12-2018 */

        update_post_meta( $post_id, 'subscriber_user_id', $new );
      } 
      elseif ( '' === $new && $old ) {
        delete_post_meta( $post_id, 'subscriber_user_id', $old );
      }
    }
}
add_action( 'save_post', 'save_your_fields_meta' );

============================================================================================================
	function the_breadcrumb() {

    $sep = ' » ';

    if (!is_front_page()) { ?>
        <ul class="breadcrumbs">
        <li><a href="<?php echo get_option('home'); ?>">Home</a></li>
        <?php
        if (is_tax()){ ?>
            <li><?php echo single_cat_title(); ?> </li>
        <?php } 
        elseif (is_archive()){
            if ( is_day() ) {
                printf( __( '%s', 'text_domain' ), get_the_date() );
            } 
            elseif ( is_month() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'text_domain' ) ) );
            } 
            elseif ( is_year() ) {
                printf( __( '%s', 'text_domain' ), get_the_date( _x( 'Y', 'yearly archives date format', 'text_domain' ) ) );
            }
            elseif ( is_archive() ) { ?>
               <li><?php echo post_type_archive_title($prefix, false); ?></li>
            <?php }
            else { ?>
                <li> <?php echo single_cat_title(); ?> </li>
            <?php }
        }
        if (is_single()) { ?>
            <li> <?php echo the_title(); ?></li>
        <?php }
        if (is_page()) { ?>
            <li> <?php echo the_title(); ?></li>
        <?php }
        if (is_home()){
            global $post;
            $page_for_posts_id = get_option('page_for_posts');
            if ( $page_for_posts_id ) { 
                $post = get_page($page_for_posts_id);
                setup_postdata($post);
                the_title();
                rewind_posts();
            }
        }
        echo '</ul>';
    }
}


remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);


=======================================================================================================
// Create the Custom Excerpts callback
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

=============================================================================================================
add_filter('style_loader_tag', 'html5_style_remove')
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}
===============================================================================================================
// Add our HTML5 Pagination
add_action('init', 'html5wp_pagination'); 
// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('«'),
        'next_text'    => __('»')
    ));
}

====================================================================================================================
// Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); 
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

=========================================================================================================================
	

https://www.solvusoft.com/en/update/drivers/laptop/hcl/me-icon/l-74-g/model-numbers/?__c=1
