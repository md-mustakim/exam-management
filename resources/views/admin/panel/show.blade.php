@extends('layouts.theme')

@section('main_content')
    <div class="">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>{{ $panel->name }} [{{ $panel->code }}]</th>
            </tr>
            <tr>
                <th>Description</th>
                <th>{{ $panel->description }}</th>
            </tr>
            <tr>
                <th>Member</th>
                <th>{{ $panel->member->count() }}</th>
            </tr>
            <tr>
                <th>File</th>
                <th>{{ $panel->course->count() }}</th>
            </tr>
        </table>
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered">
                    @if($courses->count() >0)
                        @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>{{ $course->file }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td class="alert-danger">No Course Found</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
