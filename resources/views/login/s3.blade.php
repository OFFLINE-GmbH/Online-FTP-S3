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
@include('helpers/input', [
    'id' => 'region',
    'label' => 'S3 Region',
    'type' => 'text',
    'value' => 'eu-central-1'
])
@include('helpers/input', [
    'id' => 'bucket',
    'label' => 'S3 Bucket name',
    'type' => 'string'
])
<div class="form-group">
    <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
</div>
