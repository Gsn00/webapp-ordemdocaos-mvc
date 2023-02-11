limitCharacters('.bonus-input', 2);
limitCharacters('.attributes-input', 2);

$('body').on('click', '.window-container .btn-close', (event)=>{
    let window = $(event.target).closest('.window-container');
    $('.window-overlay').css('display', 'none');
    window.css('display', 'none');
    $('[tempWindow=true]').remove();
    clearInterval(interval);
});

var openWindow = (window) => {
    $(window).appendTo('.main');
    $(window).css('display', 'flex').hide().fadeIn();
    $('.window-overlay').css('display', 'block');
}

$('body').on('click', '#btn-ficha-form', ()=>{
    openWindow('#window-ficha-create');
});

$('body').on('click', '#btn-ficha-create', ()=>{
    let nome = $('#ficha-form-nome').val();
    let classe = $('#ficha-form-classe').val();
    let idade = $('#ficha-form-idade').val();
    let nacionalidade = $('#ficha-form-nacionalidade').val();
    let deslocamento = $('#ficha-form-deslocamento').val();
    let exposicao = $('#ficha-form-exposicao').val();
    let origem = $('#ficha-form-origem').val();
    let trilha = $('#ficha-form-trilha').val();
    let pe = $('#ficha-form-pe').val();
    let vida = $('#ficha-form-vida').val();
    let energia = $('#ficha-form-energia').val();
    let stamina = $('#ficha-form-stamina').val();
    let imagem = $('#ficha-form-imagem').prop('files')[0];

    let formdata = new FormData();

    formdata.append('imagem', imagem);
    formdata.append('action', 'ficha-create');
    formdata.append('nome', nome);
    formdata.append('classe', classe);
    formdata.append('idade', idade);
    formdata.append('nacionalidade', nacionalidade);
    formdata.append('deslocamento', deslocamento);
    formdata.append('exposicao', exposicao);
    formdata.append('origem', origem);
    formdata.append('trilha', trilha);
    formdata.append('pe', pe);
    formdata.append('vida', vida);
    formdata.append('energia', energia);
    formdata.append('stamina', stamina);

    $.ajax({
		url: AJAXURL,
		method: 'post',
        contentType: false,
        processData: false,
        cache: false,
        data: formdata,
        beforeSend: ()=>{
            $('#btn-ficha-create').css('display', 'none');
        }
	}).done((data)=>{
		if ($.parseJSON(data) == 'Sucesso') {
            location.reload();
            return;
        }
        alert($.parseJSON(data));
        $('#btn-ficha-create').css('display', 'flex');
	});
});

$('body').on('click', '#btn-attributes-edit', ()=>{
    openWindow('#attributes-edit-window');
    changedAttributes = [];
    resetAttributesStyle();
});

$('body').on('click', '#btn-skills-edit', ()=>{
    openWindow('#skills-edit-window');
    changedSkills = [];
    resetSkillStyle();
});

let interval;
$('body').on('click', '.ficha-attributes-single', (event) => {
let el = $(event.target).closest('.ficha-attributes-single');
    let elName = el.attr('name');
    let elAttr = parseInt(el.attr('value'));
    if (elAttr < 1) elAttr -= 2;

    let window = $(`
    <div id="window-dice" class="window-container" tempWindow=true>
         <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div>
        <div class="window">
            `+elName.toUpperCase()+`
            <h2>1D20</h2>
            <div class="dice-values"></div>
            <h1 id="dice-value"></h1>
        </div>
    </div>
    `);

    let worstDice = 0;
    let bestDice = 0;
    let currentInterval = 0;
    interval = setInterval(() => {
        if (currentInterval < Math.abs(elAttr) && currentInterval < 10) {
            currentInterval++;
            let random = (Math.floor((Math.random() * 20 + 1)));
            let span = $('<span>'+random+'</span>');
            $('.dice-values').append(span);
            span.fadeIn();

            if (worstDice == 0) worstDice = random;
            if (random < worstDice) worstDice = random;
            if (random > bestDice) bestDice = random;
        } else {
            if (elAttr > 0) {
                $('#dice-value').html(bestDice);
            } else {
                $('#dice-value').html(worstDice);
            }
            $('#dice-value').fadeIn();
            clearInterval(interval);
        }
    }, 1000);
    openWindow(window);
});

$('body').on('click', '.skill-single', (event) => {
    let el = $(event.target).closest('.skill-single');
    let elName = el.attr('name');
    let elAttr = parseInt(el.attr('attribute'));
    if (elAttr < 1) elAttr -= 2;
    let elValue = parseInt(el.attr('value'));
    let elBonus = parseInt(el.attr('bonus'));
    let window = $(`
    <div id="window-dice" class="window-container" tempWindow=true>
         <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div>
        <div class="window">
            `+elName.toUpperCase()+`
            <h2>1D20 + `+elValue+` + `+elBonus+`</h2>
            <div class="dice-values"></div>
            <h1 id="dice-value"></h1>
        </div>
    </div>
    `);

    let worstDice = 0;
    let bestDice = 0;
    let currentInterval = 0;
    interval = setInterval(() => {
        if (currentInterval < Math.abs(elAttr) && currentInterval < 10) {
            currentInterval++;
            let random = (Math.floor((Math.random() * 20 + 1) + elValue + elBonus));
            let span = $('<span>'+random+'</span>');
            $('.dice-values').append(span);
            span.fadeIn();

            if (worstDice == 0) worstDice = random;
            if (random < worstDice) worstDice = random;
            if (random > bestDice) bestDice = random;
        } else {
            if (elAttr > 0) {
                $('#dice-value').html(bestDice);
            } else {
                $('#dice-value').html(worstDice);
            }
            $('#dice-value').fadeIn();
            clearInterval(interval);
        }
    }, 1000);
    openWindow(window);
});

var changedSkills = [];
$('body').on('click', '.skill-select-button', (event) => {
    let el = $(event.target).closest('.skill-select-button');
    let elValue = el.attr('value');
    let elParentName = el.closest('.window-skill-box').attr('name');
    let buttons = el.closest('.buttons').find('.skill-select-button');
    buttons.removeClass('selected');
    el.addClass('selected');
    changedSkills.push({[elParentName]: elValue});
});

var resetAttributesStyle = () => {
    var attributes = $('.attributes-input');
    attributes.each(function() {
        let attribute = $(this);
        let value = attribute.attr('value');
        attribute.val(value);
    });
}

var resetSkillStyle = () => {
    var skills = $('.window-skill-box');
    skills.find('.skill-select-button').removeClass('selected');
    skills.each(function() {
        let skill = $(this);
        let value = skill.attr('value');
        let buttons = skill.find('.skill-select-button');
        buttons.each(function() {
            let button = $(this);
            if (button.attr('value') == value) {
                button.addClass('selected');
            }
        });
        let bonus = skill.attr('bonus');
        skill.find('.bonus-input').val(bonus);
    });
}

$('body').on('click', '#btn-attributes-update', ()=>{
    let formdata = new FormData();
    formdata.append('action', 'attributes-update');
    formdata.append('attributes', JSON.stringify(changedAttributes));
    console.log(changedAttributes)

    $.ajax({
		url: AJAXURL,
		method: 'post',
        contentType: false,
        processData: false,
        cache: false,
        data: formdata,
        beforeSend: ()=>{
            $('#btn-attributes-update').css('display', 'none');
        }
	}).done((data)=>{
		if ($.parseJSON(data) == 'Sucesso') {
            location.reload();
            return;
        }
        alert($.parseJSON(data));
        $('#btn-attributes-update').css('display', 'flex');
	});
});

$('body').on('click', '#btn-skills-update', () => {  
    let formdata = new FormData();
    formdata.append('action', 'skills-update');
    formdata.append('skills', JSON.stringify(changedSkills));

    $.ajax({
		url: AJAXURL,
		method: 'post',
        contentType: false,
        processData: false,
        cache: false,
        data: formdata,
        beforeSend: ()=>{
            $('#btn-skill-update').css('display', 'none');
        }
	}).done((data)=>{
		if ($.parseJSON(data) == 'Sucesso') {
            location.reload();
            return;
        }
        alert($.parseJSON(data));
        $('#btn-skill-update').css('display', 'flex');
	});
});

$('body').on('input', '.bonus-input', (event)=>{
    let el = $(event.target);
    let elValue = el.val();
    let elName = el.closest('.window-skill-box').attr('name') + '_bonus';
    changedSkills.push({[elName]: elValue});
}); 

var changedAttributes = [];
$('body').on('input', '.attributes-input', (event)=>{
    let el = $(event.target);
    let elValue = el.val();
    let elName = el.attr('name');
    changedAttributes.push({[elName]: elValue});
});

$('body').on('click', '#power-add', () => {
    let window = $(`
    <div class="window-container" id="powers-add-window" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <input id="power-add-name" type="text" value="" placeholder="Nome">
            <textarea id="power-add-description" placeholder="Descrição"></textarea>
            <button id="btn-power-add-save">Salvar</button>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-power-add-save', () => {
    let elName = $('#power-add-name').val();
    let elDescription = $('#power-add-description').val();
    
    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'power-add',
            'name': elName,
            'description': elDescription
        },
        beforeSend: ()=>{
            $('#btn-power-add-save').css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-power-add-save').css('display', 'flex');
	});
})

$('body').on('click', '#btn-power-edit-delete', () => {
    let el = $('#powers-edit-window');
    let elPowerId = el.attr('powerid');

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'power-delete',
            'powerid': elPowerId
        },
        beforeSend: ()=>{
            $('#btn-power-edit-delete').parent().css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-power-edit-delete').parent().css('display', 'flex');
	});
})

$('body').on('click', '#btn-power-edit-update', () => {
    let el = $('#powers-edit-window');
    let elName = el.find('input').val();
    let elDescription = el.find('textarea').val();
    let elPowerId = el.attr('powerid');

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'power-update',
            'powerid': elPowerId,
            'name': elName,
            'description': elDescription
        },
        beforeSend: ()=>{
            $('#btn-power-edit-update').parent().css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-power-edit-update').parent().css('display', 'flex');
	});
})

$('body').on('click', '.btn-power-edit', (event) => {
    let el = $(event.target).closest('.power-single');
    let elName = el.attr('name');
    let elDescription = el.attr('description');
    let elPowerId = el.attr('powerid');
    let window = $(`
    <div class="window-container" id="powers-edit-window" powerid="`+elPowerId+`" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <input type="text" value="`+elName+`" placeholder="Nome">
            <textarea placeholder="Descrição">`+elDescription+`</textarea>
            <div class="inlineFlex">
                <button id="btn-power-edit-delete">Excluir</button>
                <button id="btn-power-edit-update">Salvar</button>
            </div>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-attack-add', () => {
    let window = $(`
    <div class="window-container" id="attack-add-window" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <div>
                <p>Arma</p>
                <input id="attack-add-arma" type="text" value="">
            </div>
            <div>
                <p>Tipo</p>
                <input id="attack-add-tipo" type="text" value="">
            </div>
            <div>
                <p>Ataque</p>
                <input id="attack-add-ataque" type="text" value="">
            </div>
            <div>
                <p>Alcance</p>
                <input id="attack-add-alcance" type="text" value="">
            </div>
            <div>
                <p>Dano</p>
                <input id="attack-add-dano" type="text" value="">
            </div>
            <div>
                <p>Crítico</p>
                <input id="attack-add-critico" type="text" value="">
            </div>
            <div>
                <p>Recarga</p>
                <input id="attack-add-recarga" type="text" value="">
            </div>
            <div>
                <p>Especial</p>
                <select id="attack-add-especial">
                    <option value="não">Não</option>
                    <option value="sim">Sim</option>
                </select>
            </div>
            
            <button id="btn-attack-add-save">Salvar</button>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-attack-add-save', () => {
    let elArma = $('#attack-add-arma').val();
    let elTipo = $('#attack-add-tipo').val();
    let elAtaque = $('#attack-add-ataque').val();
    let elAlcance = $('#attack-add-alcance').val();
    let elDano = $('#attack-add-dano').val();
    let elCritico = $('#attack-add-critico').val();
    let elRecarga = $('#attack-add-recarga').val();
    let elEspecial = $('#attack-add-especial').val();

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'attack-add',
            'arma': elArma,
            'tipo': elTipo,
            'ataque': elAtaque,
            'alcance': elAlcance,
            'dano': elDano,
            'critico': elCritico,
            'recarga': elRecarga,
            'especial': elEspecial
        },
        beforeSend: ()=>{
            $('#btn-attack-add-save').css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-attack-add-save').css('display', 'flex');
	});
})

$('body').on('click', '.btn-attack-edit', (event) => {
    let el = $(event.target).closest('.attack-single');
    let elArma = el.attr('arma');
    let elTipo = el.attr('tipo');
    let elAtaque = el.attr('ataque');
    let elAlcance = el.attr('alcance');
    let elDano = el.attr('dano');
    let elCritico = el.attr('critico');
    let elRecarga = el.attr('recarga');
    let elEspecial = el.attr('especial');
    let elAtaqueId = el.attr('ataqueid');

    let window = $(`
    <div class="window-container" id="attack-edit-window" ataqueid="`+elAtaqueId+`" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
        <div>
            <p>Arma</p>
                <input id="attack-edit-arma" type="text" value="`+elArma+`">
            </div>
            <div>
                <p>Tipo</p>
                <input id="attack-edit-tipo" type="text" value="`+elTipo+`">
            </div>
            <div>
                <p>Ataque</p>
                <input id="attack-edit-ataque" type="text" value="`+elAtaque+`">
            </div>
            <div>
                <p>Alcance</p>
                <input id="attack-edit-alcance" type="text" value="`+elAlcance+`">
            </div>
            <div>
                <p>Dano</p>
                <input id="attack-edit-dano" type="text" value="`+elDano+`">
            </div>
            <div>
                <p>Crítico</p>
                <input id="attack-edit-critico" type="number" value="`+elCritico+`">
            </div>
            <div>
                <p>Recarga</p>
                <input id="attack-edit-recarga" type="number" value="`+elRecarga+`">
            </div>
            <div>
                <p>Especial</p>
                <select id="attack-edit-especial">
                    <option `+(('não' == elEspecial) ? 'selected' : '')+` value="não">Não</option>
                    <option `+(('sim' == elEspecial) ? 'selected' : '')+` value="sim">Sim</option>
                </select>
            </div>
            <div class="inlineFlex">
                <button id="btn-attack-edit-delete">Excluir</button>
                <button id="btn-attack-edit-update">Salvar</button>
            </div>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-attack-edit-delete', () => {
    let el = $('#attack-edit-window');
    let elAtaqueId = el.attr('ataqueid');

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'attack-delete',
            'ataqueid': elAtaqueId
        },
        beforeSend: ()=>{
            $('#btn-attack-edit-delete').parent().css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-attack-edit-delete').parent().css('display', 'flex');
	});
})

$('body').on('click', '#btn-attack-edit-update', () => {
    let el = $('#attack-edit-window');
    let elArma = el.find('#attack-edit-arma').val();
    let elTipo = el.find('#attack-edit-tipo').val();
    let elAtaque = el.find('#attack-edit-ataque').val();
    let elAlcance = el.find('#attack-edit-alcance').val();
    let elDano = el.find('#attack-edit-dano').val();
    let elCritico = el.find('#attack-edit-critico').val();
    let elRecarga = el.find('#attack-edit-recarga').val();
    let elEspecial = el.find('#attack-edit-especial').val();
    let elAtaqueId = el.attr('ataqueid');

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'attack-update',
            'ataqueid': elAtaqueId,
            'arma': elArma,
            'tipo': elTipo,
            'ataque': elAtaque,
            'alcance': elAlcance,
            'dano': elDano,
            'critico': elCritico,
            'recarga': elRecarga,
            'especial': elEspecial
        },
        beforeSend: ()=>{
            $('#btn-attack-edit-update').parent().css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-attack-edit-update').parent().css('display', 'flex');
	});
})

$('body').on('click', '#btn-inventory-add', () => {
    let window = $(`
    <div class="window-container" id="inventory-add-window" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <div>
                <p>Nome</p>
                <input id="inventory-add-nome" type="text" value="">
            </div>
            <div>
                <p>Quantidade</p>
                <input id="inventory-add-quantidade" type="number" value="">
            </div>
            <div>
                <p>Categoria</p>
                <select id="inventory-add-categoria">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            <div>
                <p>Tipo</p>
                <select id="inventory-add-tipo">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>
            
            <button id="btn-inventory-add-save">Salvar</button>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-inventory-add-save', () => {
    let elNome = $('#inventory-add-nome').val();
    let elQuantidade = $('#inventory-add-quantidade').val();
    let elCategoria = $('#inventory-add-categoria').val();
    let elTipo = $('#inventory-add-tipo').val();

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'inventory-add',
            'nome': elNome,
            'quantidade': elQuantidade,
            'categoria': elCategoria,
            'tipo': elTipo
        },
        beforeSend: ()=>{
            $('#btn-inventory-add-save').css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-inventory-add-save').css('display', 'flex');
	});
})

$('body').on('click', '.btn-inventory-edit', (event) => {
    let el = $(event.target).closest('.inventory-single');
    let elNome = el.attr('nome');
    let elQuantidade = el.attr('quantidade');
    let elCategoria = el.attr('categoria');
    let elTipo = el.attr('tipo');
    let elInventarioId = el.attr('inventarioid');

    let window = $(`
    <div class="window-container" id="inventory-edit-window" inventarioid="`+elInventarioId+`" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <div>
                <p>Nome</p>
                <input id="inventory-edit-nome" type="text" value="`+elNome+`">
            </div>
            <div>
                <p>Quantidade</p>
                <input id="inventory-edit-quantidade" type="text" value="`+elQuantidade+`">
            </div>
            <div>
                <p>Categoria</p>
                <select id="inventory-edit-categoria">
                    <option `+(('0' == elCategoria) ? 'selected' : '')+` value="0">0</option>
                    <option `+(('1' == elCategoria) ? 'selected' : '')+` value="1">1</option>
                    <option `+(('2' == elCategoria) ? 'selected' : '')+` value="2">2</option>
                    <option `+(('3' == elCategoria) ? 'selected' : '')+` value="3">3</option>
                    <option `+(('4' == elCategoria) ? 'selected' : '')+` value="4">4</option>
                </select>
            </div>
            <div>
                <p>Tipo</p>
                <select id="inventory-edit-tipo">
                    <option `+(('0' == elTipo) ? 'selected' : '')+` value="0">0</option>
                    <option `+(('1' == elTipo) ? 'selected' : '')+` value="1">1</option>
                    <option `+(('2' == elTipo) ? 'selected' : '')+` value="2">2</option>
                    <option `+(('3' == elTipo) ? 'selected' : '')+` value="3">3</option>
                    <option `+(('4' == elTipo) ? 'selected' : '')+` value="4">4</option>
                </select>
            </div>
            <div class="inlineFlex">
                <button id="btn-inventory-edit-delete">Excluir</button>
                <button id="btn-inventory-edit-update">Salvar</button>
            </div>
        </div>
    </div>
    `);
    openWindow(window);
})

$('body').on('click', '#btn-inventory-edit-delete', () => {
    let el = $('#inventory-edit-window');
    let elInventarioId = el.attr('inventarioid');

    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'inventory-delete',
            'inventarioid': elInventarioId
        },
        beforeSend: ()=>{
            $('#btn-inventory-edit-delete').parent().css('display', 'none');
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-inventory-edit-delete').parent().css('display', 'flex');
	});
})

$('body').on('click', '#btn-inventory-edit-update', () => {
    let el = $('#inventory-edit-window');
    let elNome = el.find('#inventory-edit-nome').val();
    let elQuantidade = el.find('#inventory-edit-quantidade').val();
    let elCategoria = el.find('#inventory-edit-categoria').val();
    let elTipo = el.find('#inventory-edit-tipo').val();
    let elInventarioId = el.attr('inventarioid');

    $.ajax({
        url: AJAXURL,
        method: 'post',
        dataType: 'json',
        data: { 
            'action': 'inventory-update',
            'inventarioid': elInventarioId,
            'nome': elNome,
            'quantidade': elQuantidade,
            'categoria': elCategoria,
            'tipo': elTipo
        },
        beforeSend: ()=>{
            $('#btn-inventory-edit-update').parent().css('display', 'none');
        }
    }).done((data)=>{
        if (data == 'Sucesso') {
            location.reload();
            return;
        }
        alert(data);
        $('#btn-inventory-edit-update').parent().css('display', 'flex');
    });
})