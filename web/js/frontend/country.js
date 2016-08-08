$(function(){
    $('#countries').val(country_id);
    $('#countries').change(function () {
        var select = this.options[this.selectedIndex].value;
        if (select !== '' ){
            location.href = urlCountry + '/' + select;
        }
        else {
            location.href = urlCountry;
        }

    });
})