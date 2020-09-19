<?php

namespace App\Http\Controllers;

use App\Http\Livewire\WalletsTable;

class WalletsController extends Controller
{
    public function mine()
    {
        if (!auth()->user()) {
            abort(403, 'this section is for user');
        }

        $wallets = auth()->user()->wallets()->paginate(20);
        $headers = WalletsTable::HEADERS;
        
        return view('wallets.mine')->with(compact('wallets', 'headers'));
    }
}
