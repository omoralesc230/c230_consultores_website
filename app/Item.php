<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Item extends Model
{
  use HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'text', 'picture', 'section_id', 'order'
  ];

  public function section()
  {
    return $this->belongsTo('App\Section');
  }
}
