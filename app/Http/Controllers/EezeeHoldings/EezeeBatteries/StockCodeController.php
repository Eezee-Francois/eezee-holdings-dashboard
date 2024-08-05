<?php

namespace App\Http\Controllers\EezeeHoldings\EezeeBatteries;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeHoldings\EezeeBatteries\StockCode;
use Illuminate\Http\Request;

class StockCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            return view('eezee_holdings.eezee_batteries.stock.stock_code.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock_code' => 'required|string',
        ]);

        $stock_code = new StockCode();

            $stock_code->user_id = Auth::user()->id;
            $stock_code->stock_code = $request->stock_code;

        $stock_code->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(StockCode $stockCode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StockCode $stockCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StockCode $stockCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockCode $stockCode)
    {
        //
    }
}
