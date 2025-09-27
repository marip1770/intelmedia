<?php require_once('./config.php'); ?>
<header class="header-default">
		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				<!-- site logo -->
				<a class="navbar-brand" href="./"><img src="images/logo.png" alt="logo" /></a> 

				<div class="collapse navbar-collapse">
					<!-- menus -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link" href="./">Home</a>
						</li>
						<?php 
							$menu = $conn->query("SELECT cl.name as category, ml.category_id as category_id, cl.slug as cl_slug
							FROM `magazine_list` ml INNER JOIN `category_list` cl ON ml.category_id = cl.id 
							WHERE ml.status = 1 GROUP BY cl.name ORDER BY cl.name ASC");
							if($menu->num_rows < 4): 
								while($menu1 = $menu->fetch_assoc()):
						?>
							<li class="nav-item">
								<a class="nav-link" href="./<?= $menu1['cl_slug'] ?>"><?= $menu1['category'] ?></a>
							</li>
						<?php 
								endwhile;
							elseif ($menu->num_rows >= 4):
								$a = 0;
								while($menu1 = $menu->fetch_assoc()):
									if($a < 2):
						?>
							<li class="nav-item">
								<a class="nav-link" href="./<?= $menu1['cl_slug'] ?>"><?= $menu1['category'] ?></a>
							</li>
						<?php
									elseif ($a == 2):
						?> 
							<li class="nav-item dropdown">Lainnya
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="./<?= $menu1['cl_slug'] ?>"><?= $menu1['category'] ?></a></li>
						<?php
									elseif ($a > 2):
						?>
									<li><a class="dropdown-item" href="./<?= $menu1['cl_slug'] ?>"><?= $menu1['category'] ?></a></li>
						<?php 
									endif;
									$a = $a + 1;
								endwhile;
						?>
								</ul>
							</li>
						<?php 
							endif;
						?>
					</ul>
				</div>

				<!-- header right section -->
				<div class="header-right">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCAXiC0IGdFkBXF7u9rIJWwg"><i class="fab fa-youtube"></i></a></li>
					</ul>
					<!-- header buttons -->
					<div class="header-buttons">
						<button class="search icon-button">
							<i class="icon-magnifier"></i>
						</button>
						<button class="user icon-button">
								<a href="./admin" class="icon-user"></a>
						</button>
							<!-- <i class="icon-user"></i> -->
						<button class="burger-menu icon-button">
							<span class="burger-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</nav>
	</header>