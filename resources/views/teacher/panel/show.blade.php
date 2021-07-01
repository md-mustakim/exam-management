@extends('layouts.theme')

@section('page_title')
    Panel {{ $panel->name }}
@endsection

@section('page_index')
    <li class="breadcrumb-item">
        <a href="{{ route('panel.dashboard') }}">Home</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('panel.index') }}">Panel List</a>
    </li>
    <li class="breadcrumb-item active">Panel</li>
@endsection

@section('main_content')
    <div class="">
        <div class="row m-0 p-0">
            <div class="col-md-6">
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
                        <th>
                            {{ $panel->member->count() }}
                        </th>
                    </tr>
                    <tr>
                        <th>File</th>
                        <th>{{ $panel->course->count() }}</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center bg-light my-2">
                    <div class="h3 font-weight-bold">
                        Member List
                    </div>
                    <a href="{{ route('panel.add.member', $panel->id) }}" class="">
                        <i class="fa fa-user-plus"></i>
                    </a>
                </div>
                <table class="table table-bordered">
                    @foreach($members as $member)
                        <tr>
                            <td>
                                <a href="{{ route('panel.teacher.show', $member->teacher->id) }}" class="">
                                    {{ $member->teacher->name }}
                                </a>
                            </td>
                            <td>{{ $member->teacher->id }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
           <div class="col-md-4">
               <div class="card card-primary">
                   <div class="card-header">
                       <h3 class="card-title">Upload Result File</h3>
                   </div>
                   <div class="">
                       @if(Session::has('message'))
                        <div class="alert alert-success">
                            {{ Session::get('message') }}
                        </div>
                       @endif
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
                   <form method="post" action="{{ route('panel.panelCourse.store',$panel->id) }}" enctype="multipart/form-data">
                       @csrf
                       <div class="card-body">
                           <div class="form-group">
                               <label for="name">Name</label>
                               <input type="text" class="form-control" id="name"  name="name" placeholder="Enter email">
                           </div>
                           <div class="form-group">
                               <label for="description">description</label>
                               <input type="text" class="form-control" id="description"  name="description" placeholder="description">
                           </div>
                           <div class="form-group">
                               <label for="file">File input</label>
                               <div class="input-group">
                                   <div class="custom-file">
                                       <input type="file" class="custom-file-input" id="file" name="file">
                                       <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                   </div>
                                   <div class="input-group-append">
                                       <span class="input-group-text">Upload</span>
                                   </div>
                               </div>
                           </div>
                           <div class="form-check">
                               <input type="checkbox" class="form-check-input" id="exampleCheck1">
                               <label class="form-check-label" for="exampleCheck1">Check me out</label>
                           </div>
                       </div>
                       <!-- /.card-body -->

                       <div class="card-footer">
                           <button type="submit" class="btn btn-primary">Submit</button>
                       </div>
                   </form>
               </div>
           </div>
           <div class="col-md-8">
               <table class="table table-bordered">
                   <thead>
                   <tr>
                       <th>#</th>
                       <th>Name</th>
                       <th>Description</th>
                       <th>Upload By</th>
                       <th>Verify By</th>
                       <th colspan="3">Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   @if($courses->count() >0)
                       @php
                           $count = 0;
                       @endphp
                       @foreach($courses as $course)
                           @php $count++; @endphp
                           <tr>
                               <td>{{ $count }}</td>
                               <td>{{ $course->name }}</td>
                               <td>{{ $course->description }}</td>
                               <td>{{ $course->teacher->name }}</td>
                               <td title="@foreach($course->verifyBy as $t) {{ $t->teacher->name }}, @endforeach">{{ $course->verifyBy->count() }} Teacher</td>
                                <td>
                                    <a href="{{ route('panel.file.verify.create', [$panel->id, $course->id]) }}" class="">
                                        verify
                                    </a>
                                </td>
                               <td>
                                   <a href="{{ route('panel.panelCourse.download', $course->id) }}" class="">
                                       <i class="fa fa-download"></i>
                                   </a>
                               </td>
                               <td>
                                   <a href="{{ route('panel.panelCourse.destroy',  $course->id) }}" class="">
                                       <i class="fa fa-trash"></i>
                                   </a>
                               </td>
                           </tr>
                       @endforeach
                   @else
                       <tr>
                           <td colspan="5" class="text-center">No Course Found</td>
                       </tr>
                   @endif
                   </tbody>
               </table>
           </div>
        </div>
    </div>
@endsection
