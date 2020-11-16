<?php

namespace App\Http\Controllers\Customer\RePayment;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use App\User\Customer\Repayment\CardInstrument;
use Illuminate\Http\Request;

class PaymentInstrumentController extends Controller
{
    public function addCard(Request $request){
        try {
            return view('admin.customer.add_card', ['user'=> Customer::where('id', $request->uuid)->first()]);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }

    public function storeAuthCode(Request $request){
        $request->validate([
            'customer_id' => 'required|integer',
            'reference' => 'required'
        ]);
        $user = Customer::where('id', $request->customer_id)->first();
        try {
            $data = (array)$user->verifyTransaction($request->reference);
            $user->cardInstrument->create($data);
        } catch (\Throwable $th) {
            return jsonResponse(['message' => $th->getMessage()], 400);
        }
    }
}
