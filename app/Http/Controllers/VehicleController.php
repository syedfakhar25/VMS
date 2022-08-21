<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Termwind\ValueObjects\w;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user= Auth::user();
        if($user->user_type == 'admin'){
           if(isset($request->reg_no) || isset($request->department_id)|| isset($request->chassis_no) || isset($request->status)|| isset($request->body_type)){
               $vehicles = DB::table('vehicles')
                   ->join('departments', 'vehicles.department_id', '=', 'departments.id')
                  ->where('vehicles.reg_no', $request->reg_no )
                  ->orWhere('vehicles.chassis_no', $request->chassis_no )
                  ->orWhere('vehicles.status', $request->status )
                  ->orWhere('vehicles.body_type', $request->body_type )
                   ->orWhere('departments.id', $request->department_id)
                   ->get();
           }
           else{
               // $vehicles = Vehicle::with('department')->get();
               $vehicles = DB::table('vehicles')
                   /*->join('departments', 'vehicles.department_id', '=', 'departments.id')*/
                   ->get();
           }

            $departments = Department::all();
            return view('vehicle.index')->with([
                'vehicles' => $vehicles,
                'count_vehicle' => $vehicles->count(),
                'departments'=> $departments
            ]);
        }
        elseif ($user->user_type == 'department_admin'){
            $department = Department::where('user_id' , $user->id)->first();
            $vehicles = Vehicle::where('department_id', $department->id)->get();
            return view('vehicle.index')->with([
                'vehicles' => $vehicles,
                'count_vehicle' => $vehicles->count(),
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $user= Auth::user();
        $user_department = Null;
        if($user->user_type == 'department_admin')
            $user_department = Department::where('user_id', $user->id)->first();
        return view('vehicle.create')->with([
            'departments' => $departments,
            'user_department' =>$user_department
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = new Vehicle();
        $vehicle->reg_no =$request->reg_no ;
        $vehicle->department_id =$request->department_id ;
        $vehicle->allotee =$request->allotee ;
        $vehicle->maker =$request->maker ;
        $vehicle->body_type =$request->body_type ;
        $vehicle->vehicle_type =$request->vehicle_type ;
        $vehicle->model =$request->model;
        $vehicle->engine_power =$request->engine_power ;
        $vehicle->colour =$request->colour ;
        $vehicle->engine_no =$request->engine_no ;
        $vehicle->chassis_no =$request->chassis_no ;
        $vehicle->type =$request->type ;
        $vehicle->allotted_by =$request->allotted_by ;
        $vehicle->purchase_type =$request->purchase_type ;
        $vehicle->meter_reading =$request->meter_reading ;
        $vehicle->fuel_average =$request->fuel_average ;
        $vehicle->prev_reg_no =$request->prev_reg_no ;
        $vehicle->status =$request->status ;

        $vehicle->save();
        return  redirect()->route('vehicle.index')->with([
            'success' => 'Vehicle Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicle.show' )->with([
            'vehicle'=>$vehicle]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        $departments = Department::all();
        $user= Auth::user();
        $user_department = Null;
        if($user->user_type == 'department_admin')
            $user_department = Department::where('user_id', $user->id)->first();
        return view('vehicle.edit')->with([
            'vehicle' => $vehicle,
            'departments' => $departments,
            'user_department' =>$user_department
        ]);
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
        $vehicle = Vehicle::find($id);
        $vehicle->reg_no =$request->reg_no ;
        $vehicle->department_id =$request->department_id ;
        $vehicle->allotee =$request->allotee ;
        $vehicle->maker =$request->maker ;
        $vehicle->body_type =$request->body_type ;
        $vehicle->vehicle_type =$request->vehicle_type ;
        $vehicle->model =$request->model;
        $vehicle->engine_power =$request->engine_power ;
        $vehicle->colour =$request->colour ;
        $vehicle->engine_no =$request->engine_no ;
        $vehicle->chassis_no =$request->chassis_no ;
        $vehicle->type =$request->type ;
        $vehicle->allotted_by =$request->allotted_by ;
        $vehicle->purchase_type =$request->purchase_type ;
        $vehicle->meter_reading =$request->meter_reading ;
        $vehicle->fuel_average =$request->fuel_average ;
        $vehicle->prev_reg_no =$request->prev_reg_no ;
        $vehicle->status =$request->status ;

        $vehicle->update();
        return  redirect()->route('vehicle.index')->with([
            'success' => 'Vehicle Updated Successfully'
        ]);
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
    }
}
