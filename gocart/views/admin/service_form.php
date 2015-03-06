<label><?php echo lang('preview');?>
</label>

<?php echo form_open($this->config->item('admin_folder').'/profile/service/'); ?>


<div class="tabbable">


	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('service');?></a></li>
	
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
						     
  				<div id="my-icon-select"></div>
				 <input type="hidden" id="selected-text" name="selected-text" style="width:65px;">			
				
				<label for="content"><?php echo lang('content');?></label>
				<?php
				$data	= array('name'=>'service', 'class'=>'redactor', 'value'=>set_value('service', $service));
				echo form_textarea($data);
				?>
						
			</fieldset>
			<span>*Browser - Google Chrome and Safari is recommended*</span>
		</div>	

	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>

