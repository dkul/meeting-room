/**
 * Created by kirill on 18.09.14.
 */
$(function() {


    $.datepicker.setDefaults({
        showOn: "both",
        buttonImageOnly: false,
        buttonImage: "/img/zf2-logo.png",
        buttonText: "Calendar"
    });


    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker( "setDate", "today" );
    $( "#datepicker" ).datepicker( "option", "dateFormat", 'dd-mm-yy' );


});
