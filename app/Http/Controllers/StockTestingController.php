<?php

namespace App\Http\Controllers;
use App\Models\StockTesting;
use App\Models\Fuel;
use App\Models\Machine;

use Illuminate\Http\Request;

class StockTestingController extends Controller
{
    public function index()
    {
        $testings = StockTesting::with(['fuel', 'machine'])->latest()->get();
        $fuels = Fuel::all(['id', 'name']);
        $machines = Machine::all(['id', 'name', 'fuel_id']);
        return view('stock_testing', compact('testings', 'fuels', 'machines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fuel_id' => 'required|exists:fuels,id',
            'machine_id' => 'required|exists:machines,id',
            'litres' => 'required|numeric|min:0',
            'adjustment' => 'required|boolean',
        ]);

        $machine = Machine::find($request->machine_id); 

        if ($machine->liters < $request->litres) {
            return redirect()->back()->withErrors(['litres' => 'The machine does not have enough litres.']);
        }

        $machine->update([
            'liters' => $machine->liters - $request->litres,
        ]);

        StockTesting::create($request->all());

        return redirect()->back()->with('success', 'Stock Testing record added successfully.');
    }
}
