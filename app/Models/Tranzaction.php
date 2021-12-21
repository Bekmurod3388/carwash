<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tranzaction extends Model
{
    use HasFactory;
    protected $fillable=['worker_id','price_id','client_id','sum','status','rating'];
}
