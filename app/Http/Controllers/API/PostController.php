<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Str as Str;

class PostController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['show', 'index','featuredPosts']]);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return Post::orderBy('order', 'asc')->paginate(10);
  }

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function featuredPosts()
  {
    return Post::where('featured', 1)->orderBy('order', 'asc')->get();
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request,[
      'title' => 'required|string',
      'description' => 'required'
    ]);

    $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
    \Image::make($request->picture)->save(public_path('img/posts/').$name);
    $request->merge(['picture' => $name]);

    return Post::create([
      'title' => $request['title'],
      'type' => $request['type'],
      'description' => $request['description'],
      'featured' => $request['featured'],
      'picture' => $name,
      'order' => $request['order'],
    ]);
  }

  public function updatePosts(Request $request)
  {
    $posts = Post::all();

    foreach ($posts as $post) {
      $id = $post->id;
      foreach ($request->posts as $postFrontend) {
        if ($postFrontend['id'] == $id) {
          $post->update([
            'order' => $postFrontend['order']
          ]);
        }
      }
    }
    return ['message' => "Success"];
  }

  public function costumersLinked(Request $request)
  {
    $post = Post::find($request->post_id);
    $post->costumers()->sync($request->costumers);
    return ['message' => "Success"];
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    return Post::with('sections.items')->with('costumers')->find($id);
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $post = Post::findOrFail($id);

    $this->validate($request,[
      'title' => 'required|string',
      'description' => 'required'
    ]);

    $currentPicture = $post->picture;

    if ($request->picture != $currentPicture) {
      $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];

      \Image::make($request->picture)->save(public_path('img/posts/').$name);

      $request->merge(['picture' => $name]);

      $postPicture = public_path('img/posts/').$currentPicture;
      if (file_exists($postPicture)) {
        @unlink($postPicture);
      }
    }

    $post->update($request->all());

    return ['message' => 'Updated the post info'];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $post = Post::findOrFail($id);

    $post->delete();

    return ['message' => 'Post deleted!'];
  }
}
