<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Http\Controllers\Core\AdminController;
use App\Libraries\Template;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemPrice;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Country;
use App\Models\Region;
use App\Models\Card;
use App\Models\CardPrice;
use App\Models\CardFeature;
use App\Models\CardOption;
use App\Models\CardQuantity;
use App\Models\Stuff;
use Input, URL, Request, Validator, Session, DB;

class OrderController extends AdminController {

    protected $menu = 'sales';
    protected $page = 'order';
    protected $page_title = 'Orders';
    
    protected $list_route = 'admin.sales.order.list';    
    public function __construct()
    {
        parent::__construct();
    }
    
    ////////////////////////////////////////////////////////////////
    //Action Methods
    ////////////////////////////////////////////////////////////////
    public function index()
    {
        //get orders
        $this->saveSorting();
        
        $order = Request::input('order');
        $orderby = Request::input('orderby') == 'asc'? 'asc': 'desc';
        switch($order)
        {
            case 'shipping_name':
            case 'shipping_email':
            case 'created_at':
            case 'total_price':
            case 'status':
                break;
            
            default:
                $order = 'created_at';
                $orderby = 'desc';
                break;
        }
        
        $stuffs = array();
        
        $orders = Order::orderBy('created_at', 'desc')
            ->paginate($this->list_limit);  
        
        return $this->view('sales.order.index', compact('orders', 'stuffs'));         
    }
    
    public function create()
    {
        
    }
    
    public function detail($id)
    {
        $order = Order::find($id);
    }
    
    public function delete($id)
    {
        Order::destroy($id);
        
        return redirect($this->listUrl());
    }
    
    public function item($item_id)
    {
        //get all stuff list
        $stuffs = Stuff::Select('id', DB::raw('CONCAT(first_name, " ", last_name) AS name'))
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get()
            ->toArray();
        $stuffs = ['' => 'Assign this job to...'] + array_convert2to1($stuffs, 'id', 'name');
        
        $item = OrderItem::find($item_id);
        
        return $this->view('sales.order.item', compact('item', 'stuffs'));   
    }
    
    ////////////////////////////////////////////////////////////////
    //Post Methods
    ////////////////////////////////////////////////////////////////
    
    public function assign()
    {    
        
    } 

    ////////////////////////////////////////////////////////////////
    //Ajax Actions
    ////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////
    //Private Methods
    ////////////////////////////////////////////////////////////////      
}