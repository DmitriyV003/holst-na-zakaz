<?php

namespace App;

use App\Exceptions\ManagerException;
use App\Models\Invoice;
use App\Models\Order;
use DB;
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
        $this->createInvoiceForOrder($amount, $order, Invoice::DEBIT_TYPE);
    }

    public function createCredit(Money $amount, Order $order): void
    {
        $this->createInvoiceForOrder($amount, $order, Invoice::CREDIT_TYPE);
    }

    private function createInvoiceForOrder(Money $amount, Order $order, string $type): void
    {
        if ($amount->isNegative() || $amount->isZero()) {
            throw new ManagerException('amount is less or zero');
        }

        DB::transaction(function () use ($amount, $order, $type) {
            $this->invoice = app(Invoice::class)->fill([
                'type' => $type,
                'amount' => $amount,
            ])
                ->save();
            $this->invoice->order()->associate($order)->save();
        });
    }
}
