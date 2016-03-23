<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Core\FrontController;
use App\Libraries\Template;
use App\Models\Customer;
use Input, Validator, Redirect;

class SettingController extends FrontController {
    protected $page_title = 'Order History';
    protected $page_menu = 'setting';
    public function __construct()
    {
        parent::__construct();
        
        // Check customer is logged in
        $this->auth->restrict();
    }

    ////////////////////////////////////////////////////////////////
    //Action Methods
    ////////////////////////////////////////////////////////////////
    public function index()
    {
        $page = 'account';
        return $this->view('customer.setting.account', compact('page'));
    }
    
    public function account()
    {
        $page = 'account';
        return $this->view('customer.setting.account', compact('page'));   
    }
    
    public function password()
    {
        $page = 'password';
        return $this->view('customer.setting.password', compact('page'));   
    }
    
    public function shipping()
    {
        $page = 'shipping';
        return $this->view('customer.setting.shipping', compact('page')); 
    }
    
    public function billing()
    {
        $page = 'billing';
        return $this->view('customer.setting.billing', compact('page'));    
    }
    
    ////////////////////////////////////////////////////////////////
    //Post Methods
    ////////////////////////////////////////////////////////////////   
    public function postAccount()
    {
        $userId = $this->current_customer->id;
        
        //validate posts
        $rules = [
            'first-name' => 'required', 
            'last-name'  => 'required', 
            'email'      => "required|email|unique:customers,email,$userId,id", 
            'phone'      => 'required', 
        ];
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $this->current_customer->first_name = Input::get('first-name');
        $this->current_customer->last_name  = Input::get('last-name');
        $this->current_customer->email      = Input::get('email');
        $this->current_customer->phone      = Input::get('phone');
        $this->current_customer->is_subscribed = Input::get('newsletter') ? 1 : 0;
        $this->current_customer->save();
        
        Template::set_message('Your account information is updated.', 'success');
        
        return redirect(route('customer.setting.account'));
    }
    
    public function postPassword() 
    {
        //validate posts
        $userId = $this->current_customer->id;
        $rules = [
            'current_password'  => "required|check_current_password:customers,id,$userId", 
            'password'          => 'required|min:4', 
            'password_confirm'  => 'required|same:password', 
        ];
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) 
        {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $salt = str_random(8);
        $this->current_customer->passsalt = $salt;
        $this->current_customer->password = md5($salt . Input::get('password'));
        $this->current_customer->save();
        
        Template::set_message('Your password is updated.', 'success');
        
        return redirect(route('customer.setting.password'));    
    }
    
    ////////////////////////////////////////////////////////////////
    // Private Functions
    ////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////
    // Ajax Functions
    ////////////////////////////////////////////////////////////////

}