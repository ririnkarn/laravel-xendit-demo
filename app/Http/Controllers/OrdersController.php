<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderSaveRequest;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Xendit\Xendit;
use Illuminate\Support\Facades\Redirect;

class OrdersController extends Controller
{
    public function index()
    {
        $dataList = Order::all();

        return view('order.index', compact('dataList'));
    }

    public function create()
    {
        return view('order.create', [
            'title' => 'Buy the Book',
            'price' => 150000
        ]);
    }

    public function store(OrderSaveRequest $request)
    {
        try {
            DB::beginTransaction();
            $order_number = 'LX-' . strtoupper(Str::random(4)) . '-' . date('YmdHis');
            $request->merge([
                'order_number' => $order_number,
                'amount' => 150000,
                'description' => 'Buy the book',
            ]);

            $order = Order::create($request->all());
            DB::commit();

            Xendit::setApiKey(config('xendit.key_auth'));
            $params = [
                'external_id' => $order_number,
                'amount' => $request->amount,
                'description' => $request->description,
                'invoice_duration' => 60 * 60 * 24, // 24 hours
                'customer' => [
                    'given_names' => $request->name,
                    'surname' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->phone_number,
                    'address' => [
                        [
                            'city' => $request->city,
                            'country' => $request->country,
                            'postal_code' => $request->postal_code,
                            'state' => $request->state,
                            'street_line1' => $request->street_line1,
                            'street_line2' => ''
                        ]
                    ]
                ],
                'customer_notification_preference' => [
                    'invoice_created' => [
                        'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_reminder' => [
                        'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_paid' => [
                        'whatsapp',
                        'sms',
                        'email'
                    ],
                    'invoice_expired' => [
                        'whatsapp',
                        'sms',
                        'email'
                    ]
                ],
                'success_redirect_url' => route('success'),
                'failure_redirect_url' => route('failure'),
                'currency' => 'IDR',
                'items' => [
                    [
                        'name' => 'Let\'s Talk and Practice',
                        'quantity' => 1,
                        'price' => $request->amount,
                        'category' => 'Education',
                        'url' => url('/')
                    ]
                ],
                'fees' => [
                    [
                        'type' => 'ADMIN',
                        'value' => 6500
                    ]
                ]
            ];

            $createInvoice = \Xendit\Invoice::create($params);
            $order->update([
                'status' => $createInvoice['status'],
                'payment_url' => $createInvoice['invoice_url'],
            ]);

            return Redirect::to($createInvoice['invoice_url']);
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with('status', $ex->getMessage());
        }
    }
    
    public function success()
    {
        return 'success';
    }

    public function failure()
    {
        return 'failure';
    }
}
