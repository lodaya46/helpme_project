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
		 <a type="button" class="btn btn-default" href="<?php echo site_url('master/add_topic')?>">Add</a>
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
					  <th>Departemen</th>
					  <th>Topik</th>
					  <th>Tindakan</th>
					</tr>
					</thead>
					<tbody>
					<?php  
					$no = $awal;
					foreach($result as $data){
					?>
					<tr>
						<td ><?php echo $no++;?></td>
						<td><?php echo $data['NAMA_DEPARTMENT']?></td>
						<td><?php echo $data['NAMA_TOPIC']?></td>
						<td><a href="<?php echo site_url('master/edit_topic/'.$data['ID_TOPIC'].'')?>" type="button" class="btn btn-primary">Edit</a>
						<a href="<?php echo site_url('master/delete_topic/'.$data['ID_TOPIC'].'')?>" type="button" class="btn btn-danger" onclick="return confirmHapus();">Delete</a></td>
						
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