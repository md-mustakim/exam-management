@extends('layouts.theme')

@section('page_title')
    Panel List
@endsection

@section('main_content')

    <div class="">
        <div class="">
            <a href="{{ route('panel.create') }}" class="btn btn-success float-right m-3">Create Panel</a>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Code</th>
                <th>Members</th>
                <th>Course</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @if (!empty($panels))
                @foreach ($panels as $panel)
                    <tr>
                        <td>{{ $panel->id }}</td>
                        <td>
                            <a href="{{ route('panel.show', $panel->id) }}" class="">
                                {{ $panel->name }}
                            </a>
                        </td>
                        <td>{{ $panel->code }}</td>
                        <td>{{ $panel->member->count() }}</td>
                        <td>{{ $panel->course->count() }}</td>
                        <td>{{ $panel->description }}</td>

                    </tr>
                @endforeach
            @else

                <tr>
                    <td colspan="3">No Data found</td>
                </tr>

            @endif
            </tbody>
        </table>

    </div>
@endsection
