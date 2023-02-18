$('body').on('click', '#btn-register', (event)=>{
    event.preventDefault();
    $('#login-form').css('display', 'none');
    $('#register-form').css('display', 'flex');
});

$('body').on('click', '#register-action', (event)=>{
    event.preventDefault();
    let user = $('#signup-user').val();
    let email = $('#signup-email').val();
    let password = $('#signup-password').val();
    let passwordRepeat = $('#signup-password-repeat').val();
    
    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'register',
            'user': user,
            'email': email,
            'password': password,
            'passwordRepeat': passwordRepeat
        }
	}).done((data)=>{
		ajaxDone(data);
	});
	});
});

$('body').on('click', '#login-action', (event)=>{
    event.preventDefault();
    let user = $('#login-user').val();
    let password = $('#login-password').val();
    
    $.ajax({
		url: AJAXURL,
		method: 'post',
		dataType: 'json',
        data: { 
            'action': 'login',
            'user': user,
            'password': password
        }
	}).done((data)=>{
		ajaxDone(data);
	});
});