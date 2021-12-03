<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // return User::findOrFail($id);

        $user = DB::table('users')
            ->select('users.*')
            ->where('users.employee_number', '=', $id)
            ->get();
        
        // Active trip
        $trip_a = DB::table('trips')
            ->where('status', '=', 3)
            ->orderBy('date', 'asc')
            ->limit(1)
            ->get();

        // Newest next trip
        $trip_n = DB::table('trips')
            ->where('employee_number', '=', $id)
            // ->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('status', '=', 2)
            // ->select('trips.*', 'vehicles.make', 'vehicles.model')
            ->orderBy('date', 'asc')
            ->limit(1)
            ->get();
        
        // Newest pending trip
        $trip_p = DB::table('trips')
            ->where('employee_number', '=', $id)
            // ->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('status', '=', 1)
            // ->select('trips.*', 'vehicles.make', 'vehicles.model')
            ->orderBy('date', 'asc')
            ->limit(1)
            ->get();
        
        // Newest old trip
        $trip_o = DB::table('trips')
            ->where('employee_number', '=', $id)
            ->join('vehicle_statuses', 'trips.trip_id', '=', 'vehicle_statuses.trip_id')
            // ->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('status', '=', 4)
            ->select('trips.*', 'vehicle_statuses.kilometres', 'vehicle_statuses.fuel_used')
            // ->select('trips.*', 'vehicles.make', 'vehicles.model', 'vehicle_statuses.kilometres', 'vehicle_statuses.fuel_used')
            ->orderBy('date', 'asc')
            ->limit(1)
            ->get();

        $res['user'] = $user;
        $res['active_trip'] = $trip_a;
        $res['next_trip'] = $trip_n;
        $res['pending_trip'] = $trip_p;
        $res['old_trip'] = $trip_o;

        return $res;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();
    }
    
    public function getTrips(Request $request)
    {
        //
        if ($request->status === 'viewRequests') {
            $trip = DB::table('trips')
                ->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id')
                ->where('status', '=', 1)
                ->select('trips.*', 'vehicles.make', 'vehicles.model')
                ->orderBy('date', 'asc')
                ->get();
        } else {
            $trip = DB::table('trips')
                ->join('vehicles', 'trips.vehicle_id', '=', 'vehicles.vehicle_id')
                ->where('employee_number', '=', $request->employee_number)
                ->where('status', '=', $request->status)
                ->select('trips.*', 'vehicles.make', 'vehicles.model')
                ->orderBy('date', 'asc')
                ->get();
        }

        return $trip;
    }
}
