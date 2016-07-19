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

    // Toggle time
    $('.toggle-time').on("click", function( ) {

        var workorderId = $( this ).attr('id');

        $this = $( this );

        $this.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
            type: "GET",
            url: SITE_URL + "/times/toggle/" + workorderId
        })
            .done( function( data ) {

                var status = $.parseJSON(data).status;
                var timerClass = '.' + workorderId + '-elapsed';

                if(status == 'started')
                {
                    $this.html('<i class="uk-icon-clock-o uk-icon-spin"></i> <i class="uk-icon-stop"></i><span class="' + workorderId + '-elapsed"> 0:00</span>').prop('disabled', false);

                    var timer = $.parseJSON(data).timer;

                    $('.toggle-time').attr('class', 'uk-button uk-button-primary toggle-time uk-text-danger');
                    $('i.uk-icon-play').attr('class', 'uk-icon-stop');
                    $('i.uk-icon-clock-o').attr('class', 'uk-icon-clock-o uk-icon-spin');

                    $('.uk-nav li.timer').remove();
                    $('.topbar .uk-subnav').prepend( timer );
                }
                else if(status == 'stopped')
                {
                    $this.html('<i class="uk-icon-clock-o"></i> <i class="uk-icon-play"></i>').prop('disabled', false);

                    var totalTime = $.parseJSON(data).total_time;

                    $('.topbar .timer').remove();
                    $('.toggle-time').attr('class', 'uk-button uk-button-primary toggle-time uk-text-success');
                    $('i.uk-icon-clock-o').attr('class', 'uk-icon-clock-o');
                    $('i.uk-icon-stop').attr('class', 'uk-icon-play');
                    $('span.total-time-' + workorderId).html( totalTime );
                    $( timerClass ).html('');
                    $('.uk-parent.timer').toggle();
                }
            })
    });
});
