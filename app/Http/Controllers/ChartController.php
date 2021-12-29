<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(){
        $cost=Cost::select('id','created_at')->get()->groupby(function($cost){
            return Carbon::parse($cost->created_at)->format('M');
        });
        $month=[];
        $count=[];
        foreach($cost as $key=>$value){
            $month[]=$key;
            $count[]=count($value);
        }
        return view('admin.chart.index',['cost' =>$cost ,'month'=>$month,'count'=>$count]);
    }
}
