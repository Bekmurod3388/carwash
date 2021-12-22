<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Price;
use App\Models\Worker;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients=Client::orderby('id','desc')->paginate(20);
        $prices=Price::all();
        $workers=Worker::all();
        return view('admin.client.index',['clients'=>$clients,'prices'=>$prices,'workers'=>$workers]);
    }

    public function store(Request $request)
    {
        (new Client($request->all()))->save();
        return redirect()->route('admin.client.index')->with('success','Клиент успешно созданы');
    }


    public function update(Request $request,Client $client)
    {
        $client->fill($request->all());
        $client->save();
        return redirect()->back()->with('success','Клиент обновлено!');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.client.index')->with('success','Клиент успешно удалено!');
    }
}
