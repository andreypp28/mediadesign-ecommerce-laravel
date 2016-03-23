<?php

namespace App\Http\Controllers\Admin\Catalog\Card;

use App\Http\Controllers\Admin\Catalog\Base\AbstractContentController;

class BusinessContentController extends AbstractContentController {

    protected $menu = 'business_card';
    protected $page = 'bc_content';
    protected $svc_type = SVC_BUSINESS_CARD;
    protected $page_title = 'Business Card';
    
    protected $base_route = 'admin.card.business.content';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    ////////////////////////////////////////////////////////////////
    //Action Methods
    ////////////////////////////////////////////////////////////////
    
    ////////////////////////////////////////////////////////////////
    //Post Methods
    ////////////////////////////////////////////////////////////////    
}