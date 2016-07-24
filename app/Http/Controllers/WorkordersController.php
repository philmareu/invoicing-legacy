<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Invoicing\Http\Requests\CreateWorkOrderRequest;
use Invoicing\Http\Requests\UpdateWorkOrderRequest;
use Invoicing\Models\Invoice;
use Invoicing\Models\WorkOrder;

class WorkOrdersController extends Controller {
	
	protected $workOrder;

    protected $invoice;
	
	public function __construct(WorkOrder $workOrder, Invoice $invoice)
	{
		$this->workOrder = $workOrder;
        $this->invoice = $invoice;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $workOrders = $this->workOrder->whereCompleted(0)->get();

        return view('workorders.index.index')->with('workOrders', $workOrders);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{
        $invoice = $this->invoice->findOrFail($request->invoice_id);

        return view('workorders.create')->with('invoice', $invoice);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateWorkOrderRequest $request)
	{
        $invoice = $this->invoice->findOrFail($request->invoice_id);
        $invoice->workOrders()->create($request->all());

        return redirect(route('invoices.show', $invoice->id))->with('success', 'Work order added.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(WorkOrder $workOrder)
	{
		return view('workorders.show.index')->with('workOrder', $workOrder);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(WorkOrder $workOrder)
	{
        return view('workorders.edit')->with('workOrder', $workOrder);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(UpdateWorkOrderRequest $request, WorkOrder $workOrder)
	{
        $workOrder->update($request->all());

        return redirect(route('work-orders.show', $workOrder->id))->with('success', 'Item updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function mark_completed($id)
    {
        $workorder = Workorder::restrict()->find($id);

        if(is_null($workorder) OR $workorder->completed)
        {
            echo json_encode(['status' => 'error']);
        }

        elseif($workorder->uncompletedTasks->count())
        {
            echo json_encode(['status' => 'error', 'message' => 'Complete all tasks first']);
        }

        else
        {
            $now = date('Y-m-d H:i:s');

            // Stop timer
            $time = Time::where('workorder_id', $id)
                ->restrict()
                ->whereNull('stop')
                ->where('user_id', getUserId());

            if(count($time)) $time->update(array('stop' => $now));

            $workorder->update(array('completed' => $now));

            $output['status'] = 'success';
            $output['message'] = 'Work Order marked complete';
            $output['html'] = View::make('partials.ajax.workorder_completed')->render();

            echo json_encode($output);
        }
    }
}
