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

<div class="Shopper-information">
<div class="row">

<div class="col-sm-12 clearfix">
<div class="bill-to">
<p>Shipping/Bill To</p>
<div class="form-one"></div>
<form action="./createNewOrder" method="post">
                                {{csrf_field()}}					
									
			        	<input type="text" name="first_name"placeholder="First_Name *" required>
				        <input type="text" name="address" placeholder="Address 1 *"  required>
						<input type="text" name="last_name"placeholder="Last_Name *" required>
						<input type="text" name="phone"placeholder="Phone *" required>
						<input type="text" name="zip"placeholder="Zip / Postal Code *" required>
						<input type="text" name="email"placeholder="Email*" required>
							</div>
                                    <select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
                                    
                                    <button class="btn btn-defalut check_out "type="submit" name="submit">Proced To Payment</button>
                                    </form>
							</div>
                            <div class="form-two">
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div>
            </div>
            </section>
            <section id="do_action">
            <div class="contanier">
            <div class="heading">
            <o1>what would you like to do next ?</o1>
            <p>chhhhjiio</p>
            </div>
            <div class="row">
            <div class="col-sm-6">
            <div class="chose-area">
            <ul class="user_option">
            <li>
            <input type="checkbox">
            <label> Use Cupon Code</label>
            </li>
            <li>
            <input type="checkbox">
            <label> Use Gifit Voucher</label>
            </li>
            <li>
            <input type="checkbox">
            <label> Estimate Shipping & Taxes </label>
            </li>
            <ul class="user_info">
            <li class="single_field">
            <label>Coutry:</label>
            <select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
                                    </li>
                                    <li class="single_field">
                                    <label>Region/ State:</label>
                                    <select>
										<option> Select</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
                                   </li>
                                   <li class="single_field zip-field">
                                   <label>Zip Code</label>
                                   <input type="text">
                                   </li>
                                   </ul>
                                   <div class="col-sm- clearfix">
                                   <div class="total_area">

                                   <a class="btn btn-defalut update"href="">Get Quotes</a>
                                   <a class="btn btn-defalut check_out"href="">Continue</a>
                                   
                                   <a class="btn btn-defalut update" href="">Update</a>
                                   </div>
                                   </div>
                                   </div>
                                   </div>
                                   </div>
                                   </section>
                                   @endsection





