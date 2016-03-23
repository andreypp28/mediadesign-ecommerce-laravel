<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Core\BasicController;
/*use Arkitecht\FedEx\Laravel\FedEx;

use Arkitecht\FedEx\Structs\RequestedShipment;   
use Arkitecht\FedEx\Structs\Party;
use Arkitecht\FedEx\Structs\Contact;
use Arkitecht\FedEx\Structs\Address;
use Arkitecht\FedEx\Structs\ContactAndAddress;
use Arkitecht\FedEx\Structs\Weight;
use Arkitecht\FedEx\Structs\Money;
use Arkitecht\FedEx\Structs\Payment;
use Arkitecht\FedEx\Structs\Payor;
use Arkitecht\FedEx\Structs\RequestedPackageLineItem;
use Arkitecht\FedEx\Structs\Dimensions;
use Arkitecht\FedEx\Structs\TransactionDetail;
use Arkitecht\FedEx\Structs\VersionId;

use Arkitecht\FedEx\Enums\DropoffType;
use Arkitecht\FedEx\Enums\PackagingType;
*/
use App\Libraries\FedexShipping;
use App\Libraries\MyCart;
use Omnipay\PayPal\Message\ExpressAuthorizeResponse;
use Omnipay;

class TestController extends BasicController 
{
    public function index()
    {
        $cart = MyCart::get();
        
        $params = array(
            'cancelUrl' => route('cart.checkout'),
            'returnUrl' => route('cart.checkout.purchaseCallback'),
            'amount'    => $cart->totalPrice(),
            'currency'  => 'USD',
        );
        
        $items = array();
        foreach($cart->items as $row)
        {
            $items[] = array(
                'name'      => $row->product_name,
                'quantity'  => 1,
                'price'     => $row->item_price
            );
        }
        
        Omnipay::setGateWay('paypal');
        $response = Omnipay::authorize($params)
            ->setItems($items)
            ->send();
        if($response->getTransactionReference())
        {
            $redirectUrl = $response->getRedirectUrl();
            return redirect($redirectUrl);                    
        }
        else
        {
             //Template::setMessage($response->getMessage(), 'danger');
        }
    }
    
    public function fedex()
    {
        /*$row = new FedexShipping;
        $row->setRecipient('Tomasz Nowak', 'Street1', 'Richmond', 'BC', 'V7C4V4', 'CA');
        $result = $row->getAvailableMethods();
        print_r($result);
        exit;*/
        
        /*$fedexConfig = array(
            'key'    => env('FEDEX_API_KEY', ''),
            'password'=> env('FEDEX_API_PASSWORD', ''),
            'account'=> env('FEDEX_ACCOUNT_NO', ''),
            'meter'  => env('FEDEX_METER_NO', ''),
            'beta'   => env('FEDEX_USE_BETA', ''),
        );
        $fedex = new FedEx($fedexConfig);
        
        $request = $fedex->rateRequest();
        $request->setTransactionDetail(new TransactionDetail(' *** Rate Request using PHP ***'));
        $request->setVersion(new VersionId('crs', '18', '0', '0'));
        $request->setReturnTransitAndCommit(true);
        
        $shipment = $this->_getRequestedShipment($fedexConfig);
        $request->setRequestedShipment($shipment);
        //print_r($request);
        //var_dump($shipment);
        
        
        $service = $fedex->rateService();
        //print_r($service);
        $response = $service->getRates($request);
        //print_r($service->getLastResponse());
        //print_r($service->getLastRequest());
        $reply = $this->_getShipmentMethods($response->getRateReplyDetails());
        print_r($reply);
        exit;  */
    }
    
    private function _getRequestedShipment($config)
    {
        //weight & dimension
        $weight = new Weight('KG', 1.0);
        $dimension = new Dimensions(108, 5, 5, 'IN');        
        
        //shipper
        $shipper = new Party();
        $shipper->setContact(new Contact(null, 'Tomasz Nowak'));
        $shipper->setAddress(new Address('Street1', 'Collierville', 'TN', '38017', '', 'US'));
        
        //recipient
        $recipient = new Party();
        $recipient->setContact(new Contact(null, 'Tomasz Nowak'));
        $recipient->setAddress(new Address('Street1', 'Richmond', 'BC', 'V7C4V4', '', 'CA'));
        
        //payor
        $payor = new Payor;
        //$payor->setResponsibleParty(new Party($config['account'], null, null, new Address('', '', '', '', '', 'US')));
        //$payor->setResponsibleParty(new Party($config['account']));
        
        //package item
        $requestedPackageLineItems = new RequestedPackageLineItem(1, 1, 1, null, null, $weight, $dimension, 'BOX');
        
        $result = new RequestedShipment();
        $result->setShipTimestamp(date('c'))
            ->setDropoffType(DropoffType::VALUE_REGULAR_PICKUP)
            //->setServiceType('INTERNATIONAL_ECONOMY')
            ->setPackagingType(PackagingType::VALUE_YOUR_PACKAGING)
            //->setVariationOptions($variationOptions)
            //->setTotalWeight($weight)
            //->setTotalInsuredValue(new Money('USD', 100))
            //->setPreferredCurrency($preferredCurrency)
            ->setShipper($shipper)
            ->setRecipient($recipient)
            //->setRecipientLocationNumber($recipientLocationNumber)
            //->setOrigin(new ContactAndAddress(new Contact(null, 'Tomasz Nowak', '', '', '23432432', '', '', '', '', 'sss@gmail.com'), new Address('Street1', 'Collierville', 'TN', '38017', '', 'US', 'United States')))
            //->setSoldTo($recipient)
            //->setShippingChargesPayment(new Payment('SENDER', $payor))
            //->setSpecialServicesRequested($specialServicesRequested)
            //->setExpressFreightDetail($expressFreightDetail)
            //->setFreightShipmentDetail($freightShipmentDetail)
            //->setDeliveryInstructions($deliveryInstructions)
            //->setVariableHandlingChargeDetail($variableHandlingChargeDetail)
            //->setCustomsClearanceDetail($customsClearanceDetail)
            //->setPickupDetail($pickupDetail)
            //->setSmartPostDetail($smartPostDetail)
            //->setBlockInsightVisibility($blockInsightVisibility)
            //->setLabelSpecification($labelSpecification)
            //->setShippingDocumentSpecification($shippingDocumentSpecification)
            //->setRateRequestTypes($rateRequestTypes)
            //->setEdtRequestType($edtRequestType)
            ->setPackageCount(1)
            //->setShipmentOnlyFields($shipmentOnlyFields)
            //->setConfigurationData($configurationData)
            ->setRequestedPackageLineItems($requestedPackageLineItems);
        return $result;
    }
    
    private function _getShipmentMethods($rateReply)
    {
        $result = array();
        
        if(is_array($rateReply))
        {
            foreach($rateReply as $row)
            {
                $item = (object)array();
                $item->serviceType = $row->ServiceType;
                $item->serviceName = trans('shipping.fedex.' . $row->ServiceType);
                $item->deliveryTimestamp = $row->DeliveryTimestamp;
                $item->transitTime = $row->TransitTime;                
                
                if(is_array($row->RatedShipmentDetails)) $item->amount = $row->RatedShipmentDetails[0]->ShipmentRateDetail->TotalNetCharge->Amount;
                else $item->amount  = $row->RatedShipmentDetails->ShipmentRateDetail->TotalNetCharge->Amount;                    
                    
                $result[$row->ServiceType] = $item;
            }
        }
        
        return $result;
    }
}