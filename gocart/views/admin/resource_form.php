<?php 
	$f_image		= array('name'=>'image', 'id'=>'image');
?>


<?php echo form_open_multipart($this->config->item('admin_folder').'/training_resource/form/'.$id); ?>

	
        
        <div class="btn-group pull-right">
			<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/training_resource'); ?>"><i class="icon-plus-sign"></i> Back to Training Resource Listing </a>	
		</div>
		
               
               <?php if (!empty($message)): ?>
			        <div class="alert alert-success alert-dismissable fade in">
			            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			            <?php echo $message; ?>
			        </div>
			    <?php endif; ?>
			
			    <?php if (!empty($error)): ?>
			        <div class="alert alert-danger alert-dismissable fade in">
			            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			            <?php echo $error; ?>
			        </div>
			    <?php endif; ?>
               
               <!-- Tab -->
                <div class="c-block" id="tabs">
                    <h3 class="block-title">File Upload Module</h3>
                    
                    <p>File Details</p>
                    <div class="tab-container">
                        <ul class="nav tab nav-tabs">
                            <li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('content');?></a></li>
							<li><a href="#attributes_tab" data-toggle="tab"><?php echo lang('attributes');?></a></li>
							<li><a href="#seo_tab" data-toggle="tab"><?php echo lang('seo');?></a></li>
							<li><a href="#image_tab" data-toggle="tab"><?php echo lang('file');?></a></li>                            
                        </ul>
                          
                        <div class="tab-content">                                                        
                            <div class="tab-pane active" id="content_tab">
								<fieldset>
									<p><?php echo lang('title');?></p>
									<?php
									$data	= array('name'=>'title', 'value'=>set_value('title', $title), 'class'=>'input-sm form-control');
									echo form_input($data);
									?>
								</fieldset>
							</div>
                           	<div class="tab-pane" id="attributes_tab">
								<fieldset>							
									<p><?php echo lang('sequence');?></p>
									 
									<?php
									$data	= array('name'=>'sequence', 'value'=>set_value('sequence', $sequence), 'class'=>'input-sm form-control');
									echo form_input($data);
									?>
										
									 <p></p>	
									<p><?php echo lang('status');?> </p>		
																				
									<?php
								 	$options = array(	 'Enable'		=> lang('enable')
														,'Disable'		=> lang('disable')
														);
									echo form_dropdown('status', $options, set_value('status',$status),'class=form-control input-lg');
									?>
									
									
								</fieldset>
							</div>
                            <div class="tab-pane" id="seo_tab">
								<fieldset>
									<p><?php echo lang('seo_title');?></p>
									<?php
									$data	= array('name'=>'seo_title', 'value'=>set_value('seo_title', $seo_title), 'class'=>'input-sm form-control');
									echo form_input($data);
									?>
									<span style="margin-bottom:2px;">&nbsp;</span>
									<p><?php echo lang('meta');?></p>
									<?php
									$data	= array('rows'=>'3', 'name'=>'meta', 'value'=>set_value('meta', html_entity_decode($meta)), 'class'=>'input-sm form-control');
									echo form_textarea($data);
									?>
									
									<!--p class="help-block"><?php echo lang('meta_data_description');?></p-->
								</fieldset>
							</div>
                            <div class="tab-pane" id="image_tab">
								<?php 
									echo form_upload($f_image).'<p></p>';
									
									$doc = array('application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/msword', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/msword', 'application/octet-stream','application/excel','application/vnd.oasis.opendocument.text','application/vnd.oasis.opendocument.formula');
									$excel = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel','application/vnd.oasis.opendocument.spreadsheet','application/vnd.oasis.opendocument.spreadsheet-template');
									$zip = array('application/zip', 'application/x-zip', 'application/x-zip-compressed', 'application/octet-stream', 'application/x-compress', 'application/x-compressed', 'multipart/x-zip', 'application/rar', 'application/x-rar', 'application/x-rar-compressed', 'application/x-compressed', 'application/octet-stream','application/x-gtar', 'application/x-gzip','application/x-tar','application/x-gzip-compressed');												
									if($id && $image != ''):
										/*PDF FILE*/ if( get_mime_by_extension($image) == "application/pdf"):?>
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img width="512px" height="512px" src="<?php echo base_url('uploads/Adobe_PDF_icon.png');?>" alt="current"/><br/><?php echo lang('current_file');?></div>				
										<?php /*DOC FILE*/ elseif(in_array(get_mime_by_extension($image), $doc)):?>				
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img width="512px" height="512px" src="<?php echo base_url('uploads/MS_word_DOC_icon.png');?>" alt="current"/><br/><?php echo lang('current_file');?></div>				
										<?php /*TXT FILE*/ elseif( get_mime_by_extension($image) == "text/plain"):?>
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img width="512px" height="512px" src="<?php echo base_url('uploads/TXT_icon.png');?>" alt="current"/><br/><?php echo lang('current_file');?></div>
										<?php /*Excel FILE*/ elseif(in_array(get_mime_by_extension($image), $excel)):?>		
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img width="512px" height="512px" src="<?php echo base_url('uploads/Excel_icon.png');?>" alt="current"/><br/><?php echo lang('current_file');?></div>
										<?php /*Excel FILE*/ elseif(in_array(get_mime_by_extension($image), $zip)):?>		
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img width="512px" height="512px" src="<?php echo base_url('uploads/Zip_icon.png');?>" alt="current"/><br/><?php echo lang('current_file');?></div>
										<?php /*IMAGE FILE*/ else:?>							
											<div style="text-align:center; padding:5px; border:1px solid #ccc;"><img src="<?php echo base_url('uploads/'.$image);?>" alt="current"/><br/><?php echo lang('current_file');?></div>
										<?php 
										endif;
									endif;	
										?>			
							</div>
                        </div>
                    </div>
                    
                    <div class="divider"></div>
                    
                    <div class="form-actions">
						<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
					</div>	
                </div>                
           


</form>