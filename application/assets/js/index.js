$(document).ready(function() {
   $(".button-collapse").sideNav();
   $('time').each(function() {
     time = $(this).text();
     moment.locale('vi');
     time=moment(time).fromNow();
     $(this).text(time);
   });

   $('#toggle-menu').click(function() {
     currenttext= $(this).find('i').text();
     if(currenttext!='trending_flat') {
            $(this).find('i').text('trending_flat');
   } else  {
            $(this).find('i').text('skip_previous');
   }
     $(this).parent().parent().toggleClass('collapse');
     $('.right-content').toggleClass(' s11 collapse-content');

   });
});
function  routercat(category) {
  var catid = category.getAttribute('catid');
  var stringtarget="[catid=" +catid + "]";
  $(stringtarget).addClass('preloader-wrapper active centerli');
  $('.right-content').html(`
    <div class="progress">
    <div class="indeterminate"></div>
</div>
    `);
    data = {
      'id' : catid
    }
   $.post('/category/view',data,function(data,success){
                    if(success) {
                      $(stringtarget).removeClass('preloader-wrapper active centerli');
                      $('.right-content').html(data);
                    }
   });
}
