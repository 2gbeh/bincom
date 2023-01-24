<h6 class="d-flex justify-content-between align-items-center mb-3">
    <b>
        Search Result Summary
    </b>
</h6>

<ul class="list-group mb-3">
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">{{ $fx->asCity($item->polling_unit_name) }}</h6>
            <small class="text-muted">Polling Unit ({{ $item->polling_unit_id }})</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between bg-light">
        <div class="text-success">
            <h6 class="my-0">{{ $item->polling_unit_number }}</h6>
            <small>@pu Number</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">{{ $fx->asCity($item->polling_unit_description) }}</h6>
            <small class="text-muted">@pu Description</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">
                @php
                    $ward_name = $mx->getWard($item->uniquewardid, 'ward_name');
                    $ward_name_f = $fx->asCity($ward_name);
                    echo sprintf('%s (Ward %s)', $ward_name_f, $item->ward_id);
                @endphp
            </h6>
            <small class="text-muted">Ward</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">{{ $mx->getLga($item->lga_id, 'lga_name') }}</h6>
            <small class="text-muted">LGA</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">
                @php
                    $lga = $mx->getLga($item->lga_id);
                    if ($lga) {
                        echo $mx->getState($lga->state_id, 'state_name');
                    } else {
                        echo 'N/A';
                    }
                @endphp
            </h6>
            <small class="text-muted">State</small>
        </div>
    </li>
    <li class="list-group-item d-flex justify-content-between">
        <span>Longitude</span>
        <strong>{{ $item->long }}</strong>
    </li>
    <li class="list-group-item d-flex justify-content-between">
        <span>Latitude</span>
        <strong>{{ $item->lat }}</strong>
    </li>
</ul>
