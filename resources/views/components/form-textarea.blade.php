
<div {{ $attributes->class([]) }}>
    <label for="email" class="form-label">{{ $attributes['label'] }}</label>
    <textarea type="{{$attributes['type'] ?? 'text'}}" class="form-control" style="min-height:100px;" name="{{$attributes['name']}}" aria-describedby="{{$attributes['name']}}-error">{{$attributes['value'] ?? old($attributes['name'])}}</textarea>
    <div id="{{$attributes['name']}}-error" class="form-text text-danger">{{ $errors->first($attributes['name']) }}</div>
</div>