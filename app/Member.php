<?php

namespace App;

class Member extends Model
{
    public function loans() {
        return $this->hasMany(Loan::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function applyLoan($principal, $date_released, $date_mature) {
        $this->loans()->create([
            'principal' => $principal,
            'date_released' => $date_released,
            'date_mature' => $date_mature,
        ]);
    }
}
