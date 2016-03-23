<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class DesignPackage extends Model implements SluggableInterface
{
    use SluggableTrait;
    
    protected $table    = 'design_packages';
    
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'on_update'  => true,
    ];
    
    public function design()
    {
        return $this->belongsTo('App\Models\Design', 'design_id');
    }
}
