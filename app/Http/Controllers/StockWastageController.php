<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\StockWastage;
use Illuminate\Http\Request;

class StockWastageController extends Controller
{
    public function index()
    {
        $wastages = StockWastage::with('fuel')->latest()->get();
        $fuels = Fuel::all();

        return view('stock_wastage', compact('wastages', 'fuels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fuel_id' => 'required',
            'liters' => 'required|numeric|min:0.01',
        ]);
        $fuel = Fuel::findOrFail($request->fuel_id);
        if ($fuel->liters < $request->liters) {
            return back()->with('error', 'Insufficient fuel stock for wastage.');
        }
        
        $wastage = StockWastage::create($request->only('fuel_id', 'liters'));
        $fuel->liters -= $request->liters;

        $fuel->save();

        return back()->with('success', 'Wastage recorded and stock updated.');
    }
}

