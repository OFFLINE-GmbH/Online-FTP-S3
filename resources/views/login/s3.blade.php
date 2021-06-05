@include('helpers/input', [
    'id' => 'key',
    'label' => 'S3 Key',
    'type' => 'text'
])
@include('helpers/input', [
    'id' => 'secret',
    'label' => 'S3 Secret',
    'type' => 'text'
])
<div class="two columns">
    <div class="column">
        @include('helpers/input', [
            'id' => 'bucket',
            'label' => 'S3 Bucket Name',
            'type' => 'string'
        ])
    </div>
    <div class="column">
        @include('helpers/input', [
            'id' => 'region',
            'label' => 'S3 Region',
            'type' => 'text',
            'value' => 'eu-central-1'
        ])
    </div>
</div>
@include('helpers/input', [
    'id' => 'endpoint',
    'label' => 'S3 Endpoint (optional)',
    'type' => 'string'
])
<div class="form-group">
    <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
</div>
