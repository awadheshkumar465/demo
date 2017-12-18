(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function validateEmail(u_email)

	{

	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

	//var address = document.forms[form_id].elements[email].value;

	var address=u_email;
 
	//alert(address);

	if(reg.test(address) == false)

		{return false;}

	else{

		return true;

	}

	};

function checkPhone(u_phone) {

       
		var phonen = u_phone;
		var phonelength=phonen.length;
		var phoneNum = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/; 
		

            if(phonen.match(phoneNum) && phonelength>=8 && phonelength<=15) {

                return true;

            }

            else {

                return false;

            }

        };

function captch() {
	var x = document.getElementById("ran")
	x.value = Math.floor((Math.random() * 10000) + 1);
}
jQuery(document).ready(function(){
	jQuery(window).scroll(function() {   
       if (jQuery(window).scrollTop() >=100) { 
	   
          if(jQuery('.navbar-default').hasClass( "nav-fixed-top" ))
  {
  //jQuery('#header').removeClass("fixed-theme");
  }
  else
  {
  jQuery('.main-header').addClass("nav-fixed-top");
  }
       }
else{
jQuery('.main-header').removeClass("nav-fixed-top");
}
if (jQuery(window).scrollTop() >=400) { 
          if(jQuery('.main-header').hasClass( "navi-top" ))
  {
  //jQuery('#header').removeClass("fixed-theme");
  }
  else
  {
  jQuery('.main-header').addClass("navi-top");
  }
       }
else{
jQuery('.main-header').removeClass("navi-top");
}
   });

/*edit user jquery starts here */
jQuery('#open-pop-ups').click(function(){
	jQuery('.pop-up-display-content-none').addClass('show');
});
var maxField = 10; //Input fields increment limitation
    var addButton = jQuery('.add_button'); //Add button selector
    var wrapper = jQuery('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="form-group"><label for="titles">Upload Box image:</label><div class="image-upload"><label for="file-input"><i class="fa fa-plus" ></i></label> <input id="file-input" type="file"/></div><label for="titles">Enter Item Id :</label><input type="text" class="itemidname" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="http://votivewordpress.in/klutterclear/wp-content/themes/boxfull/images/remove-icon.png"/></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    jQuery(addButton).click(function(){ //Once add button is clicked
        if(x < maxField){ //Check maximum number of input fields
            x++; //Increment field counter
            jQuery(wrapper).append(fieldHTML); // Add field html
        }
    });
    jQuery(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        jQuery(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

/* edit user jqeury ends here */  

/* registration page form validation using jquery and ajax starts here */

/* customer and admin side (left sidebar) menu toggle section starts here */
	jQuery('.resp-tabs-list.hor_1 li').click(function(e){
				
	jQuery(this).children('ul').slideToggle('slow');
	if(jQuery(this).find('i').hasClass('fa-expand'))
	{
	jQuery(this).find('i').removeClass('fa-expand').addClass('fa-plus');
	}
	else
	{

	jQuery(this).find('i').removeClass('fa-plus').addClass('fa-expand');
	}				
	jQuery(this).siblings('li').find('ul').hide('slow');
	jQuery(this).siblings('li').find('i').removeClass('fa-expand').addClass('fa-plus');
	e.stopPropagation();
	});
/* customer and admin side (left sidebar) menu toggle section starts here */

  jQuery("#user_registrations").validate({
     rules: {                   
				user_username: {
					required: true
					
				},
			termsouse:"required",
			user_firstname: "required",
			user_lastname: "required",
			user_telephone: {
			required: true,
			//minlength: 10,
			number: true,
			phonenumber: true
			},
			user_pickup_address: "required",
			user_email:{
			required: true,
			//email: true,
			emailvalidation: true
		    },
			/*user_confirm_email: {
			equalTo : "#user_email"
			},*/
			user_password:{
			required: true,
			minlength: 7
			},
			user_confirm_password: {
			equalTo : "#user_password"
			},
			contr_captcha: {
			equalTo : "#ran"
			},
			user_profile_image: "required"  
		},  
			errorElement: "span" ,                              
		messages: {
			user_firstname: "Please Enter First Name.",
			user_lastname: "Please Enter Last Name.",
			user_pickup_address: " Enter User Pick up address",
			email: "Please Enter Email",
			user_password: "Please Enter Password.",
			user_confirm_password: "Password and Confirm Password are not matching",
			contr_captcha: "Please Enter Captcha Code.",
			termsouse : "Please check terms & condition.",
			user_profile_image: "Please upload image."
			},
			submitHandler: function(form) {
            form.submit();
			
           }
 });

jQuery.validator.addMethod("emailvalidation",function(value,element){
   // var phonenumber = jQuery("#user_email").val();
	 return value.match(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);
       },"Please Enter Valid Email.");

jQuery.validator.addMethod("phonenumber",
       function(value, element) {
           return value.match(/^(\s*|\d+)$/);
       },"Please type correct phone number");
	   
jQuery.validator.addMethod("checkAvailability",function(value,element){
	var result = false;
    var useremail = value;
	var ajax_url = jQuery('#ajaxUrl').val();
	if(useremail != ''){
	 jQuery.ajax({
          url: ajax_url,
          type: "post",
          async: false,
          data: { action: 'checkemail', useremails: useremail},
            success: function(response) { //alert(response);
			result = (response == "0")? false : true;
			  //alert(result);
			} 			
      });
	}	
	 return result; 
},"Email Already Exists");



jQuery.validator.addMethod("validatephone",function(value,element){
	var result = false;
	var ajax_url = jQuery('#ajaxUrl').val();
    var chk_phone_number = jQuery("#user_telephone").val(); //alert (username);
	 jQuery.ajax({
          url: ajax_url,
          type: "POST",
          async: false,
          data: { action: 'checkphone', phonecheck: chk_phone_number},
            success: function(response) { //alert(response);
			result = (response == "1") ? true : false;
			} 			
    });
	 return result; 
},"Phone Number Already Exists");

jQuery.validator.addMethod("checkUsername",function(value,element){
	var result = false;
    var userName = value; 
	var ajax_url = jQuery('#ajaxUrl').val();
	if(userName != ''){
	 jQuery.ajax({
          url: ajax_url,
          type: "POST",
          data: { action: 'checkUser', userName: userName},
            success: function(response) { 
			   result = (response == "1") ? true : false;
			} 			
      });
	}	
	
return result; 
},"User Already Exists");


/* registrationpage form validation using jquery and ajax ends here */	





/* customer and admin side (left sidebar) menu toggle section starts here  15-12-2017*/

  jQuery("#business_registrations").validate({
     rules: {                   
				business_username: {
					required: true
					
				},
			termsouse:"required",
			business_firstname: "required",
			business_lastname: "required",
			company_name: "required",

			office_number: {
			required: true,
			//minlength: 10,
			number: true,
			phonenumber: true
			},

			business_telephone: {
			required: true,
			//minlength: 10,
			number: true,
			phonenumber: true
			},
			user_pickup_address: "required",
			business_email:{
			required: true,
			//email: true,
			emailvalidation: true
		    },
	
			business_password:{
			required: true,
			minlength: 7
			},
			business_confirm_password: {
			required: true,
			equalTo : "#business_password"
			},
			business_captcha: {
			equalTo : "#business_ran"
			},
			user_profile_image: "required"  
		},  
			errorElement: "span" ,                              
		messages: {
			company_name: "Please Enter Company Name.",
			business_firstname: "Please Enter First Name.",
			business_lastname: "Please Enter Last Name.",
			business_pickup_address: " Enter User Pick up address",
			email: "Please Enter Email",
			business_password: "Please Enter Password.",
			business_confirm_password: "Password and Confirm Password are not matching",
			business_captcha: "Please Enter Captcha Code.",
			termsouse : "Please check terms & condition.",

			},
			submitHandler: function(form) {
            form.submit();
			
           }
 });

jQuery.validator.addMethod("emailvalidation",function(value,element){
   // var phonenumber = jQuery("#user_email").val();
	 return value.match(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i);
       },"Please Enter Valid Email.");

jQuery.validator.addMethod("phonenumber",
       function(value, element) {
           return value.match(/^(\s*|\d+)$/);
       },"Please type correct phone number");
	   
jQuery.validator.addMethod("checkAvailability",function(value,element){
	var result = false;
    var useremail = value;
	var ajax_url = jQuery('#ajaxUrl').val();
	if(useremail != ''){
	 jQuery.ajax({
          url: ajax_url,
          type: "post",
          async: false,
          data: { action: 'checkemail', useremails: useremail},
            success: function(response) { //alert(response);
			result = (response == "0")? false : true;
			  //alert(result);
			} 			
      });
	}	
	 return result; 
},"Email Already Exists");



jQuery.validator.addMethod("validatephone",function(value,element){
	var result = false;
	var ajax_url = jQuery('#ajaxUrl').val();
    var chk_phone_number = jQuery("#business_telephone").val(); //alert (username);
	 jQuery.ajax({
          url: ajax_url,
          type: "POST",
          async: false,
          data: { action: 'checkphone', phonecheck: chk_phone_number},
            success: function(response) { //alert(response);
			result = (response == "1") ? true : false;
			} 			
    });
	 return result; 
},"Phone Number Already Exists");

jQuery.validator.addMethod("checkUsername",function(value,element){
	var result = false;
  var userName = value; 
	var ajax_url = jQuery('#ajaxUrl').val();
	if(userName != ''){
	 jQuery.ajax({
          url: ajax_url,
          type: "POST",
          data: { action: 'checkUser', userName: userName},
            success: function(response) { 
			   		result = (response == "1") ? true : false;
					} 			
      });
	}	
	
return result; 
},"User Already Exists");


/* registrationpage form validation using jquery and ajax ends here 15-12-2017 */	










/* registration page Region field on change function starts here */
	jQuery('#user_region').change(function()
		{
			var selecteddistrict=jQuery(this).val();
			var ajax_url = jQuery('#ajaxUrl').val();
			jQuery('.submit-loading').show();
			
			jQuery('#user_district').empty();
			jQuery.ajax({

			         type: "post",
			         url: ajax_url,
			        data: {
				            action:'selected_district_regions_ajax',
				            selecteddistrict : selecteddistrict
				        	},
			         success: function(data){
			         	
			         
			         	jQuery('#user_district').append(data);
			         	jQuery('.submit-loading').hide();
			         }
			         
				});     

		});
/* registration page Region field on change function starts here */

/* Registration page image section starts here */
jQuery("#file-input").change(function() {
 jQuery('img#blah').css('display','block');
  readURL(this);
});
/* Registration page image section starts here */

/* schedule a pick up date picker and toggle */
/*jQuery("[name=pickup_of_boxes_datetime]").click(function(){
            jQuery('.col-md-12.scheduleapickupdate').toggle();
            //jQuery("#blk-"+$(this).val()).show('slow');
});*/
jQuery("#startschedulepickupdates").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0,
            
        });
jQuery('input#schedulepickuptime').timepicker({ minTime: '9:00:00',maxHour: 12,'step': 15 });
/* schedule a pick up date picker and toggle */
/* admin side schedule start and end date */
	jQuery("#startscheduledate").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0,
            onSelect: function (date) {
                var date2 = jQuery('#startscheduledate').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                jQuery('#endscheduledate').datepicker('setDate', date2);
                //sets minDate to dt1 date + 1
                jQuery('#endscheduledate').datepicker('option', 'minDate', date2);
            }
        });
        
		
		jQuery('#endtimedisableTimeRangesExample').timepicker({
			'disableTimeRanges': [
			['1am', '2am'],
			['3am', '4:01am']
			]
		});
		jQuery('input#stepExample1').timepicker({ minTime: '9:00:00',maxHour: 12,'step': 15 });
		jQuery('input#stepExample2').timepicker({ minTime: '9:15:00',maxHour: 12,'step': 15 });
	/* admin side schedule start and end date ends here */
	
	
	
	/* admin side edit schedule start and end date */
	jQuery("#editstartscheduledate").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: jQuery('#editstartscheduledate').val(),
            onSelect: function (date) {
				var seconddate = jQuery('#editendscheduledate').val();
                var date2 = jQuery('#editstartscheduledate').datepicker('getDate');
                date2.setDate(date2.getDate() + 1);
                jQuery('#editendscheduledate').datepicker('setDate', seconddate);
                //sets minDate to dt1 date + 1
                jQuery('#editendscheduledate').datepicker('option', 'minDate', seconddate);
            }
        });
        jQuery('#editendscheduledate').datepicker({
           dateFormat : 'yy/mm/dd',
            onClose: function () {
                var dt1 = jQuery('#editstartscheduledate').datepicker('getDate');
                console.log(dt1);
                var dt2 = jQuery('#editendscheduledate').datepicker('getDate');
                if (dt2 <= dt1) {
                    var minDate = jQuery('#editendscheduledate').datepicker('option', 'minDate');
                    jQuery('#editendscheduledate').datepicker('setDate', minDate);
                }
            }
        });
		
		jQuery('#endtimedisableTimeRangesExample').timepicker({
			'disableTimeRanges': [
			['1am', '2am'],
			['3am', '4:01am']
			]
		});
		jQuery('#starttimedisableTimeRangesExample').timepicker({
			'disableTimeRanges': [
			['1am', '2am'],
			['3am', '4:01am']
			]
		});
	/* admin side schedule start and end date ends here */
	
	
	
	jQuery(function() {
		/* admin page set date time datepicker starts here */
		 jQuery( "#datepickerstartdate" ).datepicker({
            dateFormat : 'yy/mm/dd',
			'minDate': new Date()
			 
        });
		/* admin page set date time datepicker ends here */
		
		/* admin page set date time datepicker end date starts here */
		
		 jQuery( "#datepickerenddate" ).datepicker({
			 dateFormat : 'yy/mm/dd',
			'minDate': new Date()
        });
		
		/* admin page set date time datepicker end date ends here */
		
		
    jQuery( "#datepicker" ).datepicker({
            dateFormat : 'mm/dd/yy',
			'minDate': new Date(),
			'maxDate': "11/25/2017 00:53"
        });
  });
	

/* Mystuff section starts here */
	jQuery("input.submitbystuffs").click(function(e){
            var favorite = [];
            jQuery.each(jQuery("input[name='stuffcheckbox']:checked"), function(){ 
			favorite.push(jQuery(this).val());
			jQuery('.userallinformation').val(favorite); 
            });
			if(favorite==''){
				alert ("Please select a product.");
				e.preventDefault();
				return false;
			}
			else{
				
			}
			
            
        });
/* Mystuff section ends here */

/* schedule a return page change region select box ajax run here */
	jQuery('select#country_lists').on('change', function() {
		var country= ( this.value );
		var ajaxurl = jQuery('input.schedule_ajax_url').val();
		
		jQuery.ajax({
			url: ajaxurl,
			type: 'POST',
			dataType: "html",
			data: { action: 'getdistricts', countryid:country},
			success : function(data){
				jQuery('select#dropoff_select_dist').html(data);
				
			}
		})
});
/* schedule a return page change region select box ajax code ends here */

/* schedule a return schedule delivery days section starts here */
jQuery('.col-md-12 .form-group #scheduleday').click(function(){
	var schedulevals = jQuery(this).val();
	//alert (schedulevals);
	if(schedulevals=='samebusinessday'){
		jQuery('div.same_business_day').toggle();
		jQuery('div.editnextbusinessday').css('display','none');
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.editinormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').css('display','none');
		jQuery('input#editscheduledayinormorethantwobusinessday').attr('value','');
		jQuery('input#editscheduletimescheduledayinormorethantwobusinessday').attr('value','');
		jQuery('input#editscheduletimenextbusinessday').attr('value','');
		jQuery('input#editscheduletimenextbusinessday').attr('value','');
		
		jQuery("#scheduledaysamebusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimesamebusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	 if(schedulevals=='nextbusinessday'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.editsame_business_day').css('display','none');
		jQuery('div.editsame_business_day').css('display','none');
		jQuery('div.nextbusinessday').toggle();
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.editinormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').css('display','none');
		jQuery('input#editscheduledaysamebusinessday').attr('value','');
		jQuery('input#editscheduletimesamebusinessday').attr('value','');
		jQuery('input#editscheduledayinormorethantwobusinessday').attr('value','');
		jQuery('input#editscheduletimescheduledayinormorethantwobusinessday').attr('value','');
		jQuery('input#editscheduledaysamebusinessday').attr('value','');
		jQuery('input#editscheduletimesamebusinessday').attr('value','');
		jQuery('input#editscheduletimenextbusinessday').attr('value','');
		jQuery('input#editscheduletimenextbusinessday').attr('value','');
		
		jQuery("#scheduledaynextbusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimenextbusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
			/*'disableTimeRanges': [
			['1am', '2am'],
			['3am', '4:01am']
			]*/
		});
	}
	if(schedulevals=='inormorethantwobusinessday'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.editsame_business_day').css('display','none');
		jQuery('div.editnextbusinessday').css('display','none');
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.inormorethantwobusinessday').toggle();
		jQuery('div.afterhoursdelivery').css('display','none');
		jQuery('input#editscheduledaysamebusinessday').attr('value','');
		jQuery('input#editscheduletimesamebusinessday').attr('value','');
		
		jQuery("#scheduledayinormorethantwobusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimescheduledayinormorethantwobusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	if(schedulevals=='afterhoursdelivery'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.editsame_business_day').css('display','none');
		jQuery('div.editnextbusinessday').css('display','none');
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').toggle();
		jQuery("#scheduledayafterhoursdelivery").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimesafterhoursdelivery').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	
});
/* schedule a return schedule delivery days section starts here */



/* schedule a return editschedule delivery days section starts here */
jQuery('.col-md-12 .form-group #editscheduleday').click(function(){
	var schedulevals = jQuery(this).val();
	//alert (schedulevals);
	if(schedulevals=='samebusinessday'){
		jQuery('div.editsame_business_day').toggle();
		
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').css('display','none');
		jQuery("#scheduledaysamebusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimesamebusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	 if(schedulevals=='nextbusinessday'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.editsame_business_day').css('display','none');
		jQuery('div.editnextbusinessday').toggle();
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').css('display','none');
		
		jQuery("#scheduledaynextbusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimenextbusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
			/*'disableTimeRanges': [
			['1am', '2am'],
			['3am', '4:01am']
			]*/
		});
	}
	if(schedulevals=='inormorethantwobusinessday'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.editinormorethantwobusinessday').toggle();
		
		
		jQuery('div.afterhoursdelivery').css('display','none');
		
		jQuery("#scheduledayinormorethantwobusinessday").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimescheduledayinormorethantwobusinessday').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	if(schedulevals=='afterhoursdelivery'){
		jQuery('div.same_business_day').css('display','none');
		jQuery('div.nextbusinessday').css('display','none');
		jQuery('div.inormorethantwobusinessday').css('display','none');
		jQuery('div.afterhoursdelivery').toggle();
		jQuery("#scheduledayafterhoursdelivery").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });
		jQuery('#scheduletimesafterhoursdelivery').timepicker({
			minTime: '9:00:00',
			maxHour: 14
		});
	}
	
});
/* schedule a return editschedule delivery days section starts here */



/* stais checkbox starts here */
	var lastChecked = null;
	jQuery("input[name='do_we_need_carry_box']").on("change", function () {
		if(lastChecked && lastChecked != jQuery(this)){
			lastChecked.prop("checked", false);
		}
		if (jQuery(this).prop("checked", true)) {
			lastChecked = jQuery(this);
		}
	
	});
	
	jQuery('.upstairs input[type=checkbox]').click(function(){
		
		var getvals = jQuery(this).val();
		if(getvals=='yes'){
			var checkal = jQuery('.upstairs input[type=checkbox]').attr('checked');
			jQuery('.upstairs input[type=checkbox]').removeAttr('checked');
			jQuery('.upstairs input[type=checkbox]').find
			jQuery('.form-group.selectfloors').css('display','block');
			jQuery('.form-group.editselectfloors').css('display','block')
		}
		if(getvals=='no'){
			var checkal = jQuery('.upstairs input[type=checkbox]').attr('checked');
			jQuery('.upstairs input[type=checkbox]').removeAttr('checked');
			jQuery('.form-group.editselectfloors').css('display','none');
			jQuery('.form-group.selectfloors').css('display','none');
			
		}
		
		
	});
	/* stais checkbox ends here */

/* Schedule recheck-in/Final check-out both front-end and customer section starts here */
		jQuery('.date_picker').datepicker({
            dateFormat : 'mm/dd/yy',
			minDate:1
        });
		
		jQuery("#pickupdate").datepicker({
            dateFormat : 'yy/mm/dd',
            minDate: 0
            
        });

	jQuery('.pickoption').click(function(){
		jQuery('.pickup_hidden').hide('slow');
		jQuery(this).parent().find('.pickup_hidden').show('slow');
	});
	
/* Schedule recheck-in/Final check-out both front-end and customer section ends here */	

/*schedule a return final payment tabs starts here */
jQuery('.col-md-12.paypal_payment h2.payment_header').click(function(){
	jQuery('.col-md-12.paypal_payment .payment_using_paypal').css('display','block');
	jQuery('.col-md-12.credit_card_payment p.creditcards').css('display','none');
	jQuery('.col-md-12.cheque_payment .cheque_header').css('display','none');
	jQuery('.col-md-12.bank_transfer .bank_transfer_para').css('display','none');
});

jQuery('.col-md-12.credit_card_payment h2.credit_card_payment_header').click(function(){
	jQuery('.col-md-12.paypal_payment .payment_using_paypal').css('display','none');
	jQuery('.col-md-12.cheque_payment .cheque_header').css('display','none');
	jQuery('.col-md-12.bank_transfer .bank_transfer_para').css('display','none');
	jQuery('.col-md-12.credit_card_payment p.creditcards').css('display','block');
});

jQuery('.col-md-12.cheque_payment h2.cheque_payment_header').click(function(){
	jQuery('.col-md-12.cheque_payment .payment_using_paypal').css('display','none');
	jQuery('.col-md-12.paypal_payment .payment_using_paypal').css('display','none');
	jQuery('.col-md-12.credit_card_payment p.creditcards').css('display','none');
	jQuery('.col-md-12.bank_transfer .bank_transfer_para').css('display','none');
	jQuery('.col-md-12.cheque_payment .cheque_header').css('display','block');
});


jQuery('.col-md-12.bank_transfer h2.bank_transfer_header').click(function(){
	jQuery('.col-md-12.paypal_payment .payment_using_paypal').css('display','none');
	jQuery('.col-md-12.cheque_payment .payment_using_paypal').css('display','none');
	jQuery('.col-md-12.credit_card_payment p.creditcards').css('display','none');
	jQuery('.col-md-12.cheque_payment .cheque_header').css('display','none');
	jQuery('.col-md-12.bank_transfer .bank_transfer_para').css('display','block');
});


/*schedule a return final payment tabs starts here */

/* admin side schedule a return history information starts here */
jQuery('a.change_returning_schedule_status').click(function() {
	var schedule_return_history_id = jQuery(this).attr('data-schedulehistoryid');
	var ajax_url = jQuery('input.adminurls').val();
	jQuery.ajax({
		url: ajax_url,
		type : 'POST',
		dataType: "html",
		data: { action: 'ChangeReturnAScheduleStatus', schedulereturnhistoryid: schedule_return_history_id},
		success : function(data){
			//alert (data);
			console.log (data);
			var statushtml = jQuery('.admin_schedule_return_status .col-md-8.delivery_status').html();
			
				var statushtmls = 'Delivered';
				jQuery('.admin_schedule_return_status .col-md-8.delivery_status').html(statushtmls);
				alert ("Schedule A Return Status Updated Successfully");
				window.location =  "?type=scheduleareturninfo";
			 	
		}
	});
/* getting schedule pick up upload images get keywords of category starts here */

		
});
/* admin side schedule a return history information ends here */
jQuery('.category_lits_pickup').change(function()
{
	var selectcategory=jQuery(this).val();
	var ajax_url = jQuery('.ajaxurls_chedule').val();
	jQuery('.submit-loading').show();
	//alert (selectcategory);
	jQuery.ajax({
		url: ajax_url,
		type : 'POST',
		dataType: "html",
		data: { action: 'getSchedulePickUpKeywordLists', selectcategory: selectcategory},
		success : function(data){
			//alert (data);
			//console.log (data);
			jQuery('.submit-loading').hide();
			jQuery('.pickupschedulecatkeywords').html(data);
			
			 	
		}
	});
});
/* getting schedule pick up upload images get keywords of category starts here */	
 var max_fields_limit      = 10; //set limit for maximum input fields
    var x = 1; //initialize counter for text box
    jQuery('.add_more_button').click(function(e){
        e.preventDefault();
        if(x < max_fields_limit){ 
            x++; 
            jQuery('.input_fields_container').append('<div><input type="text" name="schedulekeyword[]"/><a href="#" class="remove_field" style="margin-left:10px;">Remove</a></div>'); //add input field
        }
    });  
    jQuery('.input_fields_container').on("click",".remove_field", function(e){ //user click on remove text links
        e.preventDefault(); jQuery(this).parent('div').remove(); x--;
    })

/* remove edit schedule pick up edit image section */
jQuery('.change_image_edit').click(function(){
jQuery('.editsubimages').toggle();
jQuery('.image-upload.hiddens').toggle();
});	

/* delete sub images all records schedule pick up section */
jQuery('.deletesubimagesrecord').click(function(){
	var datadeletes = jQuery(this).attr('data-deletes');
	var ajax_url = jQuery(this).attr('data-urls');
	var data_subimgid = jQuery(this).attr('data-subimgid');
	//alert (datadeletes + ajax_url);
	jQuery.ajax({
		url: ajax_url,
		type : 'POST',
		dataType: "html",
		data: { action: 'deleteScheduleImagesRecordsPickup', pickupids: datadeletes,subimgid:data_subimgid},
		success : function(data){
			alert ("Image Deleted Successfully");
			var re = new RegExp(/^.*\//);
			window.location = re.exec(window.location.href)+"?type=mystuff";
			console.log (data);
			 	
		}
	});
});
});

function form_validation_schedule(formid)   
{ 

var flag = ''; 
		var error_Msg='';
		var error_Msg = "Please correct the following : ";
		var myform =jQuery('#schedule_booking_form_out');
		
		var pickupafterdropoff = document.getElementById('pickup_of_boxes').checked;
		var pickupdate = document.getElementById('pick_up_date').checked;
		var select_pickupdate =myform.find('#pickupdate').val();
		var schedulelater = document.getElementById('pickup_of_boxeslater').checked;
		var pickupoffinalcheckout = document.getElementById('pickup_of_finalcheckout').checked;
		
		if((pickupafterdropoff===false)&&(pickupdate===false)&&(schedulelater===false)&&(pickupoffinalcheckout===false))
			{
			flag = 1;
			error_Msg += "\n - Please Select Any One Schedule recheck-in/Final check-out.";
			//alert ("testing" +error_Msg); return false;
		}
		
		if(flag == 1)
		{
			jAlert(error_Msg, 'Required Fields');
		return false;
		}

		else{
			return true;
		}
		
		
}
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      jQuery('#blah').attr('src', e.target.result);
	 }
    reader.readAsDataURL(input.files[0]);
  }
}














	