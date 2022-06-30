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
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Editar Cerdo <small><a href="<?php echo URL ?>/sheet/listAnimalRegistry/<?php echo $datas['IdRegistroAnimal'] ?>" class="text-success p-1"><b>(Atras)</b></a></small></h2>
            <p class="mb-0">Completa todos los campos.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><img width="85"
                            src="<?php echo URL ?>/images/detalleRegistroAnimal/<?php echo $array_foto['Valor'] ?>"
                            alt=""></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" enctype="multipart/form-data"
                            action="<?php send('edit_item_animal_registry') ?>">
                            <input type="hidden" name="Id" value="<?php echo $datas['Id'] ?>">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Foto del Cerdo</label>
                                    <input type="file" name="foto" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>¿A que Lote pertenece ?</label>
                                    <select name="lote" class="form-control">
                                        <?php 
                                            while($lote = mysqli_fetch_array($lotes)){
                                                $attr = '';
                                                if($datas['Lote'] == $lote['Id']){
                                                    $attr = 'selected';
                                                }
                                                echo  '<option value="'.$lote['Id'].'"'.$attr.'>'.$lote['Nombre'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control"
                                        value="<?php echo $array_color['Valor']; ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Caracteristicas</label>
                                    <textarea name="caracteristicas" class="form-control" id="" cols="30"
                                        rows="5"><?php echo $array_caracteristica['Valor']; ?></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Peso</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                        <input type="number" name="peso" class="form-control"
                                            value="<?php echo $array_peso['Valor']; ?>">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Precio</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="number" name="precio" class="form-control"
                                            value="<?php echo $array_precio['Valor']; ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">¿Está Muerto?</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">
                                             
                                                    <div class="form-group mb-0">

                                                        <label class="radio-inline mr-3">
                                                            <input type="radio"
                                                                name="muerto" value="si"
                                                                <?php if($datas['EstaMuerto'] == "1"){echo "checked" ;} ?>>Si
                                                        </label>
                                                        <label class="radio-inline mr-3">
                                                            <input type="radio"
                                                                name="muerto" value="no"
                                                                <?php if($datas['EstaMuerto'] == "0"){echo "checked" ;} ?>>
                                                            No
                                                        </label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Escriba la fecha de Fallecimiento</label>
                                                        <input type="date" name="fallecimiento"
                                                            class="form-control"
                                                            value="<?php echo $datas['FechaFallecimiento']; ?>">
                                                    </div>
                                          

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">¿Está Vendido?</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="basic-form">

                                                    <div class="form-group mb-0">
                                                        <label class="radio-inline mr-3"><input type="radio"
                                                                name="vendido" value="1"
                                                                <?php if($datas['EstaVendido'] == "1"){echo "checked" ;} ?>>Si</label>
                                                        <label class="radio-inline mr-3"><input type="radio"
                                                                name="vendido" value="0"
                                                                <?php if($datas['EstaVendido'] == "0"){echo "checked" ;} ?>>
                                                            No</label>
                                                    </div>
                                           
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<?php }
} ?>