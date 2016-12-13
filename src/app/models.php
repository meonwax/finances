<?php
class Category extends \Illuminate\Database\Eloquent\Model {
  protected $table = 'category';

  public function expenses() {
    return $this->hasMany('Expense');
  }
}

class Person extends \Illuminate\Database\Eloquent\Model {
  protected $table = 'person';

  public function expenses() {
    return $this->hasMany('Expense');
  }
}

class Expense extends \Illuminate\Database\Eloquent\Model {
  protected $table = 'expense';

  public function category() {
    return $this->belongsTo('Category');
  }

  public function person() {
    return $this->belongsTo('Person');
  }
}
