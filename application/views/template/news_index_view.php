<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $row['news_title'];?> | ระบบสหกิจ | มหาวิทยาลัยบูรพา</title>
    <meta property="og:url" content="<?php echo site_url('news/'.$row['news_id']);?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $row['news_title'];?>" />
    <meta property="og:description" content="<?php echo substr(strip_tags($row['news_detail']), 0, 250);?>" />
    <meta property="og:image" content="<?php echo $cover_image;?>" />

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/scrolling-nav.css');?>" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">ระบบสหกิจศึกษา</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="<?php echo site_url('Member/login/');?>">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header class="bg-primary text-white">
      <div id="about" class="container text-center">

        <h1><?php echo $row['news_title'];?></h1>
        <p class="lead"><?php echo thaiDate($row['news_date'], true);?></p>
      </div>
    </header>

    <section>
      <div id="contact" class="container">
        <div class="row">
          <div class="col-lg-8 mx-auto">
                <?php echo $row['news_detail']; ?>
            
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>

    <!-- Custom JavaScript for this theme -->
    <script src="<?php echo base_url('assets/js/scrolling-nav.js');?>"></script>

  </body>

</html>
