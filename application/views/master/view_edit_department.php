
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
				<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url('master/edit_department');?>" method="post" onsubmit="return validate();">
					<input type="hidden" name="id_department" value = "<?php echo $result->ID_DEPARTMENT;?>">
					
					<div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nama Department
                       </label>
                       <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="nama_department" name="nama_department" value="<?php echo $result->NAMA_DEPARTMENT;?>" required="required" class="form-control col-md-7 col-xs-12">
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