<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDigitizedCard;
use App\Http\Requests\UpdateDigitizedCard;
use App\Models\DigitizedCard;
use Illuminate\Http\Request;

class DigitizedCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('digitized_card.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('digitized_card.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDigitizedCard $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDigitizedCard $request)
    {
        $digitized_card = DigitizedCard::make($request->validated());
        $digitized_card->user_id = auth()->user()->id;
        $digitized_card->save();
        return redirect(route('digitized_card.show', ['digitized_card' => $digitized_card]))->with('status', 'Nouvelle carte digitalisée enregistrée !');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\DigitizedCard $digitized_card
     * @return \Illuminate\Http\Response
     */
    public function show(DigitizedCard $digitized_card)
    {
        return view('digitized_card.show', ['digitized_card' => $digitized_card]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\DigitizedCard $digitized_card
     * @return \Illuminate\Http\Response
     */
    public function edit(DigitizedCard $digitized_card)
    {
        return view('digitized_card.form.edit', ['digitized_card' => $digitized_card]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDigitizedCard $request
     * @param \App\Models\DigitizedCard $digitized_card
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDigitizedCard $request, DigitizedCard $digitized_card)
    {

        $digitized_card->update($request->validated());
        return redirect(route('digitized_card.show', ['digitized_card' => $digitized_card]))->with('status', 'Carte digitalisée mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\DigitizedCard $digitized_card
     * @return \Illuminate\Http\Response
     */
    public function destroy(DigitizedCard $digitized_card)
    {
        $digitized_card->delete();
        return redirect('home')->with('status', 'Carte Digitalisée supprimée !');
    }
}
