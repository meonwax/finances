<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

  protected $table = 'category';

  public function expenses() {
    return $this->hasMany('App\Model\Expense');
  }
}
