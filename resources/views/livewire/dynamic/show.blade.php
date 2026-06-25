<div>
   
    @if($this->image != '')
        <div class="col-12 text-center">
            <img src="{{ asset('storage/'.$this->image) }}" class="img-fluid" style="max-width: 100%" alt="{{ $this->title }}">
        </div>
    @endif

    <div class="col-12 justify-content-center pt-5">
        <h3>{{ $this->title }}</h3>
        <small>{{ $this->category }} || By: {{ $this->user }}</small>

        <p class="pt-5">
            {!! $this->body !!}
        </p>
    </div>
                  
</div>
