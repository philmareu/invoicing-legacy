$(function(){

    // Add task Modal
	$('a#add-task').on('click', function(e){
        id = $( this ).attr('data-invoicing-work-order-id');
        uri = "/tasks/create/" + id;

        getModal(uri);

	});
    
    // Save task
	$('#modal').on("click", 'button#save-task', function( event ) {
	    
	    event.preventDefault();
		button = $( this );
		button.html('Saving <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);
	    
        var modal = $.UIkit.modal("#modal");
	    
	    uri = "/tasks";
	    data = $("form#add-task").serialize();
        
        $.ajax({
    		type: "POST",
    		url: SITE_URL + uri,
    		data: data
    	})
    	.done( function( response ) {

            if(response.status == 'saved')
    		{
				if ($('.uncompleted-tasks tr.task').length == 0) {
    		        table = '<div class="uk-overflow-container"><table class="uk-table uk-table-striped uk-table-condensed tasks uncompleted"><caption class="uk-margin-bottom">These are tasks assigned to this work order.</caption><tbody>' + response.html + '</tbody></table></div>';
    		        
    		        $('p.no-tasks').remove();
    		        $('.uncompleted-tasks').html( table );
                }
                
                else {
                    $('table.tasks tbody').append( response.html );
                }

    			modal._hide();
    		}

    	});
		
	});

    // Edit task Modal
	$('.uncompleted-tasks, .completed-tasks').on('click', 'a.edit-task', function(){
	    
        taskId = $( this ).attr('id');
        uri = "/tasks/" + taskId + "/edit";
        
        getModal(uri);
		
	});
	
	// Update task
	$('#modal').on("click", 'button#update-task', function( event ) {
	    
	    event.preventDefault();
        var button = $( this );
        var modal = $.UIkit.modal("#modal");
        var form = button.parents('form');
        var action = form.attr('action');

		button.html('Updating <i class="uk-icon-refresh uk-icon-spin"></i>').prop('disabled', true);

        $.ajax({
    		type: "PUT",
    		url: action,
    		data: form.serialize()
    	})
    	.done( function( response ) {

            if(response.status == 'saved')
    		{
                $('table.tasks tr#row-' + response.task.id).replaceWith( response.html );

    			modal._hide();
    		}

    	});
		
	});

    // Delete task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.delete-task', function(event){
        
        event.preventDefault();

        taskId = $( this ).attr('id');
        
        if (confirm("Are you sure?"))
		{
		    $.ajax({
                type: "DELETE",
                url: SITE_URL + "/tasks/" + taskId,
                data: {_token: csrf}
            })
            .done( function( response ) {

                if(response.status == 'success')
                {
                    $('tr#row-' + taskId).remove();
                }			
            })
		}

    });

    // Toggle task
    $('.uncompleted-tasks, .completed-tasks').on('click', 'a.toggle-task', function( event ){

        event.preventDefault();

        var $taskId = $( this ).attr('id');

        $.ajax({
            type: "PUT",
            url: SITE_URL + "/tasks/toggle/" + $taskId,
            data: {_token: csrf}
        })
        .done( function( response ) {

            if(response == 'completed')
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-check-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.completed tbody'));
            }
            else
            {
                $('a#' + $taskId + '.toggle-task i').attr('class', 'uk-icon-square-o');
                $('tr#row-' + $taskId).detach().appendTo($('table.tasks.uncompleted tbody'));
            }

        })

    });

});