@extends('layouts.admin')

@php
    $profile=asset(Storage::url('uploads/avatar/'));
@endphp

@section('page-title')
    {{__('Sessions')}}
@endsection

@push('css-page')
    <style>
        .modal-dialog {
            background-color: white;
        }
    </style>
@endpush

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
                                        <td>
                                            @if (count($session->made) != $session->quantity)
                                                <a data-toggle="modal" data-target="#made_{{ $session->id }}" href="#" class="edit-icon bg-success">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endif

                                            <a data-toggle="modal" data-target="#info_{{ $session->id }}" href="#" class="edit-icon">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal" id="made_{{ $session->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ __('Made session') }}</h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="/sessions/{{ $session->id }}" method="POST">
                                                    @method('PUT')
                                                    @csrf

                                                    <div class="modal-body p-3">
                                                        <p>{{ __('Are you sure?') }}</p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                                                        <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal" id="info_{{ $session->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Info</h5>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <p>{{ __('Customer') }}: {{ $session->customer->name }}</p>
                                                    <p>{{ __('Invoice number') }}: {{ auth()->user()->invoiceNumberFormat($session->invoice_id) }}</p>
                                                    <p>{{ __('Service') }}: {{ $session->service->name }}</p>
                                                    <p>{{ __('Quantity') }}: {{ $session->quantity }}</p>

                                                    <hr>

                                                    <p><b>Sesiones realizadas</b></p>

                                                    <div class="row">
                                                        <div class="col">#</div>
                                                        <div class="col">{{ __('Date') }}</div>
                                                        <div class="col">{{ __('User') }}</div>
                                                    </div>

                                                    @foreach($session->made as $made)
                                                        <div class="row">
                                                            <div class="col">{{ $loop->iteration }}</div>
                                                            <div class="col">{{ $made['datetime'] }}</div>
                                                            <div class="col">{{ $made['user'] }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
