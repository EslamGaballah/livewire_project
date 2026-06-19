<div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <b>Posts</b>
                    <a href="javascript:void(0);" wire:click="create_post" class="btn btn-primary btn-sm ">Create Post</a>
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show" role="alert">

                            {{ session('message') }}

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Owner</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        @if ($post->image != '')
                                            <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}" width="100"></td>
                                        @endif
                                    <td>
                                        <a href="javascript:void(0);" wire:click="show_post({{ $post->id }})">{{ $post->title }}</a>
                                    </td>
                                    <td>{{ $post->user->name }}</td>
                                    <td>{{ $post->category->name }}</td>
                                    <td>
                                        <a href="javascript:void(0);" wire:click="edit_post({{ $post->id }})" class="btn btn-primary btn-sm">Edit</a>
                                        {{-- <a href="javascript:void(0);" wire:click="delete_post({{ $post->id }})" class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Are you sure?')">Delete</a> --}}
                                            <button
                                                type="button"
                                                wire:click="delete_post({{ $post->id }})"
                                                wire:confirm="Are you sure?"
                                                class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="ms-auto">
                        {{ $posts->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>