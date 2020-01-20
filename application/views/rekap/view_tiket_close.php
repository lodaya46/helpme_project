<script language="javascript" type="text/javascript">
	function confirmHapus(){
		var cek = confirm("Anda ingin menghapus data ini ?");
		if(cek == true) return true;
		else return false;
	}
</script>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
         <h3><?php echo $judul;?></h3><br>
		 </div>
		
    </div>

	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content" style="overflow-x:scroll; overflow-y:scroll;">
				
				<table  class="table table-striped table-bordered">
					<thead>
					<tr>
					  <th>No</th>
					  <th>Unit</th>
					  <th>Tiket</th>
					  <th>Masalah</th>
					  <th>Kejadian</th>
					  <th>Pelapor</th>
					  <th>Agent</th>
					  <th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php  
					$no = $awal;
					foreach($result as $data){
						
					?>
					<tr>
						<td ><?php echo $no++;?></td>
						<td><?php echo $data['UNIT']?></td>
						<td><u><a href=<?php echo site_url('rekap/rincian_tiket/'.$data['NOMOR_TIKET'].'')?>><?php echo $data['NOMOR_TIKET']?></a></u></td>
						<td><?php echo $data['MASALAH']?></td>
						<td><?php echo date('d/m/Y H:i:s',strtotime($data['TGL_CREATED']))?></td>
						<td><?php echo $data['NAMA']?></td>
						<td><?php echo $data['USER_AGENT']?></td>
						<td><?php echo set_status($data['USER_RESPONSE'],$data['USER_CLOSED']);?></td>
						
					</tr>
			<?php	}?>
					</tbody>
				</table>
				
				</div>
				<br/>
				<div align="center">Jumlah data: <strong>
				  <?=number_format($jml_data,0,'','.')?>
				</strong> record</div>
				<div align="center" ><?=$paging?></div>
			  
			</div>
		</div>

		<div class="clearfix"></div>
		<div class="clearfix"></div>
	</div>
</div>
<?php
function set_status($user_response,$user_closed){
	if($user_response == "" and $user_closed == ""){
		$status = "Open";
	}else if($user_response != "" and $user_closed == ""){
		$status = "Progress";
	}else if($user_response != "" and $user_closed != ""){
		$status = "Closed";
	}else{
		$status = "Closed";
	}
	
	return $status;
}


?>