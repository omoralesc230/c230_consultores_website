<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Media;

class MediaController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return Media::latest()->paginate(10);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    // return ['message' => 'I have your data'];
    $this->validate($request,[
      'title' => 'required|string',
      'link' => 'required|string'
    ]);

    return Media::create([
      'title' => $request['title'],
      'description' => $request['description'],
      'type' => $request['type'],
      'link' => $request['link'],
      'thumbnail' => $request['thumbnail'],
      'publication_date' => $request['publication_date'],
      'status' => $request['status'],
    ]);
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {

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
    $media = Media::findOrFail($id);

    $this->validate($request,[
      'title' => 'required|string',
      'link' => 'required|string'
    ]);

    $media->update($request->all());

    return ['message' => 'Updated the user info'];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $media = Media::findOrFail($id);

    $media->delete();

    return ['message' => 'Media deleted'];
  }
}
