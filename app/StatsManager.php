<?php

namespace App;

use App\Models\Invoice;
use Carbon\Carbon;
use DB;

class StatsManager
{
    private Carbon $startDate;
    private Carbon $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = new Carbon($startDate);
        $this->endDate = new Carbon($endDate);
    }

    public function statsByPeriod(): array
    {
        return DB::table('invoices')
            ->whereDate('created_at', '>=', $this->startDate)
            ->whereDate('created_at', '<=', $this->endDate)
            ->select([
                    DB::raw("SUM(CASE WHEN invoices.type = 'debit' THEN amount ELSE 0 END) AS debit"),
                    DB::raw("SUM(CASE WHEN invoices.type = 'credit' THEN -amount ELSE 0 END) AS credit"),
                    DB::raw("SUM(CASE WHEN invoices.type = 'debit' THEN amount ELSE 0 END) +
  SUM(CASE WHEN invoices.type = 'credit' THEN -amount ELSE 0 END) AS revenue"),
                    DB::raw("COUNT(DISTINCT order_id) as orders"),
                    DB::raw('created_at::date'),
                ]
            )
            ->groupByRaw(DB::raw('created_at::date'))
            ->get()
            ->transform(function ($item) {
                if (isset($item->debit)) {
                    $item->debit = money($item->debit)->toDecimalString();
                }
                if (isset($item->credit)) {
                    $item->credit = money($item->credit)->toDecimalString();
                }
                if (isset($item->revenue)) {
                    $item->revenue = money($item->revenue)->toDecimalString();
                }

                return $item;
            })
            ->all();
    }
}
