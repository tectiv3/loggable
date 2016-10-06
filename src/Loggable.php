<?php
namespace tectiv3\Loggable;

use tectiv3\Loggable\Models\Log;

trait Loggable {

    public function logs() {
        return $this->morphMany(Log::class, 'loggable', 'entity', 'entity_id');
    }

    public static function bootLoggable() {
        static::creating(function($model) {
            if (method_exists($model, 'beforeCreate')) {
                $model->beforeCreate();
            }
        });

        static::updating(function($model) {
            if (method_exists($model, 'beforeUpdate')) {
                $model->beforeUpdate();
            }
        });

        static::created(function ($model) {
		    Log::save_event($model, 'create');
        });

        static::updated(function ($model) {
            $attributes = $model->getDirty();
            unset($attributes['updated_at'], $attributes['updated']);
            if (empty($attributes)) return;
		    Log::save_event($model, 'update', 'Updated: ' . implode(',', array_keys($attributes)));
        });

        static::deleted(function($model) {
            Log::save_event($model, 'delete');
        });

        if (method_exists(get_class(), 'restored'))
            static::restored(function ($model) {
                Log::save_event($model, 'restore');
            });
    }
} 