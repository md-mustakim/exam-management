@extends('layouts.theme')

@section('main_content')
    <div class="">
        <table class="table table-bordered">
           <tbody>
           <tr>
               <td>{{ $course->teacher->name }}</td>
               <td>{{ $course->name }}</td>
               <td>{{ $course->description }}</td>
               <td>
                   <a href="{{ route('panel.panelCourse.download', $course->id) }}" class="">
                       <i class="fa fa-download"></i>
                   </a>
               </td>
               <td>
                   {{ Carbon\Carbon::parse($course->update_at)->format('d-M-y h:i:s a') }}
                   ({{ Carbon\Carbon::parse($course->update_at)->diffForHumans() }})
               </td>
               <td>
                   {{ Carbon\Carbon::parse($course->created_at)->format('d-M-y h:i:s a') }}
                   ({{ Carbon\Carbon::parse($course->created_at)->diffForHumans() }})
               </td>
           </tr>
           </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th colspan="3" class="text-center">Verified Teacher List</th>
            </tr>
            <tr>
                <th>Name</th>
                <th colspan="2">Time</th>
            </tr>
            </thead>

            @php $varified = false; @endphp
            @foreach($course->verifyBy as $a)
                @if(Auth::guard('teacher')->id() === $a->teacher->id)

                    @php $varified = true; @endphp
                @endif
                <tr>
                    <td>
                        <a href="{{ route('panel.teacher.show', $a->teacher->id) }}" class="">
                            {{$a->teacher->name}}
                        </a>
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($a->created_at)->format('d-M-Y h:m:s a') }}
                    </td>
                    <td>
                        {{ Carbon\Carbon::parse($a->created_at)->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="">
            @if(!$varified)
                <form action="{{ route('panel.file.verify.store', $panel->id) }}" method="POST">
                    <div class="">
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                {{ Session::get('message') }}
                            </div>
                        @endif
                    </div>
                    @csrf
                    <input type="hidden" name="teacher_id" value="{{ $course->teacher->id }}">
                    <input type="hidden" name="panel_course" value="{{ $course->id }}">

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-success">Make as Verified <i class="fa fa-circle-notch text-success"></i></button>
                    </div>
                </form>
            @else
                @if(Auth::guard('teacher')->check())
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-success">Verified <i class="fa fa-check-circle"></i></button>
                    </div>
                @endif
            @endif
            <div class="">
                <a href="{{ route('panel.show', $panel->id) }}" class="">Go Back</a>
            </div>
        </div>
    </div>
@endsection
