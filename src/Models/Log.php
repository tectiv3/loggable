<?php
namespace tectiv3\Loggable\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Eloquent {

    use SoftDeletes;

    protected $table = 'logs';
    
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public function loggable() {
        return $this->morphTo('loggable', 'entity', 'entity_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function model() {
        return $this->entity::withTrashed()->find($this->entity_id) ?: $this->entity_id;
    }

    public static function save_event($model, $type, $notes = '') {
        $model->logs()->save(new self([
            'user_id'   => \Auth::id(),
		    'entity_id' => $model->id,
		    'entity'    => get_class($model),
		    'notes'     => $notes,
		    'action'    => $type
        ]));
    }

} 