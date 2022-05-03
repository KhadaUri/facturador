<?php 
$empleado1='Juan Manuel Osorio Zamora';
$empleado2='Mercedes Ochoa';
$empleado3='Diego Israel';




 
 $host="localhost";
 $usuario="root";
 $contraseña="";
 $base="banana";

 $conexion = new mysqli($host,$usuario,$contraseña,$base);
 if ($conexion -> connect_errno) {
   die("fallo la conexion".$conexion->mysql_connect_errno().")".$conexion->mysqli_connect_error());
 }


$sql = "SELECT nombrep, precio
FROM  productos";
$result = $conexion->query($sql);
while ($row = mysqli_fetch_array($result)) {
  $nombrep = $row['nombrep'];

  
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Ejemplo de facturador con JSRender - Anexsoft </title>
		
        <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        
        <script src="assets/js/jquery.js"></script>
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="jumbotron">
                        Ejemplo de facturador con JSRender <?php echo $empleado1 ?> 
                    </h1>
                    
                    <div class="row">
                        <div class="col-xs-7">
                            <label for="empleado">Empleado:</label>

                                <select id="empleado" name="empleado" type="text" class="form-control" >
                                      <option value="<?php echo $empleado1 ?> "><?php echo $empleado1 ?> </option>
                                      <option value="<?php echo $empleado2 ?> "><?php echo $empleado2 ?> </option>
                                      <option value="<?php echo $empleado3 ?> "><?php echo $empleado3 ?> </option>
                                </select>

                                <form>
  Selecciona el producto
  <select id="pizza" onchange="mostrarprecio()">
    <option value="0" ></option>
    <option value="15">Mayonesa</option>
    <option value="150">Jamon</option>
    <option value="250">Queso</option>
  
  </select>
  <input type="text" id="precio" class="form-control" />
</form>

    
                            <input id="producto" class="form-control" type="text" placeholder="Nombre del producto" />
                        </div>
                        <div class="col-xs-2">
                            <input id="cantidad" class="form-control" type="text" placeholder="Cantidad" />
                        </div>
                        <div class="col-xs-2">
                      <!--       <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">S/.</span>
                              <input id="precio" class="form-control" type="text" placeholder="Precio" />
                            </div> -->
                        </div>
                        <div class="col-xs-1">
                            <button class="btn btn-primary form-control" id="btn-agregar">
                                 <i class="glyphicon glyphicon-plus"></i>
                            </button>
                        </div>
                    </div>
                    
                    <hr />
                    
                    <ul id="facturador-detalle" class="list-group"></ul>
                    
                    
                </div>
            </div>
        </div>
        
<script id="facturador-detalle-template" type="text/x-jsrender" src="">
    {{for items}}
    <li class="list-group-item">
        <div class="row">
            <div class="col-xs-7">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-danger form-control" onclick="facturador.retirar({{:id}});">
                            <i class="glyphicon glyphicon-minus"></i>
                        </button>
                    </span>
                    <input name="producto" class="form-control" type="text" placeholder="Nombre del producto" value="{{:producto}}" />
                </div>
            </div>
            <div class="col-xs-1">
                <input name="cantidad" class="form-control" type="text" placeholder="Cantidad" value="{{:cantidad}}" />
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">S/.</span>
                  <input name="precio" class="form-control" type="text" placeholder="Precio" value="{{:precio}}" />
                </div>
            </div>
            <div class="col-xs-2">
                <div class="input-group">
                    <span class="input-group-addon">S/.</span>
                    <input  class="form-control" type="text" readonly value="{{:total}}" />
                    <span class="input-group-btn">
<button class="btn btn-success form-control" onclick="facturador.actualizar({{:id}}, this);" class="btn-retirar">
    <i class="glyphicon glyphicon-refresh"></i>
</button>
                    </span>
                </div>
            </div>
        </div>
    </li>
    {{else}}
    <li class="text-center list-group-item">No se han agregado productos al detalle</li>
    {{/for}}

    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Sub Total
            </div>
            <div class="col-xs-2">
                <b>{{:subtotal}}</b>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                IGV (18%)
            </div>
            <div class="col-xs-2">
                <b>{{:igv}}</b>
            </div>
        </div>
    </li>
    <li class="list-group-item">
        <div class="row text-right">
            <div class="col-xs-10 text-right">
                Total
            </div>
            <div class="col-xs-2">
                <b>{{:total}}</b>
            </div>
        </div>
    </li>
</script>
        
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/js-render.js"></script>
        <script src="assets/js/facturador.js"></script>
 
	</body>
</html>
<script type="text/javascript">
function mostrarprecio() {
  var pizza = document.getElementById("pizza"),
     precio = document.getElementById("precio");

   
  precio.value = pizza.value;

   if (precio > "200") {
     document.getElementById("producto").value='Queso';
}

 if (precio < "199" && precio > "101") {
     document.getElementById("producto").value='Jamon';
}

if (precio < "100") {
     document.getElementById("producto").value='Mayonesa';
}

}
</script>