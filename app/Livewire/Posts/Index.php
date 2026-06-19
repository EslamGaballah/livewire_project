<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class Index extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if (
            $post->image &&
            Storage::disk('public')->exists($post->image)
        ) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        session()->flash(
            'success',
            'Post Deleted Successfully'
        );
    }

    public function render()
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(5);

        return view('livewire.posts.index', [
            'posts' => $posts
        ])
        ;
    }

    public function create_post()
    {
        return redirect()->to('/posts/create');
    }

    public function show_post($id)
    {
        return redirect()->to('/posts/show');
    }

    public function edit_post($id)
    {
        $post = Post::whereId($id)->whereUserId(auth()->id())->first();

        if(!$post) {
            return redirect()->back()->with([
                'message' => 'you can not update not yours',
                'alert-type' => 'danger'
            ]);
        }else{
            return redirect()->to('/posts/'.$id.'/edit');
        }

    }

    public function delete_post($id)
    {
        $post = Post::whereId($id)->whereUserId(auth()->id())->first();

        if (! $post) {
            return redirect()->back()->with([
                'message' => 'you can not delete not yours',
                'alert-type' => 'danger'
            ]);
        }

        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        session()->flash('message', 'Post deleted successfully');

        return redirect()->to('/posts');
    }
}