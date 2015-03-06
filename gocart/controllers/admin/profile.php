<?php

class Profile extends Admin_Controller {

	//this is used when editing or adding a customer
	var $customer_id	= false;		
	
	//because of website has share to alot admin.... i cant tied with admin ID by: $this->current_admin['id']	
	//public $admin_id = $this->current_admin['id'];
	public $admin_id = 1;

	function __construct()
	{		
		parent::__construct();

		$this->load->model(array('Profile_model','Settings_model'));
		$this->load->helper('formatting_helper');
		$this->load->helper('form');
		
		$this->current_admin	= $this->session->userdata('admin');
		$lang = $this->session->userdata('lang');
		$this->lang->load('profile', $lang);
		
	}
	

	function process_upload(){

		// load other page content
		$this->load->helper('directory');

		$today_datetime = date("YmdHis");
		$today_date 	= date("Ymd");

		if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
		{
			############ Edit settings ##############
			//$UploadDirectory	= 'F:/Websites/file_upload/uploads/'; //specify upload directory ends with / (slash)


			if (empty($_POST['resume']))
			{
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['upload_path']		= 'uploads/profile/'.$today_date.'/';

				if (!is_dir($config['upload_path'])) {
					mkdir('./uploads/profile/' . $today_date, 0777, TRUE);
				}

			}else{
				$config['allowed_types'] 	= 'doc|txt|pdf';
				$config['upload_path']		= 'uploads/resume/'.$today_date.'/';

				if (!is_dir($config['upload_path'])) {
					mkdir('./uploads/resume/' . $today_date, 0777, TRUE);
				}
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

			if (!$this->upload->do_upload($file_element_name))
			{
				/* $status = 'error';
				 $msg = $this->upload->display_errors('', ''); */
				die('Error Found which is document is empty, please try again.');
			}else{
				$data = $this->upload->data();
				// full path is uploads/ [resume||profile] / [today-datetime] / [filename]
				$full_path = $config['upload_path'].$data['file_name'];
				$profile['id'] 		= $this->admin_id;

								
				if (isset($_POST['photo']) && !empty($_POST['photo']))
				{
					$title = $today_datetime.'-profile';
					$profile['image'] 	= $full_path;					
				}else{
					$profile['image'] 	= $full_path;
				}			

				
				

				//update member table for record resume or logo path to retrieve next day
				$file_id = $this->Profile_model->save_profile($profile);				
				
				
				if($file_id)
				{
					if (empty($_POST['photo']))
					{
					 echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="profile Logo" class="profile-logo" style="width:280px; height:180px;"/></div>';
					}
					else
					{
						echo '<a href="'. base_url($full_path).'">'.$data['file_name'].'</a>';
					}

				}
				else
				{
					unlink($data['full_path']);
					/* $status = "error";
					 $msg = "Something went wrong when saving the file, please try again."; */
					die('Something went wrong when saving the file, please try again.');
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
	
	
	
/* 	
	function index()
	{
		//we're going to use flash data and redirect() after form submissions to stop people from refreshing and duplicating submissions
		//$this->session->set_flashdata('message', 'this is our message');
		
		
		$data['profile']	= $this->Profile_model->get_profile(1);
				
		
		$this->view($this->config->item('admin_folder').'/profile', $data);
	} */
	
	function index()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		
		
		$data['page_title']		= lang('profile_form');
		
		//default values are empty if the profile is new
		$data['id']					= '';
		$data['display_name']		= '';
		$data['about_us']			= '';
		$data['seo_title']			= '';
		$data['meta']				= '';		
		$data['image']				= '';
		$data['location']			= '';
		$data['address']			= '';
		$data['office']				= '';
		$data['mobile']				= '';
		$data['facebook']			= '';
		$data['google_plus']		= '';
		$data['twitter']			= '';
		$data['pinterest']			= '';
		$data['linkedin']			= '';
		
						
		$profile					= $this->Profile_model->get_profile($this->admin_id);
				
		//set values to db values
		$data['id']					= $this->admin_id;
		$data['display_name']		= $profile['display_name'];
		$data['about_us']			= $profile['about_us'];				
		$data['seo_title']			= $profile['seo_title'];
		$data['meta']				= $profile['meta'];
		$data['image']				= $profile['image'];
		
		$data['location']			= $profile['location'];
		$data['address']			= $profile['address'];
		$data['office']				= $profile['office'];
		$data['mobile']				= $profile['mobile'];
		$data['facebook']			= $profile['facebook'];
		$data['google_plus']		= $profile['google_plus'];
		$data['twitter']			= $profile['twitter'];
		$data['pinterest']			= $profile['pinterest'];
		$data['linkedin']			= $profile['linkedin'];						
			
		//make sure we haven't submitted the form yet before we pull in the images/related profiles from the database
		if(!$this->input->post('submit'))
		{		
			$data['image']				= $profile['image'];
		}
					
		//no error checking on these
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta_data', 'trim');
		$this->form_validation->set_rules('display_name', 'lang:display_name', 'trim|max_length[64]');
		$this->form_validation->set_rules('about_us', 'lang:about_us', 'trim');	
		$this->form_validation->set_rules('location', 'lang:location', 'trim');
		$this->form_validation->set_rules('address', 'lang:address', 'trim');
		$this->form_validation->set_rules('office', 'lang:office', 'trim');
		$this->form_validation->set_rules('mobile', 'lang:mobile', 'trim');
		$this->form_validation->set_rules('facebook', 'lang:facebook', 'trim');
		$this->form_validation->set_rules('google_plus', 'lang:google_plus', 'trim');
		$this->form_validation->set_rules('twitter', 'lang:twitter', 'trim');
		$this->form_validation->set_rules('pinterest', 'lang:pinterest', 'trim');
		$this->form_validation->set_rules('linkedin', 'lang:linkedin', 'trim');
		
		
		
		if($this->input->post('submit'))
		{
			//reset the profile options that were submitted in the post
			$data['image']				= $this->input->post('image');				
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/profile', $data);
		}
		else
		{
			$this->load->helper('text');			
										
			$save['id']					= $this->admin_id;
			$save['display_name']		= $this->input->post('display_name');
			$save['seo_title']			= $this->input->post('seo_title');
			$save['meta']				= $this->input->post('meta');
			$save['about_us']			= $this->input->post('about_us');
			
			$save['location']			= $this->input->post('location');
			$save['address']			= $this->input->post('address');
			$save['office']				= $this->input->post('office');
			$save['mobile']				= $this->input->post('mobile');
			$save['facebook']			= $this->input->post('facebook');
			$save['google_plus']		= $this->input->post('google_plus');
			$save['twitter']			= $this->input->post('twitter');
			$save['pinterest']			= $this->input->post('pinterest');
			$save['linkedin']			= $this->input->post('linkedin');
			
			// save profile
			$profile_id	= $this->Profile_model->save_profile($save);
										
			$this->session->set_flashdata('message', lang('message_saved_profile'));
		
			//go back to the profile list
			redirect($this->config->item('admin_folder').'/profile');
		}
	}
	
	function service()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		$profile					= $this->Profile_model->get_profile($this->admin_id);
		$data['id']					= $this->admin_id;
		$data['service']			= $profile['service'];
		
		
		//make sure we haven't submitted the form yet before we pull in the images/related profiles from the database
		if(!$this->input->post('submit'))
		{
			$data['image']				= $profile['image'];
		}
			
		//no error checking on these
		$this->form_validation->set_rules('service', 'lang:service', 'trim');				
		
		if($this->input->post('submit'))
		{
			//reset the profile options that were submitted in the post
			$data['image']				= $this->input->post('image');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/service_form', $data);
		}
		else
		{
			$this->load->helper('text');
		
			$save['id']					= $this->admin_id;
			$save['service']			= $this->input->post('service');
				
			// save profile
			$profile_id	= $this->Profile_model->save_profile($save);
		
			$this->session->set_flashdata('message', lang('message_saved_service'));
		
			//go back to the profile list
			redirect($this->config->item('admin_folder').'/profile/service');
		}
								
	}
	
	function portfolio_form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$profile					= $this->Profile_model->get_profile($this->admin_id);
		$data['id']					= $this->admin_id;
		$data['portfolio']			= $profile['portfolio'];		
		
		//make sure we haven't submitted the form yet before we pull in the images/related profiles from the database
		if(!$this->input->post('submit'))
		{
			$data['image']				= $profile['image'];
		}
			
		//no error checking on these
		$this->form_validation->set_rules('portfolio', 'lang:portfolio', 'trim');
		
		if($this->input->post('submit'))
		{
			//reset the profile options that were submitted in the post
			$data['image']				= $this->input->post('image');
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/portfolio_form', $data);
		}
		else
		{
			$this->load->helper('text');
		
			$save['id']					= $this->admin_id;
			$save['portfolio']			= $this->input->post('portfolio');
		
			// save profile
			$profile_id	= $this->Profile_model->save_profile($save);
		
			$this->session->set_flashdata('message', lang('message_saved_portfolio'));
		
			//go back to the profile list
			redirect($this->config->item('admin_folder').'/profile/portfolio_form');
		}
	}
	
	function clients_form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$profile					= $this->Profile_model->get_profile($this->admin_id);
		$data['id']					= $this->admin_id;
		$data['client']				= $profile['clients'];
	
		//make sure we haven't submitted the form yet before we pull in the images/related profiles from the database
		if(!$this->input->post('submit'))
		{
			$data['image']				= $profile['image'];
		}
			
		//no error checking on these
		$this->form_validation->set_rules('client', 'lang:client', 'trim');
	
		if($this->input->post('submit'))
		{
			//reset the profile options that were submitted in the post
			$data['image']				= $this->input->post('image');
		}
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/client_form', $data);
		}
		else
		{
			$this->load->helper('text');
	
			$save['id']					= $this->admin_id;
			$save['clients']			= $this->input->post('client');
	
			// save profile
			$profile_id	= $this->Profile_model->save_profile($save);
	
			$this->session->set_flashdata('message', lang('message_saved_client'));
	
			//go back to the profile list
			redirect($this->config->item('admin_folder').'/profile/clients_form');
		}
	}
	
	function email_form()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');		
		$data['setting'] = $this->Settings_model->get_settings('gocart');
			
		//no error checking on these
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_check_email');

		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->config->item('admin_folder').'/email_form', $data);
		}
		else
		{
			$this->load->helper('text');
	
			//email setting
			$save['email']	= $this->input->post('email');
			$this->Settings_model->save_settings('gocart', $save);
			
			$this->session->set_flashdata('message', lang('message_saved_email'));
	
			//go back to the profile list
			redirect($this->config->item('admin_folder').'/profile/email_form');
		}
	}
	
}

