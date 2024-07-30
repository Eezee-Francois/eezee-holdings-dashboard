<?php

namespace App\Http\Controllers\EezeeBatteries;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeBatteries\Client;
use App\Models\EezeeBatteries\Upliftment;

use Illuminate\Http\Request;

class UpliftmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'size' => 'required|string',
        ]);

        $client = Client::find($request->client_id);

        $upliftment = new Upliftment();

            $upliftment->user_id = Auth::user()->id;
            $upliftment->consultant_id = $client->consultant_id;
            $upliftment->consultant_name = $client->consultant_name;
            $upliftment->client_id = $client->id;
            $upliftment->client_name = $client->client_name;
            $upliftment->company_name = $client->company_name;
            $upliftment->completed = 'No';
            $upliftment->province = $client->province;
            $upliftment->address = $client->address;
            $upliftment->address_comments = $client->address_comments;
            $upliftment->lat = $client->lat;
            $upliftment->lng = $client->lng;
            $upliftment->telephone_1 = $client->telephone_1;
            $upliftment->telephone_2 = $client->telephone_2;
            $upliftment->size = $request->size;

        $upliftment->save();

        return redirect()->back()->with('success', 'Upliftment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('Admin|Sales Rep')){
            $upliftment = Upliftment::find($id);
            return view('eezee_batteries.client.show.upliftment', compact('upliftment'));
        } else {
            return redirect()->back();
        }
    }
}
