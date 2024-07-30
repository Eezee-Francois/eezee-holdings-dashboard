<?php

namespace App\Http\Controllers\EezeeLogistics;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeLogistics\Truck;
use App\Models\EezeeLogistics\Driver;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('Admin')){
            return view('eezee_logistics.driver.index');
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
            return view('eezee_logistics.driver.create');
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

        $driver = new Driver;

            $driver->user_id = $user->id;

            $driver->first_name = $request->first_name;
            $driver->last_name = $request->last_name;
            $driver->drivers_license = '$request->drivers_license';

            $driver->active = 'Yes';

        $driver->save();

        return redirect('/eezee_logistics/driver/index')->with('success_message', 'The Driver has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('Admin')){
            $driver = Driver::find($id);
            $trucks = Truck::all();
            return view('eezee_logistics.driver.show.show', compact('driver', 'trucks'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
