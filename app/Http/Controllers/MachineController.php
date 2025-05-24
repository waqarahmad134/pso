<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\FuelType;
use App\Models\Fuel;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('fuelType')->get();
        $fuel = Fuel::all();
        return view('machines', compact('machines', 'fuel'));
    }

    public function create()
    {
        $fuel = Fuel::all();
        return view('machines.create', compact('fuel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fuel_id' => 'required|exists:fuel_types,id',
            'last_reading' => 'required',
            'status' => 'required',
        ]);

        Machine::create($request->all());
        return redirect()->route('machines.index')->with('success', 'Machine created successfully.');
    }

    public function show(Machine $machine)
    {
        return view('machines.show', compact('machine'));
    }

    public function edit(Machine $machine)
    {
        $fuelTypes = FuelType::all();
        return view('machines.edit', compact('machine', 'fuelTypes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'fuel_id' => 'required|exists:fuel_types,id',
            'last_reading' => 'required',
        ]);

        $machine = Machine::findOrFail($id);
        $machine->update($request->all());
        return redirect()->route('machines.index')->with('success', 'Machine updated successfully.');
    }

    public function updateStatus($id)
    {
        try {
            $machine = Machine::findOrFail($id);
            $machine->status = $machine->status === 'active' ? 'inactive' : 'active';
            $machine->save();

            return redirect()->route('machines.index')->with('success', 'Machine status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('machines.index')->with('error', 'Failed to update machine status: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $machine = Machine::findOrFail($id);
            $machine->delete();
            return redirect()->route('machines.index')->with('success', 'Machine deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('machines.index')->with('error', 'Failed to delete Machine: ' . $e->getMessage());
        }
    }

}
