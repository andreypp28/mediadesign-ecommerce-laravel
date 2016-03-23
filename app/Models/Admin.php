<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    public function full_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    public function status_lang($label=false)
    {
        $lang = '';
        $class = '';
        if($this->is_active == STATUS_ACTIVE)
        {
            $lang = 'Active';
            $class = 'success';
        }
        else if($this->job_status == STATUS_INACTIVE)
        {
            $lang = 'InActive';
            $class = 'warning';
        }
        
        if($label == false) return $lang;
        
        return "<label class='text-$class'>$lang</label>";
    }
}
