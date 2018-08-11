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
        return $this->date_released->diffInMonths(Carbon::now());
    }

    public static function parReport() {
        $totalBalance = Member::totalBalance();
        return collect([
            [
                'label' => 'Current (active): ',
                'data' => round(Member::PAR([-INF,0])['data'], 2),
                'percentage' => round(Member::PAR([-INF,0])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(127, 127, 127, 0.75)',
                'members' => Member::PAR([-INF,0])['names'],
            ],
            [
                'label' => '1-7 days: ',
                'data' => round(Member::PAR([1,7])['data'], 2),
                'percentage' => round(Member::PAR([1,7])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(255, 99, 132, .75)',
                'members' => Member::PAR([1,7])['names'],
            ],
            [
                'label' => '8-15 days: ',
                'data' => round( Member::PAR([8,15])['data'], 2),
                'percentage' => round( Member::PAR([8,15])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(54, 162, 235, .75)',
                'members' => Member::PAR([8,15])['names'],
            ],
            [
                'label' => '16-30 days: ',
                'data' => round(Member::PAR([16,30])['data'], 2),
                'percentage' => round(Member::PAR([16,30])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(255, 206, 86, .75)',
                'members' => Member::PAR([16,30])['names'],
            ],
            [
                'label' => '31-90 days: ',
                'data' => round(Member::PAR([31,90])['data'], 2),
                'percentage' => round(Member::PAR([31,90])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(75, 192, 192, .75)',
                'members' => Member::PAR([31,90])['names'],
            ],
            [
                'label' => '91-360 days: ',
                'data' => round(Member::PAR([91,360])['data'], 2),
                'percentage' => round(Member::PAR([91,360])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(153, 102, 255, .75)',
                'members' => Member::PAR([91,360])['names'],
            ],
            [
                'label' => 'over 361 days: ',
                'data' => round(Member::PAR([361,INF])['data'], 2),
                'percentage' => round(Member::PAR([361,INF])['data'] / $totalBalance * 100, 2),
                'backgroundColor' => 'rgba(255, 159, 64, .75)',
                'members' => Member::PAR([361,INF])['names'],
            ],
            [
                'label' => 'Total: ',
                'data' => round($totalBalance, 2),
                'percentage' => 100
            ],
        ]);
    }
}
