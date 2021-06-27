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
        <div class="">
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Upload Result File</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name"  name="name" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="password" class="form-control" id="description"  name="description" placeholder="description">
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
    </div>
@endsection
