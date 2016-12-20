<div class="form-group">
    <label for="{{ $id }}">
        {{ $label }}
        @if($errors->has($id))
            <span class="badge badge-danger">
                {{ $errors->get($id)[0] }}
            </span>
        @endif
    </label>
    <input type="{{ $type }}" class="form-control" name="{{ $id }}" id="{{ $id }}"
           @if(isset($autofocus))
            autofocus
           @endif
           @if( ! isset($value))
            <?php $value = old($id) ?: '' ?>
           @endif
           value="{{ $value }}"
    >
</div>