<?php  
session_start();
$usuario=$_SESSION['username'];
$rol=$_SESSION['rol'];
if(!isset($usuario)):
	header("location:login.php");
else:
	if($rol==1):
		require 'login//conexion.php';
		$salonesQuery="SELECT * FROM salon";
		$salonResult=mysqli_query($conexion,$salonesQuery);
		if(isset($_POST['claseElegida'])):
			$claseElegida=$_POST['claseElegida'];
			$clasesQuery="SELECT * FROM clase where idClase='$claseElegida'";
			$queryResult=mysqli_query($conexion,$clasesQuery);
			$datosObtenidos=mysqli_fetch_array($queryResult);
		else:
			echo "No se eligio ninguna clase";
		endif;
		?>
		<html>
		<head>
			<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	        <link rel="stylesheet" type="text/css" href="css/style.css">
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	        <link rel="icon" href="img/uady.png"/>
	        <title>Editar clase</title>
		</head>
		<body>
	        <div class="container-fluid min-vh-100">
		        <div class="row justify-content-center">
		        	<div class="col-12 text-center">
		        		<a href="horariosAdministrador.php"><input type="button" class="btn btn-dark btn-sm float-left" value="Regresar"></a>
		        		
		        		<h3 class="d-inline">Editar un horario</h3>
		        	</div>
		        </div>       
	            <div class="form-row h-100 justify-content-center ">
	                <div class="col-4 text-center my-auto">
		                <div class="formulario">
		                    <form action="" method="POST">
								<label>Hora inicio: 
									<input type="time" name="horaInicio" min="07:00"  max="21:00" required="true" step="1800" value="<?php echo $datosObtenidos['HoraInicio']?>">
								</label><br>
                				<label>Hora Fin: <input type="time" name="horaFin" required="true" min="07:00"  max="21:00" step="1800" value="<?php echo $datosObtenidos['HoraFin']?>"></label><br>
                				<label>Día: 
				                    <select name="dia" required="true" value="<?php echo $datosObtenidos['Dia']?>">
				                        <option value="Lunes">Lunes</option>
				                        <option value="Martes">Martes</option>
				                        <option value="Miercoles">Miércoles</option>
				                        <option value="Jueves">Jueves</option>
				                        <option value="Viernes">Viernes</option>
				                    </select>
			               	 	</label><br>
				                <label>Salón: 
				                    <select name="salon" required="true" value="<?php echo $datosObtenidos['idSalon']?>">
				                        <?php while($salones=mysqli_fetch_array($salonResult)){
				                            echo "<option value=".$salones['idSalon'].">".$salones['DescSalon']."</option> ";
				                        } 
				                        ?>
				                    </select>
				                </label><br>
		                        <input type="submit" class="btn btn-dark btn-sm " value="Editar"><br><br>
		                    </form>
		                </div>
	                </div>
	            </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>
		</html>
		<?php
	else:
		header("location:cerrarSesion.php");
	endif;
endif;	
?>