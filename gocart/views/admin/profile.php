
<div class="row">
	<?php echo form_open($this->config->item('admin_folder').'/profile/' ); ?>
	<div class="span8">
		<div class="tabbable">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#product_info" data-toggle="tab"><?php echo lang('details');?></a></li>								
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane active" id="product_info">
				<div class="row">				
					<div class="span4">
						<?php
						$data	= array('placeholder'=>lang('display_name').'*', 'name'=>'display_name', 'value'=>set_value('display_name', $display_name), 'class'=>'span8');
						echo form_input($data);
						?>
					</div>
				</div>
				
				<!--div class="row" style="margin-bottom:5px;">
					<div class="span8">						
						<?php
						$data	= array('name'=>'about_us', 'class'=>'redactor', 'placeholder'=>lang('about_us'), 'value'=>set_value('about_us', $about_us));
						echo form_textarea($data);
						?>						
					</div>
				</div-->								
												
				<div class="row">
					<div class="span4">						
						<?php
							$data	= array('placeholder'=>lang('office_no'), 'name'=>'office', 'value'=>set_value('office', $office), 'class'=>'span4');
							echo form_input($data);
						?>					
					</div>
					<div class="span4">						
						<?php
							$data	= array('placeholder'=>lang('mobile_no'), 'name'=>'mobile', 'value'=>set_value('mobile', $mobile), 'class'=>'span4');
							echo form_input($data);
						?>					
					</div>
				</div>
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('location'), 'name'=>'location', 'value'=>set_value('location', $location), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>		
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('address'), 'name'=>'address', 'value'=>set_value('address', $address), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>		
															
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('facebook'), 'name'=>'facebook', 'value'=>set_value('facebook', $facebook), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('google_plus'), 'name'=>'google_plus', 'value'=>set_value('google_plus', $google_plus), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('twitter'), 'name'=>'twitter', 'value'=>set_value('twitter', $google_plus), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>		
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('pinterest'), 'name'=>'pinterest', 'value'=>set_value('pinterest', $google_plus), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>				
				
				<div class="row">
					<div class="span8">						
						<?php
							$data	= array('placeholder'=>lang('linkedin'), 'name'=>'linkedin', 'value'=>set_value('linkedin', $google_plus), 'class'=>'span8');
							echo form_input($data);
						?>					
					</div>
				</div>		
								
				<div class="row">
					<div class="span8">
						<fieldset>
							<legend><?php echo lang('header_information');?></legend>
							<div class="row" style="padding-top:10px;">
								<div class="span8">
																											
									<label for="seo_title"><?php echo lang('seo_title');?> </label>
									<?php
									$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'span8');
									echo form_input($data);
									?>

									<label for="meta"><?php echo lang('meta');?> <!--i><?php echo lang('meta_example');?></i--></label> 
									<?php
									$data	= array('name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'span8');
									echo form_textarea($data);
									?>
								</div>
							</div>
						</fieldset>
					</div>
				</div>
			</div>
			

		</div>
		
		<div class="form-actions">
			<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
		</div>				
	</div>
	</form>
	
	<div class="span4">
			<div class="form-regist-container">
				<h4><?php echo lang('upload_logo')?></h4>
				
				<p>
				<a href="#" data-toggle="tooltip" data-placement="right" data-html="true" title="Company Logo">	
					<div id="output">
						<?php if(!empty($image)){?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url($image)?>" alt="Company Logo" class="company-logo" style="width:280px; height:180px;" />
								</div>											
						<?php }else{?>
								<div class="step-by-inner-img2">										
									<img src="<?php echo base_url('assets/img/no_picture.png')?>" alt="Company Logo" class="company-logo" style="width:280px; height:180px;" />
								</div>																					
						<?php }?>
					</div>
					
				</a>	
				</p>
				
				<p>
					<?php echo lang('best_photo_size')?> <b><?php echo lang('width')?>: 371px, <?php echo lang('height')?>: 113px </b>
				</p>
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
			            	<li><?php echo lang('best_photo_size')?> <b><?php echo lang('width')?>: 371px, <?php echo lang('height')?>: 113px </b></li> 
			            	<li><?php echo lang('max_file_size')?> <strong>5 MB</strong>.</li>
			                <li><?php echo lang('only_image_files')?>(<strong>JPG, GIF, PNG</strong>) <?php echo lang('allowed_in_background_image')?>.</li>
			                <li><?php echo lang('files_from_desktop')?></li>	                
			            </ul>
			        </div>
			    </div>
														
			</div>	
		
	</div>
</div>

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
     var url = "<?php echo base_url(); ?>"+"admin/upload/upload_profile/",            
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
					'width','280px', 'height','180px'    									
                 ); 
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
