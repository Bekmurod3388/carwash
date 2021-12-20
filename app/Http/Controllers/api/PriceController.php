<?php

namespace App\Http\Controllers;

use App\Http\Resources\PriceResource;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function index()
    {
        $prices=Price::latest()->get();
        return response()->json([PriceResource::collection($prices),'Prices fetched']);
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
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
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

        $price=Price::create($request->all());
        if ($price){
            return response()->json(['Price created successfully.',new PriceResource($price)]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'summ'=>'required',
        ]);
        if ($validator->fails()){
            return response()->json($validator->error())->with('error','Validation Error.');
        }

        $price->name = $request->name;
        $price->summ = $request->summ;
        $price->save();

        return response()->json(['Price updated successfully.', new PriceResource($price)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $delete=$price->delete();
        return response()->json('Price deleted successfully');
    }
}
