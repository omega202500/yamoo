<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
 protected $fillable = ['phone', 'amount', 'campay_reference', 'status', 'payment_method'];
}
