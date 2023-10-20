<div class="left message">
    @if (auth()->user()->avatar == null)
    <img src="{{ asset('../assets/img/noimage.png') }}"   width="70" class="rounded-circle mt-2">
@else
    <img  src="{{ asset('storage/assets/img/' . auth()->user()->avatar) }}"  width="70" class="rounded-circle mt-2" >                    
@endif       <p>{{$message}}</p>
</div>