$(document).ready(function() {
 /*------------- SideBar ------------*/   
    // Hide all submenus
    $('.sidebar > li > ul').hide();
    
    //Open .active submenu
    $('.active').next().show();

    // Add (.current) to submenu  active link	
    $('.sidebar ul li a').click(function() {
        $(".sidebar ul li a").removeClass("current");
        $(this).addClass("current");
    });

    // Dropdown
    $(function() {

        var parent = $('.sidebar > li > a');
        var child = $('.sidebar > li > ul');

        // Click on any link in main menu
        parent.click(function(event) {
            // Check if has submenu
            var has_sub = $(this).hasClass('sub');
            
            if(has_sub) // If has submenu
                event.preventDefault(); //Deactivate the link

            if ($(this).hasClass('active')) {
                // If link is active
                $(this).removeClass('active');
                $(this).next().stop(true, true).slideUp(500);
            } else {
                //Close previously opened submenu dropdown
                parent.removeClass('active');
                child.filter(':visible').slideUp(500);

                //Open clicked current dropdown
                $(this).addClass('active').next().stop(true, true).slideDown(500);
            }
                
        });

    });

 /*------------ offcanvas ----------*/ 
  $('[data-toggle=offcanvas]').click(function() {
    $('.row-offcanvas').toggleClass('active');
  });
    
 /*------------ Remove visit button ----------*/ 
  $('#rev-link').click(function(){
      $('.vitis-url').hide();
  });  
    
 /*----- Toggle faqs -----------*/ 
  $('.open-faq').click(function(){
    var str = this.name;
    var id = str.slice(7); 
  //  alert(id);
    $('#collapse_'+id).addClass('in');
  });  
  
 /*----- Clickable Row Inbox-----------*/ 
    $(".clickableRow").click(function() {
       window.document.location = $(this).parent().attr("href");
      });

});

jQuery(function($) {

    $(function(){
        $('#main-slider.carousel').carousel({
            interval: 4000,
            pause: false
        });
    });

    //Ajax contact
    // var form = $('.contact-form');
    // form.submit(function () {
    //     alert($(this).attr('action'));
    //     $this = $(this);
    //     $.post($(this).attr('action'), function(data) {
    //         $this.prev().text(data.message).fadeIn().delay(3000).fadeOut();
    //     },'json');
    //     return false;
    // });

    //smooth scroll
    $('.navbar-nav > li').click(function(event) {
        // event.preventDefault();
        var target = $(this).find('>a').prop('hash');
        $('html, body').animate({
            scrollTop: $(target).offset().top
        }, 500);
    });

    //scrollspy
    $('[data-spy="scroll"]').each(function () {
        var $spy = $(this).scrollspy('refresh')
    })

});


<!------------- Delete Confirmation ---------------> 

    function delete_confirmation() {
        return confirm('Do you really want to delete the data?');
    }
  




