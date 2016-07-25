<?php

namespace Invoicing\Http\Controllers;

use Illuminate\Http\Request;
use Invoicing\Http\Requests\CreateWorkOrderRequest;
use Invoicing\Http\Requests\ToggleCompletionRequest;
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
        $workOrders = $this->workOrder
            ->whereCompleted(0)
            ->orderBy('scheduled', 'asc')
            ->get();

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
        $workOrder = $invoice->workOrders()->create($request->all());

        return redirect(route('work-orders.show', $workOrder->id))->with('success', 'Work order added.');
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

    public function toggleCompletion(ToggleCompletionRequest $request)
    {
        $workorder = $this->workOrder->findOrFail($request->work_order_id);

        if($workorder->uncompletedTasks->count()) return response()
            ->json(['status' => 'error', 'message' => 'Complete all tasks first']);

        $workorder->update(['completed' => ! $workorder->completed]);

        return response()->json(['workOrder' => $workorder]);
    }
}
