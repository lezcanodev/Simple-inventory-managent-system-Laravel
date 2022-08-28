@if(Session::has('error'))
    <div {{ $attributes->class(['bg-danger text-white p-1 text-center  rounded']) }}>
        {{ Session::get('error') }}     
    </div>
@endif

                
        