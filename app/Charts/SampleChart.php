<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Report;
use App\Reservation;
use App\Reservation_item;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $reservations = Reservation_item::select('created_at',DB::raw('SUM(tot_price) AS total'))
            ->where(DB::raw("year(created_at)"),Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->toDateTimeString())->year)

            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"));

        $outcomes = Report::select('created_at',DB::raw('SUM(outcome) + SUM(store_outcome)+SUM(out_store_outcome) AS total'))
            ->where(DB::raw("year(created_at)"),Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now()->toDateTimeString())->year)

            ->orderBy("created_at")
            ->groupBy(DB::raw("month(created_at)"))->get()->toArray();

        $vals = $reservations->get()
            ->toArray();

        for($i=0;$i<sizeof($vals);$i++){
            $timestamp = strtotime($vals[$i]['created_at']);
            for($j=0;$j<sizeof($outcomes);$j++) {
                $timestamp2 = strtotime($outcomes[$j]['created_at']);
                if (date('m',$timestamp) == date('m',$timestamp2)) {
                    $vals[$i]['total'] -= $outcomes[$j]['total'];
                }
            }
        }
        $values  = [];
        for($i=0;$i<sizeof($vals);$i++) {
            array_push($values,$vals[$i]['total']);

        }

        $months = $reservations->selectRaw('month(created_at) as date')->pluck('date')
            ->toArray();


        return Chartisan::build()
            ->labels($months)
            ->dataset('Sample', $values);

    }
}
