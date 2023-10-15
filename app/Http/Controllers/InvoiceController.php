<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    private const PER_PAGE = 20;

    /**
     * @OA\Get(
     *     path="/api/v1/admin/invoice",
     *     summary="Returns paginated invoices",
     *     operationId="getAllInvoices",
     *     @OA\Response(
     *         response=200,
     *         description="successful",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/InvoiceResource")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return InvoiceResource::collection(
            Invoice::query()
                ->with('order')
                ->paginate(self::PER_PAGE)
        );
    }
}
