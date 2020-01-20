<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Helpme</title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>asset/back/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>asset/back/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>asset/back/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>asset/back/build/css/custom.min.css" rel="stylesheet">
	<!-- Datatables -->
    <link href="<?php echo base_url();?>asset/back/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/back/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/back/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/back/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/back/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
	
	<!-- jQuery -->
    <script src="<?php echo base_url();?>asset/back/jquery/dist/jquery.min.js"></script>
    
	</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
		<?php $this->load->view('menu/menu_admin')?>

        <!-- page content -->
        <?php $this->load->view($isi);?>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="col-md-3 center-margin">
            Created By Tim TI KD Disjaya 2017
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>asset/back/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src=".<?php echo base_url();?>asset/back/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>asset/back/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>asset/back/iCheck/icheck.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>asset/back/build/js/custom.min.js"></script>
	
	<!-- Datatables -->
    <script src="<?php echo base_url();?>asset/back/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src=".<?php echo base_url();?>asset/back/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>asset/back/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/pdfmake/build/vfs_fonts.js"></script>
	
	<!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>asset/back/build/js/moment/moment.min.js"></script>
    <script src="<?php echo base_url();?>asset/back/build/js/datepicker/daterangepicker.js"></script>
	<script>
	$(document).ready(function() {
		$('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();
		 var table = $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });
	});
	</script>
  </body>
</html>