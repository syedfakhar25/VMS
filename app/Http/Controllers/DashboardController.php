<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Psr\Log\NullLogger;

class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        if($user->user_type == 'admin'){
            $vehicles = Vehicle::all();
            $total_vehicles = $vehicles->count();
            $on_road = Vehicle::where('status', 'On road')->get();
            $off_road = Vehicle::where('status', 'off road')->get();
            $on_road = $on_road->count();
            $off_road = $off_road->count();
            $total_departments = Department::all();
            $total_departments = $total_departments->count();

            //body_types
            $cars = Vehicle::where('body_type', 'CAR')->get();
            $jeeps = Vehicle::where('body_type', 'JEEP')->get();
            $bikes = Vehicle::where('body_type', 'MOTOR CYCLE')->get();
            $pickup = Vehicle::where('body_type', 'PICKUP')->get();
            $tractor = Vehicle::where('body_type', 'TRACTOR')->get();
            $bus = Vehicle::where('body_type', 'BUS')->get();
            $mini_bus = Vehicle::where('body_type', 'MINI BUS')->get();

            //year
            $less_than_2000 = Vehicle::where('model' ,'<', '2000')->get();
            $less_than_2010 = Vehicle::where('model' ,'>=', '2000')->where('model', '<', '2010' )->get();
            $greater_than_2010 = Vehicle::where('model' ,'>=', '2010')->get();


            //vehicles condition
            $vehicles_condition=DB::table('vehicles')
                ->select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->where('status', '!=', NULL)
                ->where('status', '!=', 'Loss')
                ->get();
            //dd($vehicles_condition);


            return view('admin.dashboard')->with([
                'total_vehicles' => $total_vehicles,
                'total_departments' => $total_departments,
                'on_road' => $on_road,
                'off_road' => $off_road,
                'cars' => $cars->count(),
                'jeeps'=> $jeeps->count(),
                'bikes'=> $bikes->count(),
                'pickup'=> $pickup->count(),
                'tractor'=> $tractor->count(),
                'bus'=> $bus->count(),
                'mini_bus'=> $mini_bus->count(),
                'less_than_2000'=> $less_than_2000->count(),
                'less_than_2010'=> $less_than_2010->count(),
                'greater_than_2010'=> $greater_than_2010->count(),
                'vehicles_condition' => $vehicles_condition
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
