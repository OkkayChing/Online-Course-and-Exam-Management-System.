

$(document).ready(function() {

    (function($){

        var tergetLink = $('.videoplaylink');

        tergetLink.on('click', function(e){
          

            var videoUrl = $(this).data('video-url');
            
            $('#videoModal').find('video').attr({"src": videoUrl,"autoplay": "autoplay"});

        });



    })(jQuery);


});


$(document).ready(function() {
   

       // $('#videoModal').on('click',function(e) {
       //      $('#videoModal').find('video').attr('src','');
       //      console.log('hi');

       //  });



    var modalID = $('#videoModal');


    $('.modal').on('hide.bs.modal', function(){
        console.log('hi');
    });

 
});