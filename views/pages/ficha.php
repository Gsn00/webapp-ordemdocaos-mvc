<script src="assets/js/ficha.js"></script>
<link rel="stylesheet" type="text/css" href="assets/css/ficha.css">

<?php if ($playerExists) { ?>

<div class="content-box">
	<h2 class="mini-title" nome="<?= $nome ?>" classe="<?= $classe ?>" idade="<?= $idade ?>"
	nacionalidade="<?= $nacionalidade ?>" deslocamento="<?= $deslocamento ?>"
	exposicao="<?= $exposicao ?>" origem="<?= $origem ?>" trilha="<?= $trilha ?>">
		Geral
		<ion-icon id="btn-ficha-edit" name="create-outline"></ion-icon>
	</h2>
	<div class="ficha-wrapper-1 inlineFlex spaceFlex">
		<div class="ficha-info-left">
			<div class="ficha-about">
				<div class="ficha-item">
					<p>Nome</p>
					<input type="text" name="" value="<?= ucfirst($nome) ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Classe</p>
					<input type="text" name="" value="<?= ucfirst($classe) ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Idade</p>
					<input type="text" name="" value="<?= $idade ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Nacionalidade</p>
					<input type="text" name="" value="<?= ucfirst($nacionalidade) ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Deslocamento</p>
					<input type="text" name="" value="<?= ucfirst($deslocamento) ?>" disabled>
				</div><!-- perfil-item -->
			</div><!-- ficha-about -->

			<div class="ficha-about">
				<div class="ficha-item">
					<p>Jogador</p>
					<input type="text" name="" value="<?= $jogador ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Exposição</p>
					<input type="text" name="" value="<?= $exposicao ?>%" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Origem</p>
					<input type="text" name="" value="<?= ucfirst($origem) ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>Trilha</p>
					<input type="text" name="" value="<?= ucfirst($trilha) ?>" disabled>
				</div><!-- perfil-item -->
				<div class="ficha-item">
					<p>PE/Rodada</p>
					<input type="text" name="" value="<?= $pe_rodada ?>" disabled>
				</div><!-- perfil-item -->
			</div><!-- ficha-about -->
		</div><!-- ficha-info-left -->

		<div class="ficha-info-right">
			<div class="ficha-info-image" style="">
				<img src="assets/uploads/<?= $imagem ?>">
			</div>
			<div class="ficha-bars">
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="btn-bar-rem-1 arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="btn-bar-rem-5 arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>VIDA</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="btn-bar-add-5 arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="btn-bar-add-1 arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div id="bar-single-vida" class="bar-single"></div>
						<span class="bar-stats" barname="vida" current="<?= $vida ?>" max="<?= $max_vida ?>">
							<?= $vida ?> / <?= $max_vida ?>
						</span>
					</div>
				</div><!-- bar-single-container -->
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="btn-bar-rem-1 arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="btn-bar-rem-5 arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>SANIDADE</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="btn-bar-add-5 arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="btn-bar-add-1 arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div id="bar-single-sanidade" class="bar-single"></div>
						<span class="bar-stats" barname="sanidade" current="<?= $sanidade ?>" max="<?= $max_sanidade ?>">
							<?= $sanidade ?> / <?= $max_sanidade ?>
						</span>
					</div>
				</div><!-- bar-single-container -->
				<div class="bar-single-container">
					<div class="bar-info">
						<div class="bar-arrows">
							<ion-icon class="btn-bar-rem-1 arrow-button" name="chevron-back-outline"></ion-icon>
							<div>
								<ion-icon class="btn-bar-rem-5 arrow-button" name="caret-back-outline"></ion-icon>
								<span>-5</span>
							</div>
						</div>
						<p>ESFORÇO</p>
						<div class="bar-arrows">
							<div>
								<span>+5</span>
								<ion-icon class="btn-bar-add-5 arrow-button" name="caret-forward-outline"></ion-icon>
							</div>
							<ion-icon class="btn-bar-add-1 arrow-button" name="chevron-forward-outline"></ion-icon>
						</div>
					</div>
					<div class="bar-single-wrapper">
						<div id="bar-single-esforco" class="bar-single"></div>
						<span class="bar-stats" barname="esforco" current="<?= $esforco ?>" max="<?= $max_esforco ?>">
							<?= $esforco ?> / <?= $max_esforco ?>
						</span>
					</div>
				</div><!-- bar-single-container -->
			</div><!-- ficha-bars -->

			<div class="ficha-defense-container">
				<div>
					<p>DEFESA</p>
					<h3><?= $defesa ?></h3>
				</div>
				<div>
					<p>BLOQUEIO</p>
					<h3><?= $bloqueio ?></h3>
				</div>
				<div>
					<P>ESQUIVA</P>
					<h3><?= $esquiva ?></h3>
				</div>
			</div><!-- ficha-defense-container -->
		</div><!-- ficha-info-right -->
	</div><!-- ficha-wrapper-1 -->
		
	<div class="ficha-wrapper-2">
		<div class="attributes-wrapper">
			<h2 class="mini-title">
				Atributos
				<ion-icon id="btn-attributes-edit" name="create-outline"></ion-icon>
			</h2>

			<div class="ficha-attributes">
				<img src="assets/images/Atributos.png" draggable="false" alt="">
				<div class="ficha-attributes-single" id="agi" 
					name="agilidade" value="<?= $atributos['agilidade'] ?>">
					<text><?= $atributos['agilidade'] ?></text>
				</div>
				<div class="ficha-attributes-single" id="int"
				name="inteligencia" value="<?= $atributos['inteligencia'] ?>">
					<text><?= $atributos['inteligencia'] ?></text>
				</div>
				<div class="ficha-attributes-single" id="vig"
				name="vigor" value="<?= $atributos['vigor'] ?>">
					<text><?= $atributos['vigor'] ?></text>
				</div>
				<div class="ficha-attributes-single" id="pre"
				name="presenca" value="<?= $atributos['presenca'] ?>">
					<text><?= $atributos['presenca'] ?></text>
				</div>
				<div class="ficha-attributes-single" id="for" 
				name="forca" value="<?= $atributos['forca'] ?>">
					<text><?= $atributos['forca'] ?></text>
				</div>
			</div><!-- ficha-info-middle -->

			<div class="window-container" id="attributes-edit-window">
				<div class="btn-close">
					<ion-icon name="close-outline"></ion-icon>
				</div><!-- btn-close -->
				<div class="window">
					<div class="window-compact">
						<?php foreach ($atributos as $key => $value) { ?>
						<div class="window-compact-box">
							<p><?= ucfirst($key) ?></p>
							<input class="attributes-input" name="<?= $key ?>" value="<?= $value ?>" type="number" id="">
						</div>
						<?php } ?>
					</div>
					<button id="btn-attributes-update">Salvar</button>
				</div><!-- window -->
			</div><!-- window-container -->
		</div><!-- attributes-wrapper -->

		<div class="skills-wrapper">
			<h2 class="mini-title">
				Perícias
				<ion-icon id="btn-skills-edit" name="create-outline"></ion-icon>
			</h2>

			<div class="skills-container">
				<?php foreach ($pericias as $key => $value) { if ($value != 0) { ?>
				<div class="skill-single" name="<?= $key ?>" 
				attribute="<?= $getAttrFromSkill[$key] ?>" value="<?= $value ?>" 
				bonus="<?= $pericias_bonus[$key] ?>">
					<p><?= ucfirst($key) ?></p>
					<span><?= $value ?></span>
				</div><!-- skill-single -->
				<?php } } ?>
			</div><!-- skills-container -->
		</div><!-- skills-wrapper -->

		<div class="window-container" id="skills-edit-window">
				<div class="btn-close">
					<ion-icon name="close-outline"></ion-icon>
				</div><!-- btn-close -->
				<div class="window">
					<div class="window-compact">
						<?php foreach ($pericias as $key => $value) { ?>
						<div class="window-compact-box window-skill-box" 
						name="<?= $key ?>" value="<?= $value ?>" 
						bonus="<?= $pericias_bonus[$key] ?>">
							<p><?= ucfirst($key) ?></p>
							<div class="buttons">
								<button class="skill-select-button <?=($value == 0) ? 'selected' : '' ?>" value="0">0</button>
								<button class="skill-select-button <?=($value == 5) ? 'selected' : '' ?>" value="5">5</button>
								<button class="skill-select-button <?=($value == 10) ? 'selected' : '' ?>" value="10">10</button>
								<button class="skill-select-button <?=($value == 15) ? 'selected' : '' ?>" value="15">15</button>
							</div>
							<div class="window-compact-bonus">
								<p>Bônus</p>
								<input class="bonus-input" value="<?= $pericias_bonus[$key] ?>" type="number" id="">
							</div>
						</div>
						<?php } ?>
					</div><!-- window-compact -->
					<button id="btn-skills-update">Salvar</button>
				</div><!-- window -->
			</div><!-- window-container -->
	</div><!-- ficha-wrapper-2 -->

	<div class="ficha-wrapper-3">
		<div class="powers-wrapper">
			<h2 class="mini-title">
				Poderes
				<ion-icon id="power-add" name="add-outline"></ion-icon>
			</h2>
			<table class="powers-table">
				<?php if (isset($poderes)) { foreach($poderes as $key => $value) { ?>
				<tr class="power-single" powerid="<?= $key ?>" name="<?= ucfirst($value['nome']) ?>"
				description="<?= ucfirst($value['descricao']) ?>">
					<td>
						<h3 class="power-single-name"><?= ucfirst($value['nome']) ?></h3>
						<div>
							<p class="power-single-description"><?= ucfirst($value['descricao']) ?></p>
						</div>
					</td>
					<td class="power-edit">
						<ion-icon class="btn-power-edit" name="create-outline"></ion-icon>
					</td>
				</tr>
				<?php } } ?>
			</table><!-- powers-table -->
			<div class="page-arrows">
				<ion-icon class="arrow-left" name="chevron-back-outline"></ion-icon>
				<ion-icon class="arrow-right" name="chevron-forward-outline"></ion-icon>
			</div><!-- page-arrows -->
		</div><!-- powers-wrapper -->
	</div><!-- ficha-wrapper-3 -->

	<div class="ficha-wrapper-4">
	<div class="inventory-container">
			<h2 class="mini-title">
				Ataques
				<ion-icon id="btn-attack-add" name="add-outline"></ion-icon>
			</h2>
			<table class="inventory">
				<thead>
					<th>Arma</th>
					<th>Tipo</th>
					<th>Ataque</th>
					<th>Alcance</th>
					<th>Dano</th>
					<th>Crítico</th>
					<th>Especial</th>
					<th></th>
				</thead>
				<?php if (isset($ataques)) { foreach ($ataques as $key => $value) { ?>
				<tr class="attack-single" ataqueid="<?= $key ?>" arma="<?= $value['arma'] ?>" 
				tipo="<?= $value['tipo'] ?>" ataque="<?= $value['ataque'] ?>" 
				alcance="<?= $value['alcance'] ?>" dano="<?= $value['dano'] ?>" 
				critico="<?= $value['critico'] ?>" especial="<?= $value['especial'] ?>">
					<td data-label="Arma"><?= ucfirst($value['arma']) ?></td>
					<td data-label="Tipo"><?= ucfirst($value['tipo']) ?></td>
					<td data-label="Ataque"><?= ucfirst($value['ataque']) ?></td>
					<td data-label="Alcance"><?= ucfirst($value['alcance']) ?></td>
					<td data-label="Dano"><?= strtoupper($value['dano']) ?></td>
					<td data-label="Crítico"><?= $value['critico'] ?></td>
					<td data-label="Especial"><?= ucfirst($value['especial']) ?></td>
					<td class="inventory-edit">
						<ion-icon class="btn-attack-edit" name="create-outline"></ion-icon>
					</td>
				</tr>
				<?php } } ?>
			</table><!-- inventory -->
			<div class="page-arrows">
				<ion-icon class="arrow-left" name="chevron-back-outline"></ion-icon>
				<ion-icon class="arrow-right" name="chevron-forward-outline"></ion-icon>
			</div><!-- page-arrows -->
		</div><!-- inventory-container -->
	</div><!-- ficha-wrapper-4 -->

	<div class="ficha-wrapper-5">
		<div class="inventory-container">
			<h2 class="mini-title">
				Inventário
				<ion-icon id="btn-inventory-add" name="add-outline"></ion-icon>
			</h2>
			<table class="inventory">
				<thead>
					<th>Nome</th>
					<th>Quantidade</th>
					<th>Categoria</th>
					<th>Tipo</th>
					<th></th>
				</thead>
				<?php if (isset($inventario)) { foreach ($inventario as $key => $value) { ?>
				<tr class="inventory-single" inventarioid="<?= $key ?>" nome="<?= $value['nome'] ?>"
				quantidade="<?= $value['quantidade'] ?>" categoria="<?= $value['categoria'] ?>" 
				tipo="<?= $value['tipo'] ?>">
					<td data-label="Nome"><?= ucfirst($value['nome']) ?></td>
					<td data-label="Quantidade"><?= $value['quantidade'] ?></td>
					<td data-label="Categoria"><?= $value['categoria'] ?></td>
					<td data-label="Tipo"><?= $value['tipo'] ?></td>
					<td class="inventory-edit">
						<ion-icon class="btn-inventory-edit" name="create-outline"></ion-icon>
					</td>
				</tr>
				<?php } } ?>
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
				<select id="ficha-form-classe">
					<option disabled selected value=""></option>
					<option value="combatente">Combatente</option>
					<option value="investigador">Investigador</option>
				</select>
				<p>Idade</p>
				<input type="number" id="ficha-form-idade">
				<p>Nacionalidade</p>
				<input type="text" id="ficha-form-nacionalidade">
			</div>
			<div>
				<p>Deslocamento</p>
				<input type="text" id="ficha-form-deslocamento">
				<p>Exposição</p>
				<select id="ficha-form-exposicao">
					<option disabled selected value=""></option>
					<option value="0">0%</option>
					<option value="5">5%</option>
					<option value="10">10%</option>
					<option value="15">15%</option>
					<option value="20">20%</option>
					<option value="25">25%</option>
					<option value="30">30%</option>
					<option value="35">35%</option>
					<option value="40">40%</option>
					<option value="45">45%</option>
					<option value="50">50%</option>
					<option value="55">55%</option>
					<option value="60">60%</option>
					<option value="65">65%</option>
					<option value="70">70%</option>
					<option value="75">75%</option>
					<option value="80">80%</option>
					<option value="85">85%</option>
					<option value="90">90%</option>
					<option value="95">95%</option>
					<option value="99">99%</option>
				</select>
				<p>Origem</p>
				<input type="text" id="ficha-form-origem">
				<p>Trilha</p>
				<input type="text" id="ficha-form-trilha">
			</div>
		</div><!-- split -->
		<div>
			<p>Imagem</p>
			<input type="file" accept="image/png, image/jpeg, image/gif" id="ficha-form-imagem">
			<label for="ficha-form-imagem">
				<ion-icon name="folder-open"></ion-icon>Escolha uma imagem...
			</label>

			<button class="btn-create" id="btn-ficha-create">CRIAR</button>
		</div>
	</div><!-- window -->
</div><!-- window-container -->

<?php } ?>