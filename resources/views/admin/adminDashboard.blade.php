@extends('layouts.theme')

@section('page_title')
    Dashboard
@endsection

@section('page_index')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
<!--
    <li class="breadcrumb-item active">Dashboard v1</li>
    <li class="breadcrumb-item active">Dashboard v2</li>-->
@endsection

@section('main_content')
    <div class="row m-0 p-0">
        <div class="col-lg-6 col-3">
            <div class="card">
                <div class="card-header">
                    Teacher List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Designation</th>
                            <th>Registered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->designation }}</td>
                                <td title="{{ Carbon\Carbon::parse($teacher->created_at)->format('D d-m-y h:i:s a') }}"
                                >{{ Carbon\Carbon::parse($teacher->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-3">
            <div class="card">
                <div class="card-header">
                    Panel List
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td>id</td>
                            <td>name</td>
                            <td>member</td>
                            <td>file</td>
                            <td>Admin</td>
                            <td>Create at</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($panels as $panel)
                            <tr>
                                <td>{{ $panel->id }}</td>
                                <td>{{ $panel->name }}</td>
                                <td>{{ $panel->member->count() }}</td>
                                <td>{{ $panel->course->count() }}</td>
                                <td>{{ $panel->teacher->name }}</td>
                                <td title="{{ Carbon\Carbon::parse($teacher->created_at)->format('D d-m-y h:i:s a') }}"
                                >{{ Carbon\Carbon::parse($teacher->created_at)->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
