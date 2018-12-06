<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Section extends Model
{
  use HasApiTokens;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'type', 'description', 'text', 'order', 'post_id'
  ];

  public function post()
  {
    return $this->belongsTo('App\Post');
  }

  public function items()
  {
    return $this->hasMany('App\Item');
  }
}
