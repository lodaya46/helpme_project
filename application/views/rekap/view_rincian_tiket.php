<script>
function validate(){
	var penyelesaian = $('#penyelesaian').val();
	var status_tiket = $('#status_tiket').val();
	if(penyelesaian == '' && status_tiket == 1){
		alert('Data tidak lengkap');
		return false;
	}
}
</script>
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
         <h3><?php echo $judul;?></h3>
        </div>
		
    </div>

	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<form class="form-horizontal form-label-left">
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Departement</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->NAMA_DEPARTMENT;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Topik Masalah</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->NAMA_TOPIC;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->NAMA;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->PHONE;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->EMAIL;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Masalah</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->MASALAH;?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Gedung Lantai</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->RINCIAN;?></h5></label>
                    </div>
				</form>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
				<form class="form-horizontal form-label-left">
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->UNIT;?></h5></label>
                    </div>
				
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Tiket</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->NOMOR_TIKET;?></h5></label>
                    </div>
					
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Waktu Laporan</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo set_value($result->TGL_CREATED,"lapor","");?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Agent</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo set_value($result->USER_AGENT,"agent","");?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Response</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo set_value($result->TGL_RESPONSE,"response",$result->USER_RESPONSE);?></h5></label>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Closed</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo set_value($result->TGL_CLOSED,"closed",$result->USER_CLOSED);?></h5></label>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Penyelesaian</label>
                       <label class="control-label col-md-1 col-sm-1 col-xs-12">: </label>
					    <label class="col-md-8 col-sm-8 col-xs-12"><h5><?php echo $result->PENYELESAIAN;?></h5></label>
                    </div>
				</form>
				</div>
			</div>
		</div>
		<?php 
		foreach($list_response as $data){
		?>
		<div class="col-md-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h4><?php echo $data['USER_FROM']." -> ".$data['USER_TO']." ".date('d/m/Y H:i:s',strtotime($data['TGL_CREATED']))?></h4>
				</div>
				<div class="x_content">
					<div class="col-md-12">
					<textarea class="resizable_textarea form-control" disabled="disable"><?php echo $data['PESAN']?></textarea>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
		<div class="col-md-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                         <li role="presentation" class="active"><a href="#tab_assign" role="tab" id="assign-tab" data-toggle="tab" aria-expanded="false">Assign Ticket</a>
                        </li>
						<li role="presentation" class=""><a href="#tab_reply" id="reply-tab" role="tab" data-toggle="tab" aria-expanded="true">Post Reply</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_assign" >
                        <form id="demo-form2" class="form-horizontal  form-label-left" action="<?php echo site_url('rekap/assign_tiket');?>" method="post" onsubmit=" return validate();">
                         	<input type="hidden" name="nomor_tiket" value="<?php echo $result->NOMOR_TIKET;?>" >
							<div class="form-group">
							   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Agent
							   </label>
							   <div class="col-md-6 col-sm-6 col-xs-12">
									<select id="user_agent" name="user_agent" class="select2_single form-control" tabindex="-1" >
									  <?php foreach($list_agent as $data){?>
										<option value="<?php echo $data['NAMA']."|".$data['EMAIL'];?>" <?php if($result->USER_AGENT == $data['NAMA']) echo ' selected';?>><?php echo $data['NAMA']."  -  ".$data['EMAIL']; ?></option>
										<?php }?>
									</select>
							   </div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Pesan</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
								  <textarea class="resizable_textarea form-control" name="pesan"><?php echo $result->NAMA."\n". $result->EMAIL."\n". $result->MASALAH."\n". $result->RINCIAN."\n"?></textarea>
								</div>
							</div>
							<div class="form-group">
							   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Status Tiket
							   </label>
							  <div class="col-md-6 col-sm-6 col-xs-12">
								<select id="status_tiket" name="status_tiket" class="select2_single form-control" tabindex="-1" >
									<option value="0" <?php if($result->USER_CLOSED == "") echo ' selected';?>>Open</option>
									<option value="1" <?php if($result->USER_CLOSED != "") echo ' selected';?>>Closed</option>
								</select>
							   </div>
							</div>
							<div class="form-group">
							   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">Penyelesaian
							   </label>
							  <div class="col-md-6 col-sm-6 col-xs-12">
							  	<input type="text" id="penyelesaian" name="penyelesaian" id="penyelesaian" value="<?php echo $result->PENYELESAIAN;?>"  class="form-control col-md-12 col-xs-12" placeholder="Penyelesaian" required="required">
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
									<button type="submit" name="submit" id+ class="btn btn-success" o>Submit</button>
								</div>
							 </div>
						</form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade " id="tab_reply" >
						<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('rekap/reply_tiket');?>" method="post">
							<input type="hidden" name="nomor_tiket" value="<?php echo $result->NOMOR_TIKET;?>">
							<input type="hidden" name="user_to" value="<?php echo $result->NAMA;?>">
							<div class="form-group">
							   <label class="control-label col-md-2 col-sm-2 col-xs-12" for="first-name">To
							   </label>
							   <div class="col-md-6 col-sm-6 col-xs-12">
									<input type='text' readonly name='email_to' value='<?php echo $result->EMAIL;?>'>
							   </div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-2 col-sm-2 col-xs-12">Pesan</label>
								<div class="col-md-9 col-sm-9 col-xs-12">
								  <textarea class="resizable_textarea form-control" name="pesan"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
									<button type="submit" name="submit" class="btn btn-success">Submit</button>
								</div>
							 </div>
						</form>
                        </div>
                        
                      </div>
                    </div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="clearfix"></div>
	</div>
</div>

<?php 
function set_value($field,$where,$agent){
	$result = "-";
	if($where == "lapor"){
		if($field != "")$result = date('d/m/Y H:i:s',strtotime($field));
	} else if($where == "agent"){
		if($field != "")$result = $field;
	}else if($where == "response"){
		if($field != "")$result = $agent." ".date('d/m/Y H:i:s',strtotime($field));
	}else if($where == "closed"){
		if($agent != "")$result = $agent." ".date('d/m/Y H:i:s',strtotime($field));
	}
	return $result;
}
?>