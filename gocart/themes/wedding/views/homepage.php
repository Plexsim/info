<div id="wrapper">

    <div id="content">
      
      <?php       		
      		$background_customise = isset($setting['image_background']) ? base_url($setting['image_background']) : theme_img('bg-wedding.jpg');
      		$background_color_customise = isset($setting['color_background']) ? '#'.$setting['color_background'] : '#edab4b';
      		$own_logo = isset($profile['image']) ? $profile['image'] : theme_img('/logo.png');
      ?>
      <div class="sliderbg_menu" style="background: url(<?php echo $background_customise ?>) no-repeat center center;background-attachment:fixed; -webkit-background-size: 100%; -moz-background-size: 100%;-o-background-size: 100%;background-size: 100%;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; background-size: cover;min-height:100%; background-color:<?php echo $background_color_customise ?>;">
      
                      
        <div class="logo"><a href="#">
	      	<img src="<?php echo $own_logo ?>" alt="" title="" border="0" /><span></span></a>
	      	<p><?php echo !empty($profile['display_name']) ? $profile['display_name'] : ''?></p>
        </div> 
        
        <nav id="menu">
        <ul>
        <li><a href="<?php echo base_url("contact_us");?>"><img src="<?php echo theme_img('icons/contact.png')?>" alt="" title="" /><span>Contact</span></a></li>        
        
        <?php 
			if(isset($this->pages) && !empty($this->pages)){	
			
			foreach($this->pages[0] as $menu_page):			
						
			$icon_default = !empty($menu_page->menu_default_icon) ? theme_img($menu_page->menu_default_icon) : theme_img('icons/layout.png');							
			$icon_customise = isset($menu_page->menu_icon) ? base_url($menu_page->menu_icon) : $icon_default;
			 
		?>
				
			<li><a href="<?php echo (!empty($menu_page->slug) && isset($menu_page->slug)) ? site_url($menu_page->slug) : $menu_page->url;?>" <?php if($menu_page->new_window ==1):{echo 'target="_blank"';} ?>> <img src="<?php echo $icon_customise ?>" alt="" title="" /> <span> <?php echo $menu_page->menu_title;?> </span></a> <?php else:?> <a href="<?php echo site_url($menu_page->slug);?>"> <img src="<?php echo $icon_customise ?>" width="112px" height="112px" alt="" title="" />  <span><?php echo $menu_page->menu_title;?></span> <?php endif; ?> </a></li>				
			<?php endforeach;} ?>
        
        </ul>
        </nav>
       <div class="clear"></div>  
     
     </div>
         
    </div>
</div>