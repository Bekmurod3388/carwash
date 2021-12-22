<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=['price_id','number','worker_id','status','sum'];

    public function price(){
       return $this->belongsTo(Price::class);
    }


    public function worker(){
        return $this->belongsTo(Worker::class);
    }

}
