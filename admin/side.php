<?php
include('session.php');
include('koneksi.php');
if(!isset($_SESSION)){
    session_start();
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="dist/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head><!-- 
<style>
.sidebar-menu {
    list-style: none;
    margin: 0;
    padding: 0;
}

.sidebar-menu ul {
    list-style: none;
}

.sidebar-menu li {
    width: 228;
    height: auto;
    padding: 0;
    margin: 0;
}

.sidebar-menu li ul {
    content:'»';
    width: 228;
    height: auto;
    padding-left: 7px;
    margin: 0;
    display: none;
    left: 180px;
    top: 0;
}

/*nível inferior do menu com display: none*/
.sidebar-menu a {
    display: block;
    text-decoration: none;
    padding: 7px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    font-weight: 400;
    color: darkred;
}


/* sub sub menu*/
.sidebar-menu ul ul li {
/*    display:none;*/
}

.sidebar-menu ul ul li a:hover {
    display:block;
}

/* sub sub menu fim */
.sidebar-menu a:hover {
    text-decoration: none;
    color: red;
}
.sidebar-menu li:hover > ul {
    display: block;
}

/*mostra nível inferior ao passar o cursor*/

/*untuk membuat simbol
.sidebar-menu li ul a:before {

    content: attr(title)"» ";

} */
</style> -->
<body class="hold-transition skin-blue sidebar-mini">

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $login_session; ?></p>
          <!-- Status
          <a><i class="fa fa-circle text-success"></i> status </a> -->
        </div>
      </div>

      <!-- search form (Optional) 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>	-->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
      <li class="header">MAIN MENU</li>
        <!-- Optionally, you can add icons to the links 
        <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>-->
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>CALON KARYAWAN</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
      <?php
			if (isset($status_id) == "ADMIN")
			{  
			?>
            <li><a href="approve_pengajuan_test.php">APPROVE PENGAJUAN</a></li>
            <li><a href="laporan_psikotest.php">APPROVE LAPORAN PSIKOTEST</a></li>
            <li><a href="laporan_psikotest_akhir.php">LAPORAN PSIKOTEST</a></li>
            <li><a href="laporan_akhir.php">LAPORAN AKHIR</a></li>
            
      <?php
			  }
			?>
            
          </ul>
        </li>
        
       </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
  </body>