$(function(){
    
    // Mark workorders complete
	$('a.workorder-completed').on('click', function( e ) {
	    
	    e.preventDefault();
	    
        if (confirm("Are you sure you want to complete this work order?"))
        {
			var $this = $( this );
            var workorderId = $this.attr('id');
			
			$this.html('Marking complete <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
            
            $.ajax({
                type: "GET",
                url: SITE_URL + "/workorders/mark_completed/" + workorderId
            })
            .done(function( data ) {
            
                var status = $.parseJSON(data).status;
                var html = $.parseJSON(data).html;
            
                if(status == 'success')
                {
                    $('a.workorder-completed').remove();
                    $('a.toggle-time').remove();
                    $('div.status').html( html );
                    $('div.status').attr('class', 'uk-alert uk-alert-danger');
                }
				
				else
				{
					alert('An error occurred. Please make sure you have completed all tasks.');
					$this.html('<i class="uk-icon-check"></i> Mark Completed');
				}
            
            })
        }

	});

    // Toggle time
    $('.toggle-time').on("click", function( ) {

        var workorderId = $(this).attr('id');

        $this = $(this);

        $this.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
            type: "PUT",
            url: SITE_URL + "/times/toggle",
            data: {_token: csrf, work_order_id: workorderId},
            success: function (response) {
                console.log(response.status);

                if(response.status == 'stopped') {
                    $this.html('<i class="uk-icon-play"></i>').prop('disabled', false);
                    $('i.uk-icon-stop').attr('class', 'uk-icon-play');
                    $('.timer').text('').attr('data-invoicing-work-order-id', '');
                    $('.toggle-time').attr('class', 'uk-button toggle-time uk-text-success');
                } else {
                    $this.html('<i class="uk-icon-stop"></i><span class="timer"> 0:00</span>').prop('disabled', false);
                    $('.toggle-time').attr('class', 'uk-button toggle-time uk-text-danger');
                    $('i.uk-icon-play').attr('class', 'uk-icon-stop');
                }
            }
        });

    });
            //.done( function( response ) {
            //
            //
            //    //var timerClass = '.' + workorderId + '-elapsed';
            //    //
            //    //if(response.status == 'started')
            //    //{
            //    //    $this.html('<i class="uk-icon-clock-o uk-icon-spin"></i> <i class="uk-icon-stop"></i><span class="' + workorderId + '-elapsed"> 0:00</span>').prop('disabled', false);
            //    //
            //    //    var timer = $.parseJSON(data).timer;
            //    //
            //    //    $('.toggle-time').attr('class', 'uk-button uk-button-primary toggle-time uk-text-danger');
            //    //    $('i.uk-icon-play').attr('class', 'uk-icon-stop');
            //    //    $('i.uk-icon-clock-o').attr('class', 'uk-icon-clock-o uk-icon-spin');
            //    //
            //    //    $('.uk-nav li.timer').remove();
            //    //    $('.topbar .uk-subnav').prepend( timer );
            //    //}
            //    //else if(status == 'stopped')
            //    //{
            //        $this.html('<i class="uk-icon-clock-o"></i> <i class="uk-icon-play"></i>').prop('disabled', false);
            //
            //        var totalTime = $.parseJSON(data).total_time;
            //

            //    //}
            //})
	
});
