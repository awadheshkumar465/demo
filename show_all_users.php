<?php
if($type=='allusers'){ 

$blogusers = get_users();  ?>
<div class="col-md-12 searchsort"> <!-- searchsort starts here -->
<div class="userlabel"><label class="filtertext">Search</label></div>
<div class="serachusrform"><!-- serach by form starts here -->
<form method="POST" action="" >
<input type="text" name="searchusrs" class="searchusers" value="<?php if(isset($_POST['searchusrs'])){echo $_POST['searchusrs'];}?>" />
<input type="submit" name="submitusers"class="submit-users-filter" value="Search Users" />
</form>
</div><!-- search form ends here -->

<div class="sortby" >
<div class="userlabel"><label class="filtertext">Sort By</label></div>
<?php if(isset($_POST['sortbys'])){if($_POST['sortbys']==''){}else{$selected="selected";}} ?>
<form method="POST" action="" >
<select name="sortbys" class="sortbyorder">
<option value="" <?php echo $selected;?> >ASC</option>
<option value="DESC" <?php echo $selected;?> >DESC</option>
</select>
<input type="hidden" value="<?php echo $_POST['filterbyrole'];?>" name="roleby" />
<input type="hidden" value="<?php echo $_POST['filterbynames'];?>" name="userby" />
<input type="hidden" value="<?php echo $_POST['filterbyemail'];?>" name="byemail" />
<input type="submit" class="submit-users-sort" value="Sort">
</form>
</div>
<!-- filter by fileter by name,email and role form starts here -->

<div class="filterform">
<div class="userlabel"><label class="filtertext">Filter By</label></div>
<form method="POST" action="" >

<?php
$filterusers = get_users();
//echo $filterusers->display_name;

?>

<select name="filterbynames" class="filterbyname"><!-- fileter by name starts here -->
  <?php if(!empty($_POST['filterbynames'])){} else{ ?>
  <option value="">Name</option> <?php } ?>
  <?php 
  foreach($filterusers as $filtervals){ 
  if(trim($_POST['filterbynames']) == (trim($filtervals->user_nicename))){
	   $selected="selected";
	  }
  else{
	   $selected="";
	  }?>
<option name="filtername" value="<?php echo $filtervals->user_nicename; ?>" <?php echo $selected;?> ><?php echo $filtervals->user_nicename; ?></option>
<?php
	//echo $filtervals->display_name;	
} ?>
</select> <!-- fileter by name ends  here -->

<select name="filterbyemail" class="filterbyemail"><!-- fileter by email starts here -->
  <option value="">Email</option>
  <?php 
  foreach($filterusers as $filtervals){ ?>
<option name="filteremail" value="<?php echo $filtervals->user_email; ?>"><?php echo $filtervals->user_email; ?></option>
<?php
	//echo $filtervals->display_name;	
} ?>
</select> <!-- fileter by email ends here -->

<?php
global $wp_roles;
$all_roles = $wp_roles->roles; //print_r($all_roles);
$editable_roles = apply_filters('editable_roles', $all_roles);
?>

<select name="filterbyrole" class="filterbyroles"><!-- fileter by role starts here -->
<?php if(!empty($_POST['filterbyrole'])){} else{ ?>
<option value="">Role</option><?php } ?>
  <?php 
  foreach($editable_roles as $key=>$value){ if((trim($_POST['filterbyrole'])) == (trim($value['name']))){$selected="selected";
	  }
  else{
	   $selected="";
	  }?>  ?>
<option name="filterrole" value="<?php echo $value['name'];?>" <?php echo $selected;?> ><?php echo $value['name'];?></option>
<?php
	//echo $filtervals->display_name;	
} ?>
</select> <!-- fileter by role ends here -->

<input type="submit" name="submitusers"class="submit-users-filter" value="Filter" />

</form>
</div> <!-- fileter by name,email and role form ends here -->
</div> <!-- searchsort ends here -->
<?php //print_r($_POST); ?>
<table class="table table-bordered table-inverse">
<thead>
<tr>
<th><?php _e('ID', 'pippinw'); ?></th>
<th><?php _e('Company Name', 'pippinw'); ?></th>
<th><?php _e('User Name', 'pippinw'); ?></th>
<th class="tablee_mail"><?php _e('Email', 'pippinw'); ?></th>
<th><?php _e('Role', 'pippinw'); ?></th>
<th><?php _e('Edit', 'pippinw'); ?></th>
<th><?php _e('Delete', 'pippinw'); ?></th>
<th><?php _e('Status', 'pippinw'); ?></th>
</tr>
</thead>

<tbody>
<?php
$arr='';
if(!empty($_POST['searchusrs'])){
if(isset($_POST['searchusrs'])){
	
	$searchusers = $_POST['searchusrs'];
	$user = strstr($searchusers, '@', true); 
	if(!empty($user)){
		$key='email';
		
	}
	else{
		$key='login';
	}
	
$usrarray = get_user_by($key,$searchusers);
if(!empty($usrarray)){
$i=0;
foreach($usrarray as $val){
	
	$userId = $val->ID; 
	$userids[]=$val->ID; 
	$user_country[] = get_user_meta($userId,'country_code',true);
	$userEmail[] = $val->user_email;
	$userName[] = get_user_meta($userId,'first_name',true);//get_user_meta(userId, 'first_name', true ); 
	$attachment_ids[] = get_user_meta($userId, 'user_profile_image', true ); 
	$disable_user_status = get_user_meta($userId,'ja_disable_user',true);
	if($disable_user_status=='1'){$status ="disable";}else{$status = "Enable";}

	
}


$disable_user_status = get_user_meta($userId[0],'ja_disable_user',true);
if($disable_user_status=='1'){$status ="disable";}else{$status = "Enable";}
$user_meta=get_userdata($userids[0]);

$user_roles=$user_meta->roles;

?>
<tr>
<td><?php echo $user_country[0].date('y')."000".$userId[0]; ?></td>
<td><?php echo $userName[0]; ?><br/>
<?php  //$attachment_id = get_user_meta($userids[0], 'user_profile_image', true ); 
$image_attributes = wp_get_attachment_image_src( $attachment_ids[0] );
if ( $image_attributes ) : ?>
<img src="<?php echo $image_attributes[0]; ?>" width="50>" height="50" />
<?php endif;
?></td>
<td class="tablee_mail"><?php echo $userEmail[0]; ?></td>
<td><?php echo $user_roles[0]; ?></td>
<td><a href="<?php get_the_permalink();?>?type=editUsers&userId=<?php echo $userids[0]; ?>" class="editusersbyid"> Edit</a></td>
<td><a class="deleteusersbyid" href="javascript:void(0);" data-userid="<?php echo $userids[0]; ?>">Delete</a></td>
<td class=""><?php echo $status; ?></td>
</tr>
<?php
}
}
}
elseif((!empty($_POST['filterbynames']))||(!empty($_POST['filterbyrole'])) || (!empty($_POST['filterbyemail']))){
if(isset($_POST['filterbynames'])||(isset($_POST['filterbyrole']))){
//print_r($_POST);
	$byname=$_POST['filterbynames'];
	$filterbyemail = $_POST['filterbyemail'];
	$fletrbyrole = $_POST['filterbyrole'];
	/*
	global $wp_roles;
	$wp_roles = new WP_Roles();
    print_r($wp_roles);
		$wp_roles->remove_role("HK_cus");*/
	if($fletrbyrole=='Customers'){ $fletrbyrole ='Customer';}

$sortbys=$_POST['sortbys'];
if($sortbys==''){$sortbys='ASC';}
$args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => $fletrbyrole,
	'role__in'     => array(),
	'role__not_in' => array(),
	'meta_key'     => 'nickname',
	'meta_value'   => $byname,
	'meta_compare' => '',
	'meta_query'   => array(),
	'date_query'   => array(),        
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'login',
	'order'        => $sortbys,
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => '',
 ); 

$blogusers = get_users($args);
//print_r($blogusers);
if(!empty($blogusers)){
foreach($blogusers as $key=>$filterusrs){ 
$usrdata[]=$filterusrs->data;

}

foreach($usrdata as $finalusrdata){
$userId = $finalusrdata->ID; 
$user_meta=get_userdata($userId);
$user_roles=$user_meta->roles[0];
$user_country = get_user_meta($userId,'country_code',true);
$userEmail = $finalusrdata->user_email;
$userName = get_user_meta($userId,'first_name',true);//get_user_meta(userId, 'first_name', true ); 
$attachment_ids = get_user_meta($userId, 'user_profile_image', true ); 
$disable_user_status = get_user_meta($userId,'ja_disable_user',true);
$company_name = get_user_meta($userId,'company_name',true);
if($disable_user_status=='1'){$status ="disable";}else{$status = "Enable";}
?>

<tr>
<td><?php echo $user_country.date('y')."000".$userId[0]; ?></td>
<td><?php echo $company_name; ?></td>
<td><?php echo $userName; ?><br/>
<?php $image_attributes = wp_get_attachment_image_src( $attachment_ids );
if ( $image_attributes ) : ?>
<img src="<?php echo $image_attributes[0]; ?>" width="50>" height="50" />
<?php endif;
?></td>
<td class="tablee_mail"><?php echo $userEmail; ?></td>
<td><?php echo ucfirst($user_roles); ?></td>
<td><a href="<?php get_the_permalink();?>?type=editUsers&userId=<?php echo $userId; ?>" class="editusersbyid"> Edit</a></td>
<td><a class="deleteusersbyid" href="javascript:void(0);" data-userid="<?php echo $userId; ?>">Delete</a></td>
<td class=""><?php echo $status; ?></td>
</tr>
<?php
}
}
else{
	echo '<tr><td colspan="7">No users found</td></tr>';
}

} 



}
else{
$sortbys=$_POST['sortbys'];
if($sortbys==''){$sortbys='ASC';}
$args = array(
	'blog_id'      => $GLOBALS['blog_id'],
	'role'         => '',
	'role__in'     => array(),
	'role__not_in' => array(),
	'meta_key'     => '',
	'meta_value'   => '',
	'meta_compare' => '',
	'meta_query'   => array(),
	'date_query'   => array(),        
	'include'      => array(),
	'exclude'      => array(),
	'orderby'      => 'login',
	'order'        => $sortbys,
	'offset'       => '',
	'search'       => '',
	'number'       => '',
	'count_total'  => false,
	'fields'       => 'all',
	'who'          => '',
 ); 

$blogusers = get_users($args); // this array holds all of your data
//var_dump($blogusers);
if( !empty( $blogusers ) ) :
$i=1;
foreach($blogusers as $allUsers) : 
$user_country = get_user_meta($allUsers->ID,'country_code',true);

$userId = $allUsers->ID;
$userEmail = $allUsers->user_email;
$userName = $allUsers->user_login;
$allUsers->roles[0];
$disable_user_status = get_user_meta($userId,'ja_disable_user',true);
$company_name = $allUsers->company_name;
if($disable_user_status=='1'){$status ="disable";}else{$status = "Enable";}
?>
<tr>
<td><?php echo $user_country.date('y')."000".$allUsers->ID; ?></td>
<!-- 15-12-2017 start-->
<td><?php echo $company_name; ?></td>
<!-- 15-12-2017 End-->
<td><?php echo $userName; ?><br/>
<?php $attachment_id = get_user_meta( $userId, 'user_profile_image', true ); 
$image_attributes = wp_get_attachment_image_src( $attachment_id );
if ( $image_attributes ) : ?>
<img src="<?php echo $image_attributes[0]; ?>" width="50>" height="50" />
<?php endif;
?></td>
<td class="tablee_mail"><?php echo $userEmail; ?></td>
<td><?php echo $allUsers->roles[0] ?></td>
<td><a href="<?php get_the_permalink();?>?type=editUsers&userId=<?php echo $userId; ?>" class="editusersbyid"> Edit</a></td>
<td><a class="deleteusersbyid" href="javascript:void(0);" data-userid="<?php echo $userId; ?>">Delete</a></td>
<td><a class="" href="javascript:void(0);" data-userid="<?php echo $userId; ?>"><?php  echo $status; ?></a><a class="changestatususer smallfonts" href="javascript:void(0);" data-status="<?php  echo $status; ?>" data-userid="<?php echo $userId; ?>">(click here to change status)</a></td>
</tr>
<?php $i++;
endforeach;
else : ?>
<tr>
<td colspan="3"><?php _e('No data found', 'pippinw'); ?></td>
</tr>
<?php 
endif; 

}
?>	

</tbody>
</table>

<?php
}
?>