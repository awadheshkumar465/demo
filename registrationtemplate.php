<?php
/**
 Template Name:User Registration
 */

get_header('new');

/*if(isset($_POST['catids'])){  $_SESSION['catidsess'] = $_POST['catids'];
 unset($_SESSION['hiddenchangeprices']);
 $_SESSION['hiddenchangeprices'] = $_POST['hiddenchangeprice'];
}*/
global $wpdb;
$user_type = 'personal';

?>
			<?php
					if(isset($_POST['user_register_sub'])){
						$user_name = trim($_POST['user_username']);
						$first_name= $_POST['user_firstname'];
						$user_lastname = $_POST['user_lastname'];
						$user_phone = $_POST['user_telephone'];
						$user_email = trim($_POST['user_email']);
						$user_pwd = $_POST['user_password'];
						$user_profile_image= $_FILES['user_profile_image']['name'];
						$user_id = username_exists( $user_name );
						$user_type = "personal";

							if ( !$user_id and email_exists($user_email) == false ) 
							{ 
							    global $wpdb;
							   $user_id = wp_create_user( $user_name, $user_pwd, $user_email );

									 $insert = $wpdb->insert('wp_cart', array(
									'categoryId' =>'',
									'postId' =>'',
									'storeplan' =>'',
									'PostimgId' =>'',
									'countryIp' =>'',
									'cartSession' =>'',
									'price' =>'',
									'monthdurationPrice' =>'',
									'userid' => $user_id,
									'userimgprodileid' => '',
									'username' => $user_name,
									'useremail' => $user_email,
									)); 
									//echo $insert; exit();
									$lastid = $wpdb->insert_id; 
							  	//}
								//}					   
							    $userdata_ar=array('first_name'=>$first_name,'last_name'=>$user_lastname,'user_phone'=>$user_phone,'user_email'=>$user_email,'user_name'=>$user_name,'user_personal'=>$user_type);
							    custom_update_user_meta($userdata_ar,$user_id);
							    $url=site_url('ordering');
							  
							    $to = $user_email;
							  
							    $subject = get_bloginfo("name").' User Registration';
							    $topmessage='Thankyou for your recent registration on our '.get_bloginfo("name").'.
											This email confirms our receipt of your registration.You will be able to login on our site after admin Approval.';
								
								mail_data('',$topmessage,$to,$subject,$user_name);			
								$_SESSION['lastinsertedid'] = $lastid; 			
							 	$selectusers = $wpdb->get_results("select userid from wp_cart where userid=$user_id ");		
								$redurl=site_url('ordering');			
								 wp_set_auth_cookie( $user_id );
							    wp_set_current_user( $user_id );
							    $custom_page_url = home_url( '/ordering');
							    wp_redirect( $custom_page_url );
							    exit;
								?>        
						         <?php		
								}
								else
								{
									$_SESSION['signup_user'] = $user_id;
									$random_password = __('Email Id or Username already exists.');
									echo '<div class="error-div-main"><p class="reg_error exits">'.$random_password.'</p></div>';								
								}
							} 
						?>
			

						<!-- Business Form -->
						<?php
					if(isset($_POST['business_register_sub'])){
						//print_r($_POST); 
						$company_name = $_POST['company_name'];
						$office_number = $_POST['office_number'];
						$user_name = trim($_POST['business_username']);
						$first_name= $_POST['business_firstname'];
						$user_lastname = $_POST['business_lastname'];
						$user_phone = $_POST['business_telephone'];
						$user_email = trim($_POST['business_email']);
						$user_pwd = $_POST['business_password'];
						$user_profile_image= $_FILES['business_profile_image']['name'];
						$user_id = username_exists( $user_name );
						$user_type = "business";
							if ( !$user_id and email_exists($user_email) == false ) 
							{ 
							    global $wpdb;
							   $user_id = wp_create_user( $user_name, $user_pwd, $user_email );
									 $insert = $wpdb->insert('wp_cart', array(
									'categoryId' =>'',
									'postId' =>'',
									'storeplan' =>'',
									'PostimgId' =>'',
									'countryIp' =>'',
									'cartSession' =>'',
									'price' =>'',
									'monthdurationPrice' =>'',
									'userid' => $user_id,
									'userimgprodileid' => '',
									'username' => $user_name,
									'useremail' => $user_email,
									)); 
									//echo $insert; exit();
									$lastid = $wpdb->insert_id; 
							  	//}
								//}					   
							    $userdata_ar=array('first_name'=>$first_name,'last_name'=>$user_lastname,'user_phone'=>$user_phone,'user_email'=>$user_email,'user_name'=>$user_name,'user_business'=>$user_type,'company_name'=>$company_name,'office_number'=>$office_number);
							    custom_update_user_meta($userdata_ar,$user_id);
							    $url=site_url('ordering');
							  
							    $to = $user_email;
							  
							    $subject = get_bloginfo("name").' User Registration';
							    $topmessage='Thankyou for your recent registration on our '.get_bloginfo("name").'.
											This email confirms our receipt of your registration.You will be able to login on our site after admin Approval.';
								
								mail_data('',$topmessage,$to,$subject,$user_name);			
								$_SESSION['lastinsertedid'] = $lastid; 			
							 	$selectusers = $wpdb->get_results("select userid from wp_cart where userid=$user_id ");		
								$redurl=site_url('ordering');			
								 wp_set_auth_cookie( $user_id );
							    wp_set_current_user( $user_id );
							    $custom_page_url = home_url( '/ordering');
							    wp_redirect( $custom_page_url );
							    exit;
								?>        
						         <?php		
								}
								else
								{
									$_SESSION['signup_user'] = $user_id;
									$random_password = __('Email Id or Username already exists.');
									echo '<div class="error-div-main"><p class="reg_error exits">'.$random_password.'</p></div>';								
								}
} 

if($user_type == 'business'){ ?>
<style>
#personal_user{

	display: none;
}
</style>
<?php }else{ ?>
<style>
#business_user{

	display: none;
}
</style>

<?php }
?>
<div class="main-category-cont">
	
	<section class="categry-main registerout">
		<div class="container">
			<div class="row">
				<div class="sign-up-tapage">
	                <div class="cntct-head ragi">
	                  	<div class="col-md-10 no-padding">
	                      	<div class="md-heading">
	                        	<h1>Register</h1>
	                      	</div>
	                      	<div class="cntct-head-txt">
	            <p>Please fill in the following fields and click on submit button to start using our services</p>
	                      	</div>
	                      	<!-- start 14-12-2017 -->
													<div class="rlt-form">
														Do you want to set up a personal or a business account?<br/>
														<div class="lft">
														<label for="personal">
													    <input type="radio" id="personal" name="user_type" value="personal" <?php if($user_type == 'personal'){ echo "checked";}?> />
													    <span>Personal</span>
														</label>
													  </div>
													  <div class="rgt">
														<label for="business">
								<input type="radio" id="business" name="user_type" value="business" <?php if($user_type == 'business'){ echo "checked"; } ?>  />
													    <span>Business</span>
														</label>
														</div>
													</div>
													<!-- Ending -->
	                  	</div>
	                </div>
			
		



			
					<div class="main-catgry-sec">
						<div class="row">
							<div class="col-md-12">
								<div class="contrct-reg personal" id="personal_user">
									<form method="post" action="" id="user_registrations" enctype="multipart/form-data" name="signup" >
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="user_username">Username (Display Name) *:</label>
													<input type="text" value="<?php echo $first_name; ?>" name="user_username" class="form-control" id="user_username" placeholder="Username">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_firstname">First Name*:</label>
													<input type="text" value="<?php echo $first_name; ?>" name="user_firstname" class="form-control" id="user_firstname" placeholder="First Name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_lastname">Last Name <span class="require">*</span>:</label>
													<input type="text" value="<?php echo $user_lastname; ?>" name="user_lastname" class="form-control" id="user_lastname" placeholder="Last Name">
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_telephone">Telephone <span class="require">*</span>:</label>
													<input type="text" value="<?php echo $user_phone; ?>" name="user_telephone" class="form-control" id="user_telephone" placeholder="Telephone">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_email">Email <span class="require">*</span>:</label>
													<input type="email" value="<?php echo $user_email; ?>" name="user_email" class="form-control" id="user_email" placeholder="User Email">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_password">Enter a Password <span class="require">*</span>:</label>
													<input type="password" value="<?php echo $user_pwd; ?>" name="user_password" class="form-control" id="user_password" placeholder="Choose a Password">
												</div>
												
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="user_confirm_password">Confirm Your Password <span class="require">*</span>:</label>
													<input type="password" name="user_confirm_password" class="form-control" id="user_confirm_password" placeholder="Confirm Password">
												</div>
											</div>						
										</div>	
							
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="contr_captcha">Enter Captcha <span class="require">*</span>:</label><br/>
													<?php
													$rand=substr(rand(),0,4);
													?>
													
													<input type="text" value="<?php echo $rand;?>" id="ran" readonly="readonly" class="captcha" disabled="disabled">
													<!--<input type="button" class="refer_captcha" value="Refresh" onclick="captch()" />-->
													<i class="fa fa-refresh" onclick="captch()" title="Refresh"></i>
												</div>
												<div class="form-group">
													<!--<label for="contr_captcha">Enter Captcha <span class="require">*</span>:</label>-->
													<input type="text" name="contr_captcha" class="form-control" id="contr_captcha" placeholder="Enter Captcha">
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
												<input type="checkbox" name="termsouse" id="termsouse" class="termsofuse">I have read and agree to the <a href="<?php echo get_bloginfo('url');?>/terms-of-use/" target="_blank">Terms of Use and the Privacy Policy </a>*
												</div>
											</div>
										</div>
									
										<div class="row">
											<div class="col-md-12">
												<div class="user_reg_sub_out">
													<input type="hidden" name="type" value="personal">
													<input type="submit" name="user_register_sub" value="Submit" />
													<input type="hidden" id="ajaxUrl" value="<?php echo admin_url('admin-ajax.php'); ?>" />
												</div>  
											</div>
										</div>					
									</form>
						    </div>						




						    <!-- Create new Business Form -->
						    <div class="contrct-reg" id="business_user">
									<form method="post" action="" id="business_registrations" enctype="multipart/form-data" name="business_signup" >
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="company_name">Company Name*:</label>
													<input type="text" value="<?php echo $company_name; ?>" name="company_name" class="form-control" id="company_name" placeholder="Company Name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="office_number">Office Number<span class="require">*</span>:</label>
													<input type="text" value="<?php echo $office_number; ?>" name="office_number" class="form-control" id="office_number" placeholder="Office Number">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<label for="business_username">Username (Display Name) *:</label>
													<input type="text" value="<?php echo $user_name; ?>" name="business_username" class="form-control" id="business_username" placeholder="Username">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_firstname">First Name*:</label>
													<input type="text" value="<?php echo $first_name; ?>" name="business_firstname" class="form-control" id="business_firstname" placeholder="First Name">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_lastname">Last Name <span class="require">*</span>:</label>
													<input type="text" value="<?php echo $user_lastname; ?>" name="business_lastname" class="form-control" id="business_lastname" placeholder="Last Name">
												</div>
											</div>
										</div>
										
										
											
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_telephone">Mobile Number <span class="require">*</span>:</label>
													<input type="text" value="<?php echo $user_phone; ?>" name="business_telephone" class="form-control" id="business_telephone" placeholder="Telephone">
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_email">Email <span class="require">*</span>:</label>
													<input type="email" value="<?php echo $user_email; ?>" name="business_email" class="form-control" id="business_email" placeholder="User Email">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_password">Enter a Password <span class="require">*</span>:</label>
													<input type="password" value="<?php echo $user_pwd; ?>" name="business_password" class="form-control" id="business_password" placeholder="Choose a Password">
												</div>
												
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_confirm_password">Confirm Your Password <span class="require">*</span>:</label>
													<input type="password" name="business_confirm_password" class="form-control" id="business_confirm_password" placeholder="Confirm Password">
												</div>
											</div>						
										</div>	
										
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="business_captcha">Enter Captcha <span class="require">*</span>:</label><br/>
													<?php
													$rand=substr(rand(),0,4);
													?>
													
													<input type="text" value="<?php echo $rand;?>" id="business_ran" readonly="readonly" class="captcha" disabled="disabled">
													<!--<input type="button" class="refer_captcha" value="Refresh" onclick="captch()" />-->
													<i class="fa fa-refresh" onclick="captch()" title="Refresh"></i>
												</div>
												<div class="form-group">
													<!--<label for="contr_captcha">Enter Captcha <span class="require">*</span>:</label>-->
													<input type="text" name="business_captcha" class="form-control" id="business_captcha" placeholder="Enter Captcha">
												</div>
												
											</div>
										
											<div class="col-md-12">
												<div class="form-group">
												
												<input type="checkbox" name="termsouse" id="termsouse" class="termsofuse">I have read and agree to the <a href="<?php echo get_bloginfo('url');?>/terms-of-use/" target="_blank">Terms of Use and the Privacy Policy </a>*
													
												</div>
											</div>
										</div>
									
										
											
										<div class="row">
											<div class="col-md-12">
												<div class="user_reg_sub_out">
													<input type="hidden" name="type" value="business">
													<input type="submit" name="business_register_sub" value="Submit" />
													<input type="hidden" id="ajaxUrl" value="<?php echo admin_url('admin-ajax.php'); ?>" />
												</div>  
											</div>
										</div>					
									</form>
						        </div>	


						       <!-- End Business Form -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>

