

$(document).ready(function() {




 (function($){



  //    var mainList = $('.listUl li');
  //    var tergetLink = $('.videoplaylink');
     
     
  //    tergetLink.on('click', function(e) {
  //    	e.preventDefault();

  //    	$(this).parent('.lec-title').find('.white_content').addClass('show');

  //    	$(this).parent('.lec-title').addClass('continue').find('.white_content > video')[0].play();

  //    });
     
  //   var nextVideo = $('.nextVideo');

     	
	 // nextVideo.on('click',function(e) {
	 // 	e.preventDefault();

	 // 	mainList.find('.continue').parents('li.lec').addClass('targetLi');

	 // 	$('.continue').find('.white_content.show').remove();

	 // 	$('.targetLi').next('li.lec').find('.white_content').addClass('show');
	 // 	$('.targetLi').next('li.lec').addClass('continue').find('.white_content > video')[0].play();
	 // });


 	var tergetLink = $('.videoplaylink');

 	tergetLink.on('click', function(e){
 		var videoUrl = $(this).data('video-url');

$(this).parents('.lec-title').addClass('continue');

 		$('#videoModal').find('video').attr({
                            "src": videoUrl,
                            "autoplay": "autoplay",        
                        })



 	});
var tergetClose = $('#close');

     tergetClose.on('click',function(e) {
	$('button').attr({"data-dismiss":"modal"})
$('#videoModal').find('video').removeAttr(
                             "src" 
                        )[0].pause();
});
var tergetCloseClass = $('.close');

     tergetCloseClass.on('click',function(e) {
	$('button').attr({"data-dismiss":"modal"})
$('#videoModal').find('video').removeAttr(
                             "src" 
                        )[0].pause();
});



var mainList = $('.listUl li');

var nextVideo = $('.nextVideo');

     	
	 nextVideo.on('click',function(e) {
	 	e.preventDefault();
                
                $('.listUl').find('.continue').parents('li').addClass('targetLi');

             $('.listUl').find('.targetLi').next('li').addClass('targetLi2');
              $(this).data('video-url').parents('.lec-title').addClass('continue');
var nextVideoUrl = $('.listUl').find('.targetLi2').find('.videoplaylink').data('video-url');
             
             $('#videoModal').find('video').update({
                            "src": nextVideoUrl,
                               "autoplay": "autoplay",    
                        })

	 	
	 });
         
 })(jQuery);




});