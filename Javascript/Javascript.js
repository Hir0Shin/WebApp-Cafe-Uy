$(function() {
    $('nav ul li a').click(function(event) {
        event.preventDefault();
        var activate = $(this).attr('href'); 
        $('nav ul li a').removeClass('active');
        $(this).addClass('active');
        $('section').removeClass('active-section').addClass('inactive-section');
        $(activate).removeClass('inactive-section').addClass('active-section');
    })   
    $('#Beverage').on("change", function() {
        $('#Beverage option:selected.coffee').each(function() {          
            $('#milk-group').removeClass('hidden');
            $('#milk-group input').removeAttr('disabled');
            $('#cowmilk').prop("checked", true);
            $('#sinkers-group input').prop("checked", false);
            $('#sinkers-group input').attr('disabled', 'disabled');
            $('#sinkers-group').addClass('hidden');        
        })
        $('#Beverage option:selected.milktea').each(function() {
            $('#sinkers-group').removeClass('hidden');
            $('#sinkers-group input').removeAttr('disabled');
            $('#milk-group input').prop('checked', false)
            $('#milk-group input').attr('disabled', 'disabled');
            $('#milk-group').addClass('hidden');       
        })
    })
    .trigger("change");
    $('#Beverage2').on("change", function() {
        $('#Beverage2 option:selected.coffee').each(function() {          
            $('#milk-group2').removeClass('hidden');
            $('#milk-group2 input').removeAttr('disabled');
            $('#cowmilk2').prop("checked", true);
            $('#sinkers-group2 input').prop("checked", false);
            $('#sinkers-group2 input').attr('disabled', 'disabled');
            $('#sinkers-group2').addClass('hidden');   
        })
        $('#Beverage2 option:selected.milktea').each(function() {
            $('#sinkers-group2').removeClass('hidden');
            $('#sinkers-group2 input').removeAttr('disabled');
            $('#milk-group2 input').prop('checked', false)
            $('#milk-group2 input').attr('disabled', 'disabled');
            $('#milk-group2').addClass('hidden'); 
        })
    })
    .trigger("change");
})