<?php

namespace App\Http\Controllers;

use App\Models\Dip;
use App\Models\Fuel; 
use Illuminate\Http\Request;

class DipController extends Controller
{
    public function index(Request $request)
    {
        $fuel_id = $request->get('fuel_id');
        $query = Dip::query();
        if ($fuel_id) {
            $query->where('fuel_id', $fuel_id);
        }
        $dips = $query->paginate(20);
        $fuel = Fuel::all();
        return view('dip', compact('dips', 'fuel', 'fuel_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'status' => 'required', // assuming status is present like in fuel
            'fuel_id' => 'required|exists:fuels,id',
        ]);

        Dip::create([
            'name' => $request->name,
            'type' => $request->type,
            'status' => $request->status,
            'fuel_id' => $request->fuel_id,
        ]);

        return redirect()->route('dip.index')->with('success', 'Dip added successfully!');
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|max:100',
                'status' => 'required',
                'fuel_id' => 'sometimes|required|exists:fuels,id',
            ]);

            $dip = Dip::findOrFail($id);

            if ($request->has('name')) $dip->name = $request->name;
            if ($request->has('type')) $dip->type = $request->type;
            if ($request->has('status')) $dip->status = $request->status;
            if ($request->has('fuel_id')) $dip->fuel_id = $request->fuel_id;
            $dip->save();

            return redirect()->back()->with('success', 'Dip updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function updateStatus($id)
    {
        $dip = Dip::findOrFail($id);
        $dip->status = !$dip->status; 
        $dip->save();
        return redirect()->route('dip.index')->with('success', 'Dip status updated!');
    }

    public function destroy($id)
    {
        $dip = Dip::findOrFail($id);
        $dip->delete();

        return redirect()->route('dip.index')->with('success', 'Dip deleted successfully!');
    }
}
