<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard ระบบสหกิจ | มหาวิทยาลัยบูรพา</title>

  <!-- Icons -->
  <link href="<?php echo base_url('assets/theme/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" />

  <!-- Main styles for this application -->
  <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet">

  <script src="<?php echo base_url('assets/theme/jquery/dist/jquery.min.js');?>"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
  <script>
    var SITE_URL = '<?php echo site_url();?>';
    var BASE_URL = '<?php echo base_url();?>';
  </script>
  <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
  <style>
  *, a, .btn, b, i {
    font-family: 'Kanit', serif;
  }
  .btn {
    color:#fff !important;
  }
  .sidebar .nav-link i, .sidebar .navbar .dropdown-toggle i, .navbar .sidebar .dropdown-toggle i {
    color: #fff;
  }
  .sidebar {
    background: #01579b;
  }
  .card-body img {
    width:100% !important;
  }
  .app-header.navbar .navbar-brand {
    background-image: url(<?php echo base_url('assets/img/new_logo_228.png');?>) !important;
    background-size: 70% !important;
  }
  </style>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>


    <ul class="nav navbar-nav">

      <?php if($user->login_type == 'officer') { ?>
      <li class="nav-item d-md-down-none">
        <select class="form-control" id="term_option_menu">
          <option disabled> --- เลือกปีการศึกษา --- </option>
          <?php 
          foreach($terms as $term) {
            if($current_term['term_id'] == $term['term_id']) {
              echo '<option value="'.$term['term_id'].'" selected>ปีการศึกษา '.$term['term_name'].'</option>';
            } else {
              echo '<option value="'.$term['term_id'].'">ปีการศึกษา '.$term['term_name'].'</option>';                  
            }
          }
          ?>
        </select>
      </li>
      <?php } ?>
    </ul>

    <ul class="nav navbar-nav ml-auto" style="margin-right: 30px;">

      <!-- <li class="nav-item d-md-down-none"> -->
        <!-- <a class="nav-link" href="#"><i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span></a> -->
      <!-- </li> -->
      <li class="nav-item d-md-down-none">
        <img src="<?php echo $profile_image;?>" class="rounded-circle" style="width:30px;">
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <span class="d-md-down-none"><?php echo $user_info['fullname'];?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong><h4>Account</h4></strong>
          </div>
          <a class="dropdown-item"><img src="<?php echo $profile_image;?>"class="rounded-circle"><br></a>
          <!--a class="dropdown-item text-white bg-dark" href="photos.php"></i><i class="fa fa-image"></i>Uploads Photo</a-->
          <a class="dropdown-item"><i class="fa fa-users"></i> ประเภท: <?php echo strToLevel($user->login_type);?></a>
          <a class="dropdown-item"><i class="fa fa-users"></i> <span class="d-md-down-none">ปีการศึกษา: <?php echo $current_term['term_name'];?></span></a>
          <a class="dropdown-item" href="<?php echo site_url('member/logout');?>"><i class="fa fa-lock"></i> ออกจากระบบ</a>
        </div>
      </li>
    </ul>

  </header>
  <div class="app-body">