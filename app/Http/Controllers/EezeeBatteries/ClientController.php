<?php

namespace App\Http\Controllers\EezeeBatteries;

use App\Http\Controllers\Controller;

use Auth;

use App\Models\EezeeBatteries\Client;
use Illuminate\Http\Request;

use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('Admin|Sales Rep')){
            return view('eezee_batteries.client.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->hasRole('Admin|Sales Rep')){
            return view('eezee_batteries.client.create');
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

        $client = new Client;

            $client->user_id = $user->id;
            $client->consultant_id = $user->id;
            $client->consultant_name = $user->name;

            $client->company_name = $request->company_name;
            $client->client_name = $request->client_name;
            $client->telephone_1 = encrypt($request->telephone_1);
            $client->telephone_2 = encrypt($request->telephone_2);
            $client->email = encrypt($user->email);
            $client->price = $request->price;
            $client->client_comments = $request->client_comments;
            $client->address = encrypt($request->address);
            $client->lat = encrypt($request->lat);
            $client->lng = encrypt($request->lng);
            $client->address_comments = $request->address_comments;
            $client->province = $request->province;

            $client->active = 'Yes';

        $client->save();

        return redirect('/eezee_batteries/client/index')->with('success_message', 'The Client has been saved!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if(Auth::user()->hasRole('Admin|Sales Rep')){
            $client = Client::find($id);
            return view('eezee_batteries.client.show.show', compact('client'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    public function address_update(Request $request, $id)
    {
        $client = Client::find($id);

            $client->address = encrypt($request->address);
            $client->lat = encrypt($request->lat);
            $client->lng = encrypt($request->lng);
            $client->province = $request->province;
            $client->address_comments = $request->address_comments;

        $client->save();

        return redirect('/eezee_batteries/client/'.$client->id)->with('success_message', 'Client Address Updated');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       //
    }
}
