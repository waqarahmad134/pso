<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\Machine;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::with('fuelType')->get(); // Fetch fuels with their types
        $fuelTypes = FuelType::all(); // Fetch all fuel types
        $machines = Machine::all();
        return view('fuel', compact('fuels', 'fuelTypes', 'machines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'status' => 'required|boolean',
            'price' => 'required',
            'description' => 'required|string',
        ]);

        Fuel::create([
            'name' => $request->name,
            'fuel_type_id' => $request->fuel_type_id,
            'status' => $request->status,
            'price' => $request->price,
            'description' => $request->description,
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
                'status' => 'sometimes|required|boolean',
                'fuel_type_id' => 'sometimes|required|exists:fuel_types,id',
            ]);

            $fuel = Fuel::findOrFail($id);

            if ($request->has('name')) {
                $fuel->name = $request->name;
            }

            if ($request->has('price')) {
                $fuel->price = $request->price;
            }

            if ($request->has('description')) {
                $fuel->description = $request->description;
            }

            if ($request->has('status')) {
                $fuel->status = $request->status;
            }

            if ($request->has('fuel_type_id')) {
                $fuel->fuel_type_id = $request->fuel_type_id;
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

    public function assignFuel(Request $request)
    {
        $request->validate([
            'machine_id' => 'required|exists:machines,id',
            'fuel_id' => 'required|exists:fuels,id',
        ]); 

        $machine = Machine::findOrFail($request->machine_id);
        $fuel = Fuel::findOrFail($request->fuel_id);

        $fuel->liters -= $request->liters;
        $machine->liters += $request->liters;
        $machine->save();
        $fuel->save();

        return redirect()->route('fuel.index')->with('success', 'Fuel assigned to machine successfully!');
    }
    

    public function destroy($id)
    {
        $fuel = Fuel::findOrFail($id);
        $fuel->delete();

        return redirect()->route('fuel.index')->with('success', 'Fuel deleted successfully!');
    }

}
