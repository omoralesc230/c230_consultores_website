<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;

class SectionController extends Controller
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
    return Section::orderBy('created_at', 'asc')->paginate(10);
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
      'type' => 'required'
    ]);

    return Section::create([
      'title' => $request['title'],
      'description' => $request['description'],
      'text' => $request['text'],
      'order' => $request['order'],
      'post_id' => $request['post_id'],
      'type' => $request['type'],
    ]);

    return ['message' => 'Section created'];
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
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
    $section = Section::findOrFail($id);

    $this->validate($request,[
      'title' => 'required|string',
      'type' => 'required'
    ]);

    $section->update($request->all());
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $section = Section::findOrFail($id);

    $section->delete();

    return ['message' => 'Section deleted!'];
  }
}
