<script>
    $(document).ready(function() {

        $(document).ready(function(){
            $('.collapsible').collapsible();
        });
    });
</script>
<?php //if($banderaSesion){ ?>
<div class="row">
<div class=col s20 style="float:right;">
<div id='menu2'>


    <!------PONER ID ACTUAL AL QUE ESTES EDITANDO---------------->
    <div class="chip">
        <img src="images/persona.jpg" alt="Contact Person">
        <?php echo $_SESSION["acceso"][1]." ".$_SESSION["acceso"][2]; ?>
    </div>
    <ul class="collapsible" data-collapsible="accordion" style="display:inline-block;">
                        

        <li>
            <div class="collapsible-header"><i class="material-icons">person_pin</i>
                Mi Perfil
            </div>
            <div class="collapsible-body"><p> <a href="modificaContrasena.php">Modificar Contraseña</a></p></div>
        </li>

        <li>
            <div class="collapsible-header"><i class="material-icons">settings_power</i><a   href="controlador/logout.php">Cerrar Sesión</a></div>

        </li>
    </ul>




</div>
    </div>
</div>

<?php //} ?>