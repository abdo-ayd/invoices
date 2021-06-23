<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class invoice_attachments extends Model
{
    protected $fillable =[
        'file_name','invoice_number','Created_by','invoice_id'
    ];
    
}
