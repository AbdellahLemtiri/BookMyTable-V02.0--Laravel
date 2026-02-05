<?php

namespace App\Http\Controllers;

use App\Models\Horaire;
use App\Http\Requests\StoreHoraireRequest;
use App\Http\Requests\UpdateHoraireRequest;

class HoraireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('horaires.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHoraireRequest $request)
    {
        $validated = $request->validated();
        $horaire = Horaire::create($validated);
        return view('menus.create', compact('horaire'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Horaire $horaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horaire $horaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHoraireRequest $request, Horaire $horaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horaire $horaire)
    {
        //
    }
}
 