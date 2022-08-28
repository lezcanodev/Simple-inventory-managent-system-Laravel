@props([
    'iterable'
])
@dd($attributes)
<div {{ $attributes->class([]) }}>
    <label for="email" class="form-label">{{ $attributes['label'] }}</label>
    
    <select class="form-select" name="{{$attributes['name']}}" aria-describedby="{{$attributes['name']}}-error">
            <option value="">All</option>
            @foreach($attributes['iterable'] as $itr)
                <option value="{{$itr->id}}">{{$itr->name}}</option>
            @endforeach
    </select>

    <div id="{{$attributes['name']}}-error" class="form-text text-danger">{{ $errors->first($attributes['name']) }}</div>
</div>