<?php
namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component {

    use WithFileUploads;

    public  $title = '';
    public  $body = '';
    public  $category_id = '';
    public  $image = '';

    public function render()
    {
        $categories = Category::all();
        return view('livewire.posts.create', [
            'categories' => $categories
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
 
        // dd($this->title, $this->body);
        // dd($data);
        
        Post::create($data);

        $this->resetInputs();

        // session()->flash('message', 'Post Created Successfully');
        // session()->flash('alert-type', 'success');

        return redirect()->route('posts.index_livewire')->with([
            'message' => 'Post Created Successfully',
            'alert-type' => 'success',
        ]);
    }

    private function resetInputs()
    {
        $this->title        = null;
        $this->category_id  = null;
        $this->body         = null;
        $this->image        = null;
    }

    // back to posts
    public function return_to_posts()
    {
        return redirect()->to('/posts');
    }

    
};
?>
 
