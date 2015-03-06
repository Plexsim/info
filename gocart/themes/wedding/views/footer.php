<!--scripts-->


</div> <!-- END of Container in file header.php -->

	<!--scripts-->		
	<?php echo theme_js('jquery-1.10.1.min.js', true);?>	
	<?php echo theme_js('jquery.validate.min.js', true);?>
	
	
	<?php echo theme_js('jquery.tabify.js', true);?>
	
	<?php echo theme_js('jquery.swipebox.js', true);?>
	<?php echo theme_js('jquery.fitvids.js', true);?>
	<?php echo theme_js('twitter/jquery.tweet.js', true);?>
	<?php echo theme_js('email.js', true);?>
	
	
    <!-- Demo -->
         
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	
<script>
$( document ).ready(function() {

	/* Basic Gallery */
	$( '.swipebox' ).swipebox();
	
	/* Video */
	$( '.swipebox-video' ).swipebox();

	/* Dynamic Gallery */
	$( '#gallery' ).click( function( e ) {
		e.preventDefault();
		$.swipebox( [
			{ href : 'http://swipebox.csag.co/mages/image-1.jpg', title : 'My Caption' },
			{ href : 'http://swipebox.csag.co/images/image-2.jpg', title : 'My Second Caption' }
		] );
	} );

});
</script>
</body>
</html>