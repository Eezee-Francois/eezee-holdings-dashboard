<?php

namespace App\Http\Controllers\EezeeHoldings\EezeeBatteries;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeHoldings\EezeeBatteries\Client;
use App\Models\EezeeHoldings\EezeeBatteries\Upliftment;

use Illuminate\Http\Request;

class UpliftmentController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('Admin|Logistics|Sales Rep')){
            return view('eezee_holdings.eezee_logistics.upliftment.index.index');
        } else {
            return redirect()->back();
        }
    }

    public function upcomming_index()
    {
        if(Auth::user()->hasRole('Admin|Logistics')){
            return view('eezee_holdings.eezee_logistics.upliftment.index.upcomming_index');
        } else {
            return redirect()->back();
        }
    }

    public function client_drop_off_index()
    {
        if(Auth::user()->hasRole('Admin|Logistics')){
            return view('eezee_holdings.eezee_logistics.upliftment.index.client_drop_off_index');
        } else {
            return redirect()->back();
        }
    }

    public function completed_index()
    {
        if(Auth::user()->hasRole('Admin|Logistics')){
            return view('eezee_holdings.eezee_logistics.upliftment.index.completed_index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|string',
        ]);

        $client = Client::find($request->client_id);

        $upliftment = new Upliftment();

            $upliftment->user_id = Auth::user()->id;
            $upliftment->category = 'Eezee Batteries';
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
            $upliftment->weight = $request->weight;
            $upliftment->type = $request->type;
            $upliftment->stock_code = $request->stock_code;
            $upliftment->client_price = $client->price;

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
            return view('eezee_holdings.eezee_batteries.client.show.upliftment', compact('upliftment'));
        } else {
            return redirect()->back();
        }
    }
}
