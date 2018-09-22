<!DOCTYPE html>
<html>
<title>@yield('title')</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
@section('style')
                    
@show
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<body class="w3-light-grey">
@section('modal')
                    
@show
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">
    
    
  <!-- The Grid -->
    <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-quarter">

            <div class="w3-white w3-text-grey w3-card-4 w3-margin-top">
                @section('sidebar')
                    
                @show
            </div><br>

        <!-- End Left Column -->
        </div>
            @section('content')
                    
            @show
        <!-- Right Column -->
        <div id="products_column" class="w3-threequarter">

        <!-- End Right Column -->
        </div>

    <!-- End Grid -->
    </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-teal w3-center w3-margin-top">
  <p>Created for tests</p>
  
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
</body>
<script type="text/javascript"> 
    function cartCounter(){
        $.get("/api/cart/count/{{{Session::getId()}}}", function(response, status){
            var success = response.success; 
            if(success){    
                var cart_counter = response.data.items; 
                $("#cart_counter").html(cart_counter);
            }

        });
    }
@section('scripts')
@show
cartCounter();
    function cartCounterUpdate(){
        setTimeout(cartCounter, 1000);
    }
</script>
</html>