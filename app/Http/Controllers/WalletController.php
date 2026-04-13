<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $query = Wallet::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('coin_type', 'like', "%{$search}%")
                  ->orWhere('wallet_address', 'like', "%{$search}%");
        }

        $wallets = $query->orderBy('id', 'desc')->paginate(10);

        return view('admin.wallets.index', compact('wallets'));
    }

    public function create()
    {
        return view('admin.wallets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coin_type' => 'required|string|max:50',
            'wallet_address' => 'required|string|max:255|unique:wallets,wallet_address',
        ]);

        Wallet::create($request->all());

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet created successfully.');
    }

    public function edit(Wallet $wallet)
    {
        return view('admin.wallets.edit', compact('wallet'));
    }

    public function update(Request $request, Wallet $wallet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coin_type' => 'required|string|max:50',
            'wallet_address' => 'required|string|max:255|unique:wallets,wallet_address,' . $wallet->id,
        ]);

        $wallet->update($request->all());

        return redirect()->route('admin.wallets.index')->with('success', 'Wallet updated successfully.');
    }

    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->route('admin.wallets.index')->with('success', 'Wallet deleted successfully.');
    }
}
