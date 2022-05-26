<script type="text/javascript">
jQuery(document).ready(function ($) {
	/* page anchors */
	if( $('[data-section]').length > 0 ) {
		var tabs = '';
		$('[data-section]').each(function(){
			var name = $(this).attr('data-section');
			var id = $(this).attr("id");
			tabs += '<span class="mini-nav"><a href="#'+id+'">'+name+'</a></span>';
		});

		if( $("#pageTabs").length>0 ) {
			$("#pageTabs").html('<div class="wrapper"><div id="tabcontent">'+tabs+'</div></div>');
			$("#pageTabs").show();
		}
	}
});
</script>