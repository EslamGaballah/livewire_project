<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    
    // public function index()
    // {
    //     $posts = Post::with(['user', 'category'])->orderBy('id', 'desc')->paginate(5);
    //     Return view('frontend.posts.index', compact('posts'));
    // }

    public function index_livewire()
    {
        return view('frontend.posts.index');
    }
    

    public function create()
    {
        // $categories = Category::all();
        // Return view('frontend.posts.create', compact('categories'));

        // livewire
        return view('frontend.posts.create');

        
    }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'title'         => 'required|max:255',
    //         'category_id'   => 'required|exists:categories,id',
    //         'body'          => 'required',
    //         'image'         => 'nullable|mimes:jpg,jpeg,gif,png,webp|max:2048',
    //     ]);
        
    //     $data['user_id'] = auth()->id();

    //     // create images
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $path = $image->storeAs('images', $imageName, 'public');  

    //         $data['image'] = $path;
    //     }
    //     // dd($data);

    //     Post::create($data);

    //     return redirect()->route('posts.index')->with([
    //         'message' => 'Post created successfully',
    //         'alert-type' => 'success'
    //     ]);
    // }

   
    public function show(string $id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);
        // return view('frontend.posts.show', compact('post'));

        // livewire
        return view('frontend.posts.show', compact('id'));
    }

    
    public function edit(string $id)
    {
        // $post = Post::findOrFail($id);
        // $categories = Category::all();
        // return view('frontend.posts.edit', compact('post', 'categories'));

        // livewire
        return view('frontend.posts.edit', compact('id'));
    }

//     public function update(Request $request, string $id)
//     {
//         $post = Post::findOrFail($id);

//         $data = $request->validate([
//             'title'       => 'required|max:255',
//             'category_id' => 'required|exists:categories,id',
//             'body'        => 'required',
//             'image'       => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:2048',
//         ]);

//         $data['user_id'] = auth()->id();

//         // update image if exists
//         if ($request->hasFile('image')) {

//             // delete old image
//             if ($post->image && Storage::disk('public')->exists($post->image)) {
//                 Storage::disk('public')->delete($post->image);
//             }

//             $image = $request->file('image');
//             $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

//             $path = $image->storeAs('images', $imageName, 'public');

//             $data['image'] = $path;
//         }
// // dd($request->all());
//         $post->update($data);

//         return redirect()->route('posts.index')->with([
//             'message' => 'Post updated successfully',
//             'alert-type' => 'success'
//         ]);
//     }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);

        // delete image
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with([
            'message' => 'Post deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
