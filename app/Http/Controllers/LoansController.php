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

    public function edit(Loan $loan) {
        $loan->months_to_pay = $loan->date_mature->diffInMonths($loan->date_released);
        $loan->months_to_pay += $loan->date_released->month == 2 ? 1 : 0;

        return view('loans.edit', compact('loan'));
    }

    public function update(Loan $loan) {
        $loan->principal = request('principal');
        $loan->date_released = request('date_released');
        $loan->date_mature = $this->getMaturityDate();
        $loan->save();

        return redirect(route('members.show', $loan->member->id));
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
        $members = Member::all();

        return view('par_report.index', compact('members'));
    }

    public function getPARData() {
        $PARData = ['chart' => [0,0,0,0,0,0,0]];

        foreach(Member::all() as $member) {
            $PARData['chart'][0] += $member->daysPAR() < 1 ? 1 : 0;
            $PARData['chart'][1] += $member->daysPAR() >= 1 && $member->daysPAR() <= 7 ? 1 : 0;
            $PARData['chart'][2] += $member->daysPAR() >= 8 && $member->daysPAR() <= 15 ? 1 : 0;
            $PARData['chart'][3] += $member->daysPAR() >= 16 && $member->daysPAR() <= 30 ? 1 : 0;
            $PARData['chart'][4] += $member->daysPAR() >= 31 && $member->daysPAR() <= 90 ? 1 : 0;
            $PARData['chart'][5] += $member->daysPAR() >= 91 && $member->daysPAR() <= 360 ? 1 : 0;
            $PARData['chart'][6] += $member->daysPAR() > 360 ? 1 : 0;
        }

        return response()->json($PARData, 200);
    }
}
