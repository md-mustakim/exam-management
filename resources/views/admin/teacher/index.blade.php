@extends('layouts.theme')

@section('main_content')
    <div class="">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @if ($teachers->count() === 0)
                    @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->phone }}</td>
                        <td>{{ $teacher->designation }}</td>
                        <td>{{ $teacher->admin->name }}</td>
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
