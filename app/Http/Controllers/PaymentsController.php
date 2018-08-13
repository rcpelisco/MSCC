<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\Validator;

use App\Loan;
use App\Payment;

class PaymentsController extends Controller
{
    public function store(Loan $loan) {
        $validator = Validator::make(request()->all(), [
            'date_payment' => 'required', 
            'or_number' => 'required', 
            'amount_payment' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return redirect('members/' . $loan->member->id 
                . '/?ref=create_payment_fail')
                ->withErrors($validator)
                ->withInput();
        }

        $loan->pay(request([
            'date_payment', 
            'or_number', 
            'amount_payment',
        ]));

        return back();
    }
    
    public function asyncEdit(Payment $payment) {
        return response($payment, 200);
    }

    public function update(Payment $payment) {
        $validator = Validator::make(request()->all(), [
            'date_payment' => 'required', 
            'or_number' => 'required', 
            'amount_payment' => 'required|numeric',
        ]);

        if($validator->fails()) {
            return redirect('members/' . $payment->loan->member->id 
                . '/?ref=edit_payment_fail')
                ->withErrors($validator)
                ->withInput();
        }
        
        $payment->update(request([
            'date_payment',
            'or_number',
            'amount_payment',
        ]));

        return redirect(route('members.show', 
            $payment->loan->member->id));
    }
    
    public function destroy(Payment $payment) {
        $payment->delete();
        return back();
    }
}
