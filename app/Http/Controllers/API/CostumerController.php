<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Costumer;

class CostumerController extends Controller
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
    return Costumer::latest()->paginate(10);
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
      'name' => 'required|string',
      'description' => 'sometimes'
    ]);

    $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];
    \Image::make($request->picture)->save(public_path('img/costumers/').$name);
    $request->merge(['picture' => $name]);

    return Costumer::create([
      'name' => $request['name'],
      'description' => $request['description'],
      'picture' => $name
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
    return Costumer::find($id);
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
    $costumer = Costumer::findOrFail($id);

    $this->validate($request,[
      'name' => 'required|string',
      'description' => 'sometimes'
    ]);

    $currentPicture = $costumer->picture;

    if ($request->picture != $currentPicture) {
      $name = time().'.' . explode('/', explode(':', substr($request->picture, 0, strpos($request->picture, ';')))[1])[1];

      \Image::make($request->picture)->save(public_path('img/costumers/').$name);

      $request->merge(['picture' => $name]);

      $postPicture = public_path('img/costumers/').$currentPicture;
      if (file_exists($postPicture)) {
        @unlink($postPicture);
      }
    }

    $costumer->update($request->all());

    return ['message' => 'Updated the costumer info'];
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $costumer = Costumer::findOrFail($id);

    $costumer->delete();

    return ['message' => 'Costumer deleted!'];
  }
}
