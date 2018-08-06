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

    public function daysPAR() {
        return $this->loans->last()->daysPAR();
    }

    public static function PAR($query) {
        return static::all()->filter(function($item, $key) use ($query) {
            return $item->daysPAR() >= $query[0] && $item->daysPAR() <= $query[1];
        })->count() / static::all()->filter(function($item, $key) {
                return $item->daysPAR() > 0;
            })->count() * 100;
    }
}
