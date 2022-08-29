@extends('layouts.admin')

@section('page-title')
    {{__('Create consultation')}}
@endsection

@push('css-page')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .profile {
            cursor: pointer;
            width: 100%;
            border-radius: 100%;
        }

        .upload-files {
            display: block;
        }
    </style>
@endpush


@push('script-page')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify();

        $(document).ready(function () {
            $('.select2').select2();

            $('.profile').click(function () {
                $('.input-profile').click();
            });

            $('.input-profile').change(function () {
                input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $('.profile').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('.upload-files').click(function () {
                $('.multiple-files').click();
            });

            $('.multiple-files').change(function () {
                input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        console.log(event);
                    }
                }

                html = '';

                for (var i = input.files.length - 1; i >= 0; i--) {
                    html = html + '<li>'+input.files[i].name+'</li>';
                }

                $('.files-selected').html(html);
            });

            $('#weight').change(function () {
                imc();
            });

            $('#height').change(function () {
                imc();
            });
        });

        function imc() {
            weight = $('#weight').val();
            height = $('#height').val();

            if (weight != '') {
                weight = parseInt(weight);
            }

            if (height != '') {
                height = parseInt(height);
            }

            if (weight != '' && height == '') {
                $('#imc').val(weight);
            }

            if (height != '' && weight == '') {
                $('#imc').val(height * height);
            }

            if (weight != '' && height != '') {
                $('#imc').val(weight + (height * height));
            }
        }

    </script>
@endpush

@section('content')
    <form action="/consultations" enctype="multipart/form-data" method="POST">
        @csrf

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img class="profile" src="https://sysclinic.net/storage/uploads/avatar/avatar.png" alt="">
                        <input type="file" name="photo" class="input-profile">
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
                                    <input id="weight" type="text" name="anamnesis[weight]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[height]">{{ __('Height') }}</label>
                                    <input type="text" id="height" name="anamnesis[height]" class="form-control">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="anamnesis[imc]">{{ __('IMC') }}</label>
                                    <input type="text" readonly id="imc" name="anamnesis[imc]" class="form-control">
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
                            <label for="anamnesis[cei10]">CIE 10</label>
                            <select name="anamnesis[cei10]" class="form-control">
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
                            <label for="photos">{{ __('Photos') }}</label><br>
                            <button type="button" class="btn btn-secondary upload-files">Seleccionar archivos</button>
                            <input multiple type="file" class="multiple-files" name="photos[]">
                            <p class="files-selected mt-3"></p>
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
        <a href="/consultations" class="btn btn-secondary">{{ __('Back') }}</a>
    </form>
@endsection


