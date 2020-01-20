<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Helpme</title>
<link rel="icon" href="<?=base_url()?>asset/image/icon.png" type="image/gif">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>asset/back/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>asset/back/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>asset/back/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="https://colorlib.com/polygon/gentelella/css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>asset/back/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="<?php echo site_url('auth/set_sess')?>">
              <h1><?php echo $judul;?></h1>
              <div>
                <input type="text" name="username"class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div style='background-color:#ff0000;'>
                <input type="submit" class="btn btn-default submit"  value="Submit"/>
               </div>

              <div class="clearfix"></div>

              <div class="separator">
               

                <div class="clearfix"><?php echo $error;?></div>
                <br />

                <div>
                   <h1><i class="fa fa-paw"></i> Helpme</h1>
                  <p>©2017 Copyright TI Disjaya</p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>