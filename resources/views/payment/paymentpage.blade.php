@extends('layouts.index')
@section('center')
<section id="cart_items">
<div class="container">
<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
</div>

<div class="shooper-inforamtion">
<div class="row">
<div class="col-sm-12 clearfix">
<div class="bill-to">

<p>Shipping/Bill to</p>

<div class="form-one">
<div class="total_area">
<ul>
<li>Payment Status
@if($payment_info['status']== 'on_hold')

<span>not paid yet</span></li>
@endif
<li>Shipping cost<span>free</span></li>

<li>Total<span>{{$payment_info['price']}}</span></li>
</ul>
<a class="btn btn-default update" href="">update</a>
<a class="btn btn-default check_out"id="paypal-button">paynow</a>
</div>
</div>
<div class="form-two">
</div>
</div>
<div>
</div>
</div>
</div>
</section>
@endsection



<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
  paypal.Button.render({
    // Configure environment
    env: 'production',
    client: {
      sandbox: 'client _id',
      production: 'Ad_XTFgu0IRxPDkCa9ELNIizK0a3eqTSaeZS9HDuKnC5zVUOrzMy2mxKr_lXMvNrqahfnp9Vl9odug9F'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: "{{$payment_info['price']}}",
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
        window.location = './paymentreceipt/'+data.paymentID+'/'+data.payerID;
      
      });
    }
  }, '#paypal-button');

</script>