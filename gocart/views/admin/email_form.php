<label><?php echo lang('preview');?>
</label>

<?php echo form_open($this->config->item('admin_folder').'/profile/email_form/'); ?>


<div class="tabbable">

	<ul class="nav nav-tabs">
		<li class="active"><a href="#content_tab" data-toggle="tab"><?php echo lang('email');?></a></li>	
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
			<fieldset>
						     
  				<div id="my-icon-select"></div>
				<input type="hidden" id="selected-text" name="selected-text" style="width:65px;">			
				
				<label for="content"><?php echo lang('email_setting');?></label>
				<?php
					$data	= array('name'=>'email', 'value'=>set_value('email', $setting['email']));
					echo form_input($data);
				?>
						
			</fieldset>
		</div>	

	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn btn-primary"><?php echo lang('save');?></button>
</div>	
</form>

