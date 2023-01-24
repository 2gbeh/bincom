<div class="alert alert-{{ $alert_type ?? 'success' }} alert-dismissible fade show" role="alert">
    &#9989;
    {!! $alert_text ?? 'Record saved successfully' !!}    
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
