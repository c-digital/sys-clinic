@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{__('Consultations')}}
@endsection

@push('css-page')
    <style>
        .modal-dialog {
            background-color: white;
        }
    </style>
@endpush

@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create customer')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="/consultations/create"class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> {{__('Create')}}
                </a>
            </div>
        @endcan
    </div>
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
                                <th>{{__('Professional')}}</th>
                                <th>{{__('Datetime')}}</th>
                                <th>{{__('Status')}}</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($consultations as $consultation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $consultation->customer->name }}</td>
                                        <td>{{ $consultation->user->name }}</td>
                                        <td>{{ $consultation->datetime }}</td>
                                        <td>{{ $consultation->status }}</td>
                                        <td nowrap>
                                            <a href="{{ route('consultations.show', $consultation->id) }}" class="edit-icon bg-success">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ route('consultations.edit', $consultation->id) }}" class="edit-icon">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $consultation->id}}').submit();">
                                                    <i class="fas fa-trash"></i>
                                                </a>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['consultations.destroy', $consultation->id],'id'=>'delete-form-'.$consultation->id]) !!}
                                            {!! Form::close() !!}
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
