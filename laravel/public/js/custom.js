$(document).ready(function() {
  $('.productlist .left-addon input').keyup(function(){
      txt = $(this).val();
      $('.title').parent().hide();
      if($(".title:contains('"+txt+"')")){
        $(".title:contains('"+txt+"')").parent().show();
      }
      if(txt == ""){
          $('.title').parent().show();
      }
  });
  $('.track_order .btn').click(function(){
    $('#track_order_status').submit();
  });
	$('.prod_img').hover(function(){
		$(this).next().show();
	},function(){
		$(this).next().hide();
	});
  	
  $('.price_det').hover(function(){
		$(this).show();
	});
  $('.cnt_btn').click(function(){
      $('.step2').trigger('click');
  });
  $('.cnt_btn2').click(function(){
      $('.step3').trigger('click');
  });

  //
  $('.rating-container').click(function(){
        v = $(this).find('.rating-stars').attr('style');
        v = v.replace('width: ','');
        v = v.replace('%;','');
        r = parseInt(v)/20;

        vid = $(this).parent().parent().find('.vid').attr('value');
        uid = $(this).parent().parent().find('.uid').attr('value');
        oid = $(this).parent().parent().find('.oid').attr('value');
        token = _globalObj._token;
        data = '_token='+token+'&rvalue='+r+'&oid='+oid+'&uid='+uid+'&vid='+vid;
        url = '/admin/orders/ratings';
        $.ajax({
          url:url,
          data:data,
          type:'post',
          success:function(response){
            $.removeCookie("ratevendor[vendor_id]", { path: '/' });
            $.removeCookie("ratevendor[user_id]", { path: '/' });
            $.removeCookie("ratevendor[ordrid]", { path: '/' });
             console.log(response);
          }
        });
  });
  
  $('.clearFilter').click(function(){
    $('#priceflter input').prop('checked',false);
  });
  $('#exists').hide();
  $('.msg-al').hide();
  var timer;

  $('.filter_product #title').keyup(function() {
      clearInterval(timer); 
      timer = setTimeout(function(){
        var title = $('.filter_product #title').val();
         if(title == ""){
           return false;
         }

         var data ="";
         var url = '/admin/products/fetchtitle';
         data = "title="+title;
         $.ajax({                   
            url: url,
            data: data,
            dataType: "json",
            type:'post',
            success:function(response){
              if(response){
                $('.msg-al').show();
                $('#exists').show();
                $('#exists').prop('checked',true);
                $('#exists').trigger('click');
                $('#prod_id').val(response[0].id);
              }
            },
            error:function(response){
              //$.jGrowl("The website could not be updated.");
            }
            
          });
      },700);
    });

    $('#exists').click(function(){
      if($(this).prop('checked')){
        $('.img_upload').hide();
      }else{
        $('.img_upload').show();
      }
    });
    $.extend($.expr[":"], {
    "containsIN": function(elem, i, match, array) {
    return (elem.textContent || elem.innerText || "").toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
    });
    $('#sendtocity').keyup(function() {
      txt = $('#sendtocity').val();
      if(txt){
        $('.city_option').show();
        $( ".city_option li").hide();
        $( ".city_option li:containsIN('"+txt+"')" ).show();
        if($( ".city_option li:hidden").length == 57){
            $('.city_option .nomatches').show();
        }else{
            $('.city_option .nomatches').hide();
        }
      }else{
        $('.city_option').hide();
      }
    });
    //$('#sendtocity').parent().submit();
    $('.city_option li').click(function(){
        setTimeout(function(){
            $('#sendtocity').parent().submit();
        },300);
    });
    $( ".city_option li").click(function(){
        $('.city_option').hide();
        $('#sendtocity').val($(this).text());
    });

    $('.more_count').click(function(){
        if(!$(this).hasClass('added')){
          $(this).addClass('added');
          ele = $(this);
          var url = '/admin/products/fetchotherven';
          data = 'prod_id='+$(this).prev().html();
          $.ajax({                   
            url: url,
            data: data,
            type:"post",
            dataType:"html",
            success:function(response){
              ele.parent().next().find('#oth_ven_table').html(response);
            },
            error : function(jqXHR, textStatus , errorThrown){
              if(textStatus == "OK"){
                ele.parent().next().find('#oth_ven_table').html(jqXHR.responseText);
              }
            }
          });
        }
        if($(this).parent().next().is(":visible")){
          $(this).parent().next().hide();  
        }else{
          $(this).parent().next().show();
        }    
        
    });

    $('.othervendet table .radiobtn').each(function(idx){
      $(this).click(function(){
        myRadio = $(this);
        if(myRadio.filter(':checked')){
            i = idx + 1;
            val = $('.venlist li:nth-child('+i+')').text();
            v = val.split('::');
            $('#details').html(v[0]);
            $('.price-sales .rg').html(v[2]);
            $('#reg_price').val(v[2]);
            $('.price-sales .dx').html(v[3]);
            $('#dlx_price').val(v[3]);
            $('.price-sales .pr').html(v[4]);
            $('#prm_price').val(v[4]);
        }
      }); 
    });

    // var shaObj = new jsSHA("C0Dr8m|544f12804fa68|600.00|SAU Admission 2014|Vikas|techwarrior@littleflorist.com|||||||||||3sf0jURk", "ASCII");
    // var hash = shaObj.getHash("SHA-512", "HEX");

    $('.cbx_copy').click(function(){
        if($(this).prop('checked')){
            $('#BInputName').val($('#InputName').val());
            $('#BInputLastName').val($('#InputLastName').val());
            $('#BInputAddress').val($('#InputAddress').val());
            $('#BInputAddress2').val($('#InputAddress2').val());
            $('#BInputState').val($('#InputState').val());
            $('#BInputZip').val($('#InputZip').val());
            $('#BLandmarks').val($('#landmarks').val());
            $('#BInputMobile').val($('#InputMobile').val());
            $('#BInputCity').val($('#InputCity').val());
            $('.bcity').val($('.scity').val());
        }else{
            $('.user_billing_Info input').val("");
        }
    });
    $('#InputCity').on('change', function() {
        $('.scity').val( this.value );
    });
    $('#BInputCity').on('change', function() {
        $('.bcity').val( this.value );
    });

    $('.testimonials-slider').bxSlider({
       slideWidth: 850,
       auto: true,
       autoControls: false,
       infiniteLoop : true,
       controls :false,
     });

    $('#orderstatus').change(function(){
        ordrid  =  $(this).parent().parent().find('.order_id').text();
        phone   =  $(this).parent().parent().find('.phone').text();
        status  =  $("#orderstatus option:selected").text();
        url = '/orders/updatestatus';
        data = "status="+status+'&ordrid='+ordrid+'&phone='+phone;
        $.ajax({
                url:url,
                data:data,
                type:'post',
                success:function(response){
                    obj = $.parseJSON(response);
                    if(obj.success == 'true'){
                        alert('Status updated.');
                    }
                }
        });       
    });
    var timer;
    $('#addcoupon').keyup(function(){
      if($('#hash').val() != ""){  
        clearInterval(timer); 
        timer = setTimeout(function(){
        url = '/coupon/verify';
        data = "code="+$('#addcoupon').val()+"&orderid="+$('#txnid').val();
        $.ajax({
            url : url,
            data : data,
            type : 'post',
            success : function(){
                obj = $.parseJSON(response);
                if(obj.success == 'true'){
                    alert('Discount added');
                }else{
                    alert('Error in coupon code. Coupon not applied.');
                }
            }
        });
      },700);
     }// if hash ends   
    });

    $('.paymnt_order').click(function(){
        pay_click = $(this);
        verify = 0;
        // Basic null validation 
        $('#collapseOne input.required, .user_billing_Info input.required, .user_shipping_Info input.required').each(function(){
            if($(this).hasClass('required')){
                if($(this).val() == ""){
                    $(this).css('border','1px solid red');
                    $.jGrowl($(this).attr('name')+" can't be empty", { position : 'center' });
                    verify++;
                }else{
                    $(this).css('border','1px solid #ccc');
                }
            }
        });
        if(verify == 0){
          url = '/orders/saveorder';
          var frm = $('.container input,.container textarea').serialize();
          var data = frm;//JSON.stringify(frm.serializeArray());
          $.ajax({
                url:url,
                data:data,
                type:'post',
                success:function(response){
                  obj = $.parseJSON(response);
                   if(obj.success == 'true'){
                       descp = "";
                       $('.CartDescription').each(function(){
                          descp += " "+$.trim($(this).text());
                       });
                       $('#amt').val(parseFloat($('input[name="subtotal"]').val()).toFixed(2));
                       if(obj.final_total !== undefined){
                          $('#amt').val(parseFloat(obj.final_total).toFixed(2));
                       }
                       $('#productinfo').val($.trim(descp));
                       $('#firstname').val($('#BInputName').val());
                       $('#lastname').val($('#BInputName').val());
                       $('#email').val($('#BInputEmail').val());
                       $('#phone').val($('#BInputMobile').val());

                       $('#address1').val($('#BInputAddress').val());
                       $('#address2').val($('#BInputAddress2').val());
                       $('#city').val($('#BInputCity').val());
                       $('#state').val($('#BInputState').val());
                       sha_text = $('#key').val();
                       sha_text += '|'+$('#txnid').val();
                       sha_text += '|'+parseFloat($('#amt').val()).toFixed(2);
                       sha_text += '|'+$.trim($('#productinfo').val());
                       sha_text += '|'+$('#firstname').val();
                       sha_text += '|'+$('#email').val();
                       sha_text += '|'+$('#udf1').val();
                       sha_text += '|'+$('#udf2').val();
                       sha_text += '|'+$('#udf3').val();  
                       sha_text += '|'+$('#udf4').val();
                       sha_text += '|'+$('#udf5').val();
                       sha_text += '|||||';
                       //T5q345UE
                       sha_text += '|3sf0jURk';
                       var shaObj = new jsSHA(sha_text, "ASCII");
                       var hash = shaObj.getHash("SHA-512", "HEX");
                       $('#hash').val(hash);
                       pay_click.parent().submit();
                   }else{
                      $.jGrowl(obj.message, { position : 'center' });
                   }
                }
            });
        }
    });
  
    $('.cake .deals').click(function(){
        if($(this).parent().next().is(":visible")){
          $(this).parent().next().hide();  
        }else{
          $(this).parent().next().show();
        }    
        
    });

  $('.toggle-btn span').click(function(){
    if($(this).hasClass('cake')){
      $('#sendtype').attr('value',"cake");
      $('.toggle-btn .cake').addClass('selected');
      $('.toggle-btn .flower').removeClass('selected');
    }else{
      $('#sendtype').attr('value',"flower");
      $('.toggle-btn .cake').removeClass('selected');
      $('.toggle-btn .flower').addClass('selected');
    }
    
  });

  $('.product_view #Formcart').submit(function(e){
      if($('#datepicker').val() == ""){
          e.preventDefault();
          $.jGrowl("Delivery date can't be empty", { position : 'center' });
      }else{
          $('.product_view #Formcart').submit();
      }
  });

    $('#payment_clearance').change(function(){
        ordrid  =  $(this).parent().parent().find('.order_id').text();
        phone   =  $(this).parent().parent().find('.phone').text();
        status  =  $("#payment_clearance option:selected").text();
        url = '/orders/updateclearance';
        data = "status="+status+'&ordrid='+ordrid+'&phone='+phone;
        $.ajax({
            url:url,
            data:data,
            type:'post',
            success:function(response){
                obj = $.parseJSON(response);
                if(obj.success == 'true'){
                    alert('Status updated.');
                }
            }
        });
    });
});

function updateClock ( )
    {
    var currentTime = new Date ( );

    var currentHours = currentTime.getHours ( );
    var currentMinutes = currentTime.getMinutes ( );
    var currentSeconds = currentTime.getSeconds ( );
 
    // Pad the minutes and seconds with leading zeros, if required
    currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
    currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
 
    // Choose either "AM" or "PM" as appropriate
    var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
 
    // Convert the hours component to 12-hour format if needed
    currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
 
    // Convert an hours component of "0" to "12"
    currentHours = ( currentHours == 0 ) ? 12 : currentHours;
 
    // Compose the string for display
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
     
     
    $("#clock").html(currentTimeString);
         
 }
 
$(document).ready(function(){
    setInterval('updateClock()', 1000);
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
    var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

    // Create a newDate() object
    var newDate = new Date();
    // Extract the current date from Date object
    newDate.setDate(newDate.getDate());
    // Output the day, date, month and year   
    $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
});
