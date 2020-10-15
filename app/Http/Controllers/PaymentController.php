<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePayment;
use App\Http\Requests\UpdatePayment;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('payment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('payment.form.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePayment $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayment $request)
    {
        $payment = Payment::make($request->validated());
        $payment->user_id = auth()->user()->id;
        $payment->save();
        return redirect(route('payment.show', ['payment' => $payment]))->with('status', 'Nouveau enregistré !');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return view('payment.show',['payment' => $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        return view('payment.form.edit', ['payment' => $payment]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePayment $request
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayment $request, Payment $payment)
    {
        $payment->update($request->validated());
        return redirect(route('payment.show', ['payment' => $payment]))->with('status', 'Paiement mis à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect('/')->with('status', 'Paiement supprimé !');
    }
}
