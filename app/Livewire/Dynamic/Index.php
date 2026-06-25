<?php

namespace App\Livewire\Dynamic;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $selectedPostId  = null;
    public $showCreateForm  = false;
    public $showEditForm    = false;
    public $showPost        = false;

    #[Url()]
    public $search = '';        

    #[On('postCreated')]
    public function refreshCreatedPosts($posts)
    {
        session()->flash('message', 'Post Added Sucessfully');

        $this->showCreateForm = false;
        $this->showEditForm = false;
    }

    #[On('postUpdated')] 
    public function refreshUpdatedPost()
    {
        session()->flash('message', 'Post Updated Sucessfully');

        $this->showCreateForm = false;
        $this->showEditForm = false;    
    }
    #[On('postNotUpdated')] 
    public function refreshNotUpdatedPost()
    {
        session()->flash('message', 'you can not update not yours');

        $this->showCreateForm = false;
        $this->showEditForm = false;    
    }

    #[On('postDeleted')] 
    public function refreshDeletedPost()
    {
        session()->flash('message', 'Post Deleted Sucessfully');

    }

    public function render()
    {
        $posts = Post::with(['user', 'category'])
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
                }
            )
            ->latest()->paginate(5);


        return view('livewire.dynamic.index', [
            'posts' => $posts
        ])
        ;
    }

    public function create_post()
    {
        $this->showCreateForm = !$this->showCreateForm;
        $this->showEditForm = false;
        $this->showPost = false;


    }

    public function show_post($id)
    {
        $post = Post::whereId($id)->firstOrFail();

        $this->selectedPostId = $id;
        $this->showPost = !$this->showPost;
        $this->showEditForm = false;
        $this->showCreateForm = false;

    }

    public function edit_post($id)
    {
        $post = Post::whereId($id)->whereUserId(auth()->id())->firstOrFail();

        $this->selectedPostId = $id;
        $this->showEditForm = !$this->showEditForm ;
        $this->showCreateForm = false;
        $this->showPost = false;

    }

    public function delete_post($id)
    {
         $post = Post::whereId($id)->whereUserId(auth()->id())->firstOrFail();

        $this->selectedPostId = $id;
        $this->showEditForm = false;
        $this->showCreateForm = false;

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        $this->dispatch('postDeleted');
        // session()->flash('message', 'post updated successfully');




    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    
    
    
}