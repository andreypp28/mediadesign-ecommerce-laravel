<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $table = 'orders';  
    
    protected static function boot() {
        parent::boot();

        static::deleting(function($order) { // before delete() method call this
             $order->items()->delete();
        });
    }
    
    public function items()
    {
        return $this->hasMany('App\Models\OrderItem', 'order_id');
    }
    
    public function number()
    {
        return 'OD' . $this->number;
    }
    
    public static function newNumber()
    {
        $result = self::max('number');
        
        if($result == 0) $result = 10000;
        
        $result++;
        return $result;  
    }
    
    public function isShippingRequired()
    {
        foreach($this->items as $item)
        {
            if($item->product_type != PRODUCT_DESIGN) return true;
        }    
        
        return false;
    }
}
