<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->user_type == 'admin'){
            $vehicles = Vehicle::all();
            $total_vehicles = $vehicles->count();
            $on_road = Vehicle::where('status', 'onroad')->get();
            $off_road = Vehicle::where('status', 'offroad')->get();
            $on_road = $on_road->count();
            $off_road = $off_road->count();
            $total_departments = Department::all();
            $total_departments = $total_departments->count();
            $cars = Vehicle::where('body_type', 'CAR')->get();
            $jeeps = Vehicle::where('body_type', 'JEEP')->get();
            $bikes = Vehicle::where('body_type', 'MOTOR CYCLE')->get();
            $pickup = Vehicle::where('body_type', 'PICKUP')->get();
            return view('admin.dashboard')->with([
                'total_vehicles' => $total_vehicles,
                'total_departments' => $total_departments,
                'on_road' => $on_road,
                'off_road' => $off_road,
                'cars' => $cars->count(),
                'jeeps'=> $jeeps->count(),
                'bikes'=> $bikes->count(),
                'pickup'=> $pickup->count(),
            ]);
        }
        elseif ($user->user_type == 'department_admin'){
            $department = Department::where('user_id' , $user->id)->first();
            $vehicles = Vehicle::where('department_id', $department->id)->get();
            $total_vehicles = $vehicles->count();

            return view('department.dashboard')->with([
                'total_vehicles' => $total_vehicles,
            ]);
        }

    }
}
