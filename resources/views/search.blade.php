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

@section('body')
    <form action="{{ url('/search') }}" method="GET" autocomplete="off" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
        {{-- @csrf --}}
        <table border="0" class="w-100">
            <tr>
                <td>
                    <select name="lga_id" id="lga_id" class="form-select select2" required>
                        <option value="" disabled selected hidden>-- Select LGA --</option>
                        @foreach ($data->list as $item)
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
                <td class="text-end" style="max-width:5px; padding-left:10px;">
                    <button type="submit" role="button" class="btn btn-primary" title="Search">
                        <i class="fas fa-search"></i>
                    </button>
                </td>
            </tr>
        </table>
    </form>

    <p>&nbsp;</p>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Political Party</th>
                <th>
                    <i class="fas fa-calculator me-1"></i>
                    Computed Score
                </th>
                <th>
                    <i class="fas fa-bullhorn me-1"></i>
                    Announced Score
                </th>
                <th>
                    <i class="fas fa-user-alt me-1"></i>
                    Recorded By
                </th>
                <th class="text-nowrap">Date Recorded</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {!! $fx->asPartyAvatar($item->party_abbreviation) !!}
                        {{ $item->party_abbreviation }}
                    </td>
                    <td class="text-danger">
                        @php
                            $scores = $mx->stackTraceLga($item->lga_name);
                            $score = isset($scores[$item->party_abbreviation]) ? $scores[$item->party_abbreviation] : 0;
                            echo $fx->asCash($score);
                        @endphp
                    </td>
                    <td class="text-success">{{ $fx->asCash($item->party_score) }}</td>
                    <td>
                        {{ $fx->asEmpty($item->entered_by_user) }} <br />
                        {!! $fx->asBadge($item->user_ip_address, 'secondary') !!}
                    </td>
                    <td class="text-nowrap">{!! $fx->asDate($item->date_entered) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
