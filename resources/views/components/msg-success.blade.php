@if(Session::has('msg'))
    <div {{ $attributes->class(['bg-success text-white p-1 text-center  rounded']) }}>
        {{ Session::get('msg') }}     
    </div>
@endif

                
        