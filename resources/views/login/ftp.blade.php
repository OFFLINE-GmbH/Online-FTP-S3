@include('helpers/input', [
    'id' => 'host',
    'label' => 'Host',
    'type' => 'text',
    'autofocus' => true
])
@include('helpers/input', [
    'id' => 'username',
    'label' => 'Username',
    'type' => 'text'
])
@include('helpers/input', [
    'id' => 'password',
    'label' => 'Password',
    'type' => 'password'
])
@include('helpers/input', [
    'id' => 'port',
    'label' => 'Port',
    'type' => 'number',
    'value' => 21
])
<div class="form-group">
    <button type="submit" class="btn btn-primary" id="btn-login">Login</button>
</div>
