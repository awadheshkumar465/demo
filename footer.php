<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
//custom fields
$foot_contact_number=get_option('foot_contact_number');
$foot_contact_number_link=get_option('foot_contact_number_link');
$foot_email_id=get_option('foot_email_id');
//social links
$facebook_link=get_option('facebook_link');
$twitter_link=get_option('twitter_link');
$linkdin_link=get_option('linkdin_link');
$footer_copyright=get_option('footer_copyright');
$footer_section='';
?>


		<footer class="main-footer">
    <div class="footer-top">
        <div class="container">
            <div class="ftr-social-link">
	            <div class="row">
              <?php
                if($foot_email_id)
                {
                  $footer_section .='<div class="col-md-4">
	            		<div class="ftr_visit">
	            			<a href="mailto:'.$foot_email_id.'"><i class="fa fa-envelope" aria-hidden="true"></i> '.$foot_email_id.'</a>
	            		</div>
	            	</div>';                  
                }                
                if($foot_contact_number)
                {
                    $footer_section .='<div class="col-md-4">
                  <div class="ftr_visit">
                    <a href="tel:'.$foot_contact_number_link.'"><i class="fa fa-phone" aria-hidden="true"></i> '.$foot_contact_number.'</a>
                  </div>
                </div>';
                }
	            	
                if($facebook_link || $twitter_link || $linkdin_link)
                {
                    $footer_section .='<div class="col-md-4">
                  <div class="ftr_follow">
                    <ul>';
                      if($facebook_link)
                      {
	            				   $footer_section .='<li><a href="'.$facebook_link.'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';                        
                      }
                      if ($twitter_link)
                      {
	            				   $footer_section .='<li><a href="'.$twitter_link.'"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';                       
                      }
                      if($linkdin_link)
                      {
	            				   $footer_section .='<li><a href="'.$linkdin_link.'"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';                        
                      }
	            			$footer_section .='</ul>
    	            		</div>
    	            	</div>
    	            </div>';
                }
            echo $footer_section;
              ?>
	        </div>    
            <div class="row">
                <div class="f_middle">
                <?php 
                dynamic_sidebar('footer-1');
                dynamic_sidebar('footer-2');
                dynamic_sidebar('footer-3');
                dynamic_sidebar('footer-4');
                ?>
                </div>
            </div>
                
                    
        </div>
    </div>
    <?php 
    if($footer_copyright)
    {
    echo '<div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="copyright">
                    <div class="col-sm-12">
                        <div class="cpright">
                            <span>'.$footer_copyright.'</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    }
    
    ?>
</footer><!-- .site-footer -->

<script type='text/javascript' src='<?php echo get_stylesheet_directory_uri(); ?>/js/slick.min.js?ver=4.8.1'></script>
<script>
jQuery('.center').slick({
  dots: true,
  centerMode: true,
  centerPadding: '200px',
  slidesToShow: 1,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 3
      }
    },
    {
      breakpoint: 480,
      settings: {
        arrows: false,
        centerMode: true,
        centerPadding: '40px',
        slidesToShow: 1
      }
    }
  ]
});

jQuery(document).ready(function(){
	
 jQuery("#owl-demo").owlCarousel({

      navigation : false, // Show next and prev buttons
      slideSpeed : 300,
      paginationSpeed : 400,
      pagination : true,
      singleItem:true,
      autoplay:true,
      loop:true

  });
  
   jQuery( "#slider-range" ).slider({
      range: true,
      min: 1,
      max: 13,
      values: [ 3, 5 ],
      slide: function( event, ui ) {
      	var maxval=ui.values[ 1 ];
      	if(maxval==13)
      	{
      		var maxval='12+';
      	}
        jQuery( "#amount" ).val( ui.values[ 0 ] + " - " + maxval );

      }
    });
    jQuery( "#amount" ).val( jQuery( "#slider-range" ).slider( "values", 0 ) +
      " - " + jQuery( "#slider-range" ).slider( "values", 1 ) );
	  
 /* jquery to change price when click on months */
	 jQuery('.srch-range.bybox_changeprice ul.change_prices li a').click(function(){
	   var databalue=jQuery(this).attr('data-value');
	   var datapricerange=jQuery(this).attr('data-attr');
		if ( jQuery( this).is( ".active_m" ) ) {
		
		}
		else{
			jQuery('.srch-range.bybox_changeprice ul.change_prices li a.active_m').removeClass('active_m');
			jQuery(this).addClass('active_m');
		}
	  jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
		dataType: "html",
        data: { action: 'get_prices', catids: databalue,datapriceranges:datapricerange},
        success : function(data){
			
			jQuery('.sb_products.bybox .row').html(data);
			var changeprice= jQuery('.sb_products.bybox .col-md-4:nth-child(1) .sb_pro_sub .sb_pro_details .prod-price strong').html();
			console.log ("change price" + changeprice);
			var change_prices=jQuery('#cpa-form input.storeplanbybox').attr('value',datapricerange); 
			
			
		}
    });
	
	   
   }); 
 
   
   /*jquery to change price by item when click on month */
   jQuery('.srch-range.byitem_changeprice ul.change_prices li a').click(function(){
	   var databalue=jQuery(this).attr('data-value');
	   var datapricerange=jQuery(this).attr('data-attr');
	 
		if ( jQuery( this).is( ".active_m" ) ) {
		
		}
		else{
			jQuery('.srch-range.byitem_changeprice ul.change_prices li a.active_m').removeClass('active_m');
			jQuery(this).addClass('active_m');
		}
	  jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'POST',
		dataType: "html",
        data: { action: 'get_prices_by_item', catids: databalue,datapriceranges:datapricerange},
        success : function(data){
			
			jQuery('.sb_products.byitem .row').html(data);
			var changeprice= jQuery('.sb_products.byitem .col-md-4:nth-child(1) .sb_pro_sub .sb_pro_details .prod-price strong').html();
			console.log ("change price" + data);
			var change_prices=jQuery('#cpa-form input.storeplanbyitem').attr('value',datapricerange); 
			
			
		}
    });
	
	   
   }); 
   
   
   /* home page change color of prices */
    jQuery('.srch-range.homepage ul.change_prices li a').click(function(){
	  
		if ( jQuery( this).is( ".active_m" ) ) {
		
		}
		else{
			jQuery('.srch-range.homepage ul.change_prices li a.active_m').removeClass('active_m');
			jQuery(this).addClass('active_m');
		}
   });
   
   
   jQuery('.page-template-customersaccount .btn.btn-default.addmoreimg').click(function(){ 
	
	   
	   var newlcss= jQuery('.formshiddenadd.showfields').attr('class');
	   var newlcssx= jQuery('.formshiddenadd.showfields').is( ".formshiddenadd.showfields" );
	   if(newlcssx==true){
		   jQuery('.formshiddenadd').removeClass('showfields');
		 }
	   else{ 
	   jQuery('.formshiddenadd').addClass('showfields');
	   }
	//alert (newlcss + newlcssx);
	//return false;
	   jQuery('.formshidden').css('display','none');
   });
   jQuery('.hiddenfields span').click(function(){
	   jQuery('.formshiddenadd').removeClass('showfields');
	  var spanedit=jQuery(this).attr('data-value'); 
	  var postids=jQuery(this).attr('data-attr'); 
	  var spanedithtml=jQuery(this).html();
	  var hiddenpostids=jQuery('input.hiddenvalsids').val();
	  //alert ("datavalue="+spanedit+"dtahtml="+spanedithtml+"hiddenpostids"+hiddenpostids);
	  if(spanedithtml == 'Edit'){ 
	  var oldimageid=jQuery(this).attr('data-value');
      //var editimages=jQuery(this).attr('data-actions'); 	  
		 // alert ("tesing edit html" +spanedit +postids);
		  jQuery('#featured_upload .hidden_postids').attr('value',postids);
		  jQuery('#featured_upload .hidden_oldimgpostids').attr('value',oldimageid);
		  jQuery('#featured_upload .hidden_editimgpostids').attr('value',spanedithtml);
		  
			jQuery('.formshidden').toggle();
	  }
	
	  if(spanedithtml == 'Delete'){
		  var userid = jQuery(this).attr('data-user'); 
		  var categoryid = jQuery(this).attr('data-category');
		jQuery.ajax({
			url: '<?php echo admin_url('admin-ajax.php'); ?>',
			type: 'POST',
			dataType: "html",
			data: { action: 'deleteimages', imgid: spanedit,posid:postids,userid:userid,catids:categoryid},
			success : function(data){
				//alert (data);
				console.log (data);
				var numItems = jQuery('.col-md-4.imageslists').length;
				alert("Product image deleted successfully" + numItems);
				window.location = "<?php echo get_bloginfo('url');?>/customers-account";
				
			}
		})
	  }
		  
   });
   
   jQuery('#selectservice_form_out table tr td.gllimgs .gallery .gallery-icon.landscape a').attr('href','javascript:void(0);');
   jQuery('.table.table-bordered .gallery .gallery-icon.landscape a').attr('href','javascript:void(0);');
   
   /* add to cart functin starts here */
   
   jQuery('.btn.btn-default.cartsumbit').click(function(e){
	  e.preventDefault();
		alert ("testing cart button");
   });
   /* add to cart function ends here */
   
   jQuery('.text-right.logout ul li#menu-item-logout a').html('<i class="fa fa-lock" aria-hidden="true"></i>Log Out');
   jQuery('.faq_sect .container .col-md-3:nth-child(5)').after( "<h2></h2>" );
   

/* promo code icons starts here */
jQuery('.promocodeval').click(function(){ 
	jQuery('.promocodefield').toggle();
});

/* promo code icons ends here */

});


</script>
<script type="text/javascript">
  jQuery(document).ready(function(){
  
    jQuery('input[type=radio][name=user_type]').change(function() {
        if (this.value == 'personal') {
            jQuery("#personal_user").show();
           jQuery("#business_user").hide();
        }
        else if (this.value == 'business') {
            jQuery("#personal_user").hide();
             jQuery("#business_user").show();
                }
            });
  });
</script>
<style type="text/css">
  .lft {
    float: left;
    width: 110px;
  }
  .lft span {
    float: right;
    margin-top: 13px;
}
.rgt span {
    float: right;
    margin-top: 13px;
}
.page-template-registrationtemplate form#business_registrations span.error {
    color: #FF0000;
    font-weight: normal;
}
p.reg_error.exits {
    position: absolute;
    top: 23%;
    left: 39%;
    color: #FF0000;
}
.error-div-main p {
    border: 1px solid #FF0000 !important;
}
</style>
<?php wp_footer(); ?>
</body>
</html>
