
<div {{ $attributes->class([]) }}>
    <label for="email" class="form-label">{{ $attributes['label'] }}</label>
    <input type="{{$attributes['type'] ?? 'text'}}" class="form-control" name="{{$attributes['name']}}" value="{{ $attributes['value'] ?? old($attributes['name']) }}" aria-describedby="{{$attributes['name']}}-error">
    <div id="{{$attributes['name']}}-error" class="form-text text-danger">{{ $errors->first($attributes['name']) }}</div>
</div>