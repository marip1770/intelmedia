<?php 
require_once('./config.php');
$cat_id = isset($cat_id) ? intval($cat_id) : 0;
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Intelmedia - Legas, Tugas, dan Berimbang</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
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

    <section class="main-content">
		<div class="container-xl">
        <?php 
        if ($cat_id > 0) {
			$category = $conn->query("SELECT name FROM category_list WHERE id = $cat_id LIMIT 1");
			$cat = $category->fetch_assoc();
			echo "<h1>{$cat['name']}</h1>";
        
        }
		elseif(isset($_GET['search'])){
		?>
		<h1>Search Result for <b>"<?= $_GET['search'] ?>"</b> keyword.</h1>
		<?php } ?>
        <div class="card card-outline card-primary shadow">
            <div class="card-body">
                <div class="container-fluid">
                    <div class="list-group">
                    <div class="row">
						<?php 
						if ($cat_id > 0) {
							$magazines = $conn->query("
								SELECT ml.id, ml.title, ml.banner_path, ml.date_created, ml.description,
									cl.name as category, cl.id as category_id,
									us.firstname, us.lastname, us.avatar,
									cl.slug as cl_slug, ml.slug as ml_slug
								FROM magazine_list ml
								INNER JOIN category_list cl ON ml.category_id = cl.id
								INNER JOIN users us ON ml.user_id = us.id
								WHERE ml.category_id = {$cat_id} AND ml.status = 1
								ORDER BY ml.date_created DESC
							");
							
							while ($row = $magazines->fetch_assoc()) {
								$row['description'] = strip_tags(html_entity_decode($row['description']));
							// }
						?>
							<div class="col-md-12 col-sm-6">
								<!-- post -->
								<div class="post post-list clearfix">
									<div class="thumb rounded">
										<span class="post-format-sm">
											<i class="icon-picture"></i>
										</span>
										<a href="./<?= $row['ml_slug'] ?>">
											<div class="inner">
												<img src="<?= validate_image($row['banner_path']) ?>" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details">
										<ul class="meta list-inline mb-3">
											<li class="list-inline-item"><img src="<?= validate_image(isset($row['avatar']) ? $row['avatar'] : "") ?>" class="rounded-image" alt="author"/><?= $row['firstname'] ?> <?= $row['lastname'] ?></a></li>
											<li class="list-inline-item"><a href="./<?= $row['cl_slug'] ?>"><?= $row['category'] ?></a></li>
											<li class="list-inline-item"><i class="fa fa-calendar-day"></i> <?= date('d M Y H:i',strtotime($row['date_created'])) ?></li>
										</ul>
										<h5 class="post-title"><a href="./<?= $row['ml_slug'] ?>"><?= $row['title'] ?></a></h5>
										<p class="excerpt mb-0"><?= substr($row['description'],0,500) ?></p>
										<div class="post-bottom clearfix d-flex align-items-center">
											<div class="more-button float-end">
												<a href="./<?= $row['ml_slug'] ?>"><span class="icon-options"></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php if($magazines->num_rows < 1): ?>
							<center><span class="text-muted">No News Listed Yet.</span></center>
						<?php endif; 
						}
						else {
							$search = "";
							if(isset($_GET['search'])){
								$search = " and (title LIKE '%{$_GET['search']}%' OR description LIKE '%{$_GET['search']}%' or (category_id in (SELECT id FROM `category_list` where name LIKE '%{$_GET['search']}%' or  description LIKE '%{$_GET['search']}%' and `status` = 1 )) or (user_id in (SELECT id FROM `users` where CONCAT(firstname,' ',middlename, ' ',lastname) LIKE '%{$_GET['search']}%' or  username LIKE '%{$_GET['search']}%' and `status` = 1 ))) ";
							}
							$search1 = $conn->query("SELECT * FROM `magazine_list` where `status` = 1 {$search} order by unix_timestamp(date_created) desc");
							while($cari = $search1->fetch_assoc()):
								$cari['description'] = strip_tags(html_entity_decode($cari['description']));
						?>
							<div class="col-md-12 col-sm-6">
								<!-- post -->
								<div class="post post-list clearfix">
									<div class="thumb rounded">
										<span class="post-format-sm">
											<i class="icon-picture"></i>
										</span>
										<a href="./<?= $cari['slug'] ?>">
											<div class="inner">
												<img src="<?= validate_image($cari['banner_path']) ?>" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details">
										<ul class="meta list-inline mb-3">
										<?php
										$user1 = $conn->query("SELECT * FROM `users` where `id` = {$cari['user_id']} limit 1");
										while($user = $user1->fetch_assoc()):
										?>
											<li class="list-inline-item"><img src="<?= validate_image(isset($user['avatar']) ? $user['avatar'] : "") ?>" class="rounded-image" alt="author"/><?= $user['firstname'] ?> <?= $user['lastname'] ?></a></li>
										<?php endwhile; 
										$cat1 = $conn->query("SELECT * FROM `category_list` where `id` = {$cari['category_id']} limit 1");
										while($cat = $cat1->fetch_assoc()):
										?>
											<li class="list-inline-item"><a href="./<?= $cat['slug'] ?>"><?= $cat['name'] ?></a></li>
										<?php endwhile;?>
											<li class="list-inline-item"><i class="fa fa-calendar-day"></i> <?= date('d M Y H:i',strtotime($cari['date_created'])) ?></li>
										</ul>
										<h5 class="post-title"><a href="./<?= $cari['slug'] ?>"><?= $cari['title'] ?></a></h5>
										<p class="excerpt mb-0"><?= substr($cari['description'],0,500) ?></p>
										<div class="post-bottom clearfix d-flex align-items-center">
											<div class="more-button float-end">
												<a href="./<?= $cari['slug'] ?>"><span class="icon-options"></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
						<?php if($search1->num_rows < 1): ?>
							<center><span class="text-muted">No News Listed Yet.</span></center>
						<?php endif; 
						}
						?>
							
						</div>
                    </div>
                </div>
            </div>
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

</body>
</html>