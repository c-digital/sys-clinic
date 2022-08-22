@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{__('Sessions')}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Customer')}}</th>
                                <th>{{__('Service')}}</th>
                                <th>{{__('Status')}}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($sessions as $session)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $session->customer->name }}</td>
                                        <td>{{ $session->service->name }}</td>
                                        <td>{{ $session->status }}</td>
                                        <td nowrap>
                                            <a href="{{ route('sessions.update', $sessions->id) }}" class="edit-icon bg-success">
                                                <i class="fas fa-check"></i> Realizar sesión
                                            </a>

                                            <a href="" class="edit-icon">
                                                <i class="fas fa-eye"></i> Info
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
