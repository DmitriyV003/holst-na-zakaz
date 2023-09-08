<?php

namespace App;

use App\Models\FormApplication;
use App\Models\Order;
use DB;

class OrderManager
{
    private ?Order $order;

    public function create(array $params, ?FormApplication $formApplication = null): Order
    {
        DB::transaction(function () use ($params, $formApplication) {
            $this->order = app(Order::class)->fill($params);
            $price = money_parse($params['price']);
            $this->order->price = $price;
            $this->order->save();
            if (!$formApplication) {
                $formApplication = app(FormApplication::class)->fill([
                    'phone' => $params['phone'],
                    'form_type_id' => $params['form_type_id'],
                ]);
                $formApplication->save();
            }
            $this->order->formApplication()->associate($formApplication);
            app(InvoiceManager::class, ['invoice' => null])->createDebit($price, $this->order);
        });

        return $this->order;
    }
}
