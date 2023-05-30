<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disbursement;
use App\Http\Requests\DisbursementSaveRequest;
use Carbon\Carbon;
use Str;
use Xendit\Xendit;

class DisbursementsController extends Controller
{
    public function index()
    {
        $dataList = Disbursement::all();

        return view('disbursement.index', compact('dataList'));
    }

    public function create()
    {
        Xendit::setApiKey(config('xendit.key_auth'));
        $getDisbursementsBanks = \Xendit\Disbursements::getAvailableBanks();

        return view('disbursement.create', [
            'bank_codes' => $getDisbursementsBanks
        ]);
    }

    public function store(DisbursementSaveRequest $request)
    {
        $request['disbursement_code'] = 'DIS-' . strtoupper(Str::random(4)) . '-' . date('YmdHis');
        $disbursement = Disbursement::create($request->all());

        Xendit::setApiKey(config('xendit.key_auth'));
        $params = [
            'external_id' => $disbursement->disbursement_code,
            'amount' => $disbursement->amount,
            'bank_code' => $disbursement->bank_code,
            'account_holder_name' => $disbursement->account_name,
            'account_number' => $disbursement->account_number,
            'description' => $disbursement->description,
            'X-IDEMPOTENCY-KEY' => $disbursement->disbursement_code,
            'email_to' => [
                $disbursement->email,
            ]
        ];
        $createDisbursements = \Xendit\Disbursements::create($params);
        $disbursement->update([
            'user_id' => $createDisbursements['user_id'],
            'disbursement_id' => $createDisbursements['id'],
        ]);

        return 'ok';
    }

    public function callback(Request $request)
    {
        if (empty($request->all())) {
            return response()->json(['message' => 'Can not process empty request'], 400);
        }

        $json = json_decode($request->getContent());

        Disbursement::updateOrCreate(
            [
                'disbursement_code' => $json->external_id,
            ],
            [
                'status' => $json->status,
                'completed_at' => now(),
            ]
        );

        return response()->json([
            'status' => 200,
            'message' => 'Success',
            'data' => [
                'disbursement_code' => $json->external_id,
                'disbursement_id' => $json->id,
                'status' => $json->status,
                'amount' => $json->amount,
            ]
        ]);
    }
}
