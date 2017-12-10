@include('helpers/input', [
    'id' => 'host',
    'label' => 'Host',
    'value' => request()->get('host') ?? old('host'),
    'type' => 'text',
    'autofocus' => true
])
@include('helpers/input', [
    'id' => 'username',
    'label' => 'Username',
    'value' => request()->get('username') ?? old('username'),
    'type' => 'text'
])
@include('helpers/input', [
    'id' => 'password',
    'label' => 'Password',
    'value' => request()->get('password') ?? old('password'),
    'type' => 'password'
])
@include('helpers/input', [
    'id' => 'port',
    'label' => 'Port',
    'type' => 'number',
    'value' => request()->get('port') ?? old('port') ?? 21,
])
<div class="form-group">
    <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
</div>
