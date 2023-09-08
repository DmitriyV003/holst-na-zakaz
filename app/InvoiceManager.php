<?php

namespace App;

use App\Models\Invoice;
use App\Models\Order;
use PostScripton\Money\Money;

class InvoiceManager
{
    private ?Invoice $invoice;

    public function __construct(?Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function createDebit(Money $amount, Order $order): void
    {
        $this->invoice = app(Invoice::class)->fill([
            'type' => Invoice::DEBIT_TYPE,
            'amount' => $amount,
        ]);
        $this->invoice->order()->associate($order)->save();
    }

    public function createCredit(Money $amount, Order $order): void
    {
        $this->invoice = app(Invoice::class)->fill([
            'type' => Invoice::CREDIT_TYPE,
            'amount' => $amount,
        ]);
        $this->invoice->order()->associate($order)->save();
    }
}
