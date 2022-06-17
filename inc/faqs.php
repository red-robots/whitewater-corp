<script type="text/javascript">
jQuery(document).ready(function ($) {
	/* FAQS */
	// $(document).on("click",".faqsItems .collapsible",function(e){
	// 	e.preventDefault();
	// 	if( $(this).hasClass('active') ) {
	// 		$(this).removeClass("active fadeIn");
	// 	} else {
	// 		$(".faqsItems .collapsible").removeClass("active fadeIn");
	// 		$(this).addClass("active fadeIn");
	// 	}
	// }); 

  $(document).on("click",".collapsible h3.option-name",function(e){
   e.preventDefault();
   var parent = $(this).parent();
   if( parent.hasClass('active') ) {
     parent.removeClass("active fadeIn");
   } else {
     $(".faqsItems .collapsible").removeClass("active fadeIn");
     parent.addClass("active fadeIn");
   }
  }); 


  $(document).on("click",".collapsiblewtw",function(e){
   e.preventDefault();
   var parent = $(this).parent();
   if( parent.hasClass('active') ) {
     parent.removeClass("active fadeIn");
   } else {
     $(".faqsItems .collapsiblewtw").removeClass("active fadeIn");
     parent.addClass("active fadeIn");
   }
  });



});
</script>