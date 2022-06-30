<?php 

if($rol['Id'] == 1){
    
?>
<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Crear Jefe de Granja</h2>
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
                        <form method="POST" action="<?php send('create_farm_manager') ?>">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Tipo de Documento</label>
                                    <select name="tipo" class="form-control">
                                        <option value="CC">CC</option>
                                        <option value="CE">CE</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Numero de Documento</label>
                                    <input type="number" name="NoDocumento"class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Contraseña</label>
                                    <input type="password" name="contraseña" class="form-control"
                                        placeholder="">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Municipio</label>
                                    <input type="text" name="municipio" class="form-control">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <input type="number" name="telefono" class="form-control">
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="form-group col-md-6">
                                    <label>Sexo</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="0">
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="1">
                                            Masculino
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
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