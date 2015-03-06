<?php echo form_open($this->config->item('admin_folder').'/admin/form/'.$id); ?>
	
		<p><?php echo lang('firstname');?></p>
		<?php
		$data	= array('name'=>'firstname', 'value'=>set_value('firstname', $firstname), 'class'=>'input-sm form-control');		
		echo form_input($data);
		?>
		
		<p><?php echo lang('lastname');?></p>
		<?php
		$data	= array('name'=>'lastname', 'value'=>set_value('lastname', $lastname), 'class'=>'input-sm form-control');
		echo form_input($data);
		?>

		<p><?php echo lang('username');?></p>
		<?php
		$data	= array('name'=>'username', 'value'=>set_value('username', $username), 'class'=>'input-sm form-control');		
		echo form_input($data);
		?>

		<p><?php echo lang('email');?></p>
		<?php
		$data	= array('name'=>'email', 'value'=>set_value('email', $email), 'class'=>'input-sm form-control');
		echo form_input($data);
		?>

		<?php if($this->auth->check_access('Admin')) : ?>
		<p><?php echo lang('access');?></p>
		<?php
		$options = array(	'Admin'		=> 'Admin',
							'Staff'	=> 'Staff'
		                );
		echo form_dropdown('access', $options, set_value('phone', $access), 'class=form-control input-lg');
		?>
		<?php endif; ?>
		
		<p><?php echo lang('password');?></p>
		<?php
		$data	= array('name'=>'password','class'=>'input-sm form-control');
		echo form_password($data);
		?>

		<p><?php echo lang('confirm_password');?></p>
		<?php
		$data	= array('name'=>'confirm', 'class'=>'input-sm form-control');
		echo form_password($data);
		?>
		<p></p>
		<div class="form-actions">
			<input class="btn btn-primary" type="submit" value="<?php echo lang('save');?>"/>
		</div>
	
</form>



<script type="text/javascript">
$('form').submit(function() {
	$('.btn').attr('disabled', true).addClass('disabled');
});
</script>