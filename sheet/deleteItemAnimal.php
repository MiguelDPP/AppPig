<?php 

if($rol['Id'] == 1){
    $no = $_SESSION['url_s'][1];
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $model->put('Detalle_Registro_Animal');
    $sql = $model->SQLqueryDuos('Id',$no);
    $datas = mysqli_fetch_array($sql);
    if(mysqli_num_rows($sql) > 0){

        $model->put('OtrosAtributos');
        $array_foto = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$no,'foto']));
        $array_caracteristica = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$no,'caracteristicas']));
        $array_color = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$no,'color']));
        $array_peso = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$no,'peso']));
        $array_precio = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$no,'precio']));
        $model->put('Lotes');
        $lotes =  $model->SQLquery();
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header text-center">
            <b>Cerdo</b>
        </div>
        <div class="card-body">
            <p>
                <img width="85" src="<?php echo URL ?>/images/detalleRegistroAnimal/<?php echo $array_foto['Valor'] ?>"
                    alt="">
            </p>
            <p>
                <?php echo $array_caracteristica['Valor'] ?><br>
            </p>

            <p>
                <b>Color : </b><?php echo $array_color['Valor'] ?>
                <b>Peso : </b><?php echo $array_peso['Valor'] ?>
                <b>Precio : </b><?php echo $array_precio['Valor'] ?>
            </p>
            <hr>
            <br>
            <h5 class="card-title">Mensaje de Confirmación</h5>
            <p class="card-text">¿Estas seguro de eliminar este Item?</p>
            <form method="POST" class="form-inline" action="<?php send('deleteAnimalRegistry') ?>">
                <input type="hidden" name="id" value="<?php echo $no ?>">
                <input type="hidden" name="id2" value="<?php echo $datas['IdRegistroAnimal'] ?>">
                <button class="btn btn-danger mr-2">Eliminar</button>
                <a href="<?php echo URL ?>sheet/listAnimalRegistry/<?php echo $datas['IdRegistroAnimal']; ?>" class="btn btn-primary">Regresar</a>
            </form>
            
        </div>
    </div>
</div>

<?php 
        }else{
            echo "<a href='".URL."sheet/listUsers' class='d-none' id='redirectListUser'></a>";
        }    
    }else{
        echo "<a href='".URL."' class='d-none' id='redirectSheet'></a>";
    } 
?>