<?php

namespace App\Http\Controllers;

use App\Http\Resources\CostResource;
use App\Models\Cost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $costs=Cost::latest()->get();
        return response()->json([CostResource::collection($costs),'Cost fetched']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'summ'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->error());
        }

        $price=Cost::create($request->all());
        if ($price){
            return response()->json(['Price created successfully.',new CostResource($price)]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Cost $cost
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Cost $cost)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'summ'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->error())->with('error','Validation Error.');
        }

        $cost->name = $request->name;
        $cost->summ = $request->summ;
        $cost->save();

        return response()->json(['Cost updated successfully.', new CostResource($cost)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Cost $cost
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Cost $cost)
    {
        $cost=$cost->delete();
        return response()->json('Cost deleted successfully');
    }
}
