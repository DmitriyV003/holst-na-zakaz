<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    private const PER_PAGE = 20;

    public function index()
    {
        return InvoiceResource::collection(
            Invoice::query()
                ->with('order')
                ->paginate(self::PER_PAGE)
        );
    }
}
