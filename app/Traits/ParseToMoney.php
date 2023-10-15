<?php

namespace App\Traits;

trait ParseToMoney
{
    protected function formatParams(array &$params)
    {
        if (isset($params['price'])) {
            $params['price'] = money_parse($params['price']);
        }
        if (isset($params['old_price'])) {
            $params['old_price'] = money_parse($params['old_price']);
        }
    }
}
