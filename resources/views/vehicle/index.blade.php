
@extends('template.master')
@section('title')
    Manage Vehicles
@endsection

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicles
                <a href="{{route('vehicle.create')}}" type="button" class="btn btn-success">
                    &nbsp; <i class="fa fa-plus-esscircle"></i>&nbsp;Add
                </a>
            </h6>
            <hr width="100%">
            <form action="" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2">
                        <input type="search" name="reg_no" placeholder="Registraton No" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input type="search" name="chassis_no" placeholder="Chassis No" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <select class="form-control" name="department_id">
                            @if(Auth::user()->user_type == 'admin')
                                <option>Department</option>
                                @foreach($departments as $dep)
                                    <option value="{{$dep->id}}">{{$dep->dep_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    {{--<div class="col-md-2">
                        <select class="form-control" name="status">
                            @if(Auth::user()->user_type == 'admin')
                                <option>Status</option>
                                <option value="offroad">Off Road</option>
                                <option value="onroad">On Road</option>
                            @endif
                        </select>
                    </div>--}}
                    <div class="col-md-2">
                        <input type="search" name="body_type" placeholder="Body Type" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    <div class="col-md-2">
                        Total: {{$count_vehicle}}
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-primary" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="vehicleTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>S #</th>
                        <th>Reg No.</th>
                        <th>Department</th>
                        <th>Body Type</th>
                        <th>Status</th>
                        <th>Engine Power</th>
                        <th>Model</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count =1 ;?>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td>{{$count++}}</td>
                            <td>{{$vehicle->reg_no}}</td>
                            <td>{{$vehicle->dep_name}}</td>
                            <td>{{$vehicle->body_type}}</td>
                            <td>{{$vehicle->status}}</td>
                            <td>{{$vehicle->engine_power}} @if($vehicle->engine_power !=NULL)&nbsp; cc @endif</td>
                            <td>{{$vehicle->model}}</td>
                            <td colspan="2">
                                <a href="{{route('vehicle.show', $vehicle->id)}}"><i class="fas fa-eye " style="color: darkturquoise"></i></a>
                                <a href="{{route('vehicle.edit', $vehicle->id)}}"><i class="fas fa-edit" style="color: blue"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $vehicles->withQueryString()->links() }}
            </div>
            {{--<div class="row">
                <div class="col-md-12">{{ $vehicles->links() }}
                </div>
            </div>--}}
        </div>
    </div>

@endsection


