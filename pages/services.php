<style type="text/css">
    ul.products-wrp {
    list-style: none;
    padding: 0;
    max-width: 650px;
    margin-left: auto;
    margin-right: auto;  
    color: #777;  
    text-align: center;
}
ul.products-wrp li{
    display: inline-block;
    border: 1px solid #ECECEC;
    margin: 5px;
    background: #fff;
    text-align: center;
}
ul.products-wrp li h4{
    margin: 0;
    padding: 15px 5px 5px 5px;
    text-align: center;
    border-bottom: 1px solid #FAFAFA;
}
ul.products-wrp li .item-box{
    border: 1px solid #EAEAEA;
    background: #F9F9F9;
    margin: 5px;
    padding: 5px;
    text-align: left;
}
ul.products-wrp li .item-box div{
    margin-bottom:5px;
}
ul.products-wrp li .item-box button{
    margin-left: 5px;
    background: #FA1C5F;
    border: none;
    padding: 3px 8px 3px 8px;
    color: #fff;
}
ul.products-wrp li .item-box button[disabled=disabled]{
    background: #FC84A8;
}

.cart-box {
    float: right;
    display: block;
    width: 70px;
    background: #32c5d2 url(pages/cart-icon.png) no-repeat 20px 5px;
    padding: 4px 8px 4px 8px;
    border-radius: 30px;
    color: #fff;
    font-family: Arial;
    font-size: 16px;
    text-decoration: none;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.32);
    margin-right: auto;
    margin-left: auto;
    font-weight: bold;
}
.cart-box:hover{
    background: #111 url(pages/cart-icon.png) no-repeat 20px 5px;
    color: #fff;
}
.shopping-cart-box {
    z-index: 5;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    max-width: 450px;
    color: #fff;
    background: #2b3643;
    border-radius: 4px;
    padding: 10px;
    font: small Verdana, Geneva, sans-serif;
    margin-top: 10px;
    display: none;
}
.shopping-cart-box a{
    color: #fff;
    text-decoration:none;
}
/*puntero señalador */
/*.shopping-cart-box:after {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -8px;
    width: 0; height: 0;
    border-bottom: 8px solid rgba(255, 0, 97, 1);
    border-right: 8px solid transparent;
    border-left: 8px solid transparent;
}*/
.shopping-cart-box ul.cart-products-loaded{
    margin: 0;
    padding: 0;
    list-style: none;
}
.shopping-cart-box .close-shopping-cart-box{
  float: right;
}
#shopping-cart-results ul.cart-products-loaded li{
    background: #28303b;
    margin-bottom: 1px;
    padding: 6px 4px 6px 10px;
}
.shopping-cart-box .remove-item{
    float:right;
    text-decoration:none;
}
.shopping-cart-box .cart-products-total{
    font-weight: bold;
    text-align: right;
    padding: 5px 0px 0px 5px;
}
.shopping-cart-box h3{
    margin: 0;
    padding: 0px 0px 5px 0px;
}

ul.view-cart {
  width: 600px;
  margin-left: auto;
  margin-right: auto;
  background: #fff;
  padding: 15px 15px 15px 25px;
  list-style: none;
}

ul.view-cart {
  width: 600px;
  margin-left: auto;
  margin-right: auto;
  background: #fff;
  padding: 15px 15px 15px 25px;
  list-style: none;
  border: 1px solid #ECECEC;
  border-radius: 4px;
}
ul.view-cart li span{
    float: right;
}
ul.view-cart li.view-cart-total{
  border-top: 1px solid #ddd;
  padding-top: 5px;
  margin-top: 5px;
  text-align: right;
}
hr{
    border: 0;
    height: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
    border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}


.botonmio {
    color: #FFFFFF;
    background-color: #2bb8c4;
    clear: both;
    display: block;
    padding: 6px 10px 6px 10px;
    position: relative;
    text-transform: uppercase;
    font-weight: 300;
    font-size: 11px;
    /* opacity: 0.7; */
    border: none;
    filter: alpha(opacity=70);
}
</style>

<h3 class="page-title"> Productos
                        <small>Seleccione el Producto que vas a solicitar</small>
                         <a href="?mod=view_cart" style=" float: right;"  title="Revisar carro para generar factura ">Generar Recibo</a>
</h3>

           

            <a href="#" class="cart-box " id="cart-info" title="ver carrito"> 
            <?php 
            if(isset($_SESSION["products"])){
                echo count($_SESSION["products"]); 

            }else{
                echo 0; 
               
            }
            ?>

            </a>

    <div style="border-radius: 15px !important" class="shopping-cart-box col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <a href="#" class="close-shopping-cart-box" >x</a>
        <h3>Productos Seleccionados</h3>
            <div id="shopping-cart-results">
            </div>
    </div>
        <div class="row">



<!-- 
            <?php
                $consulta="SELECT * FROM service";
                $bd->consulta($consulta);
                while ($fila=$bd->mostrar_registros())
                { 
            ?>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            <span data-counter="counterup" data-value="549"><?php echo $fila->price_service; ?> Bs</span>
                                        </div>
                                        <div class="desc"><?php echo $fila->name_service; ?></div>
                                        
                                    </div>
                                    <a title=" <?php echo $fila->info_service; ?>" class="more" href="?mod=administrador&editar&codigos=<?php echo $fila->id_service; ?>"> Pagar
                                        <i class="m-icon-swapright m-icon-white"></i>
                                    </a>
                                </div>
                    </div>                        
                    
                <?php 
                } ?> -->
<div class="col-lg-11 col-md-11 col-sm-12 col-xs-12" >
<?php
//List products from database
$results = $mysqli_conn->query("SELECT * FROM service where cantida > 0 ");
//Display fetched records as you please

$products_list =  '';

while($row = $results->fetch_assoc()) {
$products_list .= <<<EOT

<form class="form-item">

    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="dashboard-stat green">
                                    <div class="visual">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="details">
                                        <div class="number">
                                            
                                        </div>
                                        <div class="desc">{$row["name_service"]}</div>
                                        
                                    </div>
                                    <div class="more">  <input name="id_service" type="hidden" value="{$row["id_service"]}">
                                    <p style="color:white;">Disponibles: {$row["cantida"]}</p>
<label style="color:white;">Cantidad:</label>
<input name="product_qty" 
       type="number" 
       min="1" 
       max="{$row["cantida"]}" 
       value="1" 
       required 
       style="color: black; background-color: white; border: 1px solid #ccc; padding: 4px; border-radius: 4px; width: 60px;">

    <button class="botonmio" type="submit">Agregar a carrito  </button>
                                       

                                    </div>
                                </div>
                    </div>                        

</form>

EOT;

}
$products_list .= '</div>';

echo $products_list;
?>


    </div>
</div>
</div>
<script>
$(document).ready(function(){   
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Agregando...'); //Loading button text 

            $.ajax({ //make ajax request to cart_process.php
                url: "pages/cart_process.php",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data){ //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('Agregar a carrito'); //reset button text to original text
                alert("se ha agregado correctamente a tu lista de pedidos"); //alert user
                if($(".shopping-cart-box").css("display") == "block"){ //if cart box is still visible
                    $(".cart-box").trigger( "click" ); //trigger click to update the cart box.
                }
            })
            e.preventDefault();
        });

    //items en carro
    $( ".cart-box").click(function(e) { //when user clicks on cart box
        e.preventDefault(); 
        $(".shopping-cart-box").fadeIn(); //display cart box
        $("#shopping-cart-results").html('<img src="images/ajax-loader.gif">'); //show loading image
        $("#shopping-cart-results" ).load( "pages/cart_process.php", {"load_cart":"1"}); //Make ajax request using jQuery Load() & update results
    });
    
    //cerrar carro
    $( ".close-shopping-cart-box").click(function(e){ //user click on cart box close link
        e.preventDefault(); 
        $(".shopping-cart-box").fadeOut(); //close cart-box
    });
    
    //Remover productos del carrito
    $("#shopping-cart-results").on('click', 'a.remove-item', function(e) {
        e.preventDefault(); 
        var pcode = $(this).attr("data-code"); //hacer get del codigo 
        $(this).parent().fadeOut(); //remover item del formulario 
        $.getJSON( "pages/cart_process.php", {"remove_code":pcode} , function(data){ //get Item count from Server
            $("#cart-info").html(data.items); //update Item count in cart-info
            $(".cart-box").trigger( "click" ); //trigger click on cart-box to update the items list
        });
    });

});
</script>