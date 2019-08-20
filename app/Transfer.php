<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $fillable = [
        'from_user_id', 'to_user_id', 'dateTime_transfer', 'invoice_amount', 'comment', 'type', 'completed'
    ];
}
