<?php
	require_once("connection.php");
	
	////////////////////////////////////////////////////////
	//Funciones para obtener todos los parametros del POST//
	////////////////////////////////////////////////////////
	$numero2 = count($_POST); //Obtniene el numero de variables totales
	$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
	$valores2 = array_values($_POST);// obtiene los valores de las varibles
	////////////////////////////////////////////////////////	
	
	/* Ejemplo 1 de como usar un 'SPLIT' en PHP 5
	$pizza  = "porción1 porción2 porción3 porción4 porción5 porción6";
	$porciones = explode(" ", $pizza);
	echo $porciones[0]; // porción1
	echo $porciones[1]; // porción2
	*/
	$matrizResultados=array(array()); //Creo una matriz donde iran los resultados
	$matrizResultados=iniMatrizR($matrizResultados); //Inicializo la matriz
	//imprimeMatrizR($matrizResultados);
	$idUsuario;
	$idCuestionario;
	for($i=0;$i<$numero2;$i++)
	{
		//Recorro los reultados del POST y lleno la matriz
		$estilo_valor=explode("-",$valores2[$i]);
		$valores2[$i]=$estilo_valor;
		$numPregunta_numOpcion=explode("-",$tags2[$i]);
		$tags2[$i]=$numPregunta_numOpcion;
		if($i==($numero2-1))
		{
			$idCuestionario=$valores2[$i][0];;
			$idUsuario=$valores2[$i][1];			
			
		}
		else
		{
			
			$matrizResultados=llenarMatriz($valores2[$i][0],$valores2[$i][1],$matrizResultados);
			//echo "NumPregunta: ".$tags2[$i][0]." NumOpcion: ".$tags2[$i][1]." Estilo: ".$valores2[$i][0]." Valor: ".$valores2[$i][1]."<br>";
		}
	}
	//echo "<br><h1>La matriz llena</h1><br>";
	//imprimeMatrizR($matrizResultados);

	//echo "<br><h1>La matriz Multiplicada</h1><br>";
	//imprimeMatrizR(multiplicaMatriz($matrizResultados));
	$tuplaResultado=sumaColumnas(multiplicaMatriz($matrizResultados));
	//echo "<h1>Tupla Resultado</h1><br>".$tuplaResultado[0]."|".$tuplaResultado[1]."|".$tuplaResultado[2]."|".$tuplaResultado[3]."<br>";
	/*	       Estilos
		R	5 | 2 | 2 | 6 | 
		e 	1 | 6 | 4 | 4 | 
		s 	6 | 3 | 5 | 1 | 
		p 	3 | 4 | 4 | 4 | 
	*/
	$combinacionEstilo=array();
	if(count(array_count_values($matrizResultados[3]))==4)
	{		
		arsort($matrizResultados[3]);
		
		foreach($matrizResultados[3] as $key => $valor)
		{
			array_push($combinacionEstilo,($key+1));
		}
	}
	else
	{
		$combinacionEstilo=obtCombEst($matrizResultados,$tuplaResultado);
	}
	
	guardaResultado($combinacionEstilo,$idUsuario,$idCuestionario);	
	/************************************************ FUNCIONES ************************************************/
	function guardaResultado($r,$idU,$idC)
	{
		//Conexion a la BD//
		$conexion = new connection();
	
		$resultado="";
		for($i=0;$i<count($r);$i++)
		{
			if($i!=(count($r)-1))
				$resultado=$resultado.$r[$i]."-";
			else
				$resultado=$resultado.$r[$i];
		}
		
		$query="select * from cuestionarioResuelto where idUsuario=".$idU." and idCuestionario=".$idC." and fecha=CURDATE()";
		//echo "<h1>".$query."</h1>";
		$conexion->conectar();
		$conexion->myQuery($query);
		if($conexion->getFilas())//Si me regresa tuplas significa que ya esta registrado
		{
			echo "<script language='JavaScript' type='text/javascript'> 
                	alert('Al parecer no puedes contestar de nuevo el cuestionario tan pronto.'); location.href='../4mat.php';
                </script>";
		}
		else
		{
			$query="insert into cuestionarioResuelto values(".$idU.",".$idC.",now(),'".$resultado."')";
		//echo "<h1>".$query."</h1>";
			$conexion->myQuery($query);
			echo "<script language='JavaScript' type='text/javascript'> 
                	location.href='../resultados.php?id=".$idC."'; 
               	 </script>"; /////////////////////////////////////CAMBIAR AQUI LA ACCION CON EL ID CUESTIONARIO

					
		}
		$conexion->desconectar();
		
		
	}
	function obtCombEst($matrizR,$tupla)
	{
		$combinacionEstilo=array();
		$mayor_pos=mayorPos($matrizR[3]);
		//Paso (2)
		for($i=$mayor_pos[0];$i!=0;$i--)
		{
			$repetidos=obtenerRepet($matrizR[3],$i);
								
			if(count($repetidos)==0)
			{

				continue;
			}
			else
			{
				if(count($repetidos)==1)//Si no hay repetidos
				{		
					array_push($combinacionEstilo,($repetidos[0]+1));		
				}
				else
				{
					arsort($tupla);
					foreach($tupla as $key => $valor)
					{
						if(in_array($key, $repetidos))
						{
							array_push($combinacionEstilo,($key+1));
						}
					}
				}
			}
			
		}
		return $combinacionEstilo;
	}	

	function sumaColumnas($matriz)
	{
		$tupla=array(0,0,0,0);
		for($i=0;$i<4;$i++)
		{
			for($j=0;$j<4;$j++)
			{
				
				$tupla[$j]+=$matriz[$i][$j];
			}
		}
		return $tupla;
		
	}
	function llenarMatriz($estilo,$valor,$matrizResultados)
	{
		$matrizResultados[$valor-1][$estilo-1]++;
		return $matrizResultados;
	}
	function iniMatrizR($matrizResultados)
	{
		for($i=0;$i<4;$i++)
		{
			for($j=0;$j<4;$j++)
			{
				$matrizResultados[$i][$j]=0;
			}
		}
		return $matrizResultados;
	}
	function imprimeMatrizR($matrizResultados)
	{
		for($i=0;$i<4;$i++)
		{
			for($j=0;$j<4;$j++)
			{
				echo $matrizResultados[$i][$j]." | ";
			}
			echo "<br>";
		}
	}
	function multiplicaMatriz($matriz)
	{
		for($i=0;$i<4;$i++)
		{
			for($j=0;$j<4;$j++)
			{
				$matriz[$i][$j]*=($i+1);
			}
		}
		return $matriz;
	}
	function mayorPos($m)
	{
		$mayor_pos=array(0,0);
		
		for($i=0;$i<count($m);$i++)
		{
			if($m[$i]>$mayor_pos[0])
			{
				$mayor_pos[0]=$m[$i];
				$mayor_pos[1]=$i;
			}
		}
		return $mayor_pos;
	}
	function obtenerRepet($matriz,$mayor)
	{
		$posiciones=array();
		$contador=0;
		for($i=0;$i<count($matriz);$i++)
		{
			if($matriz[$i]==$mayor)
			{
				
				$posiciones[$contador]=$i;
				$contador++;
			}
		}
		return $posiciones;
	}
	/***********************************************************************************************************/
	
?>