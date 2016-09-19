

$(document).ready(function() {




 (function($){



  //    var mainList = $('.listUl li');
  //    var tergetLink = $('.videoplaylink');
     
     
  //    tergetLink.on('click', function(e) {
  //        e.preventDefault();

  //        $(this).parent('.lec-title').find('.white_content').addClass('show');

  //        $(this).parent('.lec-title').addClass('continue').find('.white_content > video')[0].play();

  //    });
     
  //   var nextVideo = $('.nextVideo');

        
     // nextVideo.on('click',function(e) {
     //     e.preventDefault();

     //     mainList.find('.continue').parents('li.lec').addClass('targetLi');

     //     $('.continue').find('.white_content.show').remove();

     //     $('.targetLi').next('li.lec').find('.white_content').addClass('show');
     //     $('.targetLi').next('li.lec').addClass('continue').find('.white_content > video')[0].play();
     // });


    var tergetLink = $('.videoplaylink');

    tergetLink.on('click', function(e){
      var modelTitle=$(this).parents('li').prevAll('.chap-title:first').find('.sectiontitle').html();

$('#modaltitle').html( modelTitle );
      var modelTitle=$(this).parents('li').find('.videoplaylink').html();

$('#modalVideotitle').html( modelTitle );


        var videoUrl = $(this).data('video-url');
        if($('.lec').hasClass('continue')){
            $('.lec').removeClass('continue');
        }
        $(this).parents('.lec').addClass('continue');

        $('#videoModal').find('video').attr({"src": videoUrl,"autoplay": "autoplay"});
    });


//     var tergetLink2 = $('.docplaylink');
//     tergetLink2.on('click', function(e){
//       var modelTitle=$(this).parents('li').prevAll('.chap-title:first').find('.sectiontitle').html();

// $('#modaltitle').html( modelTitle );
//       var modelTitle=$(this).parents('li').find('.docplaylink').html();

// $('#modalVideotitle').html( modelTitle );


//         var docUrl = $(this).data('doc-url');
//         if($('.lec').hasClass('continue')){
//             $('.lec').removeClass('continue');
//         }
//         $(this).parents('.lec').addClass('continue');

//         $('#docModal').find('embed ').attr({"src": docUrl,"autoplay": "autoplay"});
//     });



    $('#videoModal').on('hide.bs.modal',function(e) {
        $('#videoModal').find('video').attr('src','');

    });




 $('#prevVideo').on('click', function(e) {
        if($('li.continue').prev('div').prev('div').hasClass('section_quiz')){
             var prevUrl = $('li.continue').prevAll('div').first().prev('div').prev('li').find('.videoplaylink').data('video-url');
              $('li.continue').removeClass('continue').prev('div').prev('div').prev('li.lec').addClass('continue');
                      $('#videoModal').find('video').attr({"src": prevUrl,"autoplay": "autoplay"});


             // var nexttUrl = 'http://localhost/minorschool_PRO/course/view_quiz_summery/33';
              // window.location.href=prevUrl;
                            }

                  else {


              
                  if($('li.continue').prev('div').hasClass('chap-title')){
                  // $('.chap-title').addClass('class_name')
                  
                      var prevUrl = $('li.continue').prevAll('.chap-title').first().prev('li').find('.videoplaylink').data('video-url');
                      $('li.continue').removeClass('continue').prev('.chap-title').prev('li.lec').addClass('continue');
                      $('#videoModal').find('video').attr({"src": prevUrl,"autoplay": "autoplay"});
                  }

                  else {

                      var prevUrl = $('li.continue').prev('li.lec').find('.videoplaylink').data('video-url');
                      $('li.continue').removeClass('continue').prev('li.lec').addClass('continue');
                  
                      $('#videoModal').find('video').attr({"src": prevUrl,"autoplay": "autoplay"});
                  }
      }
     
   var modelTitle=$('li.continue').prevAll('.chap-title:first').find('.sectiontitle').html();
      
$('#modaltitle').html( modelTitle );
  var modelTitle=$('li.continue').find('.videoplaylink').html();

  $('#modalVideotitle').html( modelTitle );

    });



    $('#nextVideo').on('click', function(e) {

    


        if($('li.continue').next('div').hasClass('section_quiz')){
             var nexttUrl = $('li.continue').next('div').find('.quizplaylink').data('quiz-url');
              window.location.href=nexttUrl;
          }else{
          if($('li.continue').next('div').hasClass('chap-title')){
          // $('.chap-title').addClass('class_name')
              var nextUrl = $('.continue').next('.chap-title').next('.lec').find('.videoplaylink').data('video-url');

              $('li.continue').removeClass('continue').nextAll('.chap-title').eq(0).next('li.lec').addClass('continue');
              $('#videoModal').find('video').attr({"src": nextUrl,"autoplay": "autoplay"});
          
          }

          else {

              var nexUrl = $('li.continue').next('li.lec').find('.videoplaylink').data('video-url');
              $('li.continue').removeClass('continue').next('li.lec').addClass('continue');
          
              $('#videoModal').find('video').attr({"src": nexUrl,"autoplay": "autoplay"});
              }
        }


      var modelTitle=$('li.continue').prevAll('.chap-title:first').find('.sectiontitle').html();
      
$('#modaltitle').html( modelTitle );
   
      var modelTitle=$('li.continue').find('.videoplaylink').html();

$('#modalVideotitle').html( modelTitle );
    });


 $('#prevSec').on('click', function(e) {
    

   
        var prevSecUrl = $('li.continue').prevAll('.chap-title').eq(1).next('li.lec').find('.videoplaylink').data('video-url');

        $('li.continue').removeClass('continue').prevAll('.chap-title').eq(1).next('li.lec').addClass('continue');

        $('#videoModal').find('video').attr({"src": prevSecUrl,"autoplay": "autoplay"});

        var modelTitle=$('li.continue').prevAll('.chap-title:first').find('.sectiontitle').html();
            
        $('#modaltitle').html( modelTitle );

        var modelTitle=$('li.continue').find('.videoplaylink').html();

$('#modalVideotitle').html( modelTitle );
          });


    $('#nextSec').on('click', function(e) {
    

   
        var nextSecUrl = $('li.continue').nextAll('.chap-title').eq(0).next('li.lec').find('.videoplaylink').data('video-url');

        $('li.continue').removeClass('continue').nextAll('.chap-title').eq(0).next('li.lec').addClass('continue');
        $('#videoModal').find('video').attr({"src": nextSecUrl,"autoplay": "autoplay"});

        var modelTitle=$('li.continue').prevAll('.chap-title:first').find('.sectiontitle').html();
            
        $('#modaltitle').html( modelTitle );

        var modelTitle=$('li.continue').find('.videoplaylink').html();

$('#modalVideotitle').html( modelTitle );
          });

         
 })(jQuery);




});