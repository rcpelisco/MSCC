<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Member;
use App\Loan;

class LoansController extends Controller
{
    public function store(Member $member) {
        $member->applyLoan(
            request('principal'), 
            request('date_released'), 
            $this->getMaturityDate()
        );

        return back();
    }

    private function getMaturityDate() {
        $date_maturity = new Carbon(request('date_released'));
        return $date_maturity->addMonth(request('months_to_pay'));
    }

    public function pay(Loan $loan) {
        $loan->pay(request([
            'date_payment', 
            'or_number', 
            'amount_payment'
        ]));

        return back();
    }

    public function showPARReport() {
        return view('par_report.index');
    }

    public function getPARData() {
        $PARData = [0, 0, 0, 0, 0, 0];
        foreach(Loan::all() as $loan) {
            $PARData[0] += $loan->daysPAR() >= 1 && $loan->daysPAR() <= 7 ? 1 : 0;
            $PARData[1] += $loan->daysPAR() >= 8 && $loan->daysPAR() <= 15 ? 1 : 0;
            $PARData[2] += $loan->daysPAR() >= 16 && $loan->daysPAR() <= 30 ? 1 : 0;
            $PARData[3] += $loan->daysPAR() >= 31 && $loan->daysPAR() <= 90 ? 1 : 0;
            $PARData[4] += $loan->daysPAR() >= 90 && $loan->daysPAR() <= 360 ? 1 : 0;
            $PARData[5] += $loan->daysPAR() > 360 ? 1 : 0;
        }
        return response()->json($PARData, 200);
    }
}
