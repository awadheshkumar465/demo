<?php
/**
Template Name: Front Page
**/

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<?php $ids =  get_the_ID(); ?>
	<section class="wel_cont">
		<div class="container">
			<div class="mapdiv  wow slideInLeft animated animated">
				<div class="col-sm-6">
					<div class="video-er ">
						<h1><?php the_field('first_section_title'); ?></h1>
	                    <?php the_field('first_section_content'); ?>
					</div>
				</div>
			</div>	
		</div>
	</section>

	<section class="our-work">
	    <div class="details">
	        <div class="container">
	        	<div class="row">
	        		<div class="col-sm-12">
	        			<div class="heading text-center">
							<h2>Our <span><?php the_field('service_section_name'); ?></span></h2>
						</div>
	        		</div>
	        	</div>
	            <div class="row">
	                <div class="detail_box">
	                  	<?php
	                  	$count = 0;
	                  	//$services = array('post_type'=>'service', 'posts_per_page'=>-1, 'order'=>'DESC');
	                  	$services = array(
					    	'tax_query' => array(
					        	array(
					            	'taxonomy' => 'service-cat',
					            	'field' => 'slug',
					            	'terms' => array( 'clubs' )
					        	),
					    	),
					    'post_type' => 'service',
					    'posts_per_page'=>-1
						); 
						$services_query = new WP_Query( $services );
						if ( $services_query->have_posts() ):
							while ( $services_query->have_posts() ) : $services_query->the_post(); ?>
		                    <div class="col-sm-6 col-md-4">
			                    <div class="box wow slideInLeft animated">
			                        <div class="icons-setting-top in_<?php echo $count++;?>">
			                            <img src="<?php echo get_field('service_icon', $post->ID); ?>">
			                        </div>
			                        <div class="box-text">
			                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			                            <?php echo wp_trim_words( get_the_content(), 20, '...' ); ?>
			                            <div class="text-center"></div>
			                        </div>
			                    </div>
			                </div>
	                		<?php endwhile;
						endif; ?>
	            	</div>
	            </div>
	        </div>   
	    </div>
	</section>

	<section class="std-sec">
		<?php
		$technology = array('post_type'=>'technology', 'posts_per_page'=>-1, 'order'=>'DESC');
		$technology_query = new WP_Query( $technology );
		if ( $technology_query->have_posts() ):
			$num=1;
			while ( $technology_query->have_posts() ) : $technology_query->the_post();
				$image = get_field('icon', $post->ID);
				if($num%2==0){ ?> 
			    	<div class="cont_box_sec">
						<div class="col-md-6">
				            <div class="cont_box_sec_r wow slideInLeft animated animated">
				            	<?php the_post_thumbnail(); ?>
				            </div>
			            </div>
			            <div class="col-md-6">
				            <div class="cont_box_sec_l wow slideInRight animated animated">
				           		<span> <img src="<?php echo get_field('icon', $post->ID); ?>"></span>
				            	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				            	<?php the_content(); ?>
				            </div>
			            </div>
					</div>
				<?php } 
				else{ ?>
					<div class="cont_box_sec">
						<div class="col-md-6">
				            <div class="cont_box_sec_l wow slideInLeft animated animated">
				           		<span> <img src="<?php echo get_field('icon', $post->ID); ?>"></span>
				            	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				           		<?php the_content(); ?>
				            </div>
			            </div>
						<div class="col-md-6">
			            	<div class="cont_box_sec_r wow slideInRight animated animated">
			            		<?php the_post_thumbnail(); ?>
			            	</div>
			            </div>  
					</div>
				<?php }
				$num++;
			endwhile;
		endif; ?> 
	</section>


	<section class="news_sec">
		<div class="container">
			<div class="row ">
	            <div class="col-sm-12">
	    			<div class="heading sec_he text-center">
						<h2>Our <span><?php the_field ('news_section', $ids); ?></span></h2>
					</div>
	    		</div>
	    		<?php
				$news = array('post_type'=>'news', 'posts_per_page'=>2, 'order'=>'DESC');
				$news_query = new WP_Query( $news );
				if ( $news_query->have_posts() ):
					while ( $news_query->have_posts() ) : $news_query->the_post();
					$backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
			            <div class="col-md-6">
							<div class="bg-one col-md-12 col-sm-12 wow fadeInRight animated" style="background: url('<?php echo $backgroundImg[0]; ?>') ">
								<h4 class="had_fact"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<div class="books">
									<?php the_content(); ?>
								</div>
			                    <p>By <?php echo get_the_author(); ?> <?php echo get_the_date('', $post->ID); ?>&nbsp;<?php echo get_the_time('', $post->ID); ?></p>
			                    <span class="news_ic"><img src="<?php echo get_field('news_icons', $post->ID); ?>"/></span>
							</div> 
						</div>
					<?php endwhile;
				endif; ?>
			</div>
		</div>
	</section>


	<section class="email_sub">
		<div class="container">
			<div class="row">
	            <div class="email_su_icon">
	            	<img src="<?php echo get_field('newsletter_icon', $ids); ?>"/>
	            </div>
				<div class="email_su_search">
		             <div class="search-container">
		             	<script>
						function xyz_em_verify_fields()
						{
							var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,})$/;
							var address = document.subscription.xyz_em_email.value;
							if(reg.test(address) == false) {
								alert('Please check whether the email is correct.');
								return false;
							}
							else{
								//document.subscription.submit();
								return true;
							}
						}
						</script>
						<form method="POST" name="subscription" action="<?php echo site_url(); ?>/index.php?wp_nlm=subscribe">
							<!-- <input  name="xyz_em_name" type="email" placeholder="Enter your e-mail address" /> -->
							<input  name="xyz_em_email" type="email" placeholder="Enter your e-mail address" />
							<input name="htmlSubmit"  id="submit_em" class="button-primary" type="submit" value="Subscribe to our newsletter" onclick="javascript: if(!xyz_em_verify_fields()) return false; "  />
						</form>
		            </div>
	        	</div>
            </div>
        </div>
    </section>


    <section class="testo-slider">
		<div class="slider-test">
			<div class="slider-back">
				<div class="container">
					<div class="interstng-sec-head">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="heading-section">
										<h2 class="wow fadeInDown animated">Happy <span class="yellow"><?php the_field ('client_section_name', $ids); ?></span></h2>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container wow fadeInDown animated">
					<div id="demo" class="my-test-slider">      
			            <div id="owl-test" class="owl-carousel">
			            	<?php
							$clients = array('post_type'=>'clients', 'posts_per_page'=>-1, 'order'=>'DESC');
							$clients_query = new WP_Query( $clients );
							if ( $clients_query->have_posts() ):
								while ( $clients_query->have_posts() ) : $clients_query->the_post(); ?>
									<div class="item">
										<div class="item-cont">                                
		                                	<div class="row">
		                                    	<div class="col-md-4">
		                                        	<div class="tes-pro">
		                                                <?php the_post_thumbnail(); ?>
		                                            </div>                                        	
		                                        </div>
		                                        <div class="col-md-8">
			                                        <span class="coment"><?php the_content(); ?></span>
		                                    		<h3>- <?php echo the_field('author_name', $post->ID); ?>, <span><?php echo the_field('designation', $post->ID); ?></span></h3>									
		                                        </div>                                    
		                                    </div>
										</div>
									</div>
								<?php endwhile;
							endif; ?>
			            </div>         
			    	</div>
				</div>
			</div>
		</div>
	</section>




<?php endwhile; 
endif; ?>

<?php get_footer();
