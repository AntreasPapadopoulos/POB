<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePassengerOnBoardRequest;
use App\Models\PassengerOnBoard;
use Illuminate\Http\Request;

class PassengerOnBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(PassengerOnBoard::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePassengerOnBoardRequest $request)
    {
        /**
         * In general $request->all is not the best practice but since we alter the data in
         * StorePassengerOnBoardRequest then it should be fine to do so but on average $request->validated()
         * is better practice!
         */
        if (PassengerOnBoard::create($request->all())) {
            return response()->json('Record added successfully.', 201);   
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PassengerOnBoard $pob)
    {
        return response()->json($pob, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PassengerOnBoard $pob)
    {
        // ToDO: To be discussed how we want to handle this IF we even want to acccept an update endpoint
        // dd($request);
        // if ($pob->fill($request->all())->save()) {
        //     return response()->success($pob);
        // }    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PassengerOnBoard $pob)
    {
        if ($pob->delete()) {
            return response()->success('Record deleted.');
        }
    }
}