<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreditRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\InvoiceManager;
use App\Models\FormApplication;
use App\Models\Order;
use App\OrderManager;
use App\Traits\ParseToMoney;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use ParseToMoney;

    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/admin/order",
     *     summary="Returns paginated orders",
     *     operationId="getAllOrders",
     *     @OA\Parameter(
     *          in="query",
     *          name="status",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="id",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="date",
     *          required=false,
     *          @OA\Schema(
     *              type="dateTime"
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="phone",
     *          required=false,
     *          @OA\Schema(
     *              type="string"
     *          )
     *     ),
     *     @OA\Parameter(
     *          in="query",
     *          name="form_type_id",
     *          required=false,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/OrderResource")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/v1/admin/order",
     *     summary="Create order",
     *     operationId="storeOrder",
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/OrderResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/OrderRequest")
     * )
     */
    public function store(OrderRequest $request)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $order = app(OrderManager::class, ['order' => null])
            ->create($params, FormApplication::query()->find($request->input('form_application_id')));
        return new OrderResource($order);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/admin/order/{id}",
     *     summary="Returns order by id",
     *     operationId="getOrderById",
     *     @OA\Parameter(
     *          in="path",
     *          required=true,
     *          name="id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         ref="#/components/schemas/OrderResource"
     *     )
     * )
     */
    public function show(Order $order)
    {
        return new OrderResource($order->load('formApplication', 'debitInvoices', 'creditInvoices', 'size', 'angle'));
    }

    /**
     * @OA\Put(
     *     path="/api/v1/admin/order/{id}",
     *     summary="Update order by id",
     *     operationId="updateOrderById",
     *     @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="object",
     *             ref="#/components/schemas/OrderResource"
     *         )
     *     ),
     *     @OA\RequestBody(ref="#/components/requestBodies/OrderRequest")
     * )
     */
    public function update(OrderRequest $request, Order $order)
    {
        $params = $request->validated();
        $this->formatParams($params);
        $order->update($params);

        return new OrderResource($order);
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/admin/order/{id}",
     *     summary="Delete order by id",
     *     operationId="deleteOrderById",
     *     @OA\Parameter(
     *          in="path",
     *          name="id",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="successful"
     *     )
     * )
     */
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
