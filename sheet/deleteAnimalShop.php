<?php 

if($rol['Id'] == 1){
    $no = $_SESSION['url_s'][1];
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $model->put("Registro_Animal");
    $dataAnimal = mysqli_fetch_array($model->SQLqueryDuos('Id',$no));
    $model->put("Detalle_Registro_Animal");
    $rows = mysqli_num_rows($model->SQLqueryDuos('IdRegistroAnimal',$no));
    $model->put("Raza");
    $datos = $model->SQLquery();
    
?>
<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Editar la compra.(Compra #<?php echo $no ?>)<small><a
                        href="<?php echo URL ?>sheet/animalRegistry" class="text-success p-1"><b>(Atras)</b></a></small>
            </h2>
            <p class="mb-0">Completa todos los campos.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <?php if($rows > 0){ ?>
                        <small class="text-danger">
                            <b>NO PUEDES ELIMINAR ESTA COMPRA, existen <?php echo $rows ?> cerdos registrados en este
                                compra. Si deseas eliminar esta compra, elimina los cerdos registrados en esta
                                compra.</b>
                        </small>
                        <?php }else{ ?>
                        <small class="text-success">
                            <b>Enhorabuena, no existen cerdos registrados en esta compra. puedes ELIMINARLO.</b>
                        </small>
                        <?php } ?>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">

                        <input type="hidden" name="id" value="<?php echo  $no; ?>">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Seleccionar Raza</label>
                                <select name="raza" class="form-control">
                                    <?php 

                                            while($dato = mysqli_fetch_array($datos)){
                                                $attr = ' ';
                                                
                                                if($dato['Id'] == $dataAnimal['RazaAnimal']){
                                                    $attr = ' selected ';
                                                }
                                                $model->put("Animal");
                                                $arrayData = $model->list('Id',$dato['IdAnimal']);
                                                echo  '<option value="'.$dato['Id'].'" '.$attr.'>'.$arrayData['Nombre'].' '.$dato['Nombre'].'</option>';
                                            }
                                        ?>
                                </select>
                            </div>
                            <div class="form-group col-md-8">
                                <label>Cantidad Comprada</label>
                                <input type="number" name="cantidad" min="<?php echo $rows; ?>" class="form-control"
                                    value="<?php echo $dataAnimal['Cantidad']; ?>">
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-header text-center">
                                <b>Compra <a href="<?php echo URL ?>sheet/editAnimal/<?php echo $no ?>" class="p-1 text-primary">Ver Categoria</a></b>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Mensaje de Confirmación</h5>
                                <p class="card-text">¿Estas seguro de eliminar esta compra?</p>
                                <form method="POST" class="form-inline" action="<?php send('deleteAnimalShop') ?>">
                                    <input type="hidden" name="id" value="<?php echo $no ?>">
                                    <button class="btn btn-danger mr-2">Eliminar</button>
                                    <a href="<?php echo URL ?>sheet/animalRegistry"
                                        class="btn btn-primary">Regresar</a>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>


            </div>


        </div>

    </div>
    <div>
        <?php 
    }else{
        echo "<a href='".URL."' class='d-none' id='redirectSheet'></a>";
    }
        ?>