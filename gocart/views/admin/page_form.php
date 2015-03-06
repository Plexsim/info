
<button id="icon_custom" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <?php echo lang('icon_customise')?>
</button>
<div class="collapse" id="collapseExample">
  <div class="well">
    <fieldset>
 		  							 		
  	<?php if($id):?>

	<label><?php echo lang('preview');?>
	</label>
	<div>
		<p>
			<a href="#" data-toggle="tooltip" data-placement="right"
				data-html="true"
				title="<?php echo lang('background_customisation')?>">
				<div id="output">
					<?php if(!empty($menu_icon)){?>
					<div class="step-by-inner-img2">
						<img src="<?php echo base_url($menu_icon)?>"
							alt="Background" class="image-background"
							style="width: 112px; height: 112px;" />
					</div>
					<?php }else{?>
					<div class="step-by-inner-img2">
						<img src="<?php echo base_url('assets/img/no_picture.png')?>"
							alt="Background" class="image-background"
							style="width: 112px; height: 112px;" />
					</div>
					<?php }?>
				</div>
	
			</a>
		</p>
	
	</div>
	
	<div id="remove_panel" style="display: <?php echo !empty($menu_icon) ? 'block' : 'none' ?>">
		<input type="submit"  id="remove-page-btn" value="<?php echo lang('remove_image');?>"/>
		<label><?php echo lang('warning_remove_image')?></label></br>
		<label id="message_notify"></label></br>
	</div>	
	
	<label for="content"><?php echo lang('icon_customise');?> *<?php echo lang('image_size')?>: <?php echo lang('width')?>:114px, <?php echo lang('height')?>:114px *</label>
	
	<!-- The fileinput-button span is used to style the file input field as button -->
	    <span class="btn btn-success fileinput-button">
	        <i class="glyphicon glyphicon-plus"></i>
	        <span><?php echo lang('add_files')?>...</span>
	        <!-- The file input field used as target for the file upload widget -->
	        <input id="fileupload" type="file" name="userfile" multiple>
	    </span>
	    <br>
	    <br>
	    <!-- The global progress bar -->
	    <div id="progress" class="progress">
	        <div class="progress-bar progress-bar-success"></div>
	    </div>
	    <!-- The container for the uploaded files -->
	    <div id="files" class="files"></div>
	    <br>
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title"><?php echo lang('upload_image_notes')?></h3>
	        </div>
	        <div class="panel-body">
	            <ul>
	            	<li><?php echo lang('best_photo_size')?>- <b><?php echo lang('width')?>: 114px, <?php echo lang('height')?>: 114px </b></li>
	                <li><?php echo lang('max_file_size')?> <strong>5 MB</strong> </li>
	                <li><?php echo lang('only_image_files')?>(<strong>JPG, GIF, PNG</strong>) <?php echo lang('allowed_in_menu_image')?> </li>
	                <li><?php echo lang('files_from_desktop')?></li>	                
	            </ul>
	        </div>
	    </div>
	<?php else:?>    
	    
	<strong><?php echo lang('save_page_before')?></strong>          
	    
	<?php endif;?>
		  							 		
 	</fieldset>	 
    
  </div>
</div>

<?php echo form_open($this->config->item('admin_folder').'/pages/form/'.$id); ?>
<div class="tabbable">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
		<li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
		<li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
		<li><a href="#icon" data-toggle="tab"><?php echo lang('icon');?></a></li>	
		<li><a href="#metro" data-toggle="tab"><?php echo lang('metro');?></a></li>		
	</ul>
		
	

	
	<div class="tab-content">			 
	
	 <div class="tab-pane" id="icon">
	 	<fieldset>
	 		<label><?php echo lang('icon_default')?>: </label>        
  				<div id="my-icon-select"></div></br></br></br></br>
				<input type="hidden" id="selected-text" name="selected-text" style="width:65px;">				 		
	 	</fieldset>	 
	 </div>
	
	
	<div class="tab-pane" id="metro">
	 	<fieldset>
	 			</br>
				<i><?php echo lang('for_metro')?>: </i>
				<label for="content"><?php echo lang('colour');?></label>
				
				<label><?php echo lang('background_color');?></label>
				<input type="text" id="picker" name="picker" style="border-right:20px solid <?php echo '#'.$colour ?>" value="<?php echo isset($colour) ? $colour : '' ?>"></input>		 		
	 	</fieldset>	 
	 </div>
	
	   <div class="tab-pane active" id="content_tab">
			<fieldset>
						
				
				<label for="title"><?php echo lang('title');?></label>
				<?php
				$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'span12');
				echo form_input($data);
				?>
				
				<label for="content"><?php echo lang('content');?> (<span>*Browser - Google Chrome and Safari is recommended*</span>)</label>
				<?php
				$data	= array('name'=>'content', 'class'=>'redactor', 'value'=>set_value('content', $content));
				echo form_textarea($data);
				?>
				
			
																							
				
			</fieldset>
		</div>

		<div class="tab-pane" id="attributes_tab">
			<fieldset>
				<label for="menu_title"><?php echo lang('menu_title');?></label>
				<?php
				$data	= array('name'=>'menu_title', 'value'=>set_value('menu_title', $menu_title), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="slug"><?php echo lang('slug');?></label>
				<?php
				$data	= array('name'=>'slug', 'value'=>set_value('slug', $slug), 'class'=>'span3');
				echo form_input($data);
				?>
			
				<label for="sequence"><?php echo lang('parent_id');?></label>
				<?php
				$options	= array();
				$options[0]	= lang('top_level');
				/* function page_loop($pages, $dash = '', $id=0)
				{
					$options	= array();
					foreach($pages as $page)
					{
						//this is to stop the whole tree of a particular link from showing up while editing it
						if($id != $page->id)
						{
							$options[$page->id]	= $dash.' '.$page->title;
							$options			= $options + page_loop($page->children, $dash.'-', $id);
						}
					}
					return $options;
				}
				$options	= $options + page_loop($pages, '', $id); */
				echo form_dropdown('parent_id', $options,  set_value('parent_id', $parent_id));
				?>
			
				<label for="sequence"><?php echo lang('sequence');?></label>
				<?php
				$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'span3');
				echo form_input($data);
				?>
			</fieldset>
		</div>
	
		<div class="tab-pane" id="seo_tab">
			<fieldset>
				<label for="code"><?php echo lang('seo_title');?></label>
				<?php
				$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span12');
				echo form_input($data);
				?>
			
				<label><?php echo lang('meta');?></label>
				<?php
				$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span12');
				echo form_textarea($data);
				?>
				
				<!--p class="help-block"><?php echo lang('meta_data_description');?></p-->
			</fieldset>
		</div>
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/vendor/jquery.ui.widget.js');?>"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.iframe-transport.js');?>"></script>
<!-- The basic File Upload plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload.js');?>"></script>
<!-- The File Upload processing plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload-process.js');?>"></script>
<!-- The File Upload image preview & resize plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload-image.js');?>"></script>
<!-- The File Upload audio preview plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload-audio.js');?>"></script>
<!-- The File Upload video preview plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload-video.js');?>"></script>
<!-- The File Upload validation plugin -->
<script type="text/javascript" src="<?php echo base_url('assets/js/upload/jquery.fileupload-validate.js');?>"></script>


<script>

	var iconSelect;
	
	
	
	iconSelect = new IconSelect("my-icon-select", 
	    {'selectedIconWidth':48,
	    'selectedIconHeight':48,
	    'selectedBoxPadding':5,
	    'iconsWidth':48,
	    'iconsHeight':48,
	    'boxIconSpace':3,
	    'selectedIndex': 5,
	    'vectoralIconNumber':8,
	    'horizontalIconNumber':1});
	
	
	selectedText = document.getElementById('selected-text');
	
	document.getElementById('my-icon-select').addEventListener('changed', function(e){
	   selectedText.value = iconSelect.getSelectedValue();
	});

	iconSelect.COMPONENT_ICON_FILE_PATH = '<?php echo base_url('assets/img/arrow.png')?>';
	     
	
	var icons = [];
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/about.png')?>', 'iconValue':'icons/about.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/blog.png')?>', 'iconValue':'icons/blog.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/calendar.png')?>', 'iconValue':'icons/calendar.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/cart.png')?>', 'iconValue':'icons/cart.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/clients.png')?>', 'iconValue':'icons/clients.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/code.png')?>', 'iconValue':'icons/code.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/contact.png')?>', 'iconValue':'icons/contact.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/docs.png')?>', 'iconValue':'icons/docs.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/home.png')?>', 'iconValue':'icons/home.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/law.png')?>', 'iconValue':'icons/law.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/layout.png')?>', 'iconValue':'icons/layout.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/light.png')?>', 'iconValue':'icons/light.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/menu.png')?>', 'iconValue':'icons/menu.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/pencil.png')?>', 'iconValue':'icons/about.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/photos.png')?>', 'iconValue':'icons/photos.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/security.png')?>', 'iconValue':'icons/securiy.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/services.png')?>', 'iconValue':'icons/services.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/stats.png')?>', 'iconValue':'icons/stats.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/tools.png')?>', 'iconValue':'icons/tools.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/top.png')?>', 'iconValue':'icons/top.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/travel.png')?>', 'iconValue':'icons/travel.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/twitter.png')?>', 'iconValue':'icons/twitter.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons/videos.png')?>', 'iconValue':'icons/videos.png'});



	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/about.png')?>', 'iconValue':'icons_dark/about.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/blog.png')?>', 'iconValue':'icons_dark/blog.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/calendar.png')?>', 'iconValue':'icons_dark/calendar.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/cart.png')?>', 'iconValue':'icons_dark/cart.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/clients.png')?>', 'iconValue':'icons_dark/clients.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/code.png')?>', 'iconValue':'icons_dark/code.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/contact.png')?>', 'iconValue':'icons_dark/contact.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/docs.png')?>', 'iconValue':'icons_dark/docs.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/home.png')?>', 'iconValue':'icons_dark/home.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/law.png')?>', 'iconValue':'icons_dark/law.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/layout.png')?>', 'iconValue':'icons_dark/layout.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/light.png')?>', 'iconValue':'icons_dark/light.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/menu.png')?>', 'iconValue':'icons_dark/menu.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/pencil.png')?>', 'iconValue':'icons_dark/about.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/photos.png')?>', 'iconValue':'icons_dark/photos.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/security.png')?>', 'iconValue':'icons_dark/securiy.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/services.png')?>', 'iconValue':'icons_dark/services.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/stats.png')?>', 'iconValue':'icons_dark/stats.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/tools.png')?>', 'iconValue':'icons_dark/tools.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/top.png')?>', 'iconValue':'icons_dark/top.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/travel.png')?>', 'iconValue':'icons_dark/travel.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/twitter.png')?>', 'iconValue':'icons_dark/twitter.png'});
	icons.push({'iconFilePath':'<?php echo base_url('assets/img/icons_dark/videos.png')?>', 'iconValue':'icons_dark/videos.png'});
	
	iconSelect.refresh(icons);
	
	<?php if(isset($menu_default_icon)): ?>
	var index;
	for (i = 0; i < icons.length; i++) { 
			if(icons[i].iconValue == "<?php echo $menu_default_icon ?>"){
			index = i;
			break;
			}
	}       
	iconSelect.setSelectedIndex(index);
	
	<?php endif; ?>


	$('img[src="../../../assets/img/arrow.png"]').attr('src', '<?php echo $default_arrow?>'); 
	

</script>
	
<script>
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
     var url = "<?php echo base_url(); ?>"+"admin/upload/upload_icon/"+"<?php echo $id?>",            
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        console.log(data.loaded);
        console.log(data.total);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                $(data.context.children()[index])
                    .wrap(link);
                                
                $(".step-by-inner-img2 img").attr("src", file.url).css(
					'width','100px', 'height','150px'    									
                 ); 

                $("#remove_panel").show();
                
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>