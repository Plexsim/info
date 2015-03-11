<script type="text/javascript">
function areyousure()
{
	return confirm('<?php echo lang('confirm_delete');?>');
}
</script>

                 
                    <!-- Optional Row Classes -->                   
                    <div class="c-block" id="tableColored">
                     <?php if($this->auth->check_access('Admin')) : ?>
                     <div class="btn-group pull-right">
						<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/files/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_file');?></a>	
					</div>
					<?php endif;?>
                   <h3 class="block-title">Table with internal forms available for download</h3>
                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo lang('title');?></th>
                                    <th><?php echo lang('status');?></th>     
                                    <th><?php echo lang('action');?></th>                                    
                                </tr>
                            </thead>
                            <?php echo (count($files) < 1)?'<tbody><tr><td style="text-align:center;" colspan="3">'.lang('no_file_or_links').'</td></tr></tbody>':''?>
                            <?php if($files):?>
                            <tbody>
                            <?php
								$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
								foreach($files as $file){			
							?>
                                <tr class="active">
                                    <td><?php echo $file['title']; ?></td>
                                    <td><?php echo $file['status']; ?></td>
                                    <td>
	                                    <div class="btn-group pull-right">
											
											<?php if($this->auth->check_access('Admin')) : ?>
													<?php if(!empty($file['url'])): ?>
													<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/files/link_form/'.$file['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
													<a class="btn" href="<?php echo $file['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
												<?php else: ?>						
													<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/files/form/'.$file['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
												<?php endif; ?>
												<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/files/delete/'.$file['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
												<a class="btn btn-success" href="<?php echo base_url('uploads/'.$file['image'])?>" target="_blank">Download link</a>
												
											<?php else:?>												
												<a class="btn btn-success" href="<?php echo base_url('uploads/'.$file['image'])?>" target="_blank">Download link</a>
											<?php endif;?>
										</div>                                    
                                    </td>                                    
                                </tr>
                                
                            <?php		
							}
							?>                                   
                            </tbody>
                            <?php endif;?>
                        </table>
                    </div>
                </div>
               
              
