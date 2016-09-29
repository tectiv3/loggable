<?php
namespace tectiv3\Loggable;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Log extends Eloquent {

    protected $table = 'logs';

    protected $protected = ['id'];

    public function loggable() {
        return $this->morphTo();
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getModelName() {
        return $this->entity;
    }

} 