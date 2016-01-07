$(document).ready(function(){
    // Initialize collapse button
    $(".button-collapse").sideNav();

    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears:300,  // Creates a dropdown of 15 years to control year
        format: 'dd.mm.yyyy'
    });

    $('select').material_select();

    //init all toggle fields
    $('[data-togglegroup]').each(function(index, checkbox){
        var toggleGroup = $(checkbox).attr('data-togglegroup');
        var groupDiv = $('[data-group='+toggleGroup+']');
        var inputfield = $(checkbox).children('input[type="checkbox"]');

        groupDiv[inputfield.is(':checked') ? "show" : "hide"]();

        $(inputfield).on('click', function(ev){
            var toggleGroup = $(this).parent().attr('data-togglegroup');
            var groupDiv = $('[data-group='+toggleGroup+']');
            groupDiv[this.checked ? "show" : "hide"]();
        });
    });
});