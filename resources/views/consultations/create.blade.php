@extends('layouts.admin')

@section('page-title')
    {{__('Create consultation')}}
@endsection

@push('script-page')
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endpush

@section('content')
    <form action="/consultations" method="POST">
        @csrf

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img width="100%" src="https://sysclinic.net/storage/uploads/avatar/avatar.png" alt="">
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label for="customer_id">{{ __('Customer') }}</label>
                            <select name="customer_id" class="form-control select2" required>
                                <option value=""></option>

                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="professional_id">{{ __('Professional') }}</label>
                            <select name="professional_id" class="form-control select2" required>
                                <option value=""></option>

                                @foreach($professionals as $professional)
                                    <option value="{{ $professional->id }}">{{ $professional->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="age">{{ __('Age') }}</label>
                            <input type="text" class="form-control" name="age">
                        </div>

                        <div class="form-group">
                            <label for="amount">{{ __('Amount') }}</label>
                            <input type="text" class="form-control" name="amount">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">{{ __('Anamnesis') }}</div>

            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="anamnesis[general]">{{ __('General info')}}</label>
                            <textarea name="anamnesis[general]" class="form-control"></textarea>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[weight]">{{ __('Weight') }}</label>
                                    <input type="text" name="anamnesis[weight]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[height]">{{ __('Height') }}</label>
                                    <input type="text" name="anamnesis[height]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[imc]">{{ __('IMC') }}</label>
                                    <input type="text" name="anamnesis[imc]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[temperature]">{{ __('Temperatura') }}</label>
                                    <input type="text" name="anamnesis[temperature]" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[systolic_blood_pressure]">{{ __('Systolic blood presure') }}</label>
                                    <input type="text" name="anamnesis[systolic_blood_pressure]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[diastolic_blood_pressure]">{{ __('Diastolic blood presure') }}</label>
                                    <input type="text" name="anamnesis[diastolic_blood_pressure]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[breathing_frequency]">{{ __('Breathing frequency') }}</label>
                                    <input type="text" name="anamnesis[breathing_frequency]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[heart_rate]">{{ __('Heart rate') }}</label>
                                    <input type="text" name="anamnesis[heart_rate]" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[over_weight_20]">{{ __('Over weight, IMC 20') }}</label>
                                    <input type="text" name="anamnesis[over_weight_20]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[over_weight_30]">{{ __('Over weight, IMC 30') }}</label>
                                    <input type="text" name="anamnesis[over_weight_30]" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[physical_exam]">{{ __('Physical exam') }}</label>
                            <textarea name="anamnesis[physical_exam]" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[diagnosis]">{{ __('Diagnóstico') }}</label>
                            <textarea name="anamnesis[diagnosis]" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[cie10]">CIE 10</label>
                            <select name="cei10" class="form-control">
                                <option value=""></option>
                                @foreach($diseases as $disease)
                                    <option value="{{ $disease->code }}">{{ $disease->description }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[medical_prescription]">{{ __('Medical prescription') }}</label>
                            <textarea name="anamnesis[medical_prescription]" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="anamnesis[ethylism]">{{ __('Ethylism') }}</label>
                            <input type="text" name="anamnesis[ethylism]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[smoker]">{{ __('Smoker') }}</label>
                            <input type="text" name="anamnesis[smoker]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[drugs]">{{ __('Drugs') }}</label>
                            <input type="text" name="anamnesis[drugs]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[allergies]">{{ __('Allergies') }}</label>
                            <input type="text" name="anamnesis[allergies]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[diabetes]">{{ __('Diabetes') }}</label>
                            <input type="text" name="anamnesis[diabetes]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[chronic]">{{ __('Chronic diseases') }}</label>
                            <input type="text" name="anamnesis[chronic]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[hypertension]">{{ __('Hypertension') }}</label>
                            <input type="text" name="anamnesis[hypertension]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[neoplasm]">{{ __('Neoplasm') }}</label>
                            <input type="text" name="anamnesis[neoplasm]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[medication_on_demand]">{{ __('Medication on demand') }}</label>
                            <input type="text" name="anamnesis[medication_on_demand]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="anamnesis[contraceptive_method]">{{ __('Contraceptive method') }}</label>
                            <input type="text" name="anamnesis[contraceptive_method]" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="photos">Photos</label>
                            <input class="form-control" type="file" name="files[]">
                        </div>
                    </div>
                </div>

                <div class="row">
                   <div class="col-md-6">
                        @include('customFields.formBuilder')
                    </div>
                </div>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="{{ __('Create') }}">
        <a href="/consultations " class="btn btn-secondary">{{ __('Back') }}</a>
    </form>
@endsection


