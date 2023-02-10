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
		url: 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php',
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
		url: 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php',
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
		url: 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php',
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

limitCharacters('.bonus-input', 2);
limitCharacters('.attributes-input', 2);

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
    let name = $('#power-add-name').val();
    let description = $('#power-add-description').val();
    
    $.ajax({
		url: 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php',
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'power-add',
            'name': name,
            'description': description
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

$('body').on('click', '.btn-power-edit', (event) => {
    let el = $(event.target).closest('.power-single');
    let elName = el.attr('name');
    let elDescription = el.attr('description');
    let window = $(`
    <div class="window-container" id="powers-edit-window" tempWindow=true">
        <div class="btn-close">
            <ion-icon name="close-outline"></ion-icon>
        </div><!-- btn-close -->
        <div class="window">
            <input type="text" value="`+elName+`" placeholder="Nome">
            <textarea placeholder="Descrição">`+elDescription+`</textarea>
            <div class="inlineFlex"><button>Excluir</button><button>Salvar</button></div>
        </div>
    </div>
    `);
    openWindow(window);
})