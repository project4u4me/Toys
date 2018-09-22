@extends('master')

@section('title', 'Product')

@section('style')
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
@endsection

@section('sidebar')
                <div class="w3-container">
                    <br>
                    <a href="/products" class="w3-button w3-white w3-block w3-left-align w3-hover-white">
                        <i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Home</a>
                    <hr>
                    <a href="/cart" class="w3-button w3-white w3-block w3-left-align w3-hover-white">
                        <i class="fa fa-shopping-cart fa-fw w3-margin-right w3-large w3-text-teal"></i>Carts
                        <span id="cart_counter" class="w3-tag w3-red w3-round"></span>
                    </a>
                    <br>
                </div>
@endsection

@section('content')
                <div class="w3-container w3-col m8 w3-card w3-white w3-margin">
                    <div class="w3-container">
                        <h3 id="product_name" class="w3-text-teal w3-padding-16"></h3>
                        <h6 class="w3-opacity">Regular Price: <b><span id="product_price"></span> USD</b></h6>
                        <br>
                        <h6 class="w3-opacity w3-text-red">Best Price: <b><span id="best_price"></span> USD</b></h6>
                        <h6 class="w3-opacity w3-text-teal">Max Discount: <b><span id="max_discount"></span> %</b></h6>
                        <br>
                        <p class="w3-opacity">Stock: <b><span id="product_stock"></span></b></p>
                    </div>
                    <hr>
                    <div class="w3-container">
                        <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
                        <form action="/api/cart/upadte/{{{Session::getId()}}}" method="post" onsubmit="cartCounterUpdate();" target="hiddenFrame">
                            <input class="w3-hide" type="text" name="uuid" value="{{$uuid}}">
                            <input id="best_price_input" class="w3-hide" type="text" name="best_price" value="">
                            <br>
                            <i class="fa fa-cart-plus fa-fw w3-margin-right w3-large w3-text-teal"></i>
                            <input id="stock_input" class="w3-medium" type="number" name="items" value="1" min="0" max="">

                            <input class="w3-button w3-small w3-teal" type="submit" value="Add">
                        </form> 
                        <script type="text/javascript"> 
                        </script>
                    </div>
                    <hr>
                    <div class="w3-container">
                        <h5 class="w3-text-teal w3-padding-16">Available discounts:</h5>
                        <table id="discounts" style="width:100%">
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Expired Date</th>
                            </tr>
                            
                        </table>
                    </div>
                    <br>
                    
                    <hr>
                    <div class="w3-container">

                            <a href="/products" class="w3-button w3-teal">Products</a>
                    </div>
                    <br>
                </div>
@endsection

@section('scripts')
        $.get("/api/product/{{{$uuid}}}", function(response, status){
            var success = response.success; 
            if(success){
                var data = response.data;
                var uuid = data.uuid;
                var name = data.name;
                var price = data.price;
                var max_discount = data.max_discount;
                var min_price = data.min_price;
                var stock = data.stock;

                $("#product_name").html(name);
                $("#product_price").html(price);
                $("#best_price").html(min_price);
                $("#max_discount").html(max_discount);
                $("#product_stock").html(stock);
                
                $("#best_price_input").val(min_price);
                $("#stock_input").attr({"max":stock});
                
                var v_uuid,v_code,v_start,v_end,d_uuid,d_value,d_name,content;
                $.each( data.vouchers, function( key, value ) {

                    v_uuid = value.uuid;
                    v_code = value.code;
                    v_start = value.start;
                    v_end = value.end;
                    d_uuid = value.discount.uuid;
                    d_value = value.discount.value;
                    d_name = value.discount.name;

                    content = `<tr>
                                    <td>` + v_code + `</td>
                                    <td>` + d_name + `</td>
                                    <td>` + v_end + `</td>
                                </tr>`;
                    $("#discounts").append(content);
                });
            }

        });
@endsection