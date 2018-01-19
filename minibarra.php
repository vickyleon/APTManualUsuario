<script>
    $(document).ready(function() {

        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
    });
</script>
<?php if($banderaSesion){ ?>
<div class="row">
<div class=col s20 style="float:right;">
<div id='menu2'>


    <!------PONER ID ACTUAL AL QUE ESTES EDITANDO---------------->
    <div class="chip">
        <img src="images/persona.jpg" alt="Contact Person">
        <?php echo "".$usuario->getNombre().""; ?>
    </div>
    <ul class="collapsible" data-collapsible="accordion" style="display:inline-block;">
        <?php if($banderaEllos == false){ ?>

        <li>
            <div class="collapsible-header"><i class="material-icons">supervisor_account
                </i><a href="administrador.php">Administración</a></div>

        </li>
        <?php } 
                         $conexion = new connection();
                         $query="select * from cuestionario";
                         $conexion->conectar();
                         $conexion->myQuery($query);                    
        ?>   
        <li>
            <div class="collapsible-header"><i class="material-icons">message</i>Responder cuestionario</div>
            <div class="collapsible-body">

                <?php
                         while($rs=$conexion->getArrayFila())//Si me regresa tuplas significa que existen cuestionarios
                         {
                             echo " <p ><a style='border-bottom:1px solid #ddd;' href=\"cuestionario.php?id=".$rs['idCuestionario']."\">".$rs['nombre']."</a></p>";
                ?>

                <a class="" href="resultados.php?id=<?php echo $rs['idCuestionario'] ?>"> &#160; &#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160; &#160; &#160;  Resultado</a>


                <?php echo ""; } $conexion->desconectar();?>
            </div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">person_pin</i>
                Mi Perfil
            </div>
            <div class="collapsible-body"><p><a href="modificar.php">Modificar Datos</a><br> <a href="modcontra.php">Modificar Contraseña</a></p></div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">settings_power</i><a   href="controlador/logout.php">Cerrar Sesión</a></div>

        </li>
    </ul>




</div>
    </div>
</div>

<?php } ?>