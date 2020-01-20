<?php
class auth_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function cek_user($username,$password){
		$sql = "SELECT username FROM tbl_user WHERE username = '".$username."' and password = md5('".$password."') and hak_akses = '1' and status = 1";
		//echo $sql;
		$query	= $this->db->query($sql);
		if ($query->num_rows() > 0)
			return true;
		else return false;
	}
	
	function get_user($username,$password){
		$sql = "SELECT * FROM tbl_user WHERE username = '".$username."' and password = md5('".$password."') and status = 1";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row();
	}
	/*
	function cek_user_agent($username,$password){
		$sql = "SELECT username FROM tbl_user WHERE username = '".$username."' and password = md5('".$password."') and (hak_akses = '1' or hak_akses = '2') and status = 1";
		//echo $sql;
		$query	= $this->db->query($sql);
		if ($query->num_rows() > 0)
			return true;
		else return false;
	}
	
	function get_user_agent($username,$password){
		$sql = "SELECT * FROM tbl_user WHERE username = '".$username."' and password = md5('".$password."') and (hak_akses = '1' or hak_akses = '2') and status = 1";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row();
	}
	*/
}
?>