<link rel="stylesheet" href="<?= PATH ?>css/index.css">

<aside class="sidebar">
	<h3 class="title">oHypeer</h3>
	<div class="sidebar-content">
		<div class="sidebar-item">
			<ion-icon name="home-outline"></ion-icon>
			HOME
		</div><!-- sidebar-item -->
		<div class="sidebar-item">
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
				<div class="sidebar-item">MESTRAR</div>
				<div class="sidebar-item">MESA</div>
				<div class="sidebar-item">FICHA</div>
				<div class="sidebar-item">REGRAS</div>
			</div><!-- submenu -->
		</div><!-- sidebar-menu -->

		<div class="sidebar-menu" open="closed">
			<div class="sidebar-menu-btn">
				<ion-icon name="dice-outline"></ion-icon>
				ONE PIECE
				<ion-icon class="arrow" name="chevron-forward-outline"></ion-icon>
			</div><!-- sidebar-item -->

			<div class="sidebar-submenu">
				<div class="sidebar-item">MESTRAR</div>
				<div class="sidebar-item">MESA</div>
				<div class="sidebar-item">FICHA</div>
				<div class="sidebar-item">REGRAS</div>
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
	
	<?php
	if (empty($GLOBALS['CURRENT_PAGE'])) {
		$GLOBALS['CURRENT_PAGE'] = 'home';
	}
	include('pages/'.$GLOBALS['CURRENT_PAGE'].'.php');
	?>
</div><!-- content -->