
<div class="right_col" role="main">
	<div class="page-title">
		<div class="title_left">
         <h3><?php echo $judul;?></h3>
        </div>
		
    </div>

	<div class="clearfix"></div>
	
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('master/edit_user');?>" method="post" onsubmit="return validate();">
					<input type="hidden" name="id_user" value = "<?php echo $result->ID_USER;?>">
					
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Department
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="id_department" name="id_department" class="select2_single form-control" tabindex="-1" >
						  <option value="-">-</option>
						  <?php foreach($list_department as $data){?>
							<option value="<?php echo $data['ID_DEPARTMENT'];?>" <?php if($result->ID_DEPARTMENT == $data['ID_DEPARTMENT']) echo ' selected';?>><?php echo $data['NAMA_DEPARTMENT']; ?></option>
							<?php }?>
						  </select>
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nama" name="nama" value="<?php echo $result->NAMA;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="email" name="email" value="<?php echo $result->EMAIL;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Phone
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="phone" name="phone" value="<?php echo $result->PHONE;?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="username" name="username" value="<?php echo $result->USERNAME;?>"required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
					<input type="hidden" name="old_password" value = "<?php echo $result->PASSWORD;?>">
					
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Password
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Status
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="status" name="status" class="select2_single form-control" tabindex="-1" >
							<option value="1" <?php if($result->STATUS == "1") echo " selected";?>>Aktif</option>
							<option value="0" <?php if($result->STATUS == "0") echo " selected";?>>Tidak Aktif</option>
						  </select>
                        </div>
                    </div>
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
							Hak Akses
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                           <select id="hak_akses" name="hak_akses" class="select2_single form-control" tabindex="-1" >
							<option value="1" <?php if($result->HAK_AKSES == "1") echo " selected";?>>Admin</option>
							<option value="2" <?php if($result->HAK_AKSES == "2") echo " selected";?>>Agent</option>
						  </select>
                        </div>
                    </div>
					<div class="form-group">
                      <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                       <button type="submit" name="submit" class="btn btn-success">Submit</button>
						</div>
                   </div>
				</form>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<div class="clearfix"></div>
	</div>
</div>