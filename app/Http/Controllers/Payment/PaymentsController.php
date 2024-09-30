<?php

namespace App\Http\Controllers\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class PaymentsController extends Controller
{
    //
    public function index(){
        $products = Product::paginate(3);

        return view("allproducts",compact("products"));
    }

    public function showPaymentPage(){
        $payment_info = Session::get('payment_info');
        //has not paid yet
        if($payment_info ['status'] == 'on_hold'){            
            return view('payment/paymentpage',['payment_info'=>$payment_info]);
//cart is empty
        }else{
            
            return redirect()->route("error"); 

        }
    }
  
    public function validate_payment(){
        $paypalEnv ='sandbox';//orprodtion
        $paypalURL ='https://api.paypal.com/v1/';
        $paypalClientID ='Ad_XTFgu0IRxPDkCa9ELNIizK0a3eqTSaeZS9HDuKnC5zVUOrzMy2mxKr_lXMvNrqahfnp9Vl9odug9F';
        $paypalSecret ='EEHo8QJQvZQURMTHsyjyAD68OsLkAq551roNkwChIf3a576cV3Zuad3vdFWP8Z3AdmmHTq4nxHB9tCsb';
        
        
        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $paypalURL.'oauth2.0/token');
        curl_setopt($ch, CURLOPT_HEADER,false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_USERPWD,$paypalClientID.":".$paypalSecret);
        curl_setopt($ch, CURLOPT_POSTFIELDS,"GRANT_TYPE=client_credentials");
        $response = curl_exec($ch);
        curl_close($ch);
        
        if(empty($response)){
            return false;
        }else{
            $jsonData =json_decode($response);
            $curl= curl_init($paypalURL.'payments/payment/.$paypalPaypalID');
            curl_setopt($curl, CURLOPT_POST,false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);
            curl_setopt($curl, CURLOPT_HEADER,false);    
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_HTTPHEADER ,array(
                'Authorization:Bearer'.$jsonData->access_token,
                'Accept:application/json',
                'Content-Type:application/xml'
            ));

            $response=curl_exec(curl);
            curl_close($curl);
            //transaction data
            $result=json_decode($response);
            return $result;
    
    
    
        }
    }    
        private function storePaymentInfo($paypalPaymentID,$paypalPayerID){
            $payment_info= Session::get('payment_info');
            $order_id = $payment_info['order_id'];
            $status = $payment_info['status'];
            $paypal_payment_id = $paypalPaymentID;
            $paypal_paypal_id = $paypalPayerID;

            if($status=='on_hold'){
                //create issue a new payment row in payment table
                $date=date('Y-m-d H:i:s');
                $newPaymentArray=array ("order_id"=>$order_id,"date"=>$date,"amount"=>$payment_info['price'],
                "paypal_payment_id"=>$paypal_payment_id,"paypal_payer_id"=>$paypal_paypal_id);
                $created_order=DB::table("payments")->insert($newPaymentArray);
                //update statusinto paid
                DB::table('orders')->where('order_id',$order_id)->update(['status'=>'paid']);
            }
        }


    public function showPaymentReceipt($paypalPaymentID,$paypalPayerID){
        if(!empty($paypalPaymentID) &&!empty($paypalPayerID)){
            //will retur json contain transaction 
            $this->validate_payment($paypalPaymentID,$paypalPayerID);
    
            $this->storePaymentInfo($paypalPaymentID,$paypalPayerID);
    
            $payment_receipt=Session::get('payment_info');
    
            $payment_receipt['paypal_payment_id']=$paypalPaymentID;
    
            $payment_receipt['paypal_payer_id']=$paypalPayerID;
            //delete payment info from session
            Session::forget("payment_info");
            return view('payment.paymentreceipt',['payment_receipt'=>$payment_receipt]);
        }else{
            return redirect()->route("allproducts");
        }
        
        
        }

      
        


        public function createNewOrder(){
           $cart =Session::get('cart');
           $first_name=$request->input('first_name');
           $address=$request->input('address');
           $last_name=$request->input('last_name');
           $zip=$request->input('zip');
           $phone=$request->input('phone');
           $email=$request->input('email');
            //cart isnot empty
            if($cart){
                //dump($cart)
                $date= date('y-m-d h:i:s');
                $newOrderArray= array("status"=>"on_hold","date"=>$date,"del_date"=>$date,"price"=>$cart->totalPrice);
                $created_order=DB::table("orders")->insert($newOrderArray);
                $order_id = DB::getpdo()->lastInsertId();;

                foreach($cart->items as $cart_item){
                    $item_id=$cart_item['data']['id'];
                    $item_name=$cart_item['data']['name'];
                    $item_price=$cart_item['data']['price'];
                    $newItemsInCurrentOrder=array("item_id"=>$item_id,"order_id"=>$order_id,"item_name"=>$item_name,"item_price"=>$item_price);
                    $created_order_items=DB::table("order_items")->insert($newItemsInCurrentOrder);
                }
                //delete cart
                Session::forget("cart");
                session::flush();
                print_r($newOrderArray);
                //
      //          return redirect()->route("allProducts")->withsuccess("Thanks for Choosing Us ");
            }else{
                //return redirecct()->route("allProducts");
            print_r('error');
            }


            }
        }




