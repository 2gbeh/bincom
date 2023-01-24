@inject('mx', 'App\Services\BladeModelService')
@inject('fx', 'App\Services\StringFormatService')

@extends('layouts.index')

@section('title', $data->title)

@push('styles')
    <link href="{{ asset('assets/bootstrap/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/jquery/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/dataTables.bootstrap5.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush

@push('scripts_')
    <script type="text/javascript">
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endpush

@section('body')

    @includeWhen(session('alert'), 'shared.alert')

    <div class="container">

        <form action="{{ url('/') }}" method="POST" autocomplete="off" class="needs-validation" novalidate>
            @csrf

            <div class="row g-3">
                <div class="col-md-3">
                    <label for="state_id" class="form-label">State</label>
                    <select name="state_id" id="state_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select State --</option>
                        @foreach ($data->lists->state as $item)
                            @if (request()->query('state_id') == $item->state_id)
                                <option value="{{ $item->state_id }}" selected>
                                    {{ $item->state_name }}
                                </option>
                            @else
                                <option value="{{ $item->state_id }}">
                                    {{ $item->state_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `State`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="lga_id" class="form-label">Local Government</label>
                    <select name="lga_id" id="lga_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select LGA --</option>
                        @foreach ($data->lists->lga as $item)
                            @if (request()->query('lga_id') == $item->lga_id)
                                <option value="{{ $item->lga_id }}" selected>
                                    {{ $item->lga_name }}
                                </option>
                            @else
                                <option value="{{ $item->lga_id }}">
                                    {{ $item->lga_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Local Government`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="ward_uniqueid" class="form-label">Ward</label>
                    <select name="ward_uniqueid" id="ward_uniqueid" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Ward --</option>
                        @foreach ($data->lists->ward as $item)
                            @if (request()->query('ward_uniqueid') == $item->uniqueid)
                                <option value="{{ $item->uniqueid }}" selected>
                                    {{ $item->ward_name }}
                                    (Ward {{ $item->ward_id }})
                                </option>
                            @else
                                <option value="{{ $item->uniqueid }}">
                                    {{ $item->ward_name }}
                                    (Ward {{ $item->ward_id }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Ward`.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="polling_unit_uniqueid" class="form-label">Polling Unit (PU)</label>
                    <select name="polling_unit_uniqueid" id="polling_unit_uniqueid" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Polling Unit --</option>
                        @foreach ($data->lists->polling_unit as $item)
                            @if (request()->query('polling_unit_uniqueid') == $item->uniqueid)
                                <option value="{{ $item->uniqueid }}" selected>
                                    {{ ucwords($item->polling_unit_name) }}
                                    ({{ $item->polling_unit_number }})
                                </option>
                            @else
                                <option value="{{ $item->uniqueid }}">
                                    {{ ucwords($item->polling_unit_name) }}
                                    ({{ $item->polling_unit_number }})
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Polling Unit`.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="party_id" class="form-label">Political Party</label>
                    <select name="party_id" id="party_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select Political Party --</option>
                        @foreach ($data->lists->party as $item)
                            @if (request()->query('party_id') == $item->id)
                                <option value="{{ $item->id }}" selected>
                                    {{ $item->partyname }}
                                </option>
                            @else
                                <option value="{{ $item->id }}">
                                    {{ $item->partyname }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid `Political Party`.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="party_score" class="form-label">Party Score</label>
                    <input type="number" name="party_score" id="party_score" min="0" value="0"
                        class="form-control" required />
                    <div class="invalid-feedback">
                        `Party Score` is required.
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="text-end">
                <button class="btn btn-outline-secondary btn-md" type="reset">
                    <i class="fas fa-times-circle px-1"></i>
                    Clear
                </button> &nbsp;
                <button class="btn btn-primary btn-md" type="submit">
                    <i class="fas fa-save px-1"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection
