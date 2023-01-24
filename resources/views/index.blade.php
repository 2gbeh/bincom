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
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Polling Unit</th>
                <th class="text-nowrap">@pu Number</th>
                <th class="text-nowrap">@pu Description</th>
                <th>Ward</th>
                <th>LGA</th>
                <th>State</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th class="text-nowrap">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        {{ sprintf('%s (Unit %s)', $fx->asCity($item->polling_unit_name), $item->polling_unit_id) }}
                    </td>
                    <td class="text-nowrap">{{ $item->polling_unit_number }}</td>
                    <td class="text-nowrap">{{ $fx->asCity($item->polling_unit_description) }}</td>
                    <td>
                        @php
                            $ward_name = $mx->getWard($item->uniquewardid, 'ward_name');
                            $ward_name_f = $fx->asCity($ward_name);
                            echo sprintf('%s (Ward %s)', $ward_name_f, $item->ward_id);
                        @endphp
                    </td>
                    <td>
                        {{ $mx->getLga($item->lga_id, 'lga_name') }}
                    </td>
                    <td>
                        @php
                            $lga = $mx->getLga($item->lga_id);
                            if ($lga) {
                                echo $mx->getState($lga->state_id, 'state_name');
                            } else {
                                echo 'N/A';
                            }
                        @endphp
                    </td>
                    <td>{{ $item->long }}</td>
                    <td>{{ $item->lat }}</td>
                    <td class="text-nowrap">
                        <a href="{{ url('/' . $item->uniqueid) }}" class="btn btn-sm btn-primary">
                            View Result
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
