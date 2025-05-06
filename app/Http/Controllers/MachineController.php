<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\FuelType;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index()
    {
        $machines = Machine::with('fuelType')->get();
        return view('machines', compact('machines'));
    }

    public function create()
    {
        $fuelTypes = FuelType::all();
        return view('machines.create', compact('fuelTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'fuel_type_id' => 'required|exists:fuel_types,id',
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

    public function update(Request $request, Machine $machine)
    {
        $request->validate([
            'name' => 'required',
            'fuel_type_id' => 'required|exists:fuel_types,id',
        ]);

        $machine->update($request->all());
        return redirect()->route('machines.index')->with('success', 'Machine updated successfully.');
    }

    public function destroy(Machine $machine)
    {
        $machine->delete();
        return redirect()->route('machines.index')->with('success', 'Machine deleted successfully.');
    }
}
