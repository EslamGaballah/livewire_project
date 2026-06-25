<div>

    <form wire:submit.prevent="update" enctype="multipart/form-data" class="pb-5">
        <div class="row">

            <div class="col-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" wire:model="title" class="form-control">
                    @error('title')<span class="text-danger">{{ $message }}</span>@enderror
                </div>

            </div>
            <div class="col-6">
                 <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" wire:model="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<span class="text-danger">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>
       

        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" class="form-control" wire:model="body" rows="5"></textarea>
            @error('body')<span class="text-danger">{{ $message }}</span>@enderror
        </div>

        @if($old_image != '')
            <div class="form-group">
                <img src="{{ asset('storage/'. $old_image) }}" alt="{{ $this->title }}" width="100">
            </div>
        @endif

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" wire:model="image" class="custom-file" >
            @error('image')<span class="text-danger">{{ $message }}</span>@enderror
        </div>

        <div class="text-center">
            <input type="submit" name="save" value="update Post" class="btn btn-primary">
        </div>
    </form>

</div>