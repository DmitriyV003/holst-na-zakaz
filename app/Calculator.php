<?php

namespace App;

use App\Models\Angle;
use App\Models\Size;
use App\Models\Style;

class Calculator
{
    private Style $style;
    
    private Size $size;
    private ?Angle $angle;

    public function __construct(Style $style, Size $size, ?Angle $angle = null)
    {
        $this->style = $style;
        $this->size = $size;
        $this->angle = $angle;
    }

    public function calculatePrice(): array
    {
        $oldStylePrice = $this->style->old_price ? $this->style->old_price : money(0);
        $oldSizePrice = $this->size->old_price ? $this->size->old_price : money(0);
        $price = $this->size->price->add($this->style->price);
        $oldPrice = $oldSizePrice->add($oldStylePrice);
        if (isset($this->angle)) {
            $price = $price->add($this->angle->price);
            $oldPrice = $oldPrice->add($this->angle->old_price ? $this->angle->price : money(0));
        }

        return [
            'price' => $price,
            'oldPrice' => $oldPrice,
        ];
    }
    
}
