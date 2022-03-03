<script type="text/javascript">
jQuery(document).ready(function ($) {
	/* FAQS */
	$(document).on("click",".faqsItems .collapsible",function(e){
		e.preventDefault();
		if( $(this).hasClass('active') ) {
			$(this).removeClass("active fadeIn");
		} else {
			$(".faqsItems .collapsible").removeClass("active fadeIn");
			$(this).addClass("active fadeIn");
		}
	}); 
});
</script>