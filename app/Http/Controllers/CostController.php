<?php

namespace App\Http\Controllers;

use App\Models\Cost;
use Illuminate\Http\Request;

class CostController extends Controller
{

    public function index()
    {
        $costs=Cost::orderby('id','desc')->paginate(10);
        return view('admin.cost.index',['costs'=>$costs]);
    }

    public function store(Request $request)
    {
        (new Cost($request->all()))->save();
        return redirect()->route('admin.cost.index')->with('success','Расходы успешно созданы');
    }

    public function update(Request $request,Cost $cost)
    {
        $cost->fill($request->all());
        $cost->save();
        return redirect()->back()->with('success','Расходы обновлено!');
    }

    public function destroy(Cost $cost)
    {
        $cost->delete();
        return redirect()->route('admin.cost.index')->with('success','Расходы успешно удалено!');
    }
}
