<?php

namespace App\Http\Controllers\API;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth:api', ['except' => ['show', 'index']]);
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return Item::orderBy('created_at', 'asc')->paginate(10);
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
      'title' => 'sometimes'
    ]);

    $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
    \Image::make($request->picture)->save(public_path('img/items/').$name);
    $request->merge(['picture' => $name]);

    return Item::create([
      'title' => $request['title'],
      'text' => $request['text'],
      'section_id' => $request['section_id'],
    ]);

    return ['message' => 'Item created'];
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Item  $item
  * @return \Illuminate\Http\Response
  */
  public function show(Item $item)
  {
    return $item;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Item  $item
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Item $item)
  {
    $this->validate($request,[
      'title' => 'sometimes'
    ]);

    $currentPicture = $item->picture;

    if ($request->picture != $currentPicture) {
      $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];

      \Image::make($request->picture)->save(public_path('img/items/').$name);

      $request->merge(['picture' => $name]);

      $itemPicture = public_path('img/items/').$currentPicture;
      if (file_exists($itemPicture)) {
        @unlink($itemPicture);
      }
    }

    $item->update($request->all());
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Item  $item
  * @return \Illuminate\Http\Response
  */
  public function destroy(Item $item)
  {
    $item->delete();

    return ['message' => 'Item deleted!'];
  }
}
