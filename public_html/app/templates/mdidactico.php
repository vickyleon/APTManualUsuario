<?php ob_start(); 
        //session_start();
        $sesion = new Sesion();
        $usuario = $sesion->getSesion('login');
        $socio = $sesion->getSesion('socio');
        $mem=$socio->getNoMembresia();
        if($usuario!=false){
          $tablasin="";
          $tablacon="";

        $tablasin="
 <table class='responsive-table'>
        <thead>
          <tr>
              <th data-field='material'>Material</th>
              <th data-field='usuario'>Subido por</th>
              <th data-field='tamano'>Tamaño</th>
              <th data-field='fecha'>Fecha</th>
              <th data-field='descarga'>Descarga</th>";
              $tablacon.=$tablasin;
              $tablacon.="<th data-field='descarga'>Eliminar</th>";
              $tablasin.="</tr></thead><tbody>";
    $tablacon.=" </tr></thead><tbody>"; 
  ?>
    <?php
		$mysqli= new mysqli("aapt-mx.org","aaptmx","ylatesis?","aaptmx_db_prueba") ;
		if (mysqli_connect_errno())
		{
		    	printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
	    		exit();
		}
		$query = "SELECT m.Nombre, s.prefijo, s.nombreCompleto, m.Tamano, m.Fecha, m.Paths FROM socio s, material m WHERE m.noMembresia = s.noMembresia order by m.Fecha;";
		$result = mysqli_query($mysqli,$query);
    
		while ($line = mysqli_fetch_array($result, MYSQLI_BOTH)) 
		{
		//echo $line [0]; YA FUNCIONA 

      //agrego un tokenizer para eliminar partes del path que no quiero
      
		    $tablasin.="<tr>";
		    $tablasin.="<td>$line[0]</td><td>$line[1] $line[2]</td><td>$line[3]</td><td>$line[4]</td>";
		    $tablasin.="<td><a href='/app/templates/docs/$line[0]' download> <img style='width: 61px;' src='app/templates/css/imagenes/descarga.png'></a> </td>";
        $tablacon.="<tr>";
        $tablacon.="<td>$line[0]</td><td>$line[1] $line[2]</td><td>$line[3]</td><td>$line[4]</td>";
        $tablacon.="<td><a href='/app/templates/docs/$line[0]' download> <img style='width: 61px;' src='app/templates/css/imagenes/descarga.png'></a> </td>";
        $tablacon.="<td><form action='' method='POST' style=' margin: inherit;    background: white;    padding: initial;    border: 0px; '><input type='image' style='width: 61px;' src='app/templates/css/imagenes/delete1.ico' name='valor' value='$line[5]' /> </form></td>";
        $tablasin.="</tr>";
        $tablacon.="</tr>";
		}
     if($mem==9 || $mem==19 || $mem==22 || $mem==5){
        echo $tablacon;
     }
     else{
        echo $tablasin;
     }

	?>		
        </tbody>
      </table>
      <?php

        
	

        if($mem==9 || $mem==19 || $mem==22 || $mem==5){

      ?>
      <center>
      <div class="amazingcarousel-item-container">
      <div class="amazingcarousel-image"><a href="app/templates/material.php" title="" class="html5lightbox" data-group="amazingcarousel-1" data-width="500" data-height="350">
      <img src="app/templates/css/imagenes/subirm.png">
      </a></div>
      </div>
      </center>      
    <?php
        if(isset($_POST['valor'])){
           // echo $_POST['valor'];
          if(unlink($_POST['valor'])){
              //echo "lo logre";
              $path=$_POST['valor'];
              $query="DELETE from material where Paths like('%$path%');";
              $result = mysqli_query($mysqli,$query);
              echo "<script> alert (\"Se ha eliminado el archivo con éxito\"); </script>"; 
              echo "<script language=Javascript> location.href=\"index.php\"; </script>"; 
              die(); 
          }
        
        }
      }
    }
  
    ?>
    


<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>
