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
}
