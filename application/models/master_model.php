<?php
class master_model extends CI_Model{
	
	function __contruct(){
		parent::__construct();
	}
	//-----------------------------------------------------department------------------------------------------------------
	function get_department($awal,$limit){
		if($awal == 0 and $limit == 0) $where = "";
		else $where = "limit $limit offset $awal";
		
		$sql = "select * from tbl_department $where";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_department(){
		$sql = "SELECT count(1) as JML FROM tbl_department";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	function add_department($data){
		$this->db->insert('tbl_department',$data);
	}
	
	function edit_department($id_department){
		$sql = "select * from tbl_department where id_department = '$id_department'";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row();
	}
	
	function update_department($data,$id_department){
		$this->db->where('ID_DEPARTMENT',$id_department);
		$this->db->update('TBL_DEPARTMENT',$data);
	}
	
	function delete_department($id_department){
		$this->db->where('ID_DEPARTMENT',$id_department);
		$this->db->delete('TBL_DEPARTMENT');
	}
	
	//-----------------------------------------------------topic------------------------------------------------------
	function get_topic($awal,$limit){
		$sql = "select t.*,d.NAMA_DEPARTMENT from tbl_topic t, tbl_department d 
		where t.id_department = d.id_department
		limit $limit offset $awal";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_topic(){
		$sql = "SELECT count(1) as JML from tbl_topic t, tbl_department d 
		where t.id_department = d.id_department";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	function add_topic($data){
		$this->db->insert('tbl_topic',$data);
	}
	
	function edit_topic($ID_TOPIC){
		$sql = "select * from tbl_topic where ID_TOPIC = '$ID_TOPIC'";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row();
	}
	
	function update_topic($data,$ID_TOPIC){
		$this->db->where('ID_TOPIC',$ID_TOPIC);
		$this->db->update('tbl_topic',$data);
	}
	
	function delete_topic($ID_TOPIC){
		$this->db->where('ID_TOPIC',$ID_TOPIC);
		$this->db->delete('tbl_topic');
	
	}
	
	//-----------------------------------------------------user------------------------------------------------------
	function get_user($awal,$limit){
		$sql = "select t.*,d.NAMA_DEPARTMENT from tbl_user t, tbl_department d 
		where t.id_department = d.id_department
		limit $limit offset $awal";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_user(){
		$sql = "SELECT count(1) as JML from tbl_user t, tbl_department d 
		where t.id_department = d.id_department";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	function add_user($data){
		$this->db->insert('tbl_user',$data);
	}
	
	function edit_user($ID_USER){
		$sql = "select * from tbl_user where ID_USER = '$ID_USER'";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row();
	}
	
	function update_user($data,$ID_USER){
		$this->db->where('ID_USER',$ID_USER);
		$this->db->update('tbl_user',$data);
	}
	
	function delete_user($ID_USER){
		$this->db->where('ID_USER',$ID_USER);
		$this->db->delete('tbl_user');
	
	}
}
?>