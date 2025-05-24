<?php

namespace App\Http\Controllers;

use App\Models\MobilOil;
use Illuminate\Http\Request;

class MobilOilController extends Controller
{
    public function index()
    {
        $mobilOils = MobilOil::all();
        return view('mobil_oil', compact('mobilOils'));
    }

    public function create()
    {
        return view('mobil_oil.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sale_price' => 'required|numeric|min:0',
            'inventory' => 'required|integer|min:0',
        ]);

        MobilOil::create($request->all());
        return redirect()->route('mobil_oil.index')->with('success', 'Mobil oil added successfully.');
    }

    public function show(MobilOil $mobilOil)
    {
        return view('mobil_oil.show', compact('mobilOil'));
    }

    public function edit(MobilOil $mobilOil)
    {
        return view('mobil_oil.edit', compact('mobilOil'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sale_price' => 'required|numeric|min:0',
            'inventory' => 'required|integer|min:0',
        ]);

        $mobilOil = MobilOil::findOrFail($id);
        $mobilOil->update($request->only(['name', 'sale_price', 'inventory']));

        return redirect()->route('mobil_oil.index')->with('success', 'Mobil oil updated successfully.');
    }


    public function destroy($id)
    {
        try {
            $mobilOil = MobilOil::findOrFail($id);
            $mobilOil->delete();
    
            return redirect()->route('mobil_oil.index')->with('success', 'Mobil oil deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('mobil_oil.index')->with('error', 'Failed to delete Mobil Oil: ' . $e->getMessage());
        }
    }
    
    
}
