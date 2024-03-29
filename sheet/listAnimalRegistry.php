<?php 

if($rol['Id'] == 1){

$no = $_SESSION['url_s'][1];
$obj = new conexion();
$con = $obj->predetermined();
$model = new Models($con);
$model->put('Registro_Animal');
$sql = $model->SQLqueryDuos('Id',$no);
$datas = mysqli_fetch_array($sql);
if(mysqli_num_rows($sql) > 0){
    $model->put('Raza');
    $array_raza =  mysqli_fetch_array($model->SQLqueryDuos('Id',$datas['RazaAnimal']));
    $model->put('Animal');
    $array_animal =  mysqli_fetch_array($model->SQLqueryDuos('Id',$array_raza['IdAnimal']));
    $model->put('Lotes');
    $lotes =  $model->SQLquery();

  //Cerdos Rgistrados
  $model->put('Detalle_Registro_Animal');
  $sql1 = $model->SQLqueryDuos('IdRegistroAnimal',$no);
  $cerdos_registrados = mysqli_num_rows($sql1);
  $cerdos_sin_registro = intval($datas['Cantidad']) - intval($cerdos_registrados);
?>
<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Registrar Animales por Individual <small><a
                        href="<?php echo URL ?>sheet/animalRegistry" class="text-success p-1"><b>(Atras)</b></a></small>
            </h2>
            <p class="mb-0">Aqui puedes registrar cada uno de los animales comprados.<br><span
                    class="badge badge-xl light badge-warning">Comprastes #<?php echo $datas['Cantidad']; ?>
                    <?php echo $array_animal['Nombre']." ".$array_raza['Nombre']; ?></span></p>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-primary">
                            <!-- <i class="ti-user"></i> -->
                            <!-- <svg width="36" height="28" viewBox="0 0 36 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M31.75 6.75H30.0064L30.2189 4.62238C30.2709 4.10111 30.2131 3.57473 30.0493 3.07716C29.8854 2.57959 29.6192 2.12186 29.2676 1.73348C28.9161 1.3451 28.4871 1.03468 28.0082 0.822231C27.5294 0.609781 27.0114 0.500013 26.4875 0.5H7.0125C6.48854 0.500041 5.9704 0.609864 5.49148 0.822391C5.01256 1.03492 4.58348 1.34543 4.23189 1.73392C3.88031 2.12241 3.61403 2.58026 3.45021 3.07795C3.28639 3.57564 3.22866 4.10214 3.28075 4.6235L5.2815 24.6224C5.31508 24.9222 5.38467 25.2168 5.48875 25.5H1.75C1.41848 25.5 1.10054 25.6317 0.866116 25.8661C0.631696 26.1005 0.5 26.4185 0.5 26.75C0.5 27.0815 0.631696 27.3995 0.866116 27.6339C1.10054 27.8683 1.41848 28 1.75 28H31.75C32.0815 28 32.3995 27.8683 32.6339 27.6339C32.8683 27.3995 33 27.0815 33 26.75C33 26.4185 32.8683 26.1005 32.6339 25.8661C32.3995 25.6317 32.0815 25.5 31.75 25.5H28.0115C28.1154 25.2172 28.1849 24.9229 28.2185 24.6235L28.881 18H31.75C32.7442 17.9989 33.6974 17.6035 34.4004 16.9004C35.1035 16.1974 35.4989 15.2442 35.5 14.25V10.5C35.4989 9.50577 35.1035 8.55258 34.4004 7.84956C33.6974 7.14653 32.7442 6.75109 31.75 6.75ZM9.0125 25.5C8.70243 25.501 8.40314 25.3862 8.17327 25.1782C7.9434 24.9701 7.79949 24.6836 7.76975 24.375L5.7685 4.37575C5.75109 4.20188 5.7703 4.0263 5.82488 3.86031C5.87946 3.69432 5.96821 3.5416 6.0854 3.412C6.2026 3.28239 6.34564 3.17877 6.50532 3.10781C6.665 3.03685 6.83777 3.00013 7.0125 3H26.4875C26.6622 3.00012 26.8349 3.03681 26.9945 3.10772C27.1541 3.17863 27.2972 3.28218 27.4143 3.4117C27.5315 3.54123 27.6203 3.69386 27.6749 3.85977C27.7295 4.02568 27.7488 4.20119 27.7315 4.375L25.7308 24.3762C25.7007 24.6848 25.5566 24.971 25.3267 25.1788C25.0967 25.3867 24.7975 25.5012 24.4875 25.5H9.0125ZM33 14.25C32.9998 14.5815 32.868 14.8993 32.6337 15.1337C32.3993 15.368 32.0815 15.4998 31.75 15.5H29.1311L29.7561 9.25H31.75C32.0815 9.2502 32.3993 9.38196 32.6337 9.61634C32.868 9.85071 32.9998 10.1685 33 10.5V14.25Z" fill="#2F4CDD"/></svg> -->
                            <img src="https://cdn-icons-png.flaticon.com/512/6992/6992591.png" width="36" alt="">
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span
                                    class="counter ml-0"><?php echo $cerdos_registrados; ?></span></h3>
                            <p class="mb-0">Cerdos Registrados</p>
                            <small></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-primary">
                            <!-- <i class="ti-user"></i> -->
                            <img src="https://cdn-icons-png.flaticon.com/512/6992/6992591.png" width="36" alt="">
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span
                                    class="counter ml-0"><?php echo $cerdos_sin_registro; ?></span></h3>
                            <p class="mb-0">Cerdos Sin Registros</p>
                            <small></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <div class="widget-stat card">
                <div class="card-body p-4">
                    <div class="media ai-icon">
                        <span class="mr-3 bgl-primary text-primary">
                            <!-- <i class="ti-user"></i> -->
                            <img src="https://cdn-icons-png.flaticon.com/512/6992/6992591.png" width="36" alt="">
                        </span>
                        <div class="media-body">
                            <h3 class="mb-0 text-black"><span
                                    class="counter ml-0"><?php echo $datas['Cantidad']; ?></span></h3>
                            <p class="mb-0">Cerdos Comprados</p>
                            <small></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-xxl-3 col-lg-6 col-md-6 col-sm-6">
            <a class="widget-stat card bg-danger" href="#cerditos">
                
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/6992/6992591.png" width="36" alt="">
                        </span>
                        <div class="media-body text-white">
                            <p class="mb-1">Lista</p>
                            <h3 class="text-white">VER</h3>
                            <div class="progress mb-2 bg-secondary">
                                <div class="progress-bar progress-animated bg-light" style="width: 100%"></div>
                            </div>
                            <small>Cerdos</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
</div>

<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Registrar Cerdo</h2>
            <p class="mb-0">Completa todos los campos.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><img width="50" src="<?php echo URL ?>/images/pink.png" alt=""></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" enctype="multipart/form-data"
                            action="<?php send('create_list_animal_registry') ?>">
                            <input type="hidden" name="IdRegistroAnimal" value="<?php echo $datas['Id'] ?>">
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
                                                echo  '<option value="'.$lote['Id'].'">'.$lote['Nombre'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Color</label>
                                    <input type="text" name="color" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Caracteristicas</label>
                                    <textarea name="caracteristicas" class="form-control" id="" cols="30"
                                        rows="5"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Peso</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Kg</div>
                                        </div>
                                        <input type="number" name="peso" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Precio</label>
                                    <div class="input-group ">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="number" name="precio" class="form-control">
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

<div class="container-fluid" id="cerditos">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Cerdos Registrados</h2>
            <p class="mb-0"></p>
        </div>
    </div>
    <div class="card">
        <div class="card-body pt-2">
            <div class="table-responsive ">
                <table class="table items-table">
                    <tbody>
                        <tr>
                            <th class="my-0 text-black font-w500 fs-20">Items</th>
                            <th style="width:10%;" class="my-0 text-black font-w500 fs-20">Color</th>
                            <th style="width:10%;" class="my-0 text-black font-w500 fs-20">Lote</th>
                            <th style="width:10%;" class="my-0 text-black font-w500 fs-20">Peso</th>
                            <th class="my-0 text-black font-w500 fs-20">Precio</th>
                            <th></th>
                        </tr>
                        <?php 
                        $model->put('Detalle_Registro_Animal');
                        $sql1 = $model->SQLqueryDuos('IdRegistroAnimal',$no);
                        $i = 0;
                         while($item = mysqli_fetch_array($sql1)){ 
                            $model->put('OtrosAtributos');
                            $array_foto = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$item['Id'],'foto']));
                            $array_caracteristica = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$item['Id'],'caracteristicas']));
                            $array_color = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$item['Id'],'color']));
                            $array_peso = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$item['Id'],'peso']));
                            $array_precio = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$item['Id'],'precio']));
                            $model->put('Lotes');
                            $array_Lote = mysqli_fetch_array($model->SQLqueryDuos('Id',$item['Lote']));
                            $i++;
                            ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid rounded" width="85"
                                        src="<?php echo URL?>/images/detalleRegistroAnimal/<?php echo $array_foto['Valor'] ?>"
                                        alt="DexignZone">
                                    <div class="media-body">
                                        <small class="mt-0 mb-1 text-primary font-w500">Cerdo #<?php echo $i ?></small>
                                        <h5 class="mt-0 mb-2 text-black mb-4">
                                            <?php echo $array_caracteristica['Valor']; ?></h5>
                                        <div class="star-review fs-14">
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-orange"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <i class="fa fa-star text-gray"></i>
                                            <span class="ml-3 text-dark">451 reviews</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h4 class="my-0 text-secondary font-w600"><?php echo $array_color['Valor']; ?></h4>
                            </td>
                            <td>
                                <h4 class="my-0 text-secondary font-w600"><?php echo $array_Lote['Nombre'] ?></h4>
                            </td>
                            <td>
                                <h4 class="my-0 text-secondary font-w600"><?php echo $array_peso['Valor'] ?></h4>
                            </td>
                            <td>
                                <h4 class="my-0 text-secondary font-w600"><?php echo $array_precio['Valor'] ?></h4>
                            </td>
                            <td>
                                <a href="<?php echo URL ?>sheet/deleteItemAnimal/<?php echo $item['Id']; ?>"
                                    class="ti-close fs-28 text-danger las la-times-circle"></a>
                                <a href="<?php echo URL ?>sheet/editAnimalRegistry/<?php echo $item['Id']; ?>"
                                    class="fs-28 text-primary"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        <?php }

                        if($i == 0){
                            echo "
                            <tr>    
                                <td>No hay Registros</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
        }else{
            echo "<a href='".URL."sheet/animalRegistry' class='d-none' id='redirectListUser'></a>";
        }    
    }else{
        echo "<a href='".URL."' class='d-none' id='redirectSheet'></a>";
    } 
?>