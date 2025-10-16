<?php
require_once('./config.php');

// if(isset($_GET['id'])){
    // $qry = $conn->query("SELECT * FROM `magazine_list` where id = '{$_GET['id']}'");
if(isset($m_id)){
    $qry = $conn->query("SELECT * FROM `magazine_list` where id = '{$m_id}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
    $user_qry = $conn->query("SELECT username,id,avatar,firstname,lastname FROM `users` where id = '{$user_id}' ");
    if($user_qry->num_rows > 0){
        $user_arr  = $user_qry->fetch_array();
    }
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- <title>Intelmedia - Legas, Tugas, dan Berimbang</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme"> -->
	<title><?= isset($title) ? $title : "" ?></title>
	<!-- <meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme"> -->
    <meta charset="utf-8">
    <meta property="og:type" content="article">
    <!-- <meta property="og:site_name" content="detiknews"> -->
    <meta property="og:title" content="<?= isset($title) ? $title : "" ?>">
    <meta property="og:image" content="<?= validate_image(isset($banner_path) ? $banner_path : "") ?>?wid=54&amp;w=650&amp;v=1&amp;t=jpeg">
    <meta property="og:description" content="<?= isset($title) ? $title : "" ?>">

    <!-- <meta property="og:image:type" content="image/jpeg"> -->
    <meta property="og:image:width" content="650">
    <meta property="og:image:height" content="366">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<style>
        /* Gaya untuk gambar */
        .rounded-image {
            width: 30px; /* Ubah sesuai keinginan Anda */
            height: 30px; /* Ubah sesuai keinginan Anda */
            border-radius: 50%; /* Membuat gambar bundar */
            object-fit: cover; /* Menyembunyikan gambar yang melebihi batas lingkaran */
        }
    </style>
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    
<!-- preloader -->
<div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>
<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

    <!-- header -->
	<?php require_once('tambahan/header.php') ?>
    <!-- section main content -->
	<section class="main-content">
		<div class="container-xl">
            <!-- <div class="py-3"> -->
                <div class="card card-outline card-primary">
                    <div class="card-body">
                        <div class="container-fluid">
                            
                            <div class="row justify-content-center align-items-end">
                                <div class="col-md-4 text-center">
                                    <img src="<?= validate_image(isset($banner_path) ? $banner_path : "") ?>" alt="" id="magazine-cover-view" class="img-thumbnail bg-dark">
                                </div>
                                <div class="col-md-8">
                                    <h2 class='text-purple'><b><?= isset($title) ? $title : "" ?></b></h2>
                                    <!-- <br> -->
                                    <a id="whatsapp-share" href="#" target="_blank" title="Bagikan ke WhatsApp">
                                    <img src="images/whatsapp-svgrepo-com.svg" 
                                        alt="WhatsApp" 
                                        width="32" 
                                        height="32" 
                                        style="cursor: pointer;">
                                    </a>

                                    <!-- Tombol Salin Link -->
                                    <button onclick="copyLink()" title="Salin Link" style="background:none;border:none;cursor:pointer;">
                                    <img src="images/share-nodes-svgrepo-com.svg" 
                                        alt="Bagikan" 
                                        width="32" 
                                        height="32">
                                    </button>

                                    <!-- Popup Notifikasi -->
                                    <div id="copy-notification"
                                        style="
                                            position: fixed !important;
                                            bottom: 20px;
                                            right: 20px;
                                            background: #4caf50;
                                            color: white;
                                            padding: 10px 15px;
                                            border-radius: 8px;
                                            box-shadow: 0 2px 8px rgba(0,0,0,0.3);
                                            z-index: 999999;
                                            font-size: 14px;
                                            opacity: 0;
                                            transition: opacity 0.5s ease;
                                        ">
                                    Link disalin!
                                    </div>
                                    <hr>
                                    <div class="row justify-content-between align-items-top">
                                        <div class="col-auto">
                                            <div class="d-flex align-items-center">
                                                <span>
                                                    <img src="<?= validate_image(isset($user_arr['avatar']) ? $user_arr['avatar'] : "") ?>" alt="Author Image" id="author-avatar" class="rounded-image">
                                                </span>
                                                <span class="mx-2 text-muted"><?= isset($user_arr['firstname']) ? $user_arr['firstname'] : "N/A" ?> <?= isset($user_arr['lastname']) ? $user_arr['lastname'] : "N/A" ?></span>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <span class="text-muted">
                                                <i class="fa fa-calendar-day"></i> <?= date("M d, Y h:i A",strtotime($date_created)) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row py-3">
                                <div class="col-md-12">
                                    <div class="text-muted">Description</div>
                                    <div><?= isset($description) ? html_entity_decode($description) : "" ?></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </section>
	<!-- footer -->
	<?php require_once('tambahan/footer.php') ?>
</div>

<!-- search popup area -->
<?php require_once('tambahan/search_popup.php') ?>

<!-- canvas menu -->
<?php require_once('tambahan/canvas.php') ?>

<!-- JAVA SCRIPTS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/jquery.sticky-sidebar.min.js"></script>
<script src="js/custom.js"></script>
<script src="js/custom_new.js"></script>

</body>
</html>