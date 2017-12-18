<?php
if($type=='orders' || $type==''){ ?>

<?php 
global $wpdb;
$user = wp_get_current_user();
$userId = $user->ID;
$user_email = $user->user_email;
$selects = $wpdb->get_results("select * from wp_orders where subscr_id!=''");	
$html='';
$html.='<div class="col-xs-12 table-responsive">
<table class="table table-striped">
<thead>
<tr>
	<th>Customer Name</th>
	<th>Company Name</th>
	<th>Total Products</th>
	 <th>Total Price</th>
	<th>View Details</th>
</tr>
</thead><tbody>';
//$product_counts = getProductCountByCustomerEmail('votivephp.dibya@gmail.com'); //Total number of products
//$product_total_price = getProductPriceByCustomerEmail('votivephp.dibya@gmail.com'); //Total Price
$orderlists = getOrdersLists();	
foreach($orderlists as $totalorderlists){
	//print_r($totalorderlists);
	$email = $totalorderlists['useremail'];
  $user = get_user_by( 'email', $email );
  $companyName = get_user_meta($user->ID, 'company_name', true);

	$order_id = $totalorderlists['order_id'];
	$datetime = $totalorderlists['datetime'];
	$html.='<tr>
	<td>'.$totalorderlists['fullname'].'</td>
	<td>'.$companyName.'</td>
	<td>'.getProductCountByCustomerEmail($email).'</td>
	<td>'.getProductPriceByCustomerEmail($email).'</td>
	<td><a href="'.get_the_permalink().'?type=orderdetailslists&date='.$datetime.'&orderid='.$order_id.'&useremail='.$email.'">View Details</a></td>
	</tr>';
}

$html.='</tbody></table>
</div>';
echo $html; 
} ?>


