$(document).ready(function() {
    let heating = 700,
        no_heating = 200,
        tariff1 = 410,
        tariff2 = 1200,
        current_tariff = 380

    $('#calculate').click(function() {
        let value = $('#calculator').val();
        var type = $('input:radio[name="calc"]:checked').val();

        let limit = type === 'heating' ? heating : no_heating;

        calculate(value, limit);
    })

    function calculate(value, limit) {
        let proposed_rate = value > limit ? limit * tariff1 + (value - limit) * tariff2 : value * tariff1;
        let current_rate = value * current_tariff;
        let difference = proposed_rate - current_rate;

        let formula = value > limit ? '' + limit + ' * ' + tariff1 + ' + ' + (value - limit) + ' * ' + tariff2 : value + ' * ' + tariff1



        $('#proposed_rate')[0].innerHTML = number_format(proposed_rate)
        $('#current_rate')[0].innerHTML = number_format(current_rate);
        $('#difference')[0].innerHTML = number_format(difference);
        $('#formula')[0].innerHTML = formula;
    }


    function number_format(number, decimals, thousands_sep) {
        return number ? parseFloat(number).toFixed(decimals ? decimals : 2).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1' + (thousands_sep ? thousands_sep : ' ')) : "0"
    }
})