<?php
if($type=='editUsers'){
global $wp_country;

$userId = $_GET['userId'];
$company_name = get_user_meta($userId,'company_name',true);
$office_number = get_user_meta($userId,'office_number',true);
$user_business = get_user_meta($userId,'user_business',true);
$userfirstname = get_user_meta($userId,'first_name',true);
$nickname = get_user_meta($userId,'nickname',true); 
$last_name = get_user_meta($userId,'last_name',true); 
$user_phone = get_user_meta($userId,'user_phone',true); 
$user_pickup_address = get_user_meta($userId,'user_pickup_address',true); 
$author_obj = get_user_by('id', $userId);
$user_status = get_user_meta($userId,'ja_disable_user',true);
$user_country = get_user_meta($userId,'country_code',true);
if($user_status=='1' ){$checked='checked';}else{$checked='';}
foreach($author_obj as $ussserdetails){ //print_r($ussserdetails);
$useremail[] = $ussserdetails->user_email;
$userpass[] = $ussserdetails->user_pass;
$userurl[] = '';
$user_pass[] = $ussserdetails->user_pass;
}
$countrylist = $wp_country->countries_list();
											

//echo $user_pass[0];
?>

<div class="col-md-12">
<form method="POST" action="" id="edituser" enctype="multipart/form-data">
<?php global $post; $postids = getCartCountUserId($userId); 
if(!empty($postids)){ /* edit by posts cart starts hre */ ?>
<!--<div class="col-md-12">
<div class="form-group">
<!--<label for="titles" class="itemslists">Items:</label>-->
<?php /*
$args = array(
    'post__in' => $postids,
	'post_type'=>'storagetype',
);
$posts = get_posts( $args );


while (list($i, $post) = each($posts)) :
    setup_postdata($post);
    
    get_the_title();
	$ktstorage_type_image = get_field('ktstorage_type_image'); 
	$img_width= get_option('thumbnail_size_w');
	$img_height = get_option('thumbnail_size_w');*/?>
	<!--<div class="col-md-4 ">
	<div class="all-products">
	<div class="imgageshow">
	<img src="<?php //echo $ktstorage_type_image; ?>" width="<?php //echo $img_width; ?>" height="<?php echo $img_width; ?>" />
	</div>
	<div class="titleopost"><h6><?php //echo get_the_title();?></h6></div>
	<div class="buttonlists"><a id="open-pop-ups" href="javascript:void(0);">Enter Items Details</a></div>
	</div>
	</div> -->
	
<?php /*
endwhile;
wp_reset_postdata();*/

?>
<!--
</div>
</div>-->
<!-- div class popup starts here -->
<div id="pop-ups" class="pop-up-display-content-none">
<div class="field_wrapper extrafields">
<div class="form-group">
<label for="titles">Upload Box image:</label>
<div class="image-upload">
    <label for="file-input">
        <i class="fa fa-plus" ></i>
    </label>

    <input id="file-input" type="file"/>
</div>
<label for="titles">Enter Item Id :</label>
<input type="text" class="itemidname" name="field_name[]" value="" placeholder="Enter Item Id" required />
<a href="javascript:void(0);" class="add_button" title="Add field"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/add-icon.png"/></a>
<input type="hidden" name="" value="" />
</div>
</div>
</div>
	<!-- div class popup ends here -->
<?php }  /* edit by posts cart starts hre */  ?>
<?php
		
	if($user_business == "business"){ ?>
		<div class="form-group">
			<label for="titles">Company Name:</label>

			<input type="text" class="editcompanyname" name="editcompanyname" class="form-control" id="editcompanyname" value="<?php echo $company_name; ?>" required>
		</div>
		<div class="form-group">
		<label for="titles">Office Number:</label>
		<input type="text" class="editofficenumber" name="editofficenumber" class="form-control" id="editofficenumber" value="<?php echo $office_number; ?>" required>
		</div>
	<?php }
?>
<div class="form-group">
<label for="titles">User First Name:</label>

<input type="text" class="editfirstname" name="editfirstname" class="form-control" id="editfirstname" value="<?php echo $userfirstname; ?>" required>
</div>
<div class="form-group">
<label for="titles">User Last Name:</label>
<input type="text" class="editlastname" name="editlastname" class="form-control" id="editlastname" value="<?php echo ucfirst($last_name);?>" required>
</div>

<div class="form-group">
<label for="titles">User Nick Name:</label>
<input type="text" class="editnickname" name="editnickname" class="form-control" id="editnickname" value="<?php echo ucfirst($nickname);?>" required>
</div>

<div class="form-group">
<label for="titles">User Address:</label>
<input type="text" class="editaddress" name="editaddress" class="form-control" id="editaddress" value="<?php echo $user_pickup_address;?>" required>
</div>

<div class="form-group">
<label for="titles">User Phone:</label>
<input type="text" class="editphone" name="editphone" class="form-control" id="editphone" value="<?php echo $user_phone;?>" required>
</div>


<div class="form-group">
<label for="titles">User Email:</label>
<input type="email"  name="editemail" class="form-control" id="editemail" value="<?php echo  $useremail[0];?>" required>
</div>

<div class="form-group">
<label for="titles">Disable User:</label>
<input type="checkbox" name="ja_disable_user" value="1" > If checked, the user cannot login with this account.


</div>


<div class="form-group">
<label for="titles">User password:</label><br/>
<button class="changepasswordbutton" >Generate Password</button>
<input type="text" name="changepassword"  class="form-control changepassword" value="<?php echo rand();?>" /> 
<button class="cancelpassword" >Cancel</button>
</div>

<div class="form-group">
<label for="titles">Country:</label><br/>
<?php
echo '<select name="selectcountry" class="selectcontry" >';
foreach($countrylist as $key=>$countryval){
	if($key==$user_country){echo $selected= "selected";echo '<option name="countryname" value="'.$key.'" '.$selected.'>'.$countryval.'</option>';}else { echo '<option name="countryname" value="'.$key.'">'.$countryval.'</option>';}

}
echo '</select>';	
?>
</div>

<div class="form-group usersimagesection">

<?php $attachment_id = get_user_meta( $userId, 'user_profile_image', true ); 
$image_attributes = wp_get_attachment_image_src( $attachment_id );
if ( $image_attributes ) : ?>
<img src="<?php echo $image_attributes[0]; ?>" class="userimageids"/>
<?php endif;
?>
<a class="changeuserimage" href="javascript:void(0);">Change Image</a>
<div class="upload-file userimagechange">
<input type="file" accept=".gif,.jpg,.jpeg,.png" name="user_profile_image" class="form-control" id="user_profile_image"><br/>

</div>

</div>

<input type="hidden" class="hidden_editsuserid" name="uesr_ids" value="<?php echo $editpostid;?>" />

<?php wp_nonce_field( 'user_nonce', 'user_edit_nonce_field' ); ?>
<input type="hidden" name="userurl" value="<?php echo $userurl[0]; ?>" />
<input type="hidden" name="editsuser" id="editsuser" value="<?php echo $userId; ?>" />
<input type="submit" class="btn btn-default useredit" value="Update">
</form>
</div>


<?php 

if(isset($_POST['user_edit_nonce_field'])){
	
	$ja_disable_user = $_POST['ja_disable_user'];
	$editcompanyname = $_POST['editcompanyname'];//  Company Name
	$editofficenumber = $_POST['editofficenumber'];//  Office Number
	$editfirstname = $_POST['editfirstname']; 
	$editlastname = $_POST['editlastname'];
	$editnickname = $_POST['editnickname'];
	$editaddress = $_POST['editaddress'];
	$editphone = $_POST['editphone'];
	$editemail = $_POST['editemail'];
	$changepassword =sanitize_text_field($_POST['changepassword']);
	$userurl = $_POST['userurl'];
	$editsuser = $_POST['editsuser'];
	$address = $_POST['editaddress'];
	$user_profile_image= $_FILES['user_profile_image']['name'];
	$countrylist = $_POST['selectcountry'];
	
	//custom_update_user_meta($userdata_ar,$editsuser);
	update_user_meta( $editsuser, 'ja_disable_user', "$ja_disable_user" );
	
	if(!empty($user_profile_image))
	{							
		if($user_profile_image)
		{
		$fname=$user_profile_image;
		$media_handle_name='user_profile_image'; 
		
		$user_profile_image_attch=inserting_file_type_form_data($fname,$media_handle_name,$editsuser);
		
		update_user_meta($editsuser,'user_profile_image',$user_profile_image_attch); 
		}
	}
	
	$userdata = array(
            'ID'        =>  $editsuser,
            'user_pass' =>  $changepassword // Wordpress automatically applies the wp_hash_password() function to the user_pass field.
        );
	$user_id = wp_update_user($userdata);
	
	$userdata_ar=array('first_name'=>$editfirstname,'last_name'=>$editlastname,'nickname'=>$editnickname,'user_phone'=>$editphone,'user_pickup_address'=>$address,'user_delivery_address'=>'','ja_disable_user'=>$ja_disable_user,'country_code'=>$countrylist,'company_name'=>$editcompanyname,'office_number'=>$editofficenumber);

	if($user_id){
	$updateusers = custom_update_user_meta($userdata_ar,$user_id);
	$to = $editemail;
	$subject = get_bloginfo("name").' Edit User';
	$topmessage='Your profile has been updated.';
	

$postuseremail ='<votivewp.bijay@gmail.com>';
$email='<'.$editemail.'>';
$subject = 'User Updated';

$message = "User Updated Successfully";
$encodedvalues = 'Hello User'.$editfirstname.'';
//exit();
$message = '<html>
<head>
<title>HTML email</title>
</head>
<body>';
$message.='<div style="background-color: #eee;color: #000;line-height: 23px;padding: 10px 0px 20px 10px;">';
$message.='<div class="navbar-header" style="width: 100%;float: left;margin: 0px;padding: 0px;margin: 10px 0px 10px 0px;    text-align: center;"><img width="240" height="62" src="'.get_bloginfo("url").'/wp-content/uploads/2017/09/cropped-logo.png" class="custom-logo" alt="KlutterClear" itemprop="logo"></div>';
$message.= 'Hi '.$editfirstname.',<br>';
$message.='This notice confirms that your profile was updated on KlutterClear.';
$message.="If you did not change your profile, please contact the Site Administrator at ".get_bloginfo('admin_email')."";
$message.="<br>This email has been sent to ".$editemail."";
$message.=" <br>Regards, <br>";
$message.="All at KlutterClear <br>";
$message.=get_bloginfo('url');
$message .= '</div></body>
			</html>  
			';

 $multiple_recipients = array(
            $postuseremail,
            $email
            ); 
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <info@votivewordpress.in>' . "\r\n";
$endmails = wp_mail( $multiple_recipients, $subject, $message, $headers);
if($endmails){echo "send";}else{echo "notsend";}
	
	?>
		<script type = "text/javascript" language = "javascript">
			jQuery(document).ready(function() {
			alert ("User Updated");
			window.location = "<?php echo get_permalink();?>?type=allusers";
			});
		</script>
	
	<?php 

	} else {
	echo 'error';
	}
	 
		
	
}
}

?>