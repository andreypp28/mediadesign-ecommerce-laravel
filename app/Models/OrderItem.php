<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    
    public $timestamps  = false;
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($order) { // before delete() method call this
             $order->options()->delete();
             $order->files()->delete();
             
             OrderItemDesignInfo::where('item_id', $item->id)->delete();
        });
    }
    
    public function files()
    {
        return $this->hasMany('App\Models\OrderItemFile', 'item_id');
    }
    
    public function filesBy($target=0)
    {
        return OrderItemFile::where('item_id', $this->id)
            ->where('target', $target)
            ->get();
    }
    
    public function features()
    {
        return OrderItemOption::where('item_id', $this->id)
            ->groupBy('feature_id')
            ->orderBy('feature_sort')
            ->get();
    }
    
    public function options()
    {
        return $this->hasMany('App\Models\OrderItemOption', 'item_id');
    }
    
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }  
    
    public function designInfo()
    {
        return OrderItemDesignInfo::where('item_id', $this->id)->first();
    }
    
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }
    
    public function stuff()
    {
        return $this->belongsTo('App\Models\Stuff', 'job_stuff_id');
    }
    
    public function assigner()
    {
        return $this->belongsTo('App\Models\Admin', 'job_assigned_by');
    }
    
    public function jobNumber()
    {
        return 'Job # ' . $this->job_number;
    }
    
    public function status_lang($label=false)
    {
        $lang = 'Uniassigned';
        $class = 'warning';
        if($this->job_status == JOB_WORKING)
        {
            $lang = 'Working';
            $class = 'success';
        }
        else if($this->job_status == JOB_COMPLETED)
        {
            $lang = 'Completed';
            $class = 'success';
        }
        
        if($label == false) return $lang;
        
        return "<label class='text-$class'>$lang</label>";
    }
    
    public static function newJobNumber()
    {
        $result = self::max('job_number');
        
        if($result == 0) $result = 100000;
        
        $result++;
        return $result;  
    }
    
    public function featureOptions($featureId)
    {
        return OrderItemOption::where('item_id', $this->id)
            ->where('feature_id', $featureId)
            ->orderBy('side_type')
            ->get();   
    }
    
    public function hasCustomSets()
    {
        $result = unserialize($this->custom_sets);
        if(count($result) > 0) return true;
        
        return false;
    }
    
    public function customSets()
    {
        return unserialize($this->custom_sets);
    }
}
