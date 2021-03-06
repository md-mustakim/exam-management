@extends('layouts.theme')

@section('page_title')
    Teacher List
@endsection

@section('main_content')
    <div class="">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>PHone</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($teachers))
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->designation }}</td>
                    </tr>
                    @endforeach
                @else

                <tr>
                    <td colspan="6">No Data found</td>
                </tr>

                @endif
            </tbody>
        </table>

    </div>
@endsection
