<?php
class Training_Resource extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('training_resource_model');
		
		$lang = $this->session->userdata('lang');
		$this->lang->load('training_resource', $lang);		
	}
		
	function index()
	{
		$data['training_resource_title']	= lang('training_resource');
		$data['training_resources']		= $this->training_resource_model->get_list();								
		
		$this->view($this->config->item('admin_folder').'/training_resource', $data);
	}
	
	/********************************************************************
	edit training_resource
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
		
		$data['training_resource_title']	= lang('training_resource_form');
		$data['training_resources']		= $this->training_resource_model->get_list();
		
		if($id)
		{
			
			$training_resource			= $this->training_resource_model->get_resource($id);
			
			if(!$training_resource)
			{
				//training_resource does not exist
				$this->session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->config->item('admin_folder').'/training_resource');
			}
						
			//set values to db values
			$data['id']				= $training_resource['id'];			
			$data['title']			= $training_resource['title'];
			$data['caption']		= $training_resource['caption'];
			$data['content']		= $training_resource['content'];
			$data['sequence']		= $training_resource['sequence'];
			$data['seo_title']		= $training_resource['seo_title'];
			$data['meta']			= $training_resource['meta'];
			$data['enable_date']	= $training_resource['enable_date'];
			$data['disable_date']	= $training_resource['disable_date'];
			$data['image']			= $training_resource['image'];
			$data['status']			= $training_resource['status'];
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
			$this->view($this->config->item('admin_folder').'/resource_form', $data);
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
						$training_resource = 'uploads/'.$data['image'];
			
						//delete the existing file if needed
						if(file_exists($training_resource))
						{
							unlink($training_resource);
						}
					}
				}else{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/resource_form', $data);
					return; //end script here if there is an error
				}
			
			}
			else
			{
				if(!$uploaded)
				{
					$data['error']	= $this->upload->display_errors();
					$this->view(config_item('admin_folder').'/resource_form', $data);
					return; //end script here if there is an error
				}
			}

			
			if($uploaded)
			{
				$image			= $this->upload->data();
				
				
				$save['image']	= $image['file_name'];
			}
			
			
			
			//save the file
			$file_id	= $this->training_resource_model->save_resource($save);
									
			$this->session->set_flashdata('message', lang('message_saved_resource'));
			
			//go back to the training_resource list
			redirect($this->config->item('admin_folder').'/training_resource');
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

		
		$data['training_resource_title']	= lang('link_form');
		$data['training_resources']		= $this->training_resource_model->get_list();
		if($id)
		{
			$training_resource			= $this->training_resource_model->get_resource($id);

			if(!$training_resource)
			{
				//training_resource does not exist
				$this->session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->config->item('admin_folder').'/training_resource');
			}
			
			
			//set values to db values
			$data['id']			= $training_resource->id;
			$data['parent_id']	= $training_resource->parent_id;
			$data['title']		= $training_resource->title;
			$data['url']		= $training_resource->url;
			$data['new_window']	= (bool)$training_resource->new_window;
			$data['sequence']	= $training_resource->sequence;
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
			
			//save the training_resource
			$this->training_resource_model->save($save);
			
			$this->session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the training_resource list
			redirect($this->config->item('admin_folder').'/training_resource');
		}
	}
	
	/********************************************************************
	delete training_resource
	********************************************************************/
	function delete($id)
	{
		
		$training_resource	= $this->training_resource_model->get_resource($id);
		
		if($training_resource)
		{
			$this->training_resource_model->delete_resource($id);
			$this->session->set_flashdata('message', lang('message_deleted_resource'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('error_page_not_found'));
		}
		
		redirect($this->config->item('admin_folder').'/training_resource');
	}
}	