<!-- InstanceEndEditable -->
<?php if($banderaSesion){ ?>
<div id='menuLogueado'>
    <div id='menu2'>

        <ul>
            <!------PONER ID ACTUAL AL QUE ESTES EDITANDO---------------->
            <?php if($banderaEllos == false){ ?>
            <ul id="slide-out" class="side-nav">
                <li><div class="userView">
                    <div class="background">
                        <img src="images/fondo.png">
                    </div>
                    <a href="#!user" style="background-color:rgba(240, 248, 255, 0);"><img class="circle" src="images/persona.jpg"></a>
                    <a href="#!name" style="background-color:rgba(240, 248, 255, 0);"><span class="white-text name"><?php echo "".$usuario->getNombre().""; ?> </span></a>
                    <a href="#!email" style="background-color:rgba(240, 248, 255, 0);"><span class="white-text email"><?php echo "".$usuario->getEmail().""; ?> </span></a>
                    </div></li>
                <li><a href="administrador.php"><i class="material-icons">cloud</i>Administración</a></li>

                <?php } 
                         $conexion = new connection();
                         $query="select * from cuestionario";
                         $conexion->conectar();
                         $conexion->myQuery($query);                    
                ?>
                <li><div class="divider"></div></li>
                <li><a href="#!" class="subheader"><i class="material-icons">cloud</i></a></li>
                <?php
                         while($rs=$conexion->getArrayFila())//Si me regresa tuplas significa que existen cuestionarios
                         {
                             echo "<li><a href=\"cuestionario.php?id=".$rs['idCuestionario']."\">".$rs['nombre']."</a>";
                ?>

                <li><a class="" href="resultados.php?id=<?php echo $rs['idCuestionario'] ?>">&#160; &#160; &#160; &#160;  Resultado</a></li>


                <?php echo "</li>"; } $conexion->desconectar();?>
                <li><div class="divider"></div></li>
                <li><a href="modificar.php"><i class="material-icons">cloud</i>Mi Perfil</a></li>

                <li><a   href="controlador/logout.php">Cerrar Sesión</a></li>
                <li><div class="divider"></div></li>
                <li><a   href="controlador/logout.php"></a></li>
            </ul>
        </ul>  
        <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons" style="
            right: 5%; position: absolute;">menu</i></a>





    </div>
</div>
<?php } ?>