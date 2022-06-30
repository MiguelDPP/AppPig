<?php 

if($rol['Id'] == 1){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $model->put("Raza");
    $datos = $model->SQLquery();
?>
<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Registrar compras de animales</h2>
            <p class="mb-0">Completa todos los campos.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="<?php send('create_animal_registry') ?>">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Seleccionar Raza</label>
                                    <select name="raza" class="form-control">
                                        <?php 
                                            while($dato = mysqli_fetch_array($datos)){
                                                $model->put("Animal");
                                                $arrayData = $model->list('Id',$dato['IdAnimal']);
                                                echo  '<option value="'.$dato['Id'].'">'.$arrayData['Nombre'].' '.$dato['Nombre'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Cantidad Comprar</label>
                                    <input type="number" name="cantidad"class="form-control">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>         
                </div>
            </div>
        </div>
        
    </div>

    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Lista de compras de animales</h2>
            <p class="mb-0"></p>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Animal</th>
                                    <th>Raza</th>
                                    <th>Cantidad</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $model->put("Registro_Animal");
                                $datos_animales = $model->SQLquery();
                                while($datico = mysqli_fetch_array($datos_animales)){
                                    $model->put("Raza");
                                    $arrayData = $model->list('Id',$datico['RazaAnimal']);
                                    $model->put("Animal");
                                    $arrayAnimal = $model->list('Id',$arrayData['IdAnimal']);
                                    echo  '
                                    <tr> 
                                        <td>'.$datico['Id'].'</td>
                                        <td>'.$arrayAnimal['Nombre'].'</td>
                                        <td>'.$arrayData['Nombre'].'</td>
                                        <td>'.$datico['Cantidad'].'</td>
                                        <td>
                                            <a href="./editAnimal/'.$datico['Id'].'" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="./listAnimalRegistry/'.$datico['Id'].'" class="btn btn-success shadow btn-xs sharp mr-1"><i class="fa fa-share"></i></a>
                                            <a href="./deleteAnimalShop/'.$datico['Id'].'" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="mdi mdi-delete"></i></a>
                                        </td>
                                    </tr>';
                                }

                                
                                ?> 
                            </tbody>
                        </table>
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