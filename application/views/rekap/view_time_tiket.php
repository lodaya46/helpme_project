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
				<div class="x_content">
					 <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="<?php echo site_url('rekap/time_tiket/new')?>">
						<div class="form-group">
							<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Tanggal
							</label>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<input type="text" id="tgl_awal" name="tgl_awal" value="<?php if($tgl_awal != "0") echo $tgl_awal;?>"  class="date-picker form-control col-md-7 col-xs-12" placeholder="Tgl Awal">
							
							</div>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<input type="text" id="tgl_akhir" name="tgl_akhir" value="<?php if($tgl_akhir != "0") echo $tgl_akhir;?>"  class="form-control col-md-7 col-xs-12" placeholder="Tgl Akhir">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-1 col-sm-1 col-xs-12" for="first-name">Status
							</label>
							<div class="col-md-3 col-sm-3 col-xs-12">
								<select class="select2_single form-control" tabindex="-1" name="status">
									<option value="0">-</option>
									<option value="1" <?php if($status == "1") echo ' selected';?>>Open</option>
									<option value="2" <?php if($status == "2") echo ' selected';?>>Progress</option>
									<option value="3" <?php if($status == "3") echo ' selected';?>>Close</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-1">
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					 </form>
				</div>
			</div>
			<div class="x_panel">
				<div class="x_content" style="overflow-x:scroll; overflow-y:scroll;">
				
				<table  class="table table-striped table-bordered" style="width:1500px">
					<thead>
					<tr>
					  <th>No</th>
					  <th>Unit</th>
					  <th>Tiket</th>
					  <th>Kejadian</th>
					  <th>Waktu Tunggu</th>
					  <th>Respon</th>
					  <th>Waktu Pengerjaan</th>
					  <th>Selesai</th>
					  <th>Total Penyelesaian</th>
					  <th>Nama</th>
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
						<td><?php echo set_tanggal($data['TGL_CREATED']);?></td>
						<td><?php echo set_waktu($data['WAIT_TIME']);?></td>
						<td><?php echo set_tanggal($data['TGL_RESPONSE']);?></td>
						<td><?php echo set_waktu($data['RESPONSE_TIME']);?></td>
						<td><?php echo set_tanggal($data['TGL_CLOSED']);?></td>
						<td><?php echo set_waktu($data['TOTAL_TIME']);?></td>
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
				<div align="center" >
					<?=$paging?><br>
					<a href="<?php echo site_url('rekap/excel_time_tiket/'.$tgl_awal.'/'.$tgl_akhir.'/'.$status.'/'.$jml_data)?>" class="btn btn-success">Export Excel</a>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<div class="clearfix"></div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#tgl_awal').daterangepicker({
			singleDatePicker: true,
			format : 'DD/MM/YYYY',
			calender_style: "picker_2"
        });
		$('#tgl_akhir').daterangepicker({
			singleDatePicker: true,
			format : 'DD/MM/YYYY',
			calender_style: "picker_2"
        });
	});

</script>
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

function set_tanggal($tanggal){
	if($tanggal == "" or $tanggal == "0000-00-00 00:00:00")$tanggal = "-";
	else $tanggal = date('d/m/Y H:i:s',strtotime($tanggal));
	return $tanggal;
}

function set_waktu($waktu){
	if($waktu == "") $waktu = "-";
	else $waktu = $waktu." Menit";
	return $waktu;
}


?>