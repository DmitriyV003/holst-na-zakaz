<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\InvoiceManager;
use App\Models\FormApplication;
use App\Models\Order;
use App\OrderManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private const PER_PAGE = 20;

    public function index(Request $request)
    {
        return OrderResource::collection(
            Order::query()
                ->with('formApplication', 'debitInvoices', 'creditInvoices', 'size', 'angle')
                ->when($request->input('status'), function (Builder $query, $status) {
                    $query->whereStatus($status);
                })
                ->when($request->input('id'), function (Builder $query, $id) {
                    $query->whereId($id);
                })
                ->when($request->input('date'), function (Builder $query, $date) {
                    $query->whereDate('created_at', $date);
                })
                ->when($request->input('phone'), function (Builder $query, $phone) {
                    $query->whereHas('formApplication', function ($query) use ($phone) {
                        $query->where('phone', 'like', "%$phone%");
                    });
                })
                ->when($request->input('form_type_id'), function (Builder $query, $formTypeId) {
                    $query->whereHas('formApplication', function ($query) use ($formTypeId) {
                        $query->where('form_type_id', $formTypeId);
                    });
                })
                ->paginate(self::PER_PAGE)
        );
    }

    public function store(OrderRequest $request)
    {
        $order = app(OrderManager::class, ['order' => null])
            ->create($request->validated(), FormApplication::query()->find($request->input('form_application_id')));
        return new OrderResource($order);
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load('formApplication', 'debitInvoices', 'creditInvoices', 'size', 'angle'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->update($request->validated());

        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json();
    }

    public function createCreditInvoice(CreditRequest $request, Order $order)
    {
        app(InvoiceManager::class, ['invoice' => null])->createCredit(money_parse($request->input('amount')), $order);

        return response()->json([], 204);
    }
}
