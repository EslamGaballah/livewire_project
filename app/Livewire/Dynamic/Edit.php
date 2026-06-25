<?php

namespace App\Livewire\Dynamic;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $post_id;
    public $post;

    public  $title;
    public  $body ;
    public  $category_id ;
    public  $image;
    public  $old_image ;


    public function mount($post_id)
    {
        $this->post_id = $post_id;

        $this->post = Post::whereId($post_id)
            ->whereUserId(auth()->id())
            ->firstOrFail();

        

        $this->title = $this->post->title;
        $this->body = $this->post->body;
        $this->category_id = $this->post->category_id;
        $this->old_image = $this->post->image;
    }

   
    public function render()
    {

        return view('livewire.dynamic.edit', [
            'post' => $this->post,
            'categories' => Category::all()
        ]);
    }

     public function update()
    {
        $data = $this->validate([
            'title'         => 'required|max:255',
            'category_id'   => 'required|exists:categories,id',
            'body'          => 'required',
            'image'         => 'nullable|image|mimes:jpg,jpeg,gif,png,webp|max:2048',
        ]);

        $post = Post::whereId($this->post_id)->whereUserId(auth()->id())->firstOrFail();

        if ($post) {
            $data['title']      = $this->title;
            $data['body']       = $this->body;
            $data['category_id']= $this->category_id;

            // if ($this->image) {
            if ($this->image && $this->image instanceof TemporaryUploadedFile) {

            // if there is new image -> delete old image 
                if ($this->old_image && Storage::disk('public')->exists($this->old_image)) {
                    Storage::disk('public')->delete($this->old_image);
                }

                $imageName = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();

                $path = $this->image->storeAs('images', $imageName, 'public');

                $data['image'] = $path;
            } else {
                // very important in livewire
                $data['image'] = $this->old_image;
            }

            $post->update($data);

            // $this->resetInputs();

            $this->dispatch('postUpdated');

        }
    }

    private function resetInputs()
    {
        $this->title        = null;
        $this->category_id  = null;
        $this->body         = null;
        $this->image        = null;
    }
}