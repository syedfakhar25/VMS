
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

        <!--  -->
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

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">

                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                <a href="{{route('vehicle.index')}}">On Road</a>
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

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                <a href="{{route('vehicle.index')}}">Off Road</a></div>
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

    {{-- Bar chart vehicle by their condition --}}
    <div class="row">
        <div class="col-md-12" align="center">
            <b> <h6><em>Vehicles by their Condition</em></h6></b>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" align="center">
            <canvas id="barChart" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
    <div class="row" align="center">
        <style>
            .statusCard{
                border-radius: 50px 20px;
            }

        </style>
        <div class="col-md-1"></div>
        @foreach($vehicles_condition as $i)
            <div class="col-md-2">
                <div class="statusCard card border-info mx-sm-1 p-3">
                    <div class="text-info text-center mt-3">
                        <a href="{{URL::route('vehicle.index', ['status' => $i->status])}}"> <h6><b>{{$i->status}}</b></h6></a>
                    </div>
                    <div class="text-info text-center mt-2"><h1>{{$i->total}}</h1></div>
                </div>
            </div>
        @endforeach
        <div class="col-md-1"></div>
    </div>

   {{-- vehicle body type graph--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <div class="row">
        <hr width="100%">
        <div class="col-md-6">
            <canvas id="horizontalBar"></canvas>
        </div>
        <div class="col-md-6" align="center">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
        </div>
    </div>
    <div class="row" align="center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <canvas id="yearGraph" ></canvas>
        </div>
        <div class="col-md-3"></div>
    </div>

    <script>
        var xValues = ["CAR", "JEEP", "BIKE", "PICK UP", "TRACTOR", "BUS", "MINI BUS"];
        var yValues = [{{$cars}}, {{$jeeps}}, {{$bikes}}, {{$pickup}}, {{$tractor}},{{$bus}}, {{$mini_bus}}];
        var barColors = [
            "#cc99ff",
            "#66ff99",
            "#6699ff",
            "#ffcc66",
            "#999966",
            "#9933ff",
            "#ffb3b3"
        ];

        var myChart= new Chart("myChart", {
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

        document.getElementById("myChart").onclick = function(evt){
            var activePoints = myChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = myChart.data.labels[firstPoint._index];
            var value = myChart.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            if (firstPoint !== undefined)
                //alert(label + ": " + value);
                window.location.href= "{{route('vehicle.index')}}?body_type="+label;
        };
    </script>


    {{--vehicle yearly graph model wise--}}


    <script>
        var xValues = ['< 2000', '< 2010', '> 2010'];
        var yValues = [{{$less_than_2000}},{{$less_than_2010}},{{$greater_than_2010}}];
        var barColors = [
            "#ffd633",
            "#66b3ff",
            "#33ff33",
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

    <script>
        var xValues =  [
                @foreach ($vehicles_condition as $i)
            [ "{{ $i->status }}  " ,  ],
            @endforeach
        ];
       // var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
        var yValues = [@foreach($vehicles_condition as $i) "{{$i->total}}",@endforeach];
        var barColors = ["#cc99ff", "#999966","#9933ff", "#6699ff",  "#ffcc66",  '#66ff99',  "#ffb3b3"];

        var barChart = new Chart("barChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    //text: "Vehicles by their Condition"
                }
            }
        });

        document.getElementById("barChart").onclick = function(evt){
            var activePoints =barChart.getElementsAtEvent(evt);
            var firstPoint = activePoints[0];
            var label = barChart.data.labels[firstPoint._index];
            var value = barChart.data.datasets[firstPoint._datasetIndex].data[firstPoint._index];
            if (firstPoint !== undefined)
                //alert(label + ": " + value);
               window.location.href= "http://localhost:8000/vehicle?status="+label;
        };
    </script>

    {{--horizontal bar chart for vehicle engine power--}}
    <script>
        new Chart(document.getElementById("horizontalBar"), {
            "type": "horizontalBar",
            "data": {
                "labels": ["< 1300", "< 1600", "< 1800", "< 3000", "> 3000"],
                "datasets": [{
                    "label": "Vehicles by Engine Power",
                    "data": [{{$engine_power_less_1600}}, {{$engine_power_less_1300}}, {{$engine_power_less_1600}}, {{$engine_power_less_1800}}, {{$engine_power_less_3000}},],
                    "fill": false,
                    "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                        "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
                        "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                    ],
                    "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                        "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                    ],
                    "borderWidth": 0.5
                }]
            },
            "options": {
                "scales": {
                    "xAxes": [{
                        "ticks": {
                            "beginAtZero": true
                        }
                    }]
                }
            }
        });
    </script>

@endsection
