<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePAN;
use App\Http\Requests\UpdatePAN;
use App\Models\PAN;
use Illuminate\Http\Request;

class PANController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pan.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePAN $request)
    {
        $pan = PAN::make($request->validated());
        $pan->user_id = auth()->user()->id;
        $pan->save();
        return redirect(route('pan.show', ['pan' => $pan]));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PAN $pan
     * @return \Illuminate\Http\Response
     */
    public function show(PAN $pan)
    {
        return view('pan.show', ['pan' => $pan]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PAN $pan
     * @return \Illuminate\Http\Response
     */
    public function edit(PAN $pan)
    {
        return view('pan.form.edit', ['pan' => $pan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PAN $pan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePAN $request, PAN $pan)
    {
        $pan->update($request->validated());
        return redirect(route('pan.show', ['pan' => $pan]))->with('status', 'PAN mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PAN $pan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PAN $pan)
    {
        $pan->delete();
        return redirect('home')->with('status', 'PAN supprimé !');
    }
}
