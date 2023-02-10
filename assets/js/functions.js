var limitCharacters = (input, maxlength) => {
    $('body').on('input', input, (event)=>{
        let el = $(event.target);
        let val = el.val().substr(0, maxlength);
        if (parseFloat(el.val().length) > maxlength) el.val(val);
    });
}