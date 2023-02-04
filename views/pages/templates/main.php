<link rel="stylesheet" href="assets/css/index.css">

<div class="background-clip"></div>

<aside class="sidebar">
	<h3 class="title"><?= $username?></h3>
	<div class="sidebar-content">
		<div class="sidebar-item" url="home">
			<ion-icon name="home-outline"></ion-icon>
			HOME
		</div><!-- sidebar-item -->
		<div class="sidebar-item" url="perfil">
			<ion-icon name="person-outline"></ion-icon>
			PERFIL
		</div><!-- sidebar-item -->
		<br><br>
		<div class="sidebar-menu" open="closed">
			<div class="sidebar-menu-btn">
				<ion-icon name="dice-outline"></ion-icon>
				ORDEM DO CAOS
				<ion-icon class="arrow" name="chevron-forward-outline"></ion-icon>
			</div><!-- sidebar-item -->

			<div class="sidebar-submenu">
				<div class="sidebar-item" url="mestrar">MESTRAR</div>
				<div class="sidebar-item" url="mesa">MESA</div>
				<div class="sidebar-item" url="ficha">FICHA</div>
				<div class="sidebar-item" url="regras">REGRAS</div>
			</div><!-- submenu -->
		</div><!-- sidebar-menu -->

		<br><br>
		<div class="sidebar-item last-item">
			<ion-icon name="log-out-outline"></ion-icon>
			DESCONECTAR-SE
		</div><!-- sidebar-item -->
	</div><!-- sidebar-content -->
</aside><!-- sidebar -->

<div class="content">
	<?= \Application::includeCurrentPage(); ?>
</div><!-- content -->