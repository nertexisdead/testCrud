<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class PublishingService
{
    public function toggler(Model $model): Model
    {
        $model->is_active = !$model->is_active;
        $model->save();
        return $model;
    }
}
