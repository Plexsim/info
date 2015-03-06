<?php
Class File_Model extends CI_Model
{

	/********************************************************************
	file Custom functions
	********************************************************************/
	function __construct()
	{
			parent::__construct();
	}	
	
	function get_list()
	{		
		if(!$this->auth->check_access('Admin')) :
			$this->db->where('status', 'Enable');
		endif;
		$res = $this->db->get('file');		
		return $res->result_array();
	}
	
	function get_file($id)
	{
		$res = $this->db->where('id', $id)->get('file');
		return $res->row_array();
	}
	
	function save_file($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('file', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('file', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_file($id)
	{
		$this->db->where('id', $id)->delete('file');
		return $id;
	}
	
	function display_one_file()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('file');				
		return $res->result_array();
	}
	
	
	
}