<?php

namespace App\Http\Controllers;

use App\Models\VehicleStatus;
use Illuminate\Http\Request;

class VehicleStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return VehicleStatus::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return VehicleStatus::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleStatus $vehicleStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VehicleStatus  $vehicleStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleStatus $vehicleStatus)
    {
        //
    }
}
