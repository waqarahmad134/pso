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
        try {
            $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'price' => 'sometimes|required|numeric',
                'description' => 'sometimes|nullable|string',
            ]);

            $fuel = Fuel::findOrFail($id);

            // Update only fields that are present
            if ($request->has('name')) {
                $fuel->name = $request->name;
            }

            if ($request->has('price')) {
                $fuel->price = $request->price;
            }

            if ($request->has('description')) {
                $fuel->description = $request->description;
            }

            $fuel->save();

            return redirect()->back()->with('success', 'Fuel updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
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
