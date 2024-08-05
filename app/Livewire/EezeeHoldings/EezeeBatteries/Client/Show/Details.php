<?php

namespace App\Livewire\EezeeHoldings\EezeeBatteries\Client\Show;

use Auth;

use Carbon\Carbon;

use App\Models\EezeeHoldings\EezeeBatteries\Client;

use Livewire\Component;

use Illuminate\Support\Facades\Crypt;

class Details extends Component
{
    public $client;
    public $user_id;
	public $company_name;
	public $client_name;
	public $telephone_1;
	public $telephone_2;
	public $email;
	public $price;
	public $province;
	public $client_comments;

	public function mount(Client $client)
	{
		$this->client = $client;
		$this->company_name = $client->company_name;
		$this->client_name = $client->client_name;
		$this->telephone_1 = $client->telephone_1;
		$this->telephone_2 = $client->telephone_2;
		$this->email = $client->email;
		$this->price = $client->price;
        $this->province = $client->province;
		$this->client_comments = $client->client_comments;
	}

	public function saveClientDetails()
	{
		$this->validate([
            'company_name' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'telephone_1' => 'required|string|max:255',
            'telephone_2' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'price' => 'required|numeric',
            'province' => 'required|string|max:255',
            'client_comments' => 'nullable|string|max:2000',
        ]);

        $this->client->update([
            'user_id' => Auth::user()->id,
            'company_name' => $this->company_name,
            'client_name' => $this->client_name,
            'telephone_1' => encrypt($this->telephone_1),
            'telephone_2' => encrypt($this->telephone_2),
            'email' => encrypt($this->email),
            'price' => $this->price,
            'province' => $this->province,
            'client_comments' => $this->client_comments,
        ]);

		session()->flash('client_details_saved');

	}

    public function render()
    {
        return view('livewire.eezee-holdings.eezee-batteries.client.show.details');
    }
}
