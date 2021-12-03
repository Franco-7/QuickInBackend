<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\VehicleStatus;

use Illuminate\Support\Facades\DB;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Trip::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'destination'=>'required',
            'date'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'reason'=>'required',
            'vehicle_id'=>'required',
            'employee_number'=>'required'
        ]);

        $query = DB::table('trips')->insert([
            'destination'=>$request->input('destination'),
            'date'=>$request->input('date'),
            'start_time'=>$request->input('start_time'),
            'end_time'=>$request->input('end_time'),
            'reason'=>$request->input('reason'),
            'vehicle_id'=>$request->input('vehicle_id'),
            'employee_number'=>$request->input('employee_number')
        ]);

        if ($query) {
            return response()->json([
                'status'=>200,
                'message'=>'Trip inserted seccesfully'
            ]);
        } else {
            return response()->json([
                'validation_errors'=>$query->messages(),
            ]);
        }
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
        return Trip::findOrFail($id);
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
    public function update(Request $request)
    {
        //
        $data = Trip::find($request->trip_id);

        if ($data === null) {
            return response()->json([
                'message'=>'Data is null'
            ]);
        }
        elseif ($request->status === 3) {
            $data->status = $request->status;
            $data->save();

            DB::table('vehicle_statuses')->insert([
                'trip_id'=>$request->trip_id,
                'vehicle_id'=>$request->vehicle_id
            ]);
        }
        elseif ($request->status === 4) {
            $data->status = $request->status;
            $data->save();

            $status_data = VehicleStatus::find($request->status_id);
            $kilometres = rand(10,20);

            $status_data->kilometres = $kilometres;
            $status_data->fuel_used = $kilometres * 0.125;
            $status_data->save();
        } else {
            $data->destination = $request->destination;
            $data->status = $request->status;
            $data->date = $request->date;
            $data->start_time = $request->start_time;
            $data->end_time = $request->end_time;
            $data->reason = $request->reason;
            $data->save();
        }
        
        if ($data) {
            return response()->json([
                'status'=>200,
                'message'=>'Trip updated seccesfully'
            ]);
        } else {
            return response()->json([
                'validation_errors'=>$query->messages(),
            ]);
        }
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
        $trip = Trip::findOrFail($id);
        $trip->delete();
    }
    
    public function start_trip(Request $request)
    {
        //
        $data = Trip::find($request->trip_id);
        
        $data->status = $request->status;
        $data->save();

        $kilometres = rand(10,20);
        DB::table('vehicle_statuses')->insert([
            'trip_id'=>$request->trip_id,
            'vehicle_id'=>$request->vehicle_id,
            'kilometres'=>$kilometres,
            'fuel_used'=>$kilometres * 0.125,
        ]);

        if ($data) {
            return response()->json([
                'status'=>200,
                'message'=>'Trip started seccesfully'
            ]);
        } else {
            return response()->json([
                'validation_errors'=>$query->messages(),
            ]);
        }

    }
}
