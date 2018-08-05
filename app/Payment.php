<?php

namespace App;

class Payment extends Model
{
    protected $dates = [
        'date_payment',
    ];

    public function loan() {
        return $this->belongsTo(Loan::class);
    }
    
    public function member() {
        return $this->belongsTo(Member::class);
    }
}
