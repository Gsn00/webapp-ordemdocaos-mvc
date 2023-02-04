$('body').on('click', '#btn-ficha-form', ()=>{
    let window = $('#window-ficha-create');
    window.css('display', 'flex');
});

$('body').on('click', '#window-ficha-create .btn-close', ()=>{
    let window = $('#window-ficha-create');
    window.css('display', 'none');
});

$('body').on('click', '#btn-ficha-create', ()=>{
    let window = $('#window-ficha-create');
    
    let nome = $('#ficha-form-nome').val();
    let classe = $('#ficha-form-classe').val();
    let idade = $('#ficha-form-idade').val();
    let nacionalidade = $('#ficha-form-nacionalidade').val();
    let deslocamento = $('#ficha-form-deslocamento').val();
    let exposicao = $('#ficha-form-exposicao').val();
    let origem = $('#ficha-form-origem').val();
    let trilha = $('#ficha-form-trilha').val();
    let pe = $('#ficha-form-pe').val();
    let imagem = $('#ficha-form-imagem').val();
    let vida = $('#ficha-form-vida').val();
    let energia = $('#ficha-form-energia').val();
    let stamina = $('#ficha-form-stamina').val();

    $.ajax({
		url: 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php',
		method: 'post',
		dataType: 'json',
        beforeSend: ()=>{
            $('#btn-ficha-create').css('display', 'none');
        },
        data: { 
            'action': 'ficha-create',
            'nome': nome,
            'classe': classe,
            'idade': idade,
            'nacionalidade': nacionalidade,
            'deslocamento': deslocamento,
            'exposicao': exposicao,
            'origem': origem,
            'trilha': trilha,
            'pe': pe,
            'imagem': 'imagemDoUsuario',
            'vida': vida,
            'energia': energia,
            'stamina': stamina,
        }
	}).done((data)=>{
		if (data == 'Sucesso') {
            $('#window-ficha-create').css('display', 'none');
            location.reload();
            return;
        }
        alert(data);
        $('#btn-ficha-create').css('display', 'flex');
	});
});