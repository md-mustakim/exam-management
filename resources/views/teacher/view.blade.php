@extends('layouts.theme')

@section('main_content')
    <div class="d-flex justify-content-center">
        <div class="card w-50">
            <div class="card-header">
                <div class="h3 text-info">
                    <i class="fa fa-user-alt"></i>
                    Teacher Profile
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $teacher->name }}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{ $teacher->phone }}</td>
                        </tr>
                        <tr>
                            <td>Designation</td>
                            <td>{{ $teacher->designation }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $teacher->email }}</td>
                        </tr>
                        <tr>
                            <td>Registered</td>
                            <td>{{ Carbon\Carbon::parse($teacher->created_at)->format('(h:i:s a) d-M-Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
