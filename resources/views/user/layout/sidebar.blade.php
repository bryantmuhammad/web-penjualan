 <!-- ##### Right Side Cart Area ##### -->
 <div class="cart-bg-overlay"></div>

 <div class="right-side-cart-area">

     <!-- Cart Button -->
     <div class="cart-button">
         <a href="#" id="rightSideCart"><img src="essence/img/core-img/bag.svg" alt=""> <span>3</span></a>
     </div>

     <div class="cart-content d-flex">

         <!-- Cart List Area -->
         <div class="cart-list">
             <!-- Single Cart Item -->
             <div class="single-cart-item" style="height: 350px;">
                 <a href="#" class="product-image">
                     <img src="{{ asset('essence/img/product-img/product-1.jpg') }}" class="cart-thumb" alt="">
                     <!-- Cart Item Desc -->
                     <div class="cart-item-desc">
                         <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                         <span class="badge">Mango</span>
                         <h6>Button Through Strap Mini Dress</h6>
                         <div class="row">
                             <div class="input-group">
                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                     <span class="input-group-prepend">
                                         <button type="button" class="btn btn-outline-secondary btn-number"
                                             disabled="disabled" data-type="minus" data-field="quant[1]">
                                             <span class="fa fa-minus"></span>
                                         </button>
                                     </span>
                                 </div>
                                 <div class="col-lg-6 col-md-3 col-sm-12">
                                     <input type="text" name="quant[1]" class="form-control input-number"
                                         value="1" min="1" max="10">
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-12">

                                     <span class="input-group-append" style="margin-left: -15px;">
                                         <button type="button" class="btn btn-outline-secondary btn-number"
                                             data-type="plus" data-field="quant[1]">
                                             <span class="fa fa-plus"></span>
                                         </button>
                                     </span>
                                 </div>

                             </div>
                         </div>
                         <p class="size">Size: S</p>
                         <p class="color">Color: Red</p>
                         <p class="price">$45.00</p>
                     </div>
                 </a>
             </div>

             <!-- Single Cart Item -->
             <div class="single-cart-item">
                 <a href="#" class="product-image">
                     <img src="{{ asset('essence/img/product-img/product-2.jpg') }}" class="cart-thumb" alt="">
                     <!-- Cart Item Desc -->
                     <div class="cart-item-desc">
                         <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                         <span class="badge">Mango</span>
                         <h6>Button Through Strap Mini Dress</h6>
                         <p class="size">Size: S</p>
                         <p class="color">Color: Red</p>
                         <p class="price">$45.00</p>
                     </div>
                 </a>
             </div>

             <!-- Single Cart Item -->
             <div class="single-cart-item">
                 <a href="#" class="product-image">
                     <img src="{{ asset('essence/img/product-img/product-3.jpg') }}" class="cart-thumb" alt="">
                     <!-- Cart Item Desc -->
                     <div class="cart-item-desc">
                         <span class="product-remove"><i class="fa fa-close" aria-hidden="true"></i></span>
                         <span class="badge">Mango</span>
                         <h6>Button Through Strap Mini Dress</h6>
                         <p class="size">Size: S</p>
                         <p class="color">Color: Red</p>
                         <p class="price">$45.00</p>
                     </div>
                 </a>
             </div>
         </div>

         <!-- Cart Summary -->
         <div class="cart-amount-summary">

             <h2>Summary</h2>
             <ul class="summary-table">
                 <li><span>subtotal:</span> <span>$274.00</span></li>
                 <li><span>delivery:</span> <span>Free</span></li>
                 <li><span>discount:</span> <span>-15%</span></li>
                 <li><span>total:</span> <span>$232.00</span></li>
             </ul>
             <div class="checkout-btn mt-100">
                 <a href="checkout.html" class="btn essence-btn">check out</a>
             </div>
         </div>
     </div>
 </div>



 <!-- ##### Right Side Cart End ##### -->