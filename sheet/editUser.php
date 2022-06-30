<?php 

if($rol['Id'] == 1){

$NoDocumento = $_SESSION['url_s'][1];
$obj = new conexion();
$con = $obj->predetermined();
$model = new Models($con);
$model->put('Persona');
$sql = $model->SQLqueryDuos('NoDocumento',$NoDocumento);
$datas = mysqli_fetch_array($sql);
if(mysqli_num_rows($sql) > 0){
    $people = new people($datas);
    $model->put('Relacion_Persona_Rol');
    $datas1 = mysqli_fetch_array($model->SQLqueryDuos('NoDocumento',$NoDocumento));

?>

<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Editar Usuarios</h2>
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
                        <form method="POST" action="<?php send('edit_user') ?>">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Tipo de Documento</label>
                                    <select name="tipo" class="form-control">
                                        <option value="CC"
                                            <?php if($people->TipoDocumento == "CC"){ echo "selected";} ?>>CC</option>
                                        <option value="CE"
                                            <?php if($people->TipoDocumento == "CE"){ echo "selected";} ?>>CE</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Numero de Documento</label>
                                    <input type="number" name="NoDocumento1" class="form-control"
                                        value="<?php echo $people->getNodocumento(); ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control"
                                        value="<?php echo $people->NombreCompleto ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Contraseña</label>
                                    <input type="password" name="contraseña" class="form-control"
                                        value="<?php echo $datas1['Contrasena'] ?>">
                                    <input type="hidden" name="NoDocumento"
                                        value="<?php echo $people->getNodocumento();  ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo $people->Email ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" class="form-control"
                                        value="<?php echo $people->Direccion ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Municipio</label>
                                    <input type="text" name="municipio" class="form-control"
                                        value="<?php echo $people->Municipio ?>">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha"
                                        value="<?php echo $people->FechaNacimiento ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <input type="number" name="telefono" class="form-control"
                                        value="<?php echo $people->Telefono ?>">
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="form-group col-md-6">
                                    <label>Sexo</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="0"
                                                <?php if($people->Genero == "0"){ echo "checked";} ?>>
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="1"
                                                <?php if($people->Genero == "1"){ echo "checked";} ?>>
                                            Masculino
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div>
<?php 
        }else{
            echo "<a href='".URL."sheet/listUsers' class='d-none' id='redirectListUser'></a>";
        }    
    }else{
        echo "<a href='".URL."' class='d-none' id='redirectSheet'></a>";
    } 
?>