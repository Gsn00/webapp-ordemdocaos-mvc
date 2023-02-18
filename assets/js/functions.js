var limitCharacters = (input, maxlength) => {
    $('body').on('input', input, (event)=>{
        let el = $(event.target);
        let val = el.val().substr(0, maxlength);
        if (parseFloat(el.val().length) > maxlength) el.val(val);
    });
}

var inputDice = (input) => {
    $('body').on('input', input, (event)=>{
        let el = $(event.target);
        let val = el.val();
        let length = val.length;
        if (val.match("^[0-9]{1,3}$")
         || val.match("^[0-9]{1,3}[d-d-D-D]{1}$")
         || val.match("^[0-9]{1,3}[d-d-D-D]{1}[0-9]{1,3}$")
         || val.match("^[0-9]{1,3}[d-d-D-D]{1}[0-9]{1,3}$")
         || val.match("^[0-9]{1,3}[d-d-D-D]{1}[0-9]{1,3}[+]$")
         || val.match("^[0-9]{1,3}[d-d-D-D]{1}[0-9]{1,3}[+][0-9]{1,3}$")) {
        } else {
            el.val(el.val().substr(0, length - 1));
        }
    });
}

var deformButtonDice = (button) => {
    let value = button.html().toLowerCase();
    let quantity = value.substr(0, value.indexOf("d"));
    let dice;
    let plus = 0;
    if (value.includes("+")) {
        dice = value.substr(value.indexOf("d") + 1, value.indexOf("+") - 2);
        plus = value.substr(value.indexOf("+") + 1);
    } else {
        dice = value.substr(value.indexOf("d") + 1);
    }
    quantity = parseInt(quantity);
    dice = parseInt(dice);
    plus = parseInt(plus);
    return {
        'quantity': quantity,
        'dice': dice,
        'plus': plus
    };
}

let ajaxDone = (data, onError = ()=>{}, reload = true) => {
    var failed = false;
    try {
        if ($.parseJSON(data) == 'Sucesso') {
            if (reload === true) {
                location.reload();
            } 
            return;
        }
        alert($.parseJSON(data));
        failed = true;
    } catch (error) {
        if (data == 'Sucesso') {
            if (reload === true) {
                location.reload();
            } 
            return;
        }
        alert(data);
        failed = true;
    } finally {
        if (failed === true) {
            onError();
        }
    }
}

const AJAXURL = 'http://localhost/Projetos%20Pessoais/OrdemDoCaos%20-%20MVC/assets/ajax/ajax.php';