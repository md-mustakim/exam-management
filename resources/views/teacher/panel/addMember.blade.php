@extends('layouts.theme')

@section('main_content')
    <div class="">
        <div class="">
            @if(Session::has('message'))
                <div class="">
                    {{ Session::get('message') }}
                </div>
            @endif
        </div>
        <form method="post" action="{{ route('panel.member.store', $panel->id) }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="teacher_id">Teacher Id</label>
                    @if(count($teachers) === 0)
                        <select name="" id="" disabled>
                            <option value=""> No Member available to add </option>
                        </select>
                    @else
                        <select name="teacher_id" id="teacher_id">
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}"> {{ $teacher->name }} </option>
                        @endforeach
                        </select>
                    @endif
                </div>
            </div>
            <!-- /.card-body -->
            @if(count($teachers) === 0)
            <div class="card-footer">
                <button class="btn btn-primary" disabled>Submit</button>
            </div>
            @else
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            @endif
        </form>
    </div>
@endsection
