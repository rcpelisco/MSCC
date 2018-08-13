<?php

namespace App;

use Carbon\Carbon;

class Loan extends Model
{
    protected $dates = [
        'date_released',
        'date_mature',
    ];

    public function member() {
        return $this->belongsTo(Member::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function pay($request) {
        $this->payments()->create($request);
    }

    public function monthlyPayment() {
        $monthsToPay = $this->date_mature->diffInMonths($this->date_released);
        $monthsToPay += $this->date_released->month == 2 ? 1 : 0;
        return round($this->principal / $monthsToPay, 2);
    }

    public function balance() {
        return round($this->principal - $this->totalPaid(), 2);
    }

    public function daysPAR() {
        $startingMonth = floor($this->totalPaid() / $this->monthlyPayment());
        $startingMonth = $this->date_released->addMonth($startingMonth + 1);
        if($this->totalPaid() < $this->expectedPayment()) {
            return (Carbon::now())->diffInDays($startingMonth);
        }
        return 0;
    }
    
    public function totalPaid() {
        return round($this->payments->sum('amount_payment'), 2);
    }

    public function expectedPayment() {
        return round($this->monthlyPayment() * $this->monthsPassed(), 2);
    }

    public function monthsPassed() {
        if(Carbon::now() >= $this->date_mature) {
            return $this->date_mature->diffInMonths($this->date_released);
        }
        return (Carbon::now())->diffInMonths($this->date_released);
    }

    public static function parReport() {
        $totalBalance = Member::totalBalance();
        $args = [
            [
                'label' => 'Current (active): ',
                'args' => [-INF,0],
                'backgroundColor' => 'rgba(127, 127, 127, 0.75)',
            ],
            [
                'label' => '1-7 day(s): ',
                'args' => [1,7],
                'backgroundColor' => 'rgba(255, 99, 132, .75)',
            ],
            [
                'label' => '8-15 days: ',
                'args' => [8,15],
                'backgroundColor' => 'rgba(54, 162, 235, .75)',
            ],
            [
                'label' => '16-30 days: ',
                'args' => [16,30],
                'backgroundColor' => 'rgba(255, 206, 86, .75)',
            ],
            [
                'label' => '31-90 days: ',
                'args' => [31,90],
                'backgroundColor' => 'rgba(75, 192, 192, .75)',
            ],
            [
                'label' => '91-360 days: ',
                'args' => [91,360],
                'backgroundColor' => 'rgba(153, 102, 255, .75)',
            ],
            [
                'label' => 'over 361 days: ',
                'args' => [361,INF],
                'backgroundColor' => 'rgba(255, 159, 64, .75)',
            ],
        ];

        $report = collect();

        foreach($args as $arg) {
            $data = Member::PAR($arg['args']);
            $report[] = collect([
                'label' => $arg['label'],
                'data' => round($data['data'], 2),
                'percentage' => round($data['data'] / $totalBalance * 100, 2),
                'backgroundColor' => $arg['backgroundColor'],
                'members' => $data['members'],
            ]);
        }
        $report[] = [
            'label' => 'Total: ',
            'data' => round($totalBalance, 2),
            'percentage' => 100,
        ];
        return $report;
    }
}
