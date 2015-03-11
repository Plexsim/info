<?php
Class Training_Resource_Model extends CI_Model
{

	/********************************************************************
	Training Resource Custom functions
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
		$res = $this->db->get('training_resource');		
		return $res->result_array();
	}
	
	function get_resource($id)
	{
		$res = $this->db->where('id', $id)->get('training_resource');
		return $res->row_array();
	}
	
	function save_resource($data)
	{		
		if(!empty($data['id']) && isset($data['id']))
		{
			$this->db->where('id', $data['id'])->update('training_resource', $data);
			return $data['id'];
		}
		else 
		{
			$this->db->insert('training_resource', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_resource($id)
	{
		$this->db->where('id', $id)->delete('training_resource');
		return $id;
	}
	
	function display_one_resource()
	{
		$res = $this->db->where('status', 'Enable')->order_by('sequence',"ASC")->get('training_resource');				
		return $res->result_array();
	}
	
	
	
}