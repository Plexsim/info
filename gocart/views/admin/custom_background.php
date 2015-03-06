<h1><?php echo lang('custom_background') ?></h1>


<button id="icon_custom" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
  <?php echo lang('custom_background')?>
</button>
<div class="collapse" id="collapseExample">
  <div class="well">
  <fieldset>
  <label><?php echo lang('preview');?></label>
		<div>			
			<p>
			<a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="<?php echo lang('background_customisation')?>">	
				<div id="output">
					<?php if(!empty($image_background)){?>
							<div class="step-by-inner-img2">										
								<img src="<?php echo base_url($image_background)?>" alt="Background" class="image-background" style="width:100px; height:150px;" />
							</div>											
					<?php }else{?>
							<div class="step-by-inner-img2">										
								<img src="<?php echo base_url('assets/img/no_picture.png')?>" alt="Background" class="image-background" style="width:280px; height:180px;" />
							</div>																					
					<?php }?>
				</div>
				
			</a>	
			</p>
			
		</div>
				
		<div id="remove_panel" style="display: <?php echo !empty($image_background) ? 'block' : 'none' ?>">
			<input type="submit"  id="remove-btn" value="<?php echo lang('remove_image');?>"/>
			<label><?php echo lang('warning_remove_image')?></label></br>
			<label id="message_notify"></label></br>
		</div>			
		
				
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
	            	<li><?php echo lang('best_photo_size')?> <b><?php echo lang('width')?>: 800px, <?php echo lang('height')?>: 1200px </b></li>
	                <li><?php echo lang('max_file_size')?><strong>5 MB</strong>.</li>
	                <li><?php echo lang('only_image_files')?>(<strong>JPG, GIF, PNG</strong>) <?php echo lang('allowed_in_background_image')?>.</li>
	                <li><?php echo lang('files_from_desktop')?></li>	                
	            </ul>
	        </div>
	    </div>
  </fieldset>
  </div>
</div>
  
<?php echo form_open($this->config->item('admin_folder').'/themes/custom_background' ); ?>

<div class="tabbable">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('default_background_color');?></a></li>		
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
				<label><?php echo lang('background_color');?></label>
				<input type="text" id="picker" name="picker" style="border-right:20px solid <?php echo '#'.$color_background?>" value="<?php echo isset($color_background) ? $color_background : '' ?>"></input>									
			</fieldset>
		</div>						
	</div>		
</div>
							
<div class="form-actions">
	<input type="submit" name="submit" class="btn btn-primary" value="<?php echo lang('save');?>"/>
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
/*jslint unparam: true, regexp: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
     var url = "<?php echo base_url(); ?>"+"admin/upload/upload_background/",            
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