<h3 class="tasks uk-panel-title">
	Tasks
	<a href="#" id="add-task" data-invoicing-work-order-id="{{ $workOrder->id }}" data-uk-modal>
		+
	</a>
</h3>

<div class="uk-grid">
	<div class="uk-width-1-1">
		
		<ul class="uk-tab uk-margin-bottom" data-uk-tab={connect:'#panes'}>
			<li class="active"><a href="">Uncompleted</a></li>
			<li><a href="">Completed</a></li>
		</ul>
		
		<ul id="panes" class="uk-switcher">
			<li class="uncompleted-tasks">
				@include('workorders.show.tasks.uncompleted')
			</li>

			<li class="completed-tasks">
				@include('workorders.show.tasks.completed')
			</li>
		</ul>

	</div>
</div>