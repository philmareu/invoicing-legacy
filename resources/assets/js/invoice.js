$(function() {

    // Mark workorders complete
    function deleteInvoiceListener() {
        $('a#delete-invoice').one('click', function( event ) {

            event.preventDefault();
            var button = $( this );
            var invoiceId = button.attr('data-invoicing-invoice-id');
            button.html('<i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

            if (confirm("Are you sure you want to delete this invoice?"))
            {
                $.ajax({
                    type: "POST",
                    url: SITE_URL + "/invoices/" + invoiceId,
                    data: {_token: csrf, _method: 'DELETE'}
                })
                    .done(function( response ) {
                        if(response.status == 'deleted') {
                            console.log('deleted');
                        } else {
                            console.log('unauthorized');
                        }
                    });

                deleteInvoiceListener();
            }

        });
    }

    deleteInvoiceListener();

});