
@extends('template.master')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                               <a href="{{route('vehicle.index')}}">Total Vehicles</a> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_vehicles}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                <a href="{{route('department.index')}}">Departments</a> </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_departments}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-school fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">On Road
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$on_road}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-pickup fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Off Road</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$off_road}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck-moving fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   {{-- vehicle body type graph--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <div class="row">
        <div class="col-md-6" align="center">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
        <div class="col-md-6" align="center">
            <canvas id="yearGraph" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>


    <script>
        var xValues = ["CAR", "JEEP", "BIKE", "PICK UP", "TRACTOR", "BUS", "MINI BUS"];
        var yValues = [{{$cars}}, {{$jeeps}}, {{$bikes}}, {{$pickup}}, {{$tractor}},{{$bus}}, {{$mini_bus}}];
        var barColors = [
            "#ff3300",
            "#00cc00",
            "#0000cc",
            "#ff00ff",
            "#ffcc00",
            "#660033",
            "#f00045"
        ];

        new Chart("myChart", {
            type: "doughnut",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Vehicles by their Body Types"
                }
            }
        });
    </script>


    {{--vehicle yearly graph model wise--}}


    <script>
        var xValues = ['< 2000', '< 2010', '> 2010'];
        var yValues = [{{$less_than_2000}},{{$less_than_2010}},{{$greater_than_2010}}];
        var barColors = [
            "red",
            "blue",
            "green",
        ];

        new Chart("yearGraph", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "Vehicle Models"
                }
            }
        });
    </script>


@endsection
