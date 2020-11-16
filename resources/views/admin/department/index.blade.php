@extends('layouts.admin-app')
@section('content')
<div class="layout-px-spacing">
    <div class="container">
        <div class="container">
            <div class="row layout-top-spacing mb4">
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-link active" href="{{route('department.create')}}">Create New Department</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row layout-top-spacing">
                <div id="tableHover" class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Department List</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-4">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($departments as $department)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$department->title}}</td>
                                            <td>{{$department->description}}</td>
                                            <td class="text-center">
                                                <a href="{{ route('department.destroy', [$department->id])}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="widget-content widget-content-area">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <blockquote class="blockquote">
                                                        <p class="d-inline">No Department Created yet, Please use the link below to add a Department</p>
                                                            <a class="btn btn-link" href="{{ route('department.create') }}">
                                                                <small><cite title="Create Department">Create  Department</cite></small>
                                                            </a>
                                                        </blockquote>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
