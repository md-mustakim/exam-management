@extends('layouts.theme')

@section('page_title')
    Dashboard
@endsection

@section('page_index')
    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
@endsection

@section('main_content')
    <!-- Small boxes (Stat box) -->
<!--    <div class="row">
        <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>

                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        &lt;!&ndash; ./col &ndash;&gt;
        <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                    <p>Bounce Rate</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        &lt;!&ndash; ./col &ndash;&gt;
        <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>44</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        &lt;!&ndash; ./col &ndash;&gt;
        <div class="col-lg-3 col-6">
            &lt;!&ndash; small box &ndash;&gt;
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>65</h3>

                    <p>Unique Visitors</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        &lt;!&ndash; ./col &ndash;&gt;
    </div>-->
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h2 font-weight-bold">
                                Your Panel List
                            </span>
                            <a href="{{ route('panel.create') }}" class="">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Teacher</th>
                                <th>Panel Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Start From</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($panels  as $panel)
                                <tr>
                                    <td>{{ $panel->id }}</td>
                                    <td>
                                        <a href="{{ route('panel.teacher.show', $panel->teacher->id) }}" class="">
                                            {{ $panel->teacher->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.show', $panel->id) }}" class="">
                                            {{ $panel->name }}
                                        </a>
                                    </td>
                                    <td>{{ $panel->code }}</td>
                                    <td>{{ $panel->description }}</td>
                                    <td title="{{ Carbon\Carbon::parse($panel->created_at)->format('D d-M-Y h:i:s a') }}"
                                    >{{ Carbon\Carbon::parse($panel->created_at)->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Member of Panel
                    </div>
                        <div class="card-body">
                            @if($memberOfPanel->count() ===0)
                                <h4>You are no member of any panel</h4>
                            @else
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>id</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($memberOfPanel as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                </div>
            </div>
        <!-- right col -->
    </div>
    <!-- /.row (main row) -->
@endsection
