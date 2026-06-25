<div>
{{-- {{ request()->url() }}
<br>
{{ request()->path() }} --}}
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

                    {{--  search form --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Search by title"
                                wire:model.live.debounce.500ms="search">
                        </div>

                        @if($search)
                            <div class="col-md-2">
                                <button
                                    type="button"
                                    class="btn btn-outline-secondary"
                                    wire:click="$set('search', '')">
                                    Clear
                                </button>
                            </div>
                        @endif
                    </div>

                    {{--add  forms --}}
                    @if($showCreateForm)
                        <livewire:dynamic.create/>
                    @endif
                    @if($showEditForm)
                        <livewire:dynamic.edit
                            :post_id="$selectedPostId"
                            :key="$selectedPostId"
                        />
                    @endif
                    @if($showPost)
                        <livewire:dynamic.show
                                :post_id="$selectedPostId"
                                :key="'show-'.$selectedPostId"
                        />
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
                                        @if($post->user_id == auth()->id())
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
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="ms-auto">
                        {{-- {{ $posts->withQueryString()->links('pagination::bootstrap-5') }}
                         --}}
                        {{ $posts->links('pagination::bootstrap-5') }}
                             {{-- {{ $this->posts->links() }} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>