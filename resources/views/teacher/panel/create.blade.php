@extends('layouts.theme')

@section('main_content')
    <div class="w-75 mx-auto">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create new Panel</h3>
            </div>
            <div class="">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <form action="{{ route('panel.store') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Panel Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Panel Name">
                    </div>
                    <div class="form-group">
                        <label for="description">Panel Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Panel Description">
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
