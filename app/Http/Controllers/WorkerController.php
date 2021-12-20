<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {
        $workers=Worker::orderby('id','desc')->paginate(10);
        return view('admin.worker.index',['workers'=>$workers]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        (new Worker($request->all()))->save();
        return redirect()->route('admin.worker.index')->with('success','Worker успешно созданы');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Worker $worker
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {

        $worker->fill($request->all());
        $worker->save();
        return redirect()->back()->with('success','Успешно обновлено!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Worker $worker
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('admin.worker.index')->with('success','Водитель успешно удалено!');
    }
}
