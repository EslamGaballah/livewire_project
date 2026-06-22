<?php
namespace App\Livewire\Posts;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class Show extends Component {


    public $post_id;
    public $post;



    public  $title;
    public  $body ;
    public  $category ;
    public  $user ;
    public  $image;


    public function mount($post_id)
    {
        $this->post_id = $post_id;

        $this->post    = Post::with('user', 'category')->whereId($this->post_id)->firstOrFail();

        $this->title    = $this->post->title;
        $this->body     = $this->post->body;
        $this->category = $this->post->category->name;
        $this->user     = $this->post->user->name;
        $this->image    = $this->post->image;
    } 

    public function render()
    {
        // dd('render');
        return view('livewire.posts.show', [
            'post' => $this->post
        ]);
    }

    // back to posts
    public function return_to_posts()
    {
        return redirect()->to('/posts');
    }

};
?>
 
