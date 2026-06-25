<?php

namespace App\Livewire\Dynamic;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public  $title = '';
    public  $body = '';
    public  $category_id = '';
    public  $image = '';

        
    public function render()
    {

        return view('livewire.dynamic.create', [
            'categories' => Category::all()
        ]);
    }

   public function save()
    {
        // dd($this->image);

        // dd('save called');
        
        $data = $this->validate([
            'title'         => 'required|max:255',
            'category_id'   => 'required|exists:categories,id',
            'body'          => 'required',
            'image'         => 'nullable|image|mimes:jpg,jpeg,gif,png,webp|max:2048',
        ]);
        
        $data['user_id'] = auth()->id();

        // create images
        if ($this->image) {

            $imageName = time() . '_' . uniqid() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('images', $imageName, 'public');  

            $data['image'] = $path;
        }
 
        $newPost = Post::create($data);

        $this->resetInputs();

        $this->dispatch('postCreated', $newPost);

    }

    private function resetInputs()
    {
        $this->title        = null;
        $this->category_id  = null;
        $this->body         = null;
        $this->image        = null;
    }
    
}