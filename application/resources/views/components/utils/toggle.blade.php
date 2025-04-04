<div class="form-group mb-0">
    <div class="custom-control custom-switch text-center">
        <input type="checkbox" class="custom-control-input toggle_entity_activity"
               data-id="{{ $id }}"
               data-type="{{ $type }}"
               data-action="{{ $route }}"
               id="customSwitch-{{ $type }}-{{ $id }}"
               @if ($checked) checked="checked" @endif
        >
        <label class="custom-control-label" for="customSwitch-{{ $type }}-{{ $id }}"></label>
    </div>
</div>
