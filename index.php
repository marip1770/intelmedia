<?php require_once('./config.php'); ?>
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

	<!-- hero section -->
	<section id="hero">

		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">
					<?php 
						$berita = $conn->query("SELECT ml.id as id, ml.title as title, ml.banner_path as banner_path, 
						ml.date_created as date_created, ml.description as description, cl.name as category, 
						us.firstname as firstname, us.lastname as lastname, cl.id as category_id,ml.slug as ml_slug,cl.slug as cl_slug
						FROM `magazine_list` ml 
						INNER JOIN `category_list` cl ON ml.category_id = cl.id 
						INNER JOIN `users` us ON ml.user_id = us.id
						WHERE ml.status = 1
						ORDER BY unix_timestamp(ml.date_created) DESC LIMIT 1");
							while($berita1 = $berita->fetch_assoc()):
								$berita1['description'] = strip_tags(html_entity_decode($berita1['description']));
					?>
								<!-- featured post large -->
								<div class="post featured-post-lg">
									<div class="details clearfix">
										<a href="./<?= $berita1['cl_slug'] ?>" class="category-badge"><?= $berita1['category'] ?></a>
										<h2 class="post-title"><a href="./<?= $berita1['ml_slug'] ?>"><?= $berita1['title'] ?></a></h2>
										<ul class="meta list-inline mb-0">
											<li class="list-inline-item"><?= $berita1['firstname'] ?> <?= $berita1['lastname'] ?></a></li>
											<li class="list-inline-item"><?= date('d M Y H:i',strtotime($berita1['date_created'])) ?></li>
										</ul>
									</div>
									<a href="./<?= $berita1['ml_slug'] ?>">
										<div class="thumb rounded">
											<div class="inner data-bg-image" data-bg-image="<?= validate_image($berita1['banner_path']) ?>"></div>
										</div>
									</a>
								</div>
					<?php endwhile; ?>

				</div>

				<div class="col-lg-4">

					<!-- post tabs -->
					<div class="post-tabs rounded bordered">
						<!-- tab navs -->
						<ul class="nav nav-tabs nav-pills nav-fill" id="postsTab" role="tablist">
							<li class="nav-item" role="presentation"><button aria-controls="popular" aria-selected="true" class="nav-link active" data-bs-target="#popular" data-bs-toggle="tab" id="popular-tab" role="tab" type="button">Popular</button></li>
							<li class="nav-item" role="presentation"><button aria-controls="recent" aria-selected="false" class="nav-link" data-bs-target="#recent" data-bs-toggle="tab" id="recent-tab" role="tab" type="button">Recent</button></li>
						</ul>
						<!-- tab contents -->
						<div class="tab-content" id="postsTabContent">
							<!-- loader -->
							<div class="lds-dual-ring"></div>
							<!-- popular posts -->
							<div aria-labelledby="popular-tab" class="tab-pane fade show active" id="popular" role="tabpanel">
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-1.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">3 Easy Ways To Make Your iPhone Faster</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy Method That Works For All</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-3.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">10 Ways To Immediately Start Selling Furniture</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-4.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">15 Unheard Ways To Achieve Greater Walker</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
							</div>
							<!-- recent posts -->
							<div aria-labelledby="recent-tab" class="tab-pane fade" id="recent" role="tabpanel">
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy Method That Works For All</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-1.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">3 Easy Ways To Make Your iPhone Faster</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-4.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">15 Unheard Ways To Achieve Greater Walker</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<!-- post -->
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-3.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">10 Ways To Immediately Start Selling Furniture</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</section>

	<!-- section main content -->
	<section class="main-content">
		<div class="container-xl">

			<div class="row gy-4">

				<div class="col-lg-8">

					<!-- section header -->
					

					<!-- horizontal ads -->
					<!-- <div class="ads-horizontal text-md-center">
						<span class="ads-title">- Sponsored Ad -</span>
						<a href="#">
							<img src="images/ads/ad-750.png" alt="Advertisement" />
						</a>
					</div> -->

					<!-- <div class="spacer" data-height="50"></div> -->

					<!-- section header -->
					<!-- <div class="section-header">
						<h3 class="section-title">Trending</h3>
						<img src="images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">
						<div class="row gy-5">
							<div class="col-sm-6">
								<div class="post">
									<div class="thumb rounded">
										<a href="category.html" class="category-badge position-absolute">Culture</a>
										<span class="post-format">
											<i class="icon-picture"></i>
										</span>
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-lg-1.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<ul class="meta list-inline mt-4 mb-0">
										<li class="list-inline-item"><a href="#"><img src="images/other/author-sm.png" class="author" alt="author"/>Intelmedia News</a></li>
										<li class="list-inline-item">10 Oktober 2023</li>
									</ul>
									<h5 class="post-title mb-3 mt-3"><a href="blog-single.html">Facts About Business That Will Help You Success</a></h5>
									<p class="excerpt mb-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy</p>
								</div>
								<div class="post post-list-sm square before-seperator">
									<div class="thumb rounded">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-sm-1.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">3 Easy Ways To Make Your iPhone Faster</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<div class="post post-list-sm square before-seperator">
									<div class="thumb rounded">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-sm-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy Method That Works For All</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="post">
									<div class="thumb rounded">
										<a href="category.html" class="category-badge position-absolute">Inspiration</a>
										<span class="post-format">
											<i class="icon-earphones"></i>
										</span>
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-lg-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<ul class="meta list-inline mt-4 mb-0">
										<li class="list-inline-item"><a href="#"><img src="images/other/author-sm.png" class="author" alt="author"/>Intelmedia News</a></li>
										<li class="list-inline-item">10 Oktober 2023</li>
									</ul>
									<h5 class="post-title mb-3 mt-3"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
									<p class="excerpt mb-0">A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy</p>
								</div>
								<div class="post post-list-sm square before-seperator">
									<div class="thumb rounded">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-sm-3.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">Here Are 8 Ways To Success Faster</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<div class="post post-list-sm square before-seperator">
									<div class="thumb rounded">
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/trending-sm-4.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">Master The Art Of Nature With These 7 Tips</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="spacer" data-height="50"></div> -->

					<!-- section header -->
					
					<!-- section header -->
					<div class="section-header">
						<h3 class="section-title">Latest Posts</h3>
						<img src="images/wave.svg" class="wave" alt="wave" />
					</div>

					<div class="padding-30 rounded bordered">

						<div class="row">
						<?php 
							$magazines = $conn->query("SELECT ml.id as id, ml.title as title, ml.banner_path as banner_path, 
							ml.date_created as date_created, ml.description as description, cl.name as category, 
							us.firstname as firstname, us.lastname as lastname, us.avatar as avatar, cl.id as category_id,ml.slug as ml_slug,cl.slug as cl_slug
							FROM `magazine_list` ml 
							INNER JOIN `category_list` cl ON ml.category_id = cl.id 
							INNER JOIN `users` us ON ml.user_id = us.id
							WHERE ml.status = 1
							ORDER BY unix_timestamp(ml.date_created) DESC LIMIT 3 OFFSET 1");
							while($row = $magazines->fetch_assoc()):
								$row['description'] = strip_tags(html_entity_decode($row['description']));
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
						<?php endwhile; ?>
						<?php if($magazines->num_rows < 1): ?>
							<center><span class="text-muted">No News Listed Yet.</span></center>
						<?php endif; ?>
							
						</div>
						<!-- load more button -->
						<div class="text-center">
							<button class="btn btn-simple"><a href="./list_magazine.php">Load More</a></button>
						</div>

					</div>

				</div>
				<div class="col-lg-4">

					<!-- sidebar -->
					<div class="sidebar">
						<!-- widget about -->
						<div class="widget rounded">
							<div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
								<img src="images/logo.png" alt="logo" class="mb-4" />
								<p class="mb-4">Hello, We’re content writer who is fascinated by content fashion, celebrity and lifestyle. We helps clients bring the right content to the right people.</p>
								<ul class="social-icons list-unstyled list-inline mb-0">
									<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
									<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
								</ul>
							</div>
						</div>

						<!-- widget popular posts -->
						<!-- <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Popular Posts</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<span class="number">1</span>
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-1.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">3 Easy Ways To Make Your iPhone Faster</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<span class="number">2</span>
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-2.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">An Incredibly Easy Method That Works For All</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<div class="post post-list-sm circle">
									<div class="thumb circle">
										<span class="number">3</span>
										<a href="blog-single.html">
											<div class="inner">
												<img src="images/posts/tabs-3.jpg" alt="post-title" />
											</div>
										</a>
									</div>
									<div class="details clearfix">
										<h6 class="post-title my-0"><a href="blog-single.html">10 Ways To Immediately Start Selling Furniture</a></h6>
										<ul class="meta list-inline mt-1 mb-0">
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
							</div>		
						</div> -->

						<!-- widget categories -->
						<div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Explore Topics</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<ul class="list">
									<?php 
										$categoy_list = $conn->query("SELECT COUNT(ml.id) as jml, cl.name as category, cl.id as category_id,ml.slug as ml_slug,cl.slug as cl_slug
										FROM `magazine_list` ml INNER JOIN `category_list` cl ON ml.category_id = cl.id 
										WHERE ml.status = 1 GROUP BY cl.name");
										while($baris = $categoy_list->fetch_assoc()):
									?>
									<li><a href="./<?= $baris['cl_slug'] ?>"><?= $baris['category'] ?></a><span>(<?= $baris['jml'] ?>)</span></li>
									<?php endwhile; ?>
									<?php if($categoy_list->num_rows < 1): ?>
										<center><span class="text-muted">No News Listed Yet.</span></center>
									<?php endif; ?>
								</ul>
							</div>
							
						</div>

						<!-- widget newsletter -->
						<!-- <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Newsletter</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
								<form>
									<div class="mb-2">
										<input class="form-control w-100 text-center" placeholder="Email address…" type="email">
									</div>
									<button class="btn btn-default btn-full" type="submit">Sign Up</button>
								</form>
								<span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy Policy</a></span>
							</div>		
						</div> -->

						<!-- widget post carousel -->
						<!-- <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Celebration</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<div class="post-carousel-widget">
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">How to</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="images/widgets/widget-carousel-1.jpg" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="#">Intelmedia News</a></li>
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">Trending</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="images/widgets/widget-carousel-2.jpg" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">Master The Art Of Nature With These 7 Tips</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="#">Intelmedia News</a></li>
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
									<div class="post post-carousel">
										<div class="thumb rounded">
											<a href="category.html" class="category-badge position-absolute">How to</a>
											<a href="blog-single.html">
												<div class="inner">
													<img src="images/widgets/widget-carousel-1.jpg" alt="post-title" />
												</div>
											</a>
										</div>
										<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
										<ul class="meta list-inline mt-2 mb-0">
											<li class="list-inline-item"><a href="#">Intelmedia News</a></li>
											<li class="list-inline-item">10 Oktober 2023</li>
										</ul>
									</div>
								</div>
								<div class="slick-arrows-bot">
									<button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
									<button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
								</div>
							</div>		
						</div> -->

						<!-- widget advertisement -->
						<!-- <div class="widget no-container rounded text-md-center">
							<span class="ads-title">- Sponsored Ad -</span>
							<a href="#" class="widget-ads">
								<img src="images/ads/ad-360.png" alt="Advertisement" />	
							</a>
						</div> -->

						<!-- widget tags -->
						<!-- <div class="widget rounded">
							<div class="widget-header text-center">
								<h3 class="widget-title">Tag Clouds</h3>
								<img src="images/wave.svg" class="wave" alt="wave" />
							</div>
							<div class="widget-content">
								<a href="#" class="tag">#Trending</a>
								<a href="#" class="tag">#Video</a>
								<a href="#" class="tag">#Featured</a>
								<a href="#" class="tag">#Gallery</a>
								<a href="#" class="tag">#Celebrities</a>
							</div>		
						</div> -->

					</div>

				</div>

			</div>

		</div>
	</section>

	<!-- instagram feed -->
	<!-- <div class="instagram">
		<div class="container-xl">
			<a href="#" class="btn btn-default btn-instagram">Intelmedia News on Instagram</a>

			<div class="instagram-feed d-flex flex-wrap">
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-1.jpg" alt="insta-title" />
					</a>
				</div>
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-2.jpg" alt="insta-title" />
					</a>
				</div>
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-3.jpg" alt="insta-title" />
					</a>
				</div>
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-4.jpg" alt="insta-title" />
					</a>
				</div>
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-5.jpg" alt="insta-title" />
					</a>
				</div>
				<div class="insta-item col-sm-2 col-6 col-md-2">
					<a href="#">
						<img src="images/insta/insta-6.jpg" alt="insta-title" />
					</a>
				</div>
			</div>
		</div>
	</div> -->

	<!-- footer -->
	<?php require_once('tambahan/footer.php') ?>


</div><!-- end site wrapper -->

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