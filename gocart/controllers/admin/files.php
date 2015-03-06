<?php
class Files extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('file_model');
		
		$lang = $this->session->userdata('lang');
		$this->lang->load('file', $lang);		
	}
		
	function index()
	{
		$data['file_title']	= lang('file');
		$data['files']		= $this->file_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/files', $data);
	}
	
	/********************************************************************
	edit file
	********************************************************************/
	function form($id = false)
	{
		$this->load->helper('url');
		$this->load->helper('form');
						
		$config['upload_path']		= 'uploads';
		$config['allowed_types']	= 'csv|pdf|xls|gtar|gz|tar|tgz|zip|rar|png|jpg|jpe|jpeg|gif|txt|text|doc|docx|xlsx|xlt|word|odt|odf|ods|ots';
		$config['max_size']			= $this->config->item('size_limit');
		$config['encrypt_name']		= true;
		$this->load->library('upload', $config);
		$this->load->library('form_validation');
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['caption']	= '';
		$data['content']	= '';
		$data['sequence']	= 0;
		$data['seo_title']	= '';
		$data['meta']		= '';		
		$data['enable_date']		= '';
		$data['disable_date']		= '';
		$data['image']		= '';
		$data['status']		= '';
		
		$data['file_title']	= lang('file_form');
		$data['files']		= $this->file_model->get_list();
		
		if($id)
		{
			
			$file			= $this->file_model->get_file($id);
			
			if(!$file)
			{
				//file does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/files');
			}
						
			//set values to db values
			$data['id']				= $file['id'];			
			$data['title']			= $file['title'];
			$data['caption']		= $file['caption'];
			$data['content']		= $file['content'];
			$data['sequence']		= $file['sequence'];
			$data['seo_title']		= $file['seo_title'];
			$data['meta']			= $file['meta'];
			$data['enable_date']	= $file['enable_date'];
			$data['disable_date']	= $file['disable_date'];
			$data['image']			= $file['image'];
			$data['status']			= $file['status'];
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('caption', 'lang:caption', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		$this->form_validation->set_rules('enable_date', 'lang:enable_date', 'trim');
		$this->form_validation->set_rules('disable_date', 'lang:disable_date', 'trim');
		$this->form_validation->set_rules('image', 'lang:image', 'trim');
		$this->form_validation->set_rules('seo_title', 'lang:seo_title', 'trim');
		$this->form_validation->set_rules('meta', 'lang:meta', 'trim');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('status', 'lang:status', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->config->item('admin_folder').'/file_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			$uploaded	= $this->upload->do_upload('image');
			
			$save = array();
			
			$save['title']		= $this->input->post('title');
			$save['sequence']	= $this->input->post('sequence');
			$save['content']	= $this->input->post('content');						
			
			$save['seo_title']	= $this->input->post('seo_title');
			$save['meta']		= $this->input->post('meta');
			$save['status']		= $this->input->post('status');
				
								
			if ($id)
			{
				$save['id']			= $id;
			
				//delete the original file if another is uploaded
				if($uploaded)
				{
					if($data['image'] != '')
					{
						$file = 'uploads/'.$data['image'];
			
						//delete the existing file if needed
						if(file_exists($file))
						{
							unlink($file);
						}
					}
				}
			
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/file_form', $data);
					return; //end script here if there is an error
				}
			}
				
			if($uploaded)
			{
				$image			= $this->upload->data();
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the file
			$file_id	= $this->file_model->save_file($save);
									
			$this->session->set_flashdata('message', lang('message_saved_file'));
			
			//go back to the file list
			redirect($this->config->item('admin_folder').'/files');
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

		
		$data['file_title']	= lang('link_form');
		$data['files']		= $this->file_model->get_list();
		if($id)
		{
			$file			= $this->file_model->get_file($id);

			if(!$file)
			{
				//file does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/files');
			}
			
			
			//set values to db values
			$data['id']			= $file->id;
			$data['parent_id']	= $file->parent_id;
			$data['title']		= $file->title;
			$data['url']		= $file->url;
			$data['new_window']	= (bool)$file->new_window;
			$data['sequence']	= $file->sequence;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('sequence', 'lang:sequence', 'trim|integer');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		$this->form_validation->set_rules('parent_id', 'lang:parent_id', 'trim|integer');
		
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
			
			//save the file
			$this->file_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the file list
			redirect($this->config->item('admin_folder').'/files');
		}
	}
	
	/********************************************************************
	delete file
	********************************************************************/
	function delete($id)
	{
		
		$file	= $this->file_model->get_file($id);
		
		if($file)
		{
			$this->file_model->delete_file($id);
			$this->session->set_flashdata('message', lang('message_deleted_file'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/files');
	}
}	