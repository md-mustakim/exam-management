@extends('layouts.theme')

@push('headerCSSJs')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush



@section('main_content')
    <div class="">
        <table class="table table-sm table-bordered" id="dataTable">
            <thead>
            <tr>
                <th>Id</th>
                <th>Teacher</th>
                <th>Panel Name</th>
                <th>Panel Code</th>
                <th>Panel File</th>
                <th>Panel Member</th>
                <th>Panel Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($panels as $panel)
                <tr>
                    <td>{{ $panel->id }}</td>
                    <td>{{ $panel->teacher->name }}</td>
                    <td>
                        <a href="{{ route('admin.panel.show', $panel->id) }}" class="text-decoration-none">
                            {{ $panel->name }}
                        </a>
                    </td>
                    <td>{{ $panel->code }}</td>
                    <td>{{ $panel->course->count() }}</td>
                    <td>{{ $panel->panelMember->count() }}</td>
                    <td>{{ $panel->description }}</td>
                    <td>{{ $panel->crated_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

