	  $(document).ready(function () {	  
			onfocus();
			$(".logo2").hide();
			$(".on_off_checkbox").iphoneStyle();
			$('.tip a ').tipsy({gravity: 'sw'});
			$('#login').show().animate({   opacity: 1 }, 2000);
			$('.logo').show().animate({   opacity: 1,top: '50%'}, 800,function(){			
				$('.logo').show().delay(1200).animate({   opacity: 1,top: '1%' }, 700,function(){
					$('.formLogin').animate({   opacity: 1,left: '0' }, 400);
					$('.userbox').animate({ opacity: 0 }, 300).hide();
					$(".logo").html("<img src='../images/logo/logo_login.png' alt='Purawisata' />");
				 });		
			})	
		});	

	    $('.userload').click(function(e){
			$('.formLogin').animate({   opacity: 1,left: '0' }, 300);			    
			  $('.userbox').animate({ opacity: 0 }, 200,function(){
				  $('.userbox').hide();				
			   });
	    });
	    
	$('#but_login').click(function(e){				
		  if(document.formLogin.username.value == "")
		  {
			  showError("Username Masih Kosong",500);
			  $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			  $('.inner').trigger('startRumble');
			  setTimeout('$(".inner").trigger("stopRumble")',500);
			  setTimeout('hideTop()',5000);
			  $('#username_id').focus();
			  return false;
		  }	
		  else  if(document.formLogin.password.value == "")
		  {
			  showError("password masih kosong",500);
			  $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			  $('.inner').trigger('startRumble');
			  setTimeout('$(".inner").trigger("stopRumble")',500);
			  setTimeout('hideTop()',5000);
			  $('#password').focus();
			  return false;
		  }	
		  else  if(document.formLogin.code.value == "")
		  {
			  showError("Secure Code masih kosong",500);
			  $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			  $('.inner').trigger('startRumble');
			  setTimeout('$(".inner").trigger("stopRumble")',500);
			  setTimeout('hideTop()',5000);
			  $('#code').focus();
			  return false;
		  }	
		  var username=document.formLogin.username.value;
		  var password=document.formLogin.password.value;
		  var code=document.formLogin.code.value;
		  $.ajax
			({
	 			url: "login.php?username="+username+"&password="+password+"&code="+code,
	  			type:'GET',
				dataType:'json',
	  			success: function(data){
					  if(data.error == "1")
		 				 {
			 			 showError("Secure Code yang dimasukkan salah",500);
			  			 $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			 			 $('.inner').trigger('startRumble');
			  			setTimeout('$(".inner").trigger("stopRumble")',500);
			  			setTimeout('hideTop()',5000);
			  			$('#code').focus();
						refreshcapcay()
						$('#code').val('');
			  			return false;
		  				}
					  else if(data.error == "2")
		 				 {
			 			 showError("Username yang dimasukkan salah",500);
			  			 $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			 			 $('.inner').trigger('startRumble');
			  			setTimeout('$(".inner").trigger("stopRumble")',500);
			  			setTimeout('hideTop()',5000);
						$('#username').val('');
						$('#code').val('');
			  			$('#username').focus();
						refreshcapcay()
			  			return false;
		  				}
					 else if(data.error == "3")
		 				 {
			 			 showError("Password yang dimasukkan salah",500);
			  			 $('.inner').jrumble({ x: 4,y: 0,rotation: 0 });	
			 			 $('.inner').trigger('startRumble');
			  			setTimeout('$(".inner").trigger("stopRumble")',500);
			  			setTimeout('hideTop()',5000);
						$('#password').val('');
						$('#code').val('');
			  			$('#password').focus();
						refreshcapcay()
			  			return false;
		  				}
					 else if(data.error == "0")
		 				 {
			 			    hideTop();
		 					loading('Checking',1);		
		 					setTimeout( "unloading()", 2000 );
		 					setTimeout( "Login()", 2500 );
		  				}	
          		 }
			});
	});	
																 
function Login(){
	$("#login").animate({   opacity: 1,top: '49%' }, 200,function(){
		 $('.userbox').show().animate({ opacity: 1 }, 500);
			$("#login").animate({   opacity: 0,top: '60%' }, 500,function(){
				$(this).fadeOut(200,function(){
				  $(".text_success").slideDown();
				  $("#successLogin").animate({opacity: 1,height: "200px"},500);   			     
				});							  
			 })	
     })	
	setTimeout( "window.location.href='utama.php'", 3000 );
}

$('#alertMessage').click(function(){
	hideTop();
});

function showError(str){
	$('#alertMessage').addClass('error').html(str).stop(true,true).show().animate({ opacity: 1,right: '0'}, 500);	
	
}

function showSuccess(str){
	$('#alertMessage').removeClass('error').html(str).stop(true,true).show().animate({ opacity: 1,right: '0'}, 500);	
}


function onfocus(){
				if($(window).width()>480) {					  
						$('.tip input').tipsy({ trigger: 'focus', gravity: 'w' ,live: true});
				}else{
					  $('.tip input').tipsy("hide");
				}
}

function hideTop(){
	$('#alertMessage').animate({ opacity: 0,right: '-20'}, 500,function(){ $(this).hide(); });	
}	

function loading(name,overlay) {  
	  $('body').append('<div id="overlay"></div><div id="preloader">'+name+'..</div>');
			  if(overlay==1){
				$('#overlay').css('opacity',0.1).fadeIn(function(){  $('#preloader').fadeIn();	});
				return  false;
		 }
	  $('#preloader').fadeIn();	  
 }
 
 function unloading() {  
		$('#preloader').fadeOut('fast',function(){ $('#overlay').fadeOut(); });
 }
 
 function refreshcapcay() {
	$.ajax({
	  url: "./../plugins/captcha/imagehtml.php",
	  type:'GET',
	  success: function(html){
	  	$("#capcay").html(html);	
	  }
	});
}