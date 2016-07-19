<?php

namespace Invoicing\Http\Controllers;

class SearchController extends Controller {

	public function index()
	{
		$term = Input::get('term');
		
		// @todo Ok, dumb but quick
		if( ! $term) $term = 'abcdefg';
		
		$clients = Client::restrict()
			->where('title', 'LIKE', "%$term%")
			->orWhere('contact', 'LIKE', "%$term%")
			->orWhere('contact_email', 'LIKE', "%$term%")
			->get();

		$projects = Project::restrict()
			->where('title', 'LIKE', "%$term%")
			->orWhere('url', 'LIKE', "%$term%")
			->get();
			
		$total_results = count($clients) + count($projects);
		
		if($total_results == 1)
		{
			if(count($clients))
			{
				return Redirect::to('clients/' . $clients[0]->id);
			}
			else
			{
				return Redirect::to('projects/' . $projects[0]->id);
			}
		}

		return View::make('search.results', compact('clients', 'projects', 'total_results'));
	}
	
	public function results()
	{
		$results = $custom = array();
		
		$term = Input::get('search');
		
		$clients = Client::restrict()
			->whereArchive(0)
			->where(function($query) use($term)
			{
				$query->orWhere('title', 'LIKE', "%$term%")
					->orWhere('contact', 'LIKE', "%$term%")
					->orWhere('contact_email', 'LIKE', "%$term%");
			})
			->select('id', 'title', 'contact')
			->get();
		
		foreach($clients as $client)
		{
			$results[] = array(
				'title' => icon('clients') . ' ' . $client->title,
				'url' => url('clients/' . $client->id),
				'text' => 'Contact: ' . $client->contact
			);
			
			$workorders = $this->_getWorkorders('client', $client->id, $client->title);
			
			$results = array_merge($results, $workorders);
		}
		
		$projects = Project::restrict()
			->where('title', 'LIKE', "%$term%")
			->whereArchive(0)
			->select('id', 'title', 'updated_at')
			->get();
		
		foreach($projects as $project)
		{
			$results[] = array(
				'title' =>  icon('projects') . ' ' . $project->title,
				'url' => url('projects/' . $project->id),
				'text' => 'Updated: ' . $project->updated_at->toFormattedDateString()
			);
			
			$workorders = $this->_getWorkorders('project', $project->id, $project->title);
			
			$results = array_merge($results, $workorders);
		}
		
		$proposals = Proposal::restrict()
			->where('title', 'LIKE', "%$term%")
			->with('client')
			->whereStatus(3)
			->get();
		
		foreach($proposals as $proposal)
		{
			$statuses = array(
				'1' => 'Draft',
				'2' => 'Sent',
				'3' => 'Won',
				'4' => 'Lost',
				'5' => 'Completed'
			);
			
			$results[] = array(
				'title' => icon('proposals') . ' ' . $proposal->title,
				'url' => url('proposals/' . $proposal->id),
				'text' => 'Client: ' . $proposal->client->title
			);
			
			$workorders = $this->_getWorkorders('proposal', $proposal->id, $proposal->title);
			
			$results = array_merge($results, $workorders);
		}
		
		if(strpos($term, 'new') !== false OR strpos($term, 'create') !== false)
		{
			$custom = array(
				array(
					'title' => icon('clients') . ' Create Client',
					'url' => url('clients/create'),
					'text' => 'Create a new client'
				),
				array(
					'title' => icon('projects') . ' Create Project',
					'url' => url('projects/create'),
					'text' => 'Create a new project'
				),
				array(
					'title' => icon('proposals') . ' Create Proposal',
					'url' => url('proposals/create'),
					'text' => 'Create a new proposal'
				),
				array(
					'title' => icon('workorders') . ' Create Work Order',
					'url' => url('workorders/create'),
					'text' => 'Create a new work order'
				),
				array(
					'title' => icon('invoices') . ' Create Invoice',
					'url' => url('invoices/create'),
					'text' => 'Create a new invoice'
				)
			);
		}
		
		$output['results'] = array_merge($results, $custom);
		
		echo json_encode($output);
	}
	
	private function _getWorkorders($resource, $resourceId, $referenceTitle)
	{
		$results = array();
		
		$reference = ucfirst($resource) . ' - ' . $referenceTitle;
		
		$workorders = Workorder::restrict()
				->where($resource . '_id', $resourceId)
				->whereAssignmentId(getUserId())
				->active()
				->select('id', 'scheduled', 'services')
				->get();
	
		foreach($workorders as $workorder)
		{
			if($workorder->scheduled)
			{
				$scheduled = 'Scheduled: ' . $workorder->scheduled->toFormattedDateString();
			}
			
			else
			{
				$scheduled = 'Unscheduled';
			}
			
			$results[] = array(
				'title' => icon('workorders') . ' WO#' . $workorder->id . ' for ' . $reference,
				'url' => url('workorders/' . $workorder->id),
				'text' =>  $scheduled . ' - ' . $workorder->services
			);
		}
		
		return $results;
	}
	
	// {
	//     "results": [
	//         {"title":"Article title", "url":"#", "text":"Lorem ipsum dolor sit amet, consectetur ..."},
	//         {"title":"Article title", "url":"#", "text":"Ut enim ad minim veniam, quis nostrud ..."},
	//         {"title":"Article title", "url":"#", "text":"Duis aute irure dolor in reprehenderit ..."},
	//         {"title":"Article title", "url":"#", "text":"Excepteur sint occaecat cupidatat non ..."}
	//     ]
	// }
	
}