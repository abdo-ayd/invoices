<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoices_details extends Model
{
    protected $fillable =[
        'id_Invoice',	'invoice_number',
        'product'	,'Section'	,
        'Status','Value_Status',
        'Payment_Date','note','user'
    ];
}
