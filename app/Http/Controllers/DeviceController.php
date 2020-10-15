<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDevice;
use App\Http\Requests\UpdateDevice;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('device.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('device.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDevice $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDevice $request)
    {
        $device = Device::make($request->validated());
        $device->user_id = auth()->user()->id;
        $device->save();
        return redirect(route('device.show', ['device' => $device]))->with('status', 'Nouvel appareil enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\Response
     */
    public function show(Device $device)
    {
        return view('device.show', ['device' => $device]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Device $device)
    {
        return view('device.form.edit', ['device' => $device]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevice $request, Device $device)
    {
        $device->update($request->validated());
        return redirect(route('device.show', ['device' => $device]))->with('status', 'Appareil mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Device $device)
    {
        $device->delete();
        return redirect('/')->with('status', 'Appareil supprimé !');
    }
}
