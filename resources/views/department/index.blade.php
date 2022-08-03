
@extends('template.master')
@section('title')
    Manage Departments
@endsection

@section('content')
    <div class="card shadow mb-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Departments
                <!-- Button trigger modal -->&nbsp;
                <a type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    &nbsp; <i class="fa fa-plus-circle"></i>&nbsp;Add new
                </a>

            </h6>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('department.store')}}" enctype="multipart/form-data">
                                @method('POST')
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Department Name</label>
                                        <input type="text" name="dep_name" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Focal Person</label>
                                        <input type="text" name="focal_person" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Email</label>
                                        <input type="email" name="email" class="form-control"  required/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="customFile">Phone #</label>
                                        <input type="text" name="phone" class="form-control"  required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr width="100%">
                                </div>
                                <div class="row">
                                    <button class="btn btn-success" type="submit">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="vehicleTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>S #</th>
                        <th>Name</th>
                        <th>Focal Person</th>
                        {{--<th>Email</th>--}}
                        <th>Phone #</th>
                       {{-- <th>Details</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    <?php $count=1;?>
                    @foreach($departments as $dep)
                        <tr>
                        <td>{{$count++}}</td>
                        <td>{{$dep->dep_name}}</td>
                        <td>{{$dep->focal_person}}</td>
                        {{--<td>{{$dep->users()->id}}</td>--}}
                        <td>{{$dep->phone}}</td>
                       {{-- <td>..</td>--}}
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


