<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'histories';


    protected $fillable = [
        'id',
        'from_id',
        'to_id',
        'send_date',
        'received_date',
        'equipment_id'
    ];
}
