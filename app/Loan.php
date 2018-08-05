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
        return (float)number_format(($this->principal / $monthsToPay), 2);
    }

    public function balance() {
        return $this->principal - $this->totalPaid();
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
        return (float)number_format((float)$this->payments->sum('amount_payment'), 2);
    }

    public function expectedPayment() {
        return $this->monthlyPayment() * $this->monthsPassed();
    }

    public function monthsPassed() {
        return $this->date_released->diffInMonths(Carbon::now());
    }
}
