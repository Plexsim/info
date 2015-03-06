<?php include('header.php'); ?>
    

<?php echo form_open($this->config->item('admin_folder').'/login') ?>
    
	    <div class="lbox-horz" >
	    	 <div class="logo_login_horizontal"><img src="<?php echo base_url('assets/img/login-logo.png')?>" title="Thunder Match Staff Site"></div>
	    </div>

        <div class="lbox-vert">
        	 <div class="logo_login_vertical">Thunder Match Staff Site</div>
           	 <!--div class="logo_login_vertical"><img width="200px" src="<?php echo base_url('assets/img/login-logo.png')?>" title="Thunder Match Staff Site"></div-->
        </div>
        
        <div class="login-box side-form">
            	
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
            	
                <div class="form-group">
                	<?php echo form_input(array('name'=>'username', 'class'=>'input-sm validate[required,custom[email]] form-control', 'placeholder'=>lang('username'))); ?>                    
                </div>
                <div class="form-group">
                	<?php echo form_password(array('name'=>'password', 'class'=>'input-sm validate[required] form-control', 'placeholder'=>lang('password'))); ?>                                   
                </div>
                
                <div class="form-group">
                	 <span class="checkbox">
                	 	<?php echo form_checkbox(array('name'=>'remember', 'value'=>'true'))?>
            			<?php echo lang('stay_logged_in');?>
            		 </span>
                </div>            	    
                <input type="submit" class="btn btn-gr-gray btn-block btn-xs" value="<?php echo lang('login');?>">
              	<input type="hidden" value="<?php echo $redirect; ?>" name="redirect"/>
        		<input type="hidden" value="submitted" name="submitted"/>
        </div>
<?php echo  form_close(); ?>   
      
            

<?php include('footer.php'); ?>