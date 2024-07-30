<?php

namespace App\Http\Controllers\EezeeLogistics;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeLogistics\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            return view('eezee_logistics.truck.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('Admin')){
            return view('eezee_logistics.truck.create');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $driver = new Truck;

            $driver->user_id = $user->id;

            $driver->name = $request->name;
            $driver->registration = $request->registration;
            $driver->size = $request->size;

            $driver->active = 'Yes';

        $driver->save();

        return redirect('/eezee_logistics/truck/index')->with('success_message', 'The Truck has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('Admin')){
            $truck = Truck::find($id);
            return view('eezee_logistics.truck.show.show', compact('truck'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truck $truck)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Truck $truck)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truck $truck)
    {
        //
    }
}
