<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function validatePayment(Request $request)
    {
        $card_number = $request->input('card_number');
        $expiry_month = $request->input('expiry_month');
        $expiry_year = $request->input('expiry_year');
        $cvv = $request->input('cvv');

        // Perform validation checks
        $expiry_date = Carbon::create($expiry_year, $expiry_month, 1, 0, 0, 0);
        $now = Carbon::now();
        $expiry_valid = $expiry_date->isAfter($now);

        if (substr($card_number, 0, 2) == '34' || substr($card_number, 0, 2) == '37') {
            $cvv_valid = strlen($cvv) == 4;
        } else {
            $cvv_valid = strlen($cvv) == 3;
        }

        $pan_valid = strlen($card_number) >= 16 && strlen($card_number) <= 19;
        $luhn_valid = $this->luhnCheck($card_number);

        // Respond with success or failure
        if ($expiry_valid && $cvv_valid && $pan_valid && $luhn_valid) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'failure']);
        }
    }

    private function luhnCheck($card_number)
    {
        $card_number = strrev(preg_replace('/[^0-9]/', '', $card_number));
        $sum = 0;
        for ($i = 0; $i < strlen($card_number); $i++) {
            $digit = substr($card_number, $i, 1);
            if ($i % 2 == 1) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        return $sum % 10 == 0;
    }
}
