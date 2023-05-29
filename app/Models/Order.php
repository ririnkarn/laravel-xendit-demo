<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'xendit_id', 'fees_paid_amount', 'payment_channel', 'payment_destination', 'amount'
    ];
}
