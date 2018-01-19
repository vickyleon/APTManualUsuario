<?php ob_start() ?>
    
<script type="text/javascript">
    $(document).ready(function() {
        $("#boton").click(function(e) {
                    alert("Buscaremos la contraseña en nuestra base de datos, si logramos encontrarla le enviaremos un correo electrónico")
                    $.ajax({
                        type: "post",
                        url: "app/templates/recover.php",
                        data: $("#formEmail").serialize(),
                        success: function(resp) {
                            if(resp==1){
                                alert("Se ha envidado un correo electronico con la contraseña a su cuenta");
                            }
                            else{
                                alert(resp);
                            }
                        }
                    });
                    return false;
                });
    });
</script>

<div class="Columnas">
	<article class="columna3">
    	<img src="web/img/user91(1).png" class="imgIndex">
        <h2>¿Quienes Somos?</h2>
        <p>Grupo de profesores de física en el país que tiene como interés la promoción de la física en todos los niveles. En el ámbito académico en los diferentes niveles educativos, su interés radica en mejorar el aprendizaje de los alumnos para que tengan herramientas. <a href="#QuienesSomos">Ver más</a></p>
        <!--#####################################################################################-->     
              
                 
        <div id="QuienesSomos" class="modalDialog">
        	<div class="Columnas">
            	<div class="noColumna">
                	<a href="#" title="Close" class="close">X</a> 
                    <h1><span class="icon-people"></span>¿QUIENES SOMOS?</h1> 
                    <p style="font-size:16px">Grupo de profesores de física en el país que tiene como interés la promoción de la física en todos los niveles. En el ámbito académico en los diferentes niveles educativos, su interés radica en mejorar el aprendizaje de los alumnos para que tengan herramientas con que contribuir de una manera más significativa en el desarrollo del país. También se interesa en la capacitación de profesores y abastecimiento de recursos educativos alternos que lleven a una mejor comprensión por parte de los alum-nos de los temas de física. En el nivel de la sociedad en general, les interesa que las personas aprecien la importancia de la física en el país y que puedan inducir a las nuevas generaciones a tener interés en el estudio de carreras que tengan que ver con la ciencia, en particular con la física.<br>
Las reuniones anuales buscan reunir a los profesores de Física de todos los niveles educativos para compartir experiencias, metodologías y avances de investigación.</p>	
					<img src="web/img/aaptmx.png" alt="AAPT-MX" width="35%" class="centrado">						
                </div>
            </div>
        </div>
                
        <!--#####################################################################################-->                             
    </article>
    <article class="columna3">
		<img src="web/img/clock125.png" class="imgIndex">
        <h2>Historia</h2>
        <p>La primera reunión de la AAPT-Mx se realizó en el 2008 en el Tecnológico de Monterrey, Campus Monterrey, y se ha continuado de manera anual desde entonces. <a href="#Historia">Ver más</a></p>
        <!--#####################################################################################-->     
                                 
        <div id="Historia" class="modalDialog">
        	<div class="Columnas">
            	<div class="noColumna">
                	<a href="#" title="Close" class="close">X</a> 
                    <h1><span class="icon-people"></span>Historia</h1> 	
					<img src="web/img/EnConstruccion.png" alt="AAPT-MX" width="100%" class="centrado">						
        		</div>
            </div>
        </div>
                
        <!--#####################################################################################-->
	</article>
    
    <article class="columna3">
    	<img src="web/img/add199.png" class="imgIndex">
    	<h2>Registro</h2>
    	<p>Registrate en AAPT-MX para poder tener acceso a material exclusivo. También podras registrarte a nuestros eventos y conocer la información detallada de estos. <a href="#Registro">Ver más</a></p>
    	<!--#####################################################################################-->     
                                 
    	<div id="Registro" class="modalDialog">
				    <a href="#" title="Close" class="close">X</a> 
                    <form name="formInsertar" action="index.php?ctl=registroSoc" method="POST" onSubmit="return validarDatosSocio()">
                    	<h1><span class="icon-mode_edit"></span>Registro Paso 1 de 3</h1> 	
                        <h2>Datos Personales</h2>
						<select id="cboPrefijo" name="cboPrefijo">
							<option value="-1">Seleccione una opción</option>
                            <option value="Dr.">Dr.</option>
                            <option value="M. en C.">M. en C.</option>
                            <option value="Ing.">Ing.</option>
                            <option value="Lic.">Lic.</option>
                            <option value="C.">C.</option>
                        </select>
                        <input id="txtNombre" type="text" placeholder="&#128054; Nombre completo" name="txtNombre" style="width: 95%" required>
                        <input id="txtEmail" type="email" placeholder="&#128231; Email" name="txtEmail" style="width: 95%" required>
                        <input id="txtPass" type="password" placeholder="&#128272; Password" name="txtPass" style="width: 95%" required>
                        <input id="txtPassConf" type="password" placeholder="&#128272; Confirmar password" name="txtPassConf" style="width: 95%" required>
                        <select id="cboEstudiante" name="cboEstudiante">
                        	<option value="-1">¿Es estudiante o profesor?</option>
                            <option value="0">Profesor</option>
                            <option value="1">Estudiante</option>
                        </select>
                        <select id="cboNivel" name="cboNivel">
                        	<option value="-1">¿En qué nivel imparte y/o toma clase?</option>
                            <option value="posgrado">Posgrado</option>
                            <option value="ns">Nivel Superior</option>
                            <option value="nms">Nivel Medio Superior</option>
                            <option value="basico">Básico</option>        
                        </select>
                        <select id="cboAviso" name="cboAviso">
                        	<option value="-1">¿Desea recibir nuestro boletín en su correo?</option>
                            <option value="1">Sí :D</option>
                            <option value="0">No :'(</option>
                        </select>
                        <input type="submit" value="Siguiente">
                        <?php if(isset($parametros['mensaje'])) :?>
 							<b><span style="color: red;"><?php echo $parametros['mensaje'] ?></span></b>
						<?php endif; ?>
					</form>						
	    </div>
        
        <div id="RegistroP2" class="modalDialog">
			<a href="#" title="Close" class="close">X</a> 
			<form name="formElegirInstitucion" method="post" action="index.php?ctl=mostrarEsc#RegistroP3" onSubmit="return validarDatosIns()">
				<h1><span class="icon-mode_edit"></span>Registro Paso 2 de 3</h1>
				<h2>Selecciona tu Institución</h2>
				<input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">
				<select id="idIns" name="idIns">
			    	<option value="-1">Selecciona una opción...</option>
				    <?php foreach ($parametros['instituciones'] as $ins) :?>
				    	<option value="<?php echo $ins['idInstitucion']?>"><?php echo $ins['siglas']?> - <?php echo $ins['nombre'] ?></option>
				    <?php endforeach; ?>
				</select>
			    <input type="submit" value="Siguiente">
			    <p> *Si no encuentras la institución a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroIns&mem=<?php echo $_GET['mem']?>#RegistroP2Ins">aquí</a>.</p>
			</form>
		</div>
        
        <div id="RegistroP3" class="modalDialog">
			<a href="#" title="Close" class="close">X</a> 
			<form name="formElegirEscuela" method="post" action="index.php?ctl=registroCom" onSubmit="return validarDatosEsc()">
				<h1><span class="icon-mode_edit"></span>Registro Paso 3 de 3</h1>
			    <h2>Selecciona tu Escuela</h2>
			    <input name="mem" type="hidden" value="<?php echo $_POST['mem']; ?>">
				<select id="idEsc" name="idEsc">
			    	<option value="-1">Selecciona una opción...</option>
				    <?php foreach ($parametros['escuelas'] as $school) :?>
				    	<option value="<?php echo $school['idEscuela']?>"><?php echo $school['nombre'] ?> - <?php echo $school['direccion']?></option>
				    <?php endforeach; ?>
				</select>
			    <input type="submit" value="Siguiente">
				<p> *Si no encuentras la escuela a la que perteneces puedes registrarla presionando clic <a href="index.php?ctl=registroEsc&idIns=<?php echo $_POST['idIns']?>&mem=<?php echo $_POST['mem']?>#RegistroP3Esc">aquí</a>.</p>
			</form>
		</div>
        
         <div id="RegistroP2Ins" class="modalDialog">
			<a href="#" title="Close" class="close">X</a>
        	<form action="index.php?ctl=registroIns" method="post">
            	<h1><span class="icon-mode_edit"></span>Registro Paso 2 de 3</h1>
			   	<h2>Registra tu institución</h2>
			    <input type="text" placeholder=" &#127979; Nombre de la institución (Ej. Instituto Politécnico Nacional)" name="txtInst" style="width: 95%" required> 
			    <input type="text" placeholder=" &#127979; Siglas (Ej. IPN)" name="txtSiglas" style="width: 95%" required>
			    <input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">    
			    <input type="submit" value="Siguiente">
			</form>       
		</div>
        
        <div id="RegistroP3Esc" class="modalDialog">
			<a href="#" title="Close" class="close">X</a> 
            <form action="index.php?ctl=registroEsc" method="post">
            	<h1><span class="icon-mode_edit"></span>Registro Paso 3 de 3</h1>
                <h2>Registra tu escuela</h2>
                <input type="text" placeholder=" &#127979; Nombre de la escuela" name="txtEsc" style="width: 95%" required> 
                <input type="text" placeholder=" &#128506; Dirección" name="txtDir" style="width: 95%" required>
                <input name="idIns" type="hidden" value="<?php if(isset($_GET['idIns'])) echo $_GET['idIns']; ?>">
                <input name="mem" type="hidden" value="<?php echo $_GET['mem']; ?>">
                <input type="submit" value="Siguiente">
            </form>
        </div>
        
        <div id="RegistroCompletado" class="modalDialog">
			<form>
              	<a href="#" title="Close" class="close">X</a> 
                <h1><span class="icon-people"></span>Registro Completado</h1> 
                <p style="font-size:16px">En breve te enviaremos un correo electrónico con tus datos.</p>
            </form>
         </div>
         
         <div id="Login" class="modalDialog">
			<a href="#" title="Close" class="close">X</a> 
            <form name="formLogin" action="index.php?ctl=login" method="POST">
               	<h1><span class="icon-mode_edit"></span>Inicia sesión</h1> 	
                <input id="txtEmailLogin" type="email" placeholder="&#128231; Email" name="txtEmailLogin" style="width: 95%" required>
                <input id="txtPassLogin" type="password" placeholder="&#128272; Password" name="txtPassLogin" style="width: 95%" required>
                <input type="submit" value="Iniciar sesión">
            	<?php if(isset($parametros['mensaje'])) :?>
	 			<b><span style="color: red;"><?php echo $parametros['mensaje'] ?></span></b>
				<?php endif; ?>
                <p>Si no tienes una cuenta, <a href="#Registro">registrate.</a></p>	
                <p><a href="#OlvideContra">¿Has olvidado tu contraseña?</a></p>
			</form>					
	    </div>
         
         <div id="OlvideContra" class="modalDialog">
			<a href="#" title="Close" class="close">X</a> 
            <form name="formEmail" id="formEmail" >
                <h1><span class="icon-mode_edit"></span>Recuperar Contraseña </h1> 	
                <input id="txtEmailLogin" type="email" placeholder="&#128231; Email" name="email" style="width: 95%" required>
                <input type="submit" value="Enviar" id="boton">
            	<?php if(isset($parametros['mensaje'])) :?>
	 			<b><span style="color: red;"><?php echo $parametros['mensaje'] ?></span></b>
				<?php endif; ?>
                <p>Si no tienes una cuenta, <a href="#Registro">registrate.</a></p>	
            </form>					
	    </div>
         
    	<!--#####################################################################################-->
                
    </article>
</div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>

