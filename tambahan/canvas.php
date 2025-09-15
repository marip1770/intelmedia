<?php require_once('./config.php'); ?>
<div class="canvas-menu d-flex align-items-end flex-column">
	<!-- close button -->
	<button type="button" class="btn-close" aria-label="Close"></button>

	<!-- logo -->
	<div class="logo">
		<img src="images/logo.png" alt="Intelmedia News" />
	</div>

	<!-- menu -->
	<nav>
		<ul class="vertical-menu">
			<li>
				<a href="./">Home</a>
			</li>
			<?php 
				$menu = $conn->query("SELECT cl.name as category, ml.category_id as category_id
				FROM `magazine_list` ml INNER JOIN `category_list` cl ON ml.category_id = cl.id 
				WHERE ml.status = 1 GROUP BY cl.name ORDER BY cl.name ASC");
				if($menu->num_rows < 4): 
					while($menu1 = $menu->fetch_assoc()):
			?>
			<li>
				<a href="./list_magazine.php?c=<?= $menu1['category_id'] ?>"><?= $menu1['category'] ?></a>
			</li>
			<?php 
					endwhile;
				elseif ($menu->num_rows >= 4):
					$a = 0;
					while($menu1 = $menu->fetch_assoc()):
						if($a < 2):
			?>
			<li>
				<a href="./list_magazine.php?c=<?= $menu1['category_id'] ?>"><?= $menu1['category'] ?></a>
			</li>
			<?php
						elseif ($a == 2):
			?> 
			<li>Lainnya
				<ul class="dropdown-menu">
					<li><a href="./list_magazine.php?c=<?= $menu1['category_id'] ?>"><?= $menu1['category'] ?></a></li>
			<?php
						elseif ($a > 2):
			?>
					<li><a href="./list_magazine.php?c=<?= $menu1['category_id'] ?>"><?= $menu1['category'] ?></a></li>
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
		</ul>
	</nav>

	<!-- social icons -->
	<ul class="social-icons list-unstyled list-inline mb-0 mt-auto w-100">
		<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
		<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
		<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCAXiC0IGdFkBXF7u9rIJWwg"><i class="fab fa-youtube"></i></a></li>
	</ul>
</div>