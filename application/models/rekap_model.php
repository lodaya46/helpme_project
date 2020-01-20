<?php
class rekap_model extends CI_Model{
	function __contruct(){
		parent::__construct();
	}
	
	//-----------------------------------------------------tiket------------------------------------------------------
	function get_tiket($awal,$limit){
		$sql = "select * from tbl_tiket order by nomor_tiket desc
		limit $limit offset $awal ";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_tiket(){
		$sql = "SELECT count(1) as JML from tbl_tiket";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	function get_rincian_tiket($nomor_tiket){
		$sql = "SELECT t.*,d.NAMA_DEPARTMENT from tbl_tiket t, tbl_department d
				where t.ID_DEPARTMENT = d.ID_DEPARTMENT 
				and t.NOMOR_TIKET = '$nomor_tiket'";
		
		$query	= $this->db->query($sql);
		return $query->row();
	}
	
	function get_agent(){
		$sql = "select * from tbl_user where (hak_akses  = '1' or hak_akses  = '2') and status = '1'";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_tiket_by_nomor_tiket($nomor_tiket){
		$sql = "SELECT * from tbl_tiket where nomor_tiket = '$nomor_tiket'";
		
		$query	= $this->db->query($sql);
		return $query->row();
	}
	
	function get_response($nomor_tiket){
		$sql = "select * from tbl_response where nomor_tiket = '$nomor_tiket'";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function assign_tiket($data,$nomor_tiket){
		$this->db->where('NOMOR_TIKET',$nomor_tiket);
		$this->db->update('tbl_tiket',$data);
	}
	
	function reply_tiket($data){
		$this->db->insert('tbl_response',$data);
	}
	//-----------------------------------------------------tiket open------------------------------------------------------
	function get_tiket_open($awal,$limit){
		$sql = "select * from tbl_tiket 
		where user_response is null 
		order by nomor_tiket desc
		limit $limit offset $awal ";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_tiket_open(){
		$sql = "SELECT count(1) as JML from tbl_tiket where user_response is null";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	//-----------------------------------------------------tiket progress------------------------------------------------------
	function get_tiket_progress($awal,$limit){
		$sql = "select * from tbl_tiket 
		where user_response is not null and(user_closed is null or user_closed ='')
		order by nomor_tiket desc
		limit $limit offset $awal ";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_tiket_progress(){
		$sql = "SELECT count(1) as JML from tbl_tiket where user_response is not null and(user_closed is null or user_closed ='')";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	
	//-----------------------------------------------------tiket close------------------------------------------------------
	function get_tiket_close($awal,$limit){
		$sql = "select * from tbl_tiket 
		where user_response is not null and user_closed is not null and user_closed != ''
		order by nomor_tiket desc
		limit $limit offset $awal ";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_tiket_close(){
		$sql = "SELECT count(1) as JML from tbl_tiket where user_response is not null and user_closed is not null and user_closed != ''";
		
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	//-----------------------------------------------------time tiket------------------------------------------------------
	function get_time_tiket($tgl_awal,$tgl_akhir,$status,$awal,$limit){
		$where = "";
		$tgl_awal_new = "str_to_date('$tgl_awal','%d/%m/%Y')";
		$tgl_akhir_new = "str_to_date('$tgl_akhir','%d/%m/%Y')";

		if($tgl_awal != '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_akhir_new";
		if($tgl_awal != '0' and $tgl_akhir == '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_awal_new";
		if($tgl_awal == '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_akhir_new and $tgl_akhir_new";
		
		switch($status){
			case 1: 
				$where .=" and user_response is null";
			break;
			case 2: 
				$where .=" and user_response is not null and (user_closed is null or  user_closed ='')";
			break;
			case 3: 
				$where .=" and user_response is not null and user_closed is not null and user_closed != ''";
			break;
		}	
		
		$sql = "select UNIT,NOMOR_TIKET, TGL_CREATED,
				TIMESTAMPDIFF(MINUTE,TGL_CREATED,TGL_RESPONSE) AS WAIT_TIME,TGL_RESPONSE, 
				TIMESTAMPDIFF(MINUTE,TGL_RESPONSE,TGL_CLOSED) AS RESPONSE_TIME, TGL_CLOSED, 
				TIMESTAMPDIFF(MINUTE,TGL_CREATED,TGL_CLOSED) AS TOTAL_TIME, USER_AGENT,USER_RESPONSE,USER_CLOSED,NAMA from tbl_tiket 
		where tgl_created is not null $where
		order by nomor_tiket desc
		limit $limit offset $awal";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_jml_time_tiket($tgl_awal,$tgl_akhir,$status){
		$where = "";
		$tgl_awal_new = "str_to_date('$tgl_awal','%d/%m/%Y')";
		$tgl_akhir_new = "str_to_date('$tgl_akhir','%d/%m/%Y')";

		if($tgl_awal != '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_akhir_new";
		if($tgl_awal != '0' and $tgl_akhir == '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_awal_new";
		if($tgl_awal == '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_akhir_new and $tgl_akhir_new";
		switch($status){
			case 1: 
				$where .=" and user_response is null";
			break;
			case 2: 
				$where .=" and user_response is not null and (user_closed is null or  user_closed ='')";
			break;
			case 3: 
				$where .=" and user_response is not null and user_closed is not null and user_closed != ''";
			break;
		}	
		
		$sql = "SELECT count(1) as JML from tbl_tiket 
		where tgl_created is not null $where
		order by nomor_tiket desc";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->row()->JML;
	}
	function get_time_rincian_tiket($tgl_awal,$tgl_akhir,$status,$awal,$limit){
		$where = "";
		$tgl_awal_new = "str_to_date('$tgl_awal','%d/%m/%Y')";
		$tgl_akhir_new = "str_to_date('$tgl_akhir','%d/%m/%Y')";

		if($tgl_awal != '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_akhir_new";
		if($tgl_awal != '0' and $tgl_akhir == '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_awal_new and $tgl_awal_new";
		if($tgl_awal == '0' and $tgl_akhir != '0')$where .= " and date_format(TGL_CREATED,'%Y/%m/%d') between $tgl_akhir_new and $tgl_akhir_new";
		switch($status){
			case 1: 
				$where .=" and user_response is null";
			break;
			case 2: 
				$where .=" and user_response is not null and (user_closed is null or  user_closed ='')";
			break;
			case 3: 
				$where .=" and user_response is not null and user_closed is not null and user_closed != ''";
			break;
		}	
		
		$sql = "select UNIT,NOMOR_TIKET,NAMA,EMAIL,PHONE,MASALAH,RINCIAN,PENYELESAIAN,
				TGL_CREATED,
				TIMESTAMPDIFF(MINUTE,TGL_CREATED,TGL_RESPONSE) AS WAIT_TIME,TGL_RESPONSE, 
				TIMESTAMPDIFF(MINUTE,TGL_RESPONSE,TGL_CLOSED) AS RESPONSE_TIME, TGL_CLOSED, 
				TIMESTAMPDIFF(MINUTE,TGL_CREATED,TGL_CLOSED) AS TOTAL_TIME, USER_AGENT,USER_RESPONSE,USER_CLOSED from tbl_tiket 
		where tgl_created is not null $where
		order by nomor_tiket desc
		limit $limit offset $awal";
		//echo $sql;
		$query	= $this->db->query($sql);
		return $query->result_array();
	}
	//----------------------------------------------------------mobile----------------------------------------
	function add_tiket($data){
		$this->db->insert('tbl_tiket',$data);
	}
	
	function close_tiket($data,$nomor_tiket){
		$this->db->where('NOMOR_TIKET',$nomor_tiket);
		$this->db->update('tbl_tiket',$data);
	}
}
?>