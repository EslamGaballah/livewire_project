<div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <b>show Post</b>
                    <a href="javascript:void(0);" wire:click="return_to_posts" class="btn btn-primary btn-sm -auto">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
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

                </div>
            </div>
        </div>
    </div>
</div>
