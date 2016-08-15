$(function(){
    
    // Mark workorders complete
    function completionListener() {
        $('a.toggle-completion').one('click', function( event ) {

            event.preventDefault();
            var $this = $( this );
            var workorderId = $this.attr('id');

            if($this.hasClass('completed')) {
                $this.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
                toggleCompletion(workorderId);
            } else {
                if (confirm("Are you sure you want to complete this work order?"))
                {
                    $this.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
                    toggleCompletion(workorderId);
                }
            }

            function toggleCompletion(workOrderId) {

                $.ajax({
                    type: "PUT",
                    url: SITE_URL + "/work-orders/toggle-completion",
                    data: {_token: csrf, work_order_id: workorderId}
                })
                    .done(function( response ) {
                        $this.toggleClass('completed');
                        if(response.workOrder.completed) {
                            $this.html('<i class="uk-icon-check"></i> Completed')
                        } else {
                            $this.html('<i class="uk-icon-check-box-o"></i> Open')
                        }
                        console.log(response);
                    });

                completionListener();
            }

        });
    }

    // Toggle time
    $('.toggle-time').on("click", function( ) {

        var workorderId = $(this).attr('id');

        var button = $(this);

        console.log(button);

        button.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
            type: "PUT",
            url: SITE_URL + "/times/toggle",
            data: {_token: csrf, work_order_id: workorderId},
            success: function (response) {
                console.log(response.status);

                if(response.status == 'stopped') {
                    button.html('<i class="uk-icon-play"></i> Start Timer').prop('disabled', false);
                    $('i.uk-icon-stop').attr('class', 'uk-icon-play');
                    $('.timer').text('');
                    $('.toggle-time').removeClass('uk-text-danger');
                    $('.toggle-time').addClass('uk-text-success');
                    //$('.toggle-time').attr('class', 'uk-button toggle-time uk-text-success');
                    $('table.times tbody').append(response.html);
                    document.title = 'Invoicing | Invoicing by Phil Mareu';
                } else {
                    button.html('<i class="uk-icon-stop"></i><span class="timer"> 0:00</span>').prop('disabled', false);
                    $('.toggle-time').removeClass('uk-text-success');
                    $('.toggle-time').addClass('uk-text-danger');
                    //$('.toggle-time').attr('class', 'uk-button toggle-time uk-text-danger');
                    $('i.uk-icon-play').attr('class', 'uk-icon-stop');
                    document.title = 'Timer | 0:00';
                }
            }
        });

    });

    // Mark workorders complete
    function deleteWorkOrderListener() {
        $('a#delete-work-order').one('click', function( event ) {

            event.preventDefault();
            var button = $( this );
            var workOrderId = button.attr('data-invoicing-work-order-id');
            button.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

            if (confirm("Are you sure you want to delete this work order?"))
            {
                $.ajax({
                    type: "POST",
                    url: SITE_URL + "/work-orders/" + workOrderId,
                    data: {_token: csrf, _method: 'DELETE'}
                })
                    .done(function( response ) {
                        if(response.status == 'deleted') {
                            console.log('deleted');
                        } else {
                            console.log('unauthorized');
                        }
                    });

                deleteWorkOrderListener();
            }

        });
    }

    completionListener();
    deleteWorkOrderListener();

});
