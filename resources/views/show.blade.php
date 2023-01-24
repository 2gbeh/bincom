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
    <a href="/" class="btn btn-primary">
        <i class="fas fa-arrow-circle-left me-1"></i>
        Go back
    </a>

    <p></p>

    <div class="row">
        <div class="col-md-3 col-lg-2 order-md-last">
            @includeIf('shared.aside', ['item' => $data->meta])
        </div>
        <div class="col-md-9 col-lg-10">
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Political Party</th>
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
                            <td class="text-primary">{{ $fx->asCash($item->party_score) }}</td>
                            <td>
                                {{ $fx->asEmpty($item->entered_by_user) }} <br />
                                {!! $fx->asBadge($item->user_ip_address, 'secondary') !!}
                            </td>
                            <td class="text-nowrap">{!! $fx->asDate($item->date_entered) !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
