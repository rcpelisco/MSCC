<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Loan;
use App\Payment;

class PaymentsController extends Controller
{
    public function store(Loan $loan) {
        $loan->pay(request([
            'date_payment', 
            'or_number', 
            'amount_payment'
        ]));

        return back();
    }
    
    public function asyncEdit(Payment $payment) {
        return response($payment, 200);
    }

    public function update(Payment $payment) {
        $payment->update(request([
            'date_payment',
            'or_number',
            'amount_payment',
        ]));
        return back();
    }
    
    public function destroy(Payment $payment) {
        $payment->delete();
        return back();
    }
}
