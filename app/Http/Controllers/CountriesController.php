<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Country::with('destination')->orderby('id', 'desc')->get();
        return view('countries.index', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = new Country();
        return view('countries.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        Country::create(['name' => $request->name, 'active' => $request->active]);
        return redirect()->route('countries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Country::find($id);
        return view('countries.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Country::find($id);
        $data->update(['name' => $data->name, 'active' => $data->active]);
        return view('countries.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data['name'] = $request->name;
        $data['active'] = $request->active;
        Country::where('id', $id)->update($data);
        return redirect()->route('countries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Country::destroy($id);
        return redirect()->route('countries.index');
    }
}
