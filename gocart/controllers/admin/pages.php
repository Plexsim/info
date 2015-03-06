<?php
class Pages extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('Page_model');
		$lang = $this->session->userdata('lang');
		$this->lang->load('page', $lang);
	}
		
	function index()
	{
		$data['page_title']	= lang('pages');
		$data['pages']		= $this->Page_model->get_pages();
		
		
		$this->view($this->config->item('admin_folder').'/pages', $data);
	}
	
	/********************************************************************
	edit page
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['menu_title']	= '';
		$data['slug']		= '';
		$data['sequence']	= 0;
		$data['parent_id']	= 0;
		$data['content']	= '';
		$data['seo_title']	= '';
		$data['meta']		= '';
		$data['colour']		= '';
		
		$data['page_title']	= lang('page_form');
		$data['pages']		= $this->Page_model->get_pages();
		$data['default_arrow'] = base_url('assets/img/arrow.png');
		
		if($id)
		{
			
			$page			= $this->Page_model->get_page($id);

			if(!$page)
			{
				//page does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/pages');
			}
			
			
			//set values to db values
			$data['id']				= $page->id;
			$data['parent_id']		= $page->parent_id;
			$data['title']			= $page->title;
			$data['menu_title']		= $page->menu_title;
			$data['sequence']		= $page->sequence;
			$data['content']		= $page->content;
			$data['seo_title']		= $page->seo_title;
			$data['meta']			= $page->meta;
			$data['slug']			= $page->slug;
			$data['colour']			= $page->colour;
			$data['menu_icon']		= $page->menu_icon;
			$data['menu_default_icon']	= $page->menu_default_icon;
			
			
						
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('menu_title', 'lang:menu_title', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('picker', 'lang:colour', 'trim');
		$this->form_validation->set_rules('menu_default_icon', 'lang:icon_default', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/page_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			//first check the slug field
			$slug = $this->input->post('slug');
			
			//if it's empty assign the name field
			if(empty($slug) || $slug=='')
			{
				$slug = $this->input->post('title');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			$this->load->model('Routes_model');
			if($id)
			{
				$slug		= $this->Routes_model->validate_slug($slug, $page->route_id);
				$route_id	= $page->route_id;
			}
			else
			{
				$slug			= $this->Routes_model->validate_slug($slug);
				$route['slug']	= $slug;	
				$route_id		= $this->Routes_model->save($route);
			}
			
			
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('menu_title'); 
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['colour']		= $this->input->post('picker');						
			
			$save['menu_default_icon']	= $this->input->post('selected-text');
			$save['route_id']	= $route_id;
			$save['slug']		= $slug;
			
			//set the menu title to the page title if if is empty
			if ($save['menu_title'] == '')
			{
				$save['menu_title']	= $this->input->post('title');
			}
			
			//save the page
			$page_id	= $this->Page_model->save($save);
			
			//save the route
			$route['id']	= $route_id;
			$route['slug']	= $slug;
			$route['route']	= 'cart/page/'.$page_id;
			
			$this->Routes_model->save($route);
			
			$this->session->set_flashdata('message', lang('message_saved_page'));
			
			//go back to the page list
			redirect($this->config->item('admin_folder').'/pages');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['new_window']	= false;
		$data['sequence']	= 0;
		$data['parent_id']	= 0;
		$data['colour']		= '';
		$data['menu_icon']	= '';
		$data['menu_default_icon']	= '';
		
		$data['page_title']	= lang('link_form');
		$data['pages']		= $this->Page_model->get_pages();
		$data['default_arrow'] = base_url('assets/img/arrow.png');
		if($id)
		{
			$page			= $this->Page_model->get_page($id);

			if(!$page)
			{
				//page does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/pages');
			}
			
			
			//set values to db values
			$data['id']			= $page->id;
			$data['parent_id']	= $page->parent_id;
			$data['title']		= $page->title;
			$data['url']		= $page->url;
			$data['new_window']	= (bool)$page->new_window;
			$data['sequence']	= $page->sequence;
			$data['colour']			= $page->colour;
			$data['menu_icon']		= $page->menu_icon;
			$data['menu_default_icon']	= $page->menu_default_icon;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		$this->form_validation->set_rules('picker', 'lang:colour', 'trim');
		$this->form_validation->set_rules('menu_default_icon', 'lang:icon_default', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['parent_id']	= $this->input->post('parent_id');
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['sequence']	= $this->input->post('sequence');
			$save['new_window']	= $this->input->post('new_window');
			$save['colour']		= $this->input->post('picker');				
			$save['menu_default_icon']	= $this->input->post('selected-text');
			
			//save the page
			$this->Page_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the page list
			redirect($this->config->item('admin_folder').'/pages');
		}
	}
	
	/********************************************************************
	delete page
	********************************************************************/
	function delete($id)
	{
		
		$page	= $this->Page_model->get_page($id);
		
		if($page)
		{
			$this->load->model('Routes_model');
			
			$this->Routes_model->delete($page->route_id);
			$this->Page_model->delete_page($id);
			$this->session->set_flashdata('message', lang('message_deleted_page'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/pages');
	}
	
	function process_upload($id)
	{
				
		// load other page content
		$this->load->helper('directory');

		$today_datetime = date("YmdHis");
		$today_date 	= date("Ymd");

		if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
		{
			############ Edit settings ##############
			//$UploadDirectory	= 'F:/Websites/file_upload/uploads/'; //specify upload directory ends with / (slash)

				
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['upload_path']		= 'uploads/icon/'.$today_date.'/';

			if (!is_dir($config['upload_path'])) {
				mkdir('./uploads/icon/' . $today_date, 0777, TRUE);
			}



			$config['max_size'] 		= 1024 * 8;
			$config['encrypt_name'] 	= TRUE;
			//$config['overwrite'] 		= FALSE; //overwrite user avatar
			$config['remove_spaces'] 	= true;

			$this->load->library('upload', $config);
			##########################################
			/*
			 Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
			 Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
			 and set them adequately, also check "post_max_size".
			*/

			//check if this is an ajax request
			if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
				die('this is httpx');
			}

			//Is file size is less than allowed size.
			if ($_FILES["FileInput"]["size"] > 5242880) {
				die("File size is too big!");
			}


			if (empty($_POST['photo']))
			{
				//allowed file type Server side check
				switch(strtolower($_FILES['FileInput']['type']))
				{
					//allowed file types
					case 'image/png':
					case 'image/gif':
					case 'image/jpeg':
					case 'image/pjpeg':
						break;
					default:
						die('Unsupported File!'); //output error

						/* case 'text/plain':
						 case 'text/html': //html file
						case 'application/x-zip-compressed':
						case 'application/pdf':
						case 'application/msword':
						case 'application/vnd.ms-excel':
						case 'video/mp4': */
				}
			}
			else
			{
				//allowed file type Server side check
				switch(strtolower($_FILES['FileInput']['type']))
				{
					//allowed file types
					case 'text/plain':
					case 'text/html': //html file
					case 'application/x-zip-compressed':
					case 'application/pdf':
					case 'application/msword':
					case 'application/vnd.ms-excel':
					case 'video/mp4':
						break;
					default:
						die('Unsupported File!'); //output error
				}

			}

			//Normal PHP without framework
			/* $File_Name          = strtolower($_FILES['FileInput']['name']);
				$File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
			$Random_Number      = rand(0, 9999999999); //Random number to be added to name.
			$NewFileName 		= $Random_Number.$File_Ext; //new file name */

			// this is the name at HTML <input type=file name=FileInput>
			$file_element_name = 'FileInput';
			$uploaded	= $this->upload->do_upload($file_element_name);

			if (!$this->upload->do_upload($file_element_name))
			{
				/* $status = 'error';
					$msg = $this->upload->display_errors('', ''); */
				die('Error Found which is document is empty, please try again.');
			}else{
				$data = $this->upload->data();
				// full path is uploads/ [resume||background] / [today-datetime] / [filename]
				$full_path = $config['upload_path'].$data['file_name'];

				$save = array();
				$save['id']			= $id;				

				if (isset($_POST['photo']) && !empty($_POST['photo']))
				{
					$title = $today_datetime.'-icon';
					$save['menu_icon'] 	= $full_path;
				}else{
					$save['menu_icon'] 	= $full_path;
				}
				
					
				//save the page
				$this->Page_model->save($save);				

				if (empty($_POST['photo']))
				{
					echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="Background" class="image-background" style="width:48px; height:48px;"/></div>';
				}
				else
				{
					echo '<a href="'. base_url($full_path).'">'.$data['file_name'].'</a>';
				}


			}
			@unlink($_FILES[$file_element_name]);
			/* if(move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory.$NewFileName ))
			 {
			die('Success! File Uploaded.');
			}else{
			die('error uploading File!');
			} */

		}
		else
		{
			die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
		}

	}
	

	function remove_uploaded(){
		$save['menu_icon'] 	= null;
		$save['id']			= $this->input->post('id');
		$this->Page_model->save($save);
		echo 'success';
	}
}	