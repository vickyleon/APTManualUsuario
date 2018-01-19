				
				function capPaterno()
				{
					var apP = formUsuario.txtApPat.value;
					var apPa="";				
					apP=apP.replace(/[0-9]/g,"");
					var stringArray = new Array();
					stringArray = apP.split(" ");
					for (i = 0; i < stringArray.length; i++) {
						if(i==(stringArray.length-1)){
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							apPa+=stringArray[i];
						}
						else{
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							apPa+=stringArray[i]+" ";
						}
					}
					txtApPat.value =apPa;
				}
				function capMaterno()
				{
					var apM = formUsuario.txtApMat.value;
					var apMa="";				
					apM=apM.replace(/[0-9]/g,"");
					var stringArray = new Array();
					stringArray = apM.split(" ");
					for (i = 0; i < stringArray.length; i++) {
						if(i==(stringArray.length-1)){
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							apMa+=stringArray[i];
						}
						else{
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							apMa+=stringArray[i]+" ";
						}
					}
					txtApMat.value =apMa;
				}
				function cnombre()
				{				
					var nom = formUsuario.txtNombre.value;
					var nomb="";				
					nom=nom.replace(/[0-9]/g,"");
					var stringArray = new Array();				
					stringArray = nom.split(" ");
					for (i = 0; i < stringArray.length; i++) {
						if(i==(stringArray.length-1)){
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							nomb+=stringArray[i];
						}
						else{
							stringArray[i]=stringArray[i].charAt(0).toUpperCase()+ (stringArray[i].slice(1)).toLowerCase();
							nomb+=stringArray[i]+" ";
						}
					}
					txtNombre.value =nomb;
				}
				function cemail()
				{
					var email1 = formUsuario.txtEmail.value;
					var email2 = formUsuario.txtEmail2.value;
					if(email1==email2 && (email1!="" || email2!=""))
					{
						document.getElementById("labelEmail").style.color="green";
						document.getElementById("labelEmail").textContent= "Los correos coinciden.";				
						document.formUsuario.Registrar.disabled=false;
					}
					else
					{
						document.getElementById("labelEmail").style.color="red";
						document.getElementById("labelEmail").textContent= "Los correos no coinciden.";				
						document.formUsuario.Registrar.disabled=true;
					}
				}
				function pass(){
					var password1 = formUsuario.txtPwd.value;
					var password2 = formUsuario.txtPwd2.value;
				
					if(password2.length>password1.length && password1.length>5){
						document.getElementById("labelPassC").style.color="red";
						document.getElementById("labelPassC").textContent= "Las contraseñas no coinciden.";				
						document.formUsuario.Registrar.disabled=true;
					}
					if(password1.length<6 && password1.length>0){
						document.getElementById("labelPass").style.color="red";				
						document.getElementById("labelPass").textContent= "Contraseña muy corta";
						document.formUsuario.siguiente.disabled=true;
					}
					if(!(password1.length<6 && password1.length>0) && !(password2.length>password1.length && password1.length>5)){
						document.getElementById("labelPass").style.color="white";
						document.getElementById("labelPass").textContent= ".";
						document.formUsuario.Registrar.disabled=true;
					}
					if(password2.length<password1.length && password2.length>0){
						document.getElementById("labelPassC").style.color="red";
						document.getElementById("labelPassC").textContent= "Contraseña de confirmación muy corta";
						document.formUsuario.Registrar.disabled=true;
					}
					if(!(password2.length<password1.length && password2.length>0) && !(password2.length>password1.length && password1.length>5)){
						document.getElementById("labelPassC").style.color="white";
						document.getElementById("labelPassC").textContent= ".";
						document.formUsuario.Registrar.disabled=true;			
					}
					if(!(password2.length<password1.length) && !(password1.length<6) && password2.length>0 && password1==password2){
						document.getElementById("labelPassC").style.color="green";
						document.getElementById("labelPassC").textContent= "Las contraseñas coinciden.";
						document.formUsuario.Registrar.disabled=false;
					}
					if(!(password2.length<password1.length) && !(password1.length<6) && password2.length>0 && !(password1==password2)){
						document.getElementById("labelPassC").style.color="red";
						document.getElementById("labelPassC").textContent= "Las contraseñas no coinciden.";			
						document.formUsuario.Registrar.disabled=true;
					}
				}
				function cfecha()
				{
					var fecha = formUsuario.txtFechaNac.value;		
					var pFecha="^(19[0-9]{2}|20[0-1]{1}[0-9]{1})[-](0[1-9]|1[0-2])[-](0[0-9]|1[0-9]|2[0-9]|3[0-1])$";	
					pFechaExp = new RegExp(pFecha);
			
					if(fecha.length==10 && fecha.match(pFechaExp))
					{
						document.getElementById("labelFN").style.color="green";
						document.formUsuario.Registrar.disabled=false; 
					}
					else
					{
						document.getElementById("labelFN").style.color="red";
						document.formUsuario.Registrar.disabled=true;
					}
				}
				function cinstitucion()
				{
					var inst=formUsuario.txtInstitucion.value;
					txtInstitucion.value = inst.toUpperCase();
					var pinst="[A-Z]+[-][A-Z]+";
					instExp= new RegExp(pinst);
					if(inst.match(instExp))
					{
						document.getElementById("labelInst").style.color="green";
						document.formUsuario.Registrar.disabled=false;
						
					}
					else
					{
						document.getElementById("labelInst").style.color="red";
						document.formUsuario.Registrar.disabled=true;
					}
				}
				function validaSelect(id)
				{			
				
					var arreglo=id.split("-");
					var numPregunta= parseInt(arreglo[0]);
					var numRespuesta=parseInt(arreglo[1]);
					
					//alert(x);
					
					var posicion=parseInt(document.getElementById(id).options.selectedIndex);
					var valor=document.getElementById(id).options[posicion].text;
					if(valor=='-')
					{
						//alert("No puedes dejar marcada la opcion '-'");
						return;
					}
					else					
						var valor=parseInt(document.getElementById(id).options[posicion].text);
					
					//alert("posicion: "+posicion+" valor: "+valor);
					
						
   				
					for(i=1;i<=4;i++)
					{
						//alert(i);
											
						var sel = document.getElementById(numPregunta+"-"+i);
						aBorrar = sel.options[valor];
						aBorrar.disabled=true;
					}
					

				}
				function magia(numPreguntas)
				{
					for(i=1;i<=numPreguntas;i++)
					{
						for(j=1;j<=4;j++)
						{
							for(k=0;k<5;k++)
							{
								var sel = document.getElementById(i+"-"+j);
								aBorrar = sel.options[k];
								aBorrar.disabled=false;
							}
						}
					}
				}
				function resetSelect(id)
				{
					
					document.getElementById(id).checked=false;
					
					var arreglo=id.split("-");
					var numPregunta=parseInt(arreglo[1]);
					for(j=1;j<=4;j++)
					{
							for(k=0;k<5;k++)
							{
								var sel = document.getElementById(numPregunta+"-"+j);
								sel.selectedIndex=0;
								aBorrar = sel.options[k];
								aBorrar.disabled=false;

							}
					}
					
				}
				function verificaEnvio(idCuestionario)
				{		
					var numPreguntas=9;	
					if(parseInt(idCuestionario)==1)
						numPreguntas=15	
						
					for(i=1;i<=numPreguntas;i++)
					{
						for(j=1;j<=4;j++)
						{
							for(k=0;k<5;k++)
							{
								var sel = document.getElementById(i+"-"+j);
								if(sel.selectedIndex==0)
								{
									alert("No puedes dejar seleccionado '-' en la pregunta "+i+" opción "+j);
									return false;
								}

							}
						}
					}
					magia(numPreguntas);
					return true;
				}
				
			
				function cambiarCorreo(correo)
				{
					var correo1 = document.getElementById("txtEmail");
					var correo2 = document.getElementById('txtEmail2');
					if(document.getElementById("nuevoCorreo").checked == true)
					{
						correo1.readOnly=false;
						correo1.value="";
						correo2.value="";
						correo2.style.visibility = "visible";
						correo1.placeholder = "nuevo correo";
						correo2.placeholder = "confirmar nuevo correo";
			
					}
					else
					{
						correo1.value = correo;
						correo2.value = correo;
						correo1.readOnly = true;
						correo2.style.visibility = "hidden";
					}
				}