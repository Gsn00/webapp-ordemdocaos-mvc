<script src="assets/js/ficha.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/ficha.css">

<?php if ($playerExists) { ?>

<div class="content-box">
	<div class="ficha-wrapper-1 inlineFlex spaceFlex">
		<div class="ficha-info-left">
			<div class="ficha-about">
				<div class="ficha-item">
					<p>Nome</p>
					<input type="text" name="" value="<?= $nome ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Classe</p>
					<input type="text" name="" value="<?= $classe ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Idade</p>
					<input type="text" name="" value="<?= $idade ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Nacionalidade</p>
					<input type="text" name="" value="<?= $nacionalidade ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Deslocamento</p>
					<input type="text" name="" value="<?= $deslocamento ?>" disabled>
				</div><!-- perfil-item -->
			</div><!-- ficha-about -->

			<div class="ficha-about">
				<div class="ficha-item">
					<p>Jogador</p>
					<input type="text" name="" value="<?= $jogador ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Exposição</p>
					<input type="text" name="" value="<?= $exposicao ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Origem</p>
					<input type="text" name="" value="<?= $origem ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Trilha</p>
					<input type="text" name="" value="<?= $trilha ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>PE/Rodada</p>
					<input type="text" name="" value="<?= $pe ?>" disabled>
				</div><!-- perfil-item -->
			</div><!-- ficha-about -->
		</div><!-- ficha-info-left -->

		<div class="ficha-info-right">
			<div class="ficha-info-image"></div>
			<div class="ficha-bars">
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>VIDA</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div class="bar-single"></div>
						<span><?= $vida ?> / <?= $max_vida ?></span>
					</div>
				</div><!-- bar-single-container -->
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>ENERGIA</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div class="bar-single"></div>
						<span><?= $energia ?> / <?= $max_energia ?></span>
					</div>
				</div><!-- bar-single-container -->
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>STAMINA</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div class="bar-single"></div>
						<span><?= $stamina ?> / <?= $max_stamina ?></span>
					</div>
				</div><!-- bar-single-container -->
			</div><!-- ficha-bars -->
		</div><!-- ficha-info-right -->
	</div><!-- ficha-wrapper-1 -->
		
	<div class="ficha-wrapper-2">
		<div class="attributes-wrapper">
			<h2 class="mini-title">
				Atributos
				<ion-icon name="create-outline"></ion-icon>
			</h2>

			<div class="ficha-attributes">
				<img src="assets/images/Atributos.png" draggable="false" alt="">
				<span class="ficha-attributes-single" id="agi">0</span>
				<span class="ficha-attributes-single" id="int">0</span>
				<span class="ficha-attributes-single" id="vig">0</span>
				<span class="ficha-attributes-single" id="pre">0</span>
				<span class="ficha-attributes-single" id="for">0</span>
			</div><!-- ficha-info-middle -->
		</div><!-- attributes-wrapper -->

		<div class="skills-wrapper">
			<h2 class="mini-title">
				Perícias
				<ion-icon name="create-outline"></ion-icon>
			</h2>

			<div class="skills-container">
				<div class="skill-single">
					<p>Acrobacia</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Adestramento</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Artes</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Atletismo</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Atualidades</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Ciência</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Acrobacia</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
				<div class="skill-single">
					<p>Acrobacia</p>
					<input type="text" name="" value="0">
				</div><!-- skill-single -->
			</div><!-- skills-container -->
		</div><!-- skills-wrapper -->
	</div><!-- ficha-wrapper-2 -->

	<div class="ficha-wrapper-3">
		<div class="powers-wrapper">
			<h2 class="mini-title">Poderes</h2>
			<table class="powers-table">
				<tr>
					<td>
						<h3>Soltar fogo pelas orelhas</h3>
						<p>Com esse poder vc fica girando e queima os inimigo</p>
					</td>
					<td class="power-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Super leitura</h3>
						<p>Voce consegue ler 5 livros em um minuto</p>
					</td>
					<td class="power-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>
						<h3>Olhar da desgraça</h3>
						<p>Voce consegue olhar para a face do rage sem vomitar</p>
					</td>
					<td class="power-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
			</table><!-- powers-table -->
			<div class="page-arrows">
				<ion-icon class="arrow-left" name="chevron-back-outline"></ion-icon>
				<ion-icon class="arrow-right" name="chevron-forward-outline"></ion-icon>
			</div><!-- page-arrows -->
		</div><!-- powers-wrapper -->
	</div><!-- ficha-wrapper-3 -->

	<div class="ficha-wrapper-4">
	<div class="inventory-container">
			<h2 class="mini-title">Ataques</h2>
			<table class="inventory">
				<thead>
					<th>Arma</th>
					<th>Tipo</th>
					<th>Ataque</th>
					<th>Alcance</th>
					<th>Dano</th>
					<th>Crítico</th>
					<th>Recarga</th>
					<th>Especial</th>
					<th></th>
				</thead>
				<tr>
					<td>Soco</td>
					<td>Punho</td>
					<td>For + Luta</td>
					<td>Curto</td>
					<td>1D20</td>
					<td>19</td>
					<td>1</td>
					<td>Não</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Soco</td>
					<td>Punho</td>
					<td>For + Luta</td>
					<td>Curto</td>
					<td>1D20</td>
					<td>19</td>
					<td>1</td>
					<td>Não</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Soco</td>
					<td>Punho</td>
					<td>For + Luta</td>
					<td>Curto</td>
					<td>1D20</td>
					<td>19</td>
					<td>1</td>
					<td>Não</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
			</table><!-- inventory -->
			<div class="page-arrows">
				<ion-icon class="arrow-left" name="chevron-back-outline"></ion-icon>
				<ion-icon class="arrow-right" name="chevron-forward-outline"></ion-icon>
			</div><!-- page-arrows -->
		</div><!-- inventory-container -->
	</div><!-- ficha-wrapper-4 -->

	<div class="ficha-wrapper-5">
		<div class="inventory-container">
			<h2 class="mini-title">Inventário</h2>
			<table class="inventory">
				<thead>
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Categoria</th>
					<th>Tipo</th>
					<th></th>
				</thead>
				<tr>
					<td>Pão</td>
					<td>2</td>
					<td>0</td>
					<td>1</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Arma pika das galaxia que atira raios</td>
					<td>1</td>
					<td>5</td>
					<td>1</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Arma pika das galaxia que atira raios</td>
					<td>1</td>
					<td>5</td>
					<td>1</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Arma pika das galaxia que atira raios</td>
					<td>1</td>
					<td>5</td>
					<td>1</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
				<tr>
					<td>Arma pika das galaxia que atira raios</td>
					<td>1</td>
					<td>5</td>
					<td>1</td>
					<td class="inventory-edit">
						<ion-icon name="create-outline"></ion-icon>
					</td>
				</tr>
			</table><!-- inventory -->
			<div class="page-arrows">
				<ion-icon class="arrow-left" name="chevron-back-outline"></ion-icon>
				<ion-icon class="arrow-right" name="chevron-forward-outline"></ion-icon>
			</div><!-- page-arrows -->
		</div><!-- inventory-container -->
	</div><!-- ficha-wrapper-5 -->
</div><!-- content-box -->

<?php } else { ?>

<div class="content-box">
	<div class="ficha-create">
		<h2>OPS! Você ainda não participa dessa mesa.</h2>
		<h3>Crie uma ficha para entrar!</h3>
		<button id="btn-ficha-form">CRIAR FICHA</button>
	</div><!-- ficha-create -->
</div><!-- content-box -->

<div class="window-container" id="window-ficha-create">
	<div class="btn-close">
			<ion-icon name="close-outline"></ion-icon>
		</div><!-- btn-close -->
	<div class="window">
		<div class="split">
			<div>
				<p>Nome</p>
				<input type="text" id="ficha-form-nome">
				<p>Classe</p>
				<input type="text" id="ficha-form-classe">
				<p>Idade</p>
				<input type="text" id="ficha-form-idade">
				<p>Nacionalidade</p>
				<input type="text" id="ficha-form-nacionalidade">
				<p>Deslocamento</p>
				<input type="text" id="ficha-form-deslocamento">
			</div>
			<div>
				<p>Exposição</p>
				<input type="text" id="ficha-form-exposicao">
				<p>Origem</p>
				<input type="text" id="ficha-form-origem">
				<p>Trilha</p>
				<input type="text" id="ficha-form-trilha">
				<p>PE/Rodada</p>
				<input type="text" id="ficha-form-pe">
			</div>
		</div><!-- split -->
		<div>
			<p>Imagem</p>
			<input type="file" id="file" accept="image/png, image/jpeg"  id="ficha-form-imagem">
			<label for="file">
				<ion-icon name="folder-open"></ion-icon>Escolha uma imagem...
			</label>
			<p>Vida máxima</p>
			<input type="text" id="ficha-form-vida">
			<p>Energia máxima</p>
			<input type="text" id="ficha-form-energia">
			<p>Stamina máxima</p>
			<input type="text" id="ficha-form-stamina">
			<button class="btn-create" id="btn-ficha-create">CRIAR</button>
		</div>
	</div><!-- window -->
</div><!-- window-container -->

<?php } ?>