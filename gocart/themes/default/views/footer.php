<footer><!--footer-->
  <div class="container">
      	<div class="row">
          <ul class="list-unstyled text-right">
            <li class="col-sm-4 col-xs-6">
              <a href="#">About</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">Services</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">Studies</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">References</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">Login</a>
            </li>
           <li class="col-sm-4 col-xs-6">
              <a href="#">Press</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">Contact</a>
            </li>
            <li class="col-sm-4 col-xs-6">
              <a href="#">Impressum</a>
            </li>
          </ul>
		</div><!--/row-->
    </div><!--/container-->
</footer>



<!--scripts-->


</div> <!-- END of Container in file header.php -->

	<!--scripts-->
	
	<?php echo theme_js('jquery-1.10.2.min.js', true);?>
	<?php echo theme_js('jquery.easing.1.3.min.js', true);?>
	<?php echo theme_js('bootstrap.min.js', true);?>
	<?php echo theme_js('bootstrap-hover-dropdown.min.js', true);?>	 
	<script src="<?php echo theme_url('assets/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>		
	<?php echo theme_js('jquery.flexslider-min.js', true);?>
	<?php echo theme_js('jquery.mixitup.min.js', true);?>
	<?php echo theme_js('app.js', true);?>
	<?php echo theme_js('scripts.js', true);?>
		
	<?php echo theme_js('owl-carousel/owl.carousel.js', true);?>	

    <!-- Demo -->

    <style>
    #owl-demo .item{
        margin: 3px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
    
    /* laptops */
	@media (max-width: 1023px) and (min-width: 992px) {
	    #owl-demo .item img{
	        display: block;
	        width: 100%;
	        height: 150px;
	    }
	   
	}
	
	/* desktops */
	@media (min-width: 1024px) {
		  #owl-demo .item img{
		        display: block;
		        width: 100%;
		        height: 150px;
		  }  		    
	}
    
    </style>


    <script>
    
      $("#owl-demo").owlCarousel({
        items : 6,
        lazyLoad : true,        
      });
      
   	   //$('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
       //$('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});

       $('#list').click(function(){$('#products .item').addClass('list-group-item');});
  	   $('#grid').click(function(){$('#products .item').removeClass('list-group-item');});

       
    </script>
	
	<?php echo theme_js('bootstrap-transition.js', true);?>
	
	<?php echo theme_js('bootstrap-tab.js', true);?>
	
	<?php echo theme_js('google-code-prettify/prettify.js', true);?>
	
	<?php echo theme_js('application.js', true);?>
       
       
    <?php echo theme_js('jquery.rwdImageMaps.min.js', true);?>
	<script>
		$('img[usemap]').rwdImageMaps();
		
		$('area').on('click', function() {
			//alert($(this).attr('alt') + ' clicked');
		});	

		function centerModal() {
		    $(this).css('display', 'block');
		    var $dialog = $(this).find(".modal-dialog");
		    var offset = ($(window).height() - $dialog.height()) / 1;
		    // Center modal vertically in window
		    //$dialog.css("margin-top", offset);
		}

		$('.modal').on('show.bs.modal', centerModal);
		$(window).on("resize", function () {
		    $('.modal:visible').each(centerModal);
		});
		
	</script>  
	
	
         
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>	

</body>
</html>