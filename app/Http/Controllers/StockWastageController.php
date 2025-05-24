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
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'litres' => 'required|numeric|min:0.01',
        ]);

        // Find the fuel type
        $fuel = FuelType::findOrFail($request->fuel_type_id);

        // Optional: check if stock is sufficient (if fuel has a litres column)
        if ($fuel->litres < $request->litres) {
            return back()->with('error', 'Insufficient fuel stock for wastage.');
        }

        // Create the wastage record
        $wastage = StockWastage::create($request->only('fuel_type_id', 'litres', 'time'));

        // Subtract litres from fuel stock
        $fuel->litres -= $request->litres;
        $fuel->save();

        return back()->with('success', 'Wastage recorded and stock updated.');
    }
}

