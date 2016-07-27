var modal = $('#modal');

function updateModal(html) {

    $('#modal .modal-content').html( html );

}

function getModal(uri) {

    // var modal = $.UIkit.modal("#modal");
    var modal = $.UIkit.modal("#modal");

    $.ajax({
        type: "GET",
        url: SITE_URL + uri
        })
        .done( function( data ) {

            updateModal(data.html);
            modal.show();

        });

    return false;

}

$(function(){

    // Update time
    //setInterval(function() {
    //
    //$.ajax({
    //	type: "GET",
    //	url: SITE_URL + "/times/elapsed"
    //})
    //.done(function( data ) {
    //
    //	var status = $.parseJSON(data).status;
    //	var workorder_id = $.parseJSON(data).workorder_id;
    //	var timerClass = '.' + workorder_id + '-elapsed';
    //
    //	if(status == 'success')
    //	{
    //		$( timerClass ).text($.parseJSON(data).time);
    //	}
    //	else
    //	{
    //
    //	}
    //
    //})
    //
    //}, 50000);
});
