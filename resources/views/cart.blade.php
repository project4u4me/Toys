@extends('master')

@section('title', 'Cart')

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
 /* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* The Close Button */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
} 
 /* Modal Header */
.modal-header {
    padding: 2px 16px;
    background-color: #009688 ;
    color: white;
}

/* Modal Body */
.modal-body {padding: 2px 16px;}

/* Modal Footer */
.modal-footer {
    padding: 2px 16px;
    background-color: #009688 ;
    color: white;
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 80%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    animation-name: animatetop;
    animation-duration: 0.4s
}
#myModal {
    display: none; /* Hidden by default */
    z-index: 100000;
}
/* Add Animation */
@keyframes animatetop {
    from {top: -300px; opacity: 0}
    to {top: 0; opacity: 1}
} 
@endsection

@section('modal')
    <!-- Modal content -->
    <div id ="myModal" class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Success</h2>
        </div>
        <div class="modal-body">
            <p>You have bought all items</p>
            <p>Items will be send by first rocket.</p>
        </div>
        <div class="modal-footer">
            <h3>See you...</h3>
        </div>
    </div> 
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
                    <br>
                    <div class="w3-container">
                        <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
                        @if (count($cart) > 0)
                            @foreach ($cart as $item)
                                        <form id="item_form_{{$item['uuid']}}" class="item_form" action="/api/cart/delete/{{{Session::getId()}}}" method="post" onsubmit="deleteItem('{{$item['uuid']}}');" target="hiddenFrame"> 
                                            <input class="w3-hide w3-medium" type="text" name="uuid" value="{{$item['uuid']}}">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width: 40%;">{{$item['name']}}</td>
                                                    <td style="width: 20%;">{{$item['quantity']}}</td>
                                                    <td style="width: 20%;">{{$item['value']}}</td>
                                                    <td style="width: 20%;"><input class="w3-button w3-small w3-circle w3-white w3-border" type="submit" value="-"></td>
                                                </tr>   
                                            </table>
                                        </form> 
                            @endforeach
                        @endif
                    </div>
                    
                    <hr>
                    <div class="w3-container">
                        <iframe name="hiddenFrame" width="0" height="0" border="0" style="display: none;"></iframe>
                        <form action="/api/cart/buy/{{{Session::getId()}}}" method="post" onsubmit="deleteItems();" target="hiddenFrame">
                            <input class="w3-button w3-small w3-red w3-right" type="submit" value="Buy">
                        </form> 
                    </div>
                    <br>
                </div>
@endsection

@section('scripts')
    function deleteItem(uuid){
        $("#item_form_" + uuid).remove();
        cartCounterUpdate();
    }
    
    // Get the modal
    var modal = document.getElementById('myModal');

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    } 
    
    function deleteItems(){
        $(".item_form").remove();
        modal.style.display = "block";
        cartCounterUpdate();
    }
@endsection