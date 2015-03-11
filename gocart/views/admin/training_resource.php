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
						<a class="btn" href="<?php echo site_url($this->config->item('admin_folder').'/training_resource/form'); ?>"><i class="icon-plus-sign"></i> <?php echo lang('add_new_resource');?></a>	
					</div>
					<?php endif;?>
                   <h3 class="block-title">Table with training resource available for download</h3>
                   
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo lang('title');?></th>
                                    <th><?php echo lang('status');?></th>     
                                    <th><?php echo lang('action');?></th>                                    
                                </tr>
                            </thead>
                            <?php echo (count($training_resources) < 1)?'<tr><td style="text-align:center;" colspan="3">'.lang('no_resource_or_links').'</td></tr>':''?>
                            <?php if($training_resources):?>
                            <tbody>
                            <?php
								$GLOBALS['admin_folder'] = $this->config->item('admin_folder');		
								foreach($training_resources as $training_resource){			
							?>
                                <tr class="active">
                                    <td><?php echo $training_resource['title']; ?></td>
                                    <td><?php echo $training_resource['status']; ?></td>
                                    <td>
	                                    <div class="btn-group pull-right">
											
											<?php if($this->auth->check_access('Admin')) : ?>
													<?php if(!empty($training_resource['url'])): ?>
													<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/training_resource/link_form/'.$training_resource['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>
													<a class="btn" href="<?php echo $training_resource['url'];?>" target="_blank"><i class="icon-play-circle"></i> <?php echo lang('follow_link');?></a>
												<?php else: ?>						
													<a class="btn" href="<?php echo site_url($GLOBALS['admin_folder'].'/training_resource/form/'.$training_resource['id']); ?>"><i class="icon-pencil"></i> <?php echo lang('edit');?></a>						
												<?php endif; ?>
												<a class="btn btn-danger" href="<?php echo site_url($GLOBALS['admin_folder'].'/training_resource/delete/'.$training_resource['id']); ?>" onclick="return areyousure();"><i class="icon-trash icon-white"></i> <?php echo lang('delete');?></a>
												<a class="btn btn-success" href="<?php echo base_url('uploads/'.$training_resource['image'])?>" target="_blank">Download link</a>
												
											<?php else:?>												
												<a class="btn btn-success" href="<?php echo base_url('uploads/'.$training_resource['image'])?>" target="_blank">Download link</a>
											<?php endif;?>
										</div>                                    
                                    </td>                                    
                                </tr>
                                
                            <?php		
							}
							?>                                   
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                <?php endif;?>
              
