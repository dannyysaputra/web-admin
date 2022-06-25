document.addEventListener('DOMContentLoaded', function() {
    var $select = $('.date');
    for (i = 1; i <= 31; i++) {
        $select.append($('<option></option>').val(i).html(i));
    }
})