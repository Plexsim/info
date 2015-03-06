<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {
	
	//public $admin_id = $this->current_admin['id'];
	public $admin_id = 1;
	
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file', 'text'));             
     
        $this->load->model(array('Settings_model', 'Customer_model', 'Page_model', 'Profile_model'));
        
    }

    public function index() {
        $this->load->view('admin/upload', array('error' => ''));
    }
    
    public function basic() {
    	$this->load->view('upload/basic_upload', array('error' => ''));
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
                $foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
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
            $info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
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
                $this->load->view('upload/upload_success', $file_data);
            }
        }
    }
    
    public function upload_background() {
    	 
    	$today_date 	= date("Ymd");
    	$upload_path_url = base_url() . 'uploads/background/'.$today_date.'/';
    	
    	//$config['upload_path'] = FCPATH . 'uploads/';
    	$config['upload_path']		= FCPATH . 'uploads/background/'.$today_date.'/';
    	
    	
    	if (!is_dir($config['upload_path'])) {
    		mkdir('./uploads/background/' . $today_date, 0777, TRUE);
    		mkdir('./uploads/background/' . $today_date.'/thumbs', 0777, TRUE);
    	}    	
    	
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
    				$foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
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
    		
    		
    		//echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="Background" class="image-background" style="width:100px; height:150px;"/></div>';
    		
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
    		$info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
    		$info->deleteType = 'DELETE';
    		$info->error = null;
    		
    		
    		$full_path = 'uploads/background/'.$today_date.'/'.$data['file_name'];
    		$save = array();
    		$save['image_background'] 	= $full_path;
    		//$this->load->model('Settings_model');
    		//update member table for record background or logo path to retrieve next day
    		$this->Settings_model->save_settings('gocart', $save);
    		
    		    		
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
    			$this->load->view('upload/upload_success', $file_data);
    		}
    	}
    }
    
    public function upload_icon($id){
    	
    	$today_date 	= date("Ymd");
    	$upload_path_url = base_url() . 'uploads/icon/'.$today_date.'/';
    	
    	
    	 
    	//$config['upload_path'] = FCPATH . 'uploads/';
    	$config['upload_path']		= FCPATH . 'uploads/icon/'.$today_date.'/';
    	 
    	 
    	if (!is_dir($config['upload_path'])) {
    		mkdir('./uploads/icon/' . $today_date, 0777, TRUE);
    		mkdir('./uploads/icon/' . $today_date.'/thumbs', 0777, TRUE);
    	}
    	 
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
    				$foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
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
    	
    	
    		//echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="Background" class="image-background" style="width:100px; height:150px;"/></div>';
    	
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
    		$info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
    		$info->deleteType = 'DELETE';
    		$info->error = null;
    	
    	
    		$full_path = 'uploads/icon/'.$today_date.'/'.$data['file_name'];
    		$save = array();
    		$save['id']			= $id;
    		$save['menu_icon'] 	= $full_path;
    		//$this->load->model('Settings_model');
    		//update member table for record background or logo path to retrieve next day
    		//save the page
    		$this->Page_model->save($save);
    	
    	
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
    			$this->load->view('upload/upload_success', $file_data);
    		}
    	}
    	
    }
    
    public function upload_profile(){
    	 
    	$today_date 	= date("Ymd");
    	$upload_path_url = base_url() . 'uploads/profile/'.$today_date.'/';
    
    	//$config['upload_path'] = FCPATH . 'uploads/';
    	$config['upload_path']		= FCPATH . 'uploads/profile/'.$today_date.'/';
    
    
    	if (!is_dir($config['upload_path'])) {
    		mkdir('./uploads/profile/' . $today_date, 0777, TRUE);
    		mkdir('./uploads/profile/' . $today_date.'/thumbs', 0777, TRUE);
    	}
    
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
    				$foundFiles[$f]['deleteUrl'] = base_url() . 'upload/deleteImage/' . $fileName;
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
    		 
    		 
    		//echo '<div class="step-by-inner-img2"><img src='.base_url($full_path).' alt="Background" class="image-background" style="width:100px; height:150px;"/></div>';
    		 
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
    		$info->deleteUrl = base_url() . 'upload/deleteImage/' . $data['file_name'];
    		$info->deleteType = 'DELETE';
    		$info->error = null;
    		 
    		 
    		$full_path = 'uploads/profile/'.$today_date.'/'.$data['file_name'];
    		$save = array();
    		$save['id']			= $this->admin_id;
    		$save['image'] 	= $full_path;
    		//$this->load->model('Settings_model');
    		//update member table for record background or logo path to retrieve next day
    		//save the page
    		$this->Profile_model->save_profile($save);		
    		 
    		 
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
    			$this->load->view('upload/upload_success', $file_data);
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
            $this->load->view('admin/delete_success', $file_data);
        }
    }

}