@extends('master')

@section('title', 'Products')

@section('style')
               
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
@endsection

@section('scripts')       
    $.get("/api/products", function(response, status){
        var success = response.success; 
        if(success){
            var data = response.data;
            var uuid,name,price,stock,content;
            $.each( data, function( key, value ) {
                uuid = value.uuid;
                name = value.name;
                price = value.price;
                stock = value.stock;
                
                content = `<div class="w3-container w3-col m3 w3-card w3-white w3-margin">
                                <div class="w3-container">
                                    <h5 class="w3-text-teal w3-padding-16">` + name + `</h5>
                                    <p class="w3-opacity">Price: <b>` + price + ` USD</b></p>
                                </div>
                                <hr>
                                <div class="w3-container">
                                        
                                        <a href="/product/` + uuid + `" class="w3-button w3-teal">View</a>
                                </div>
                                <br>
                            </div>`;
                $("#products_column").append(content);
            });
        }
        
    });
@endsection