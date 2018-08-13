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
        return $this->loans->last() != null ? $this->loans->last()->daysPAR() : 0;
    }

    public static function PAR($params) {
        $obj = collect([]);
        $onPAR = static::all()->filter(function($item, $key) use ($params) {
            return $item->daysPAR() >= $params[0] && $item->daysPAR() <= $params[1];
        });
        $obj['data'] = $onPAR->map(function($item, $key) {
            return $item->loans->last() != null ? $item->loans->last()->balance() : 0;
        })->sum();

        $obj['members'] = $onPAR->map(function($item, $key) {
            return ['item' =>
                ['name' => $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name,
                'amount' => $item->loans->last() != null ? $item->loans->last()->balance() : 0,]
            ];
        })->flatten(1);

        return $obj;
    }

    public static function totalBalance() {
        return static::all()->map(function($item, $key) {
            return $item->loans->last() != null ? $item->loans->last()->balance() : 0;
        })->sum();
    }
}
