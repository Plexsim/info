<?php
class Themes extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->auth->check_access('Admin', true);
		$this->load->model('themes_model');
		$this->load->model('settings_model');
		$lang = $this->session->userdata('lang');
		$this->lang->load('themes', $lang);	
		$this->load->helper('form');
	}
		
	function index()
	{
		$data['themes_title']	= lang('themes');
		/* $data['event']		= $this->event_model->get_list(); */	
		$this->load->library('form_validation');
	
		$data['themes']	= $this->themes_model->themes();	
		$data['current_theme']	= $this->settings_model->current_theme();				
		
		//set values to db values
								
		$submitted		= $this->input->post('submit');
		
		if($submitted){
			$this->form_validation->set_rules('theme', 'lang:theme', 'trim|required');
			
			// Validate the form
			if($this->form_validation->run() == false)
			{
				$this->view($this->config->item('admin_folder').'/themes_form', $data);
			}
			else
			{
				
			}			
			
			$save['setting']		= $this->input->post('theme');			
			$this->settings_model->change_themes($save);			
			//go back to the event list
			redirect($this->config->item('admin_folder').'/themes');
			
		}
												
		$this->view($this->config->item('admin_folder').'/themes_form', $data);
	}
	
	
	/********************************************************************
	edit event
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'gif|jpg|png';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['date']	= '';
		$data['date_to']	= '';
		$data['time']		= '';
		$data['time_to']		= '';
		$data['event']	= '';
		$data['venue']	= '';
		$data['status']		= '';		
		$data['brands']		= '';
		$data['event_title']	= lang('event_form');
		
		if($id)
		{
			
			$event			= $this->event_model->get_event($id);
			
			if(!$event)
			{
				//event does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/event');
			}
						
			//set values to db values
			$data['id']				= $event['id'];	
			$data['date']			= date('d-m-Y', strtotime($event['date']));
			$data['date_to']			= date('d-m-Y', strtotime($event['date_to']));
			$data['time']			= $event['time'];
			$data['time_to']			= $event['time_to'];
			$data['event']			= $event['event'];
			$data['venue']			= $event['venue'];			
			$data['brands']			= $event['brands'];
			$data['status']			= $event['status'];
		}
		
		
		
		$this->form_validation->set_rules('date', 'lang:date', 'trim|required');
		$this->form_validation->set_rules('date_to', 'lang:date_to', 'trim');
		$this->form_validation->set_rules('time', 'lang:time', 'trim|required');
		$this->form_validation->set_rules('time_to', 'lang:time_to', 'trim|required');
		$this->form_validation->set_rules('event', 'lang:event', 'trim|required');
		$this->form_validation->set_rules('venue', 'lang:venue', 'trim|required');
		$this->form_validation->set_rules('brands', 'lang:brands', 'trim');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/event_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
						
			$save['date']		= date('Y-m-d', strtotime($this->input->post('date')));		
			$save['date_to']	= date('Y-m-d', strtotime($this->input->post('date_to')));
			$save['time']		= $this->input->post('time');
			$save['time_to']	= $this->input->post('time_to');
			
			$save['event']		= $this->input->post('event');									
			$save['venue']		= $this->input->post('venue');
			$save['brands']		= $this->input->post('brands');
			$save['status']		= $this->input->post('status');
			
			$save['id']			= $id;								
			
			//save the event
			$event_id	= $this->event_model->save_event($save);
									
			$this->session->set_flashdata('message', lang('message_saved_event'));
			
			//go back to the event list
			redirect($this->config->item('admin_folder').'/event');
		}
	}
	
	/********************************************************************
	 edit color setting
	********************************************************************/
	function custom_background()
	{
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('Settings_model');
			
		$this->load->library('form_validation');
		$this->load->helper('text');
		$save = array();
		$data = $this->Settings_model->get_settings('gocart');
				
		//make sure we haven't submitted the form yet before we pull in the images/related profiles from the database
		
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('picker', 'lang:picker', 'trim');
			// Validate the form
			if($this->form_validation->run() == false)
			{
				$this->view($this->config->item('admin_folder').'/custom_background', $data);
			}
			else
			{
				//color template
				$save['color_background']	= $this->input->post('picker');
				$this->Settings_model->save_settings('gocart', $save);
			
				$this->session->set_flashdata('message', lang('message_saved_theme'));
				//go back to the event list
				redirect($this->config->item('admin_folder').'/themes/custom_background');
			}	
		}else{
			$this->view($this->config->item('admin_folder').'/custom_background', $data);
		}

		

	}

	function process_upload(){
		
		// load other page content
		$this->load->helper('directory');
		$this->load->library("UploadHandler");

		$today_datetime = date("YmdHis");
		$today_date 	= date("Ymd");

		if(isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"]== UPLOAD_ERR_OK)
		{
			############ Edit settings ##############
			//$UploadDirectory	= 'F:/Websites/file_upload/uploads/'; //specify upload directory ends with / (slash)


			
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['upload_path']		= 'uploads/background/'.$today_date.'/';

			if (!is_dir($config['upload_path'])) {
				mkdir('./uploads/background/' . $today_date, 0777, TRUE);
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
// 			if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){			
			/* if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){ */
// 				die('this is httpx');
// 			}

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
				


				if (isset($_POST['photo']) && !empty($_POST['photo']))
				{
					$title = $today_datetime.'-background';
					$save['image_background'] 	= $full_path;
				}else{
					$save['image_background'] 	= $full_path;
				}

				
				//update member table for record background or logo path to retrieve next day
				$this->Settings_model->save_settings('gocart', $save);

				
				if (empty($_POST['photo']))
				{
					echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="Background" class="image-background" style="width:100px; height:150px;"/></div>';								
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
		$save['image_background'] 	= null;
		$this->Settings_model->save_settings('gocart', $save);
		echo 'success';		
	}
	
	public function do_upload() {
		 
		$upload_path_url = base_url() . 'uploads/';
	
		$config['upload_path'] = FCPATH . 'uploads/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = '30000';
	
		$this->load->library('upload', $config);
	
		if (!$this->upload->do_upload()) {
			//$error = array('error' => $this->upload->display_errors());
			//$this->load->view('upload', $error);
	
			//Load the list of existing files in the upload directory
			$existingFiles = get_dir_file_info($config['upload_path']);
			$foundFiles = array();
			$f=0;
			foreach ($existingFiles as $fileName => $info) {
				if($fileName!='thumbs'){//Skip over thumbs directory
					//set the data for the json array
					$foundFiles[$f]['name'] = $fileName;
					$foundFiles[$f]['size'] = $info['size'];
					$foundFiles[$f]['url'] = $upload_path_url . $fileName;
					$foundFiles[$f]['thumbnailUrl'] = $upload_path_url . 'thumbs/' . $fileName;
					$foundFiles[$f]['deleteUrl'] = base_url() . 'admin/themes/deleteImage/' . $fileName;
					$foundFiles[$f]['deleteType'] = 'DELETE';
					$foundFiles[$f]['error'] = null;
	
					$f++;
				}
			}
			$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array('files' => $foundFiles)));
		} else {
			$data = $this->upload->data();
			/*
			 * Array
			(
					[file_name] => png1.jpg
					[file_type] => image/jpeg
					[file_path] => /home/ipresupu/public_html/uploads/
					[full_path] => /home/ipresupu/public_html/uploads/png1.jpg
					[raw_name] => png1
					[orig_name] => png.jpg
					[client_name] => png.jpg
					[file_ext] => .jpg
					[file_size] => 456.93
					[is_image] => 1
					[image_width] => 1198
					[image_height] => 1166
					[image_type] => jpeg
					[image_size_str] => width="1198" height="1166"
			)
			*/
			// to re-size for thumbnail images un-comment and set path here and in json array
			$config = array();
			$config['image_library'] = 'gd2';
			$config['source_image'] = $data['full_path'];
			$config['create_thumb'] = TRUE;
			$config['new_image'] = $data['file_path'] . 'thumbs/';
			$config['maintain_ratio'] = TRUE;
			$config['thumb_marker'] = '';
			$config['width'] = 75;
			$config['height'] = 50;
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
	
	
			//set the data for the json array
			$info = new StdClass;
			$info->name = $data['file_name'];
			$info->size = $data['file_size'] * 1024;
			$info->type = $data['file_type'];
			$info->url = $upload_path_url . $data['file_name'];
			// I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
			$info->thumbnailUrl = $upload_path_url . 'thumbs/' . $data['file_name'];
			$info->deleteUrl = base_url() . 'admin/themes/deleteImage/' . $data['file_name'];
			$info->deleteType = 'DELETE';
			$info->error = null;
	
			$files[] = $info;
			//this is why we put this in the constants to pass only json data
			if (IS_AJAX) {
				echo json_encode(array("files" => $files));
				//this has to be the only data returned or you will get an error.
				//if you don't give this a json array it will give you a Empty file upload result error
				//it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
				// so that this will still work if javascript is not enabled
			} else {
				$file_data['upload_data'] = $this->upload->data();
				$this->view($this->config->item('admin_folder').'/upload_success', $file_data);
			}
		}
	}
	
	public function deleteImage($file) {//gets the job done but you might want to add error checking and security
		$success = unlink(FCPATH . 'uploads/' . $file);
		$success = unlink(FCPATH . 'uploads/thumbs/' . $file);
		//info to see if it is doing what it is supposed to
		$info = new StdClass;
		$info->sucess = $success;
		$info->path = base_url() . 'uploads/' . $file;
		$info->file = is_file(FCPATH . 'uploads/' . $file);
	
		if (IS_AJAX) {
			//I don't think it matters if this is set but good for error checking in the console/firebug
			echo json_encode(array($info));
		} else {
			//here you will need to decide what you want to show for a successful delete
			$file_data['delete_data'] = $file;
			$this->load->view($this->config->item('admin_folder').'/delete_success', $file_data);
		}
	}
	
	function modern_upload()
	{			
		$this->view($this->config->item('admin_folder').'/modern_upload');
	}
	


}	