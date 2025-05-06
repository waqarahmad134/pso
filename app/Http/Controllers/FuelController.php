<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelType;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('fuelType')->get(); // Fetch fuels with their types
        $fuelTypes = FuelType::all(); // Fetch all fuel types
        return view('fuel', compact('fuels', 'fuelTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'status' => 'required|boolean',
        ]);

        Fuel::create([
            'name' => $request->name,
            'fuel_type_id' => $request->fuel_type_id,
            'status' => $request->status,
        ]);

        return redirect()->route('fuel.index')->with('success', 'Fuel added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'status' => 'required|boolean',
        ]);

        $fuel = Fuel::findOrFail($id);
        $fuel->name = $request->name;
        $fuel->fuel_type_id = $request->fuel_type_id;
        $fuel->status = $request->status;
        $fuel->save();

        return redirect()->route('fuel.index')->with('success', 'Fuel updated successfully!');
    }


    public function updateStatus($id)
    {
        $fuel = Fuel::findOrFail($id);
        $fuel->status = !$fuel->status; // Toggle the status
        $fuel->save();

        return redirect()->route('fuel.index')->with('success', 'Fuel status updated!');
    }

    public function destroy($id)
    {
        $fuel = Fuel::findOrFail($id);
        $fuel->delete();

        return redirect()->route('fuel.index')->with('success', 'Fuel deleted successfully!');
    }

}
