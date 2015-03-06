</section>

<?php if($this->auth->is_logged_in(false, false)):?>
<footer>
    	Copyright 2015
</footer>
<?php endif; ?>
 <!-- Template skin customize(you can remove this anytime) -->
          <div class="template-customize hidden-xs">
               <i class="icon-cogs" id="tc-toggle"></i>
               <ul data-elem="body">
                    <li class="header">Body</li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/cloth.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/stripes.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/bluetec.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/cement.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/fabric.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/fabric-2.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/floor.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/leather.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/pixel.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/body-bg/tactile.png')?>" alt=""></li>
               </ul>
               <ul data-elem="content">
                    <li class="header">Content</li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/content-bg.jpg')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/lines.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/cloth.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/grid.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/gray-leather.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/jean.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/light.png')?>" alt=""></li>
                    <li><img src="<?php echo base_url('assets/img/content-bg/subtle.png')?>" alt=""></li>
               </ul>
          </div>

</body>

 <!-- Javascipt -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/redactor.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.form.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/colpick.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/iconselect.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/feeds.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/chosen.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/js/shadowbox.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sparkline.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/masonry.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/enscroll.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/calendar.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datatables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/autosize.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/select.min.js');?>"></script>


<script type="text/javascript" src="<?php echo base_url('assets/js/toggler.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/datetimepicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/colorpicker.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/fileupload.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/media-player.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/validation/validate.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/validation/validationEngine.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/functions.js');?>"></script>



<script type="text/javascript">
	$('#select_date').datepicker({dateFormat:'dd-mm-yy', altField: '#date_alt', altFormat: 'yy-mm-dd'});
	$('#select_time').timepicker({ 'step': 15, 'timeFormat': 'H:i:s' });

	$('#select_date_to').datepicker({dateFormat:'dd-mm-yy', altField: '#date_to_alt', altFormat: 'yy-mm-dd'});
	$('#select_time_to').timepicker({ 'step': 15, 'timeFormat': 'H:i:s' });

	<?php if(isset($colour)):?>
		var color = '<?php echo $colour ?>';
		//var templateColor = $( ".ColorBlotch" ).css( "background-color" );

		$(".ColorBlotch").each( function (index) {

		  if(color == $(this).css('background-color')){
			  $( this ).addClass(" FocusColor");
		  }
		  
		 });
			
	<?php endif;?>
	
	
	
	$( ".ColorBlotch" ).click(function() {				

		 $( ".ColorBlotch" ).removeClass("FocusColor");
		 $( ".ColorBlotch" ).addClass("ColorBlotch");
		
		  var color = $( this ).css( "background-color" );			 
		  $("#colour").val(color);

		  $( this ).addClass(" FocusColor");
		  
	});



	/* Upload Manager */

	var options = { 
			target:   '#output',   // target element(s) to be updated with server response 
			beforeSubmit:  beforeSubmit,  // pre-submit callback 
			success:       afterSuccess,  // post-submit callback 
			uploadProgress: OnProgress, //upload progress callback 
			resetForm: true        // reset the form after successful submit 
	}; 


	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
	        
		var input = $(this).parents('.input-group').find(':text'),
		log = numFiles > 1 ? numFiles + ' files selected' : label;

		console.log(input.length);
		if( input.length ) {
		    //input.val(log);
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		    
		} else {		
		    //if( log ) alert(log);
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
		}        
	        
	});

	$(document).on('change', '.btn-file :file', function() {
	  var input = $(this),
	      numFiles = input.get(0).files ? input.get(0).files.length : 1,
	      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	  input.trigger('fileselect', [numFiles, label]);
	});

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
	    $('.selectpicker').selectpicker('mobile');
	}

	$("[data-toggle=tooltip]").tooltip();


		
	 $('#MyUploadForm').submit(function() { 		 	
			$(this).ajaxSubmit(options);  			
			// always return false to prevent standard browser submit and page navigation 
			return false; 
	}); 
			

	//function after succesful file upload (when server response)
	function afterSuccess()
	{
		$('#remove_panel').show();
		$('#submit-btn').show(); //hide submit button
		$('#loading-img').hide(); //hide submit button
		$('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
		
	}

	//function to check file size before uploading.
	function beforeSubmit(){

	   alert(window.File);
	   alert(window.FileReader);
	   alert(window.FileList);
	   alert(window.Blob);
	    //check whether browser fully supports all File API
	   if (window.File && window.FileReader && window.FileList && window.Blob)
		{			
			
			if( !$('#FileInput').val()) //check empty input filed
			{
				$("#output").html("No Image has been selected, Please try again.");
				return false
			}
			
			var fsize = $('#FileInput')[0].files[0].size; //get file size
			var ftype = $('#FileInput')[0].files[0].type; // get file type
			
			//allow file types 
			switch(ftype)
	        {
	            case 'image/png': 
				case 'image/gif': 
				case 'image/jpeg': 
				case 'image/pjpeg':
				case 'text/plain':
				case 'text/html':
				case 'application/x-zip-compressed':
				case 'application/pdf':
				case 'application/msword':
				case 'application/vnd.ms-excel':
				case 'video/mp4':
	                break;
	            default:
	                $("#output").html("<b>"+ftype+"</b> Unsupported file type!");
					return false;
	        }
			
			//Allowed file size is less than 5 MB (1048576)
			if(fsize>5242880) 
			{
				$("#output").html("<b>"+bytesToSize(fsize) +"</b> Too big file! <br />File is too big, it should be less than 5 MB.");
				return false
			}
					
			$('#submit-btn').hide(); //hide submit button
			$('#loading-img').show(); //hide submit button
			$("#output").html("");  
		}
		else
		{
			alert("browser cant support");
			//Output error to older unsupported browsers that doesn't support HTML5 File API
			$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
			return false;
		}
	}

	//progress bar function
	function OnProgress(event, position, total, percentComplete)
	{
	    //Progress bar
		$('#progressbox').show();
	    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
	    $('#statustxt').html(percentComplete + '%'); //update status text
	    if(percentComplete>50)
	        {
	            $('#statustxt').css('color','#000'); //change status text to white after 50%
	        }
	}

	//function to format bites bit.ly/19yoIPO
	function bytesToSize(bytes) {
	   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	   if (bytes == 0) return '0 Bytes';
	   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
	}

	$("#remove-btn").click(function (e) { //user clicks on button
		var r = confirm("Are you confirm to remove?");
		if (r == true) {
			$.post('<?php echo site_url(config_item('admin_folder').'/themes/remove_uploaded');?>',
			function(data) {				
				if(data == 'success'){
					window.location.reload();	
				}else{
					$('#message_notify').text(data);				
				}
										
			}).fail(function(xhr, ajaxOptions, thrownError) { 
				alert(thrownError); //alert any HTTP error								
			});	
							
		}
	});

	$("#remove-page-btn").click(function (e) { //user clicks on button

		var id = "<?php echo isset($id) ? $id : 0 ?>";
		var r = confirm("Are you confirm to remove?");
		if (r == true) {
			$.post('<?php echo site_url(config_item('admin_folder').'/pages/remove_uploaded');?>',{'id':id},
			function(data) {				
				if(data == 'success'){
					window.location.reload();	
				}else{
					$('#message_notify').text(data);				
				}
										
			}).fail(function(xhr, ajaxOptions, thrownError) { 
				alert(thrownError); //alert any HTTP error								
			});	
							
		}
	});

	

			
</script>            
<script type="text/javascript">
$(document).ready(function(){

	var setFontFamily;
	var setFontSize;

	setFontFamily = function(obj, e, key) {
	  if (key === "arial") {
		obj.execCommand("fontname", "Arial");
	  }	
	  
	  if (key === "arialblack") {
		obj.execCommand("fontname", "Arial Black");
	  }	
	  
	  if (key === "comicsans") {
		obj.execCommand("fontname", "Courier New");
	  }	
	  
	  if (key === "courier") {
		obj.execCommand("fontname", "Comic Sans");
	  }	
	  
	  if (key === "impact") {
		obj.execCommand("fontname", "Impact");
	  }

	  if (key === "lucida") {
		obj.execCommand("fontname", "Lucida");
	  }

	  if (key === "lucidaconsole") {
		obj.execCommand("fontname", "Lucida Console");
	  }

	  if (key === "georgia") {
		return obj.execCommand("fontname", "Georgia");
	  }
	  
	  if (key === "palatino") {
		return obj.execCommand("fontname", "Palatino Linotype");
	  }
	  
	  if (key === "tahoma") {
		return obj.execCommand("fontname", "Tahoma");
	  }
	  if (key === "times") {
		obj.execCommand("fontname", "Times New Roman");
	  }
	  
	  if (key === "trebuchet") {
		obj.execCommand("fontname", "Trebuchet");
	  }
	  
	  if (key === "verdana") {
		return obj.execCommand("fontname", "Verdana");
	  }	  
	  
	  if (key === "none") {
		return obj.execCommand("fontname", "none");
	  }
	  
	};
	
	setFontSize = function(obj, e, key) {
	  if (key === "eight") {
		obj.execCommand("fontsize", "1");
	  }
	  if (key === "ten") {
		return obj.execCommand("fontsize", "2");
	  }
	  if (key === "twelve") {
		return obj.execCommand("fontsize", "3");
	  }
	  if (key === "fourteen") {
		return obj.execCommand("fontsize", "4");
	  }
	  if (key === "eightteen") {
		return obj.execCommand("fontsize", "5");
	  }
	  if (key === "twentyfour") {
		return obj.execCommand("fontsize", "6");
	  }
	  if (key === "thirtysix") {
		return obj.execCommand("fontsize", "7");
	  }
	  
	};
	
    $('.datepicker').datepicker({dateFormat: 'yy-mm-dd'});

    
    $('.redactor').redactor({
            minHeight: 200,
            imageUpload: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/upload_image');?>',
            fileUpload: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/upload_file');?>',
            imageGetJson: '<?php echo site_url(config_item('admin_folder').'/wysiwyg/get_images');?>',
            convertDivs: false,
            paragraphize: false,   
            focus: true,
			buttonsAdd: ["|", "fontfamily", "fontsize"],
			buttonsCustom: {
			  fontfamily: {
				title: "Font Family",
				dropdown: {
				  
				  arial: {
					title: "<font face='Arial'>Arial</font>",
					callback: setFontFamily
				  },
				  
				  arialblack: {
					title: "<font face='Arial Black'>Arial Black</font>",
					callback: setFontFamily
				  },
				  
				  comicsans: {
					title: "<font face='Courier New'>Courier New</font>",
					callback: setFontFamily
				  },
				  
				  courier: {
					title: "<font face='Comic Sans'>Comic Sans</font>",
					callback: setFontFamily
				  },
				  
				  impact: {
					title: "<font face='Impact'>Impact</font>",
					callback: setFontFamily
				  },
				  
				  lucida: {
					title: "<font face='Lucida'>Lucida</font>",
					callback: setFontFamily
				  },
				  
				  lucidaconsole: {
					title: "<font face='Lucida Console'>Lucida Console</font>",
					callback: setFontFamily
				  },
				   
				  georgia: {
					title: "<font face='Georgia'>Georgia</font>",
					callback: setFontFamily
				  },
				  
				  palatino: {
					title: "<font face='Palatino Linotype'>Palatino Linotype</font>",
					callback: setFontFamily
				  },
				  
				  tahoma: {
					title: "<font face='Tahoma'>Tahoma</font>",
					callback: setFontFamily
				  },					  					  
				  
				  times: {
					title: "<font face='Times New Roman'>Times New Roman</font>",
					callback: setFontFamily
				  },
				  
				  trebuchet: {
					title: "<font face='Trebuchet'>Trebuchet</font>",
					callback: setFontFamily
				  },					  					  
									  
				  verdana: {
					title: "<font face='Verdana'>Verdana</font>",
					callback: setFontFamily
				  },
				  
				  none: {
					title: "Remove",
					callback: setFontFamily
				  }
				  
				}
			  },
			  fontsize: {
				title: "Font Size",
				dropdown: {
				  eight: {
					title: "8pt",
					callback: setFontSize
				  },
				  ten: {
					title: "10pt",
					callback: setFontSize
				  },					  
				  twelve: {
					title: "12pt",
					callback: setFontSize
				  },
				  fourteen: {
					title: "14pt",
					callback: setFontSize
				  },
				  eightteen: {
					title: "18pt",
					callback: setFontSize
				  },
				  twentyfour: {
					title: "24pt",
					callback: setFontSize
				  },
				  thirtysix: {
					title: "36pt",
					callback: setFontSize
				  }
				
				}
			  }
			  
			  
			},            
            imageUploadErrorCallback: function(json)
            {
                alert(json.error);
            },
            fileUploadErrorCallback: function(json)
            {
                alert(json.error);
            }
      });

	<?php 
		if(!isset($color_background)):
			if(isset($colour)):
				$color_background = $colour;
			endif;
		endif;
	?>
    
    $('#picker').colpick({
    	color: '<?php echo isset($color_background) ? $color_background : ''?>',
    	layout:'hex',
    	submit:0,
    	colorScheme:'dark',
    	onChange:function(hsb,hex,rgb,el,bySetColor) {
    		$(el).css('border-color','#'+hex);
    		// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
    		if(!bySetColor) $(el).val(hex);
    	}
    }).keyup(function(){
    	$(this).colpickSetColor(this.value);
    });
    
    
});


</script>

<script type="text/javascript">
              
                    $('.template-customize ul li').click(function(){
                         var getElem = $(this).closest('ul').attr('data-elem');
                         var target = (getElem == "body") ? "body, #leftbar, #rightbar" : "#content";
                         
                         var src = $(this).find('img').attr('src');
                         var bg = 'url('+src+')';
                         $(target).css('background', bg)
                    });
                    
                    $('#tc-toggle').click(function(){
                         $('.template-customize').css('height','auto');
                    });
                    
                    $(document).mouseup(function (e) {
                         var container = $(".template-customize");
                         if (container.has(e.target).length === 0) {
                               container.height(0);
                         }
                    });
              
              
     
               //Masonry for widgets
               $(window).load(function(){
                    $('.m-container').masonry({
                         itemSelector: '.masonry'
                    });  
               });
            
          </script>

</html>