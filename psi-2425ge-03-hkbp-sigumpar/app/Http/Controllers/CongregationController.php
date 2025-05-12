<?php

namespace App\Http\Controllers;

use App\Models\Congregation;
use Illuminate\Http\Request;

class CongregationController extends Controller
{
    public function index()
    {
        $congregations = Congregation::all();
        return view('admin.congregation.index', compact('congregations'));
    }

    public function create()
    {
        return view('admin.congregation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'gender' => 'required|string',
            'age_categories' => 'required|string',
        ]);

        Congregation::create($request->all());
        $congregations = Congregation::all();
        return view('admin.congregation.index', compact('congregations'));
        // return redirect()->route('congregation.index')->with('success', 'Data added successfully.');
    }

    public function show(Congregation $congregation)
    {
        return view('congregation.show', compact('congregation'));
    }

    public function edit(Congregation $congregation)
    {
        return view('congregation.edit', compact('congregation'));
    }

    public function update(Request $request, Congregation $congregation)
    {
        $request->validate([
            'jumlah' => 'required|integer',
            'gender' => 'required|string',
            'age_categories' => 'required|string',
        ]);

        $congregation->update($request->all());
        return redirect()->route('congregations.index')->with('success', 'Data updated successfully.');
    }

    public function destroy(Congregation $congregation)
    {
        $congregation->delete();
        return redirect()->route('congregations.index')->with('success', 'Data deleted successfully.');
    }
}
