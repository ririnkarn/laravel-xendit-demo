<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Xendit\Xendit;

class XenditController extends Controller
{
    /**
     * Balance
     */
    public function getBalance()
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $getBalance = \Xendit\Balance::getBalance('CASH');

        return response()->json(['data' => $getBalance], 200);
    }

    /**
     * Transaction
     */
    public function getTransactions()
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $params = [
            'types' => 'DISBURSEMENT',
            'for-user-id' => '<your user id>',
            'query-param'=> 'true'
        ];
        $list = \Xendit\Transaction::list();

        return response()->json(['data' => $list], 200);
    }

    public function showTransactions($id)
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $detail = \Xendit\Transaction::detail($id);

        return response()->json(['data' => $detail], 200);
    }

    /**
     * Virtual Account
     */
    public function getVAList()
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $getVABanks = \Xendit\VirtualAccounts::getVABanks();

        return response()->json(['data' => $getVABanks], 200);
    }

    public function createVA(Request $request)
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $params = [
            "external_id" => "VA_Test-8272",
            "bank_code" => $request->bank,
            "name" => $request->name,
            "expected_amount" => $request->price,
            "expiration_date" => Carbon::now()->addDays(1),
            "is_single_use" => true,
            "is_closed" => true,
        ];
        $createVA = \Xendit\VirtualAccounts::create($params);

        return response()->json(['data' => $createVA], 201);
    }
}
