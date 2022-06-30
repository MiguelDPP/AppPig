<div class="container-fluid">
    <div class="form-head d-flex mb-3 align-items-start">
        <div class="mr-auto d-none d-lg-block">
            <h2 class="text-black font-w600 mb-0">Editar Perfil</h2>
            <p class="mb-0">Hola, modifica los campos de usuario.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Completa los campos</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="<?php send('profile') ?>">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Numero de Documento</label>
                                    <input type="text" class="form-control" readonly
                                        value="<?php echo $data->getNodocumento(); ?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre" class="form-control"
                                        value="<?php echo $data->NombreCompleto ?>">
                                </div>
                                <div class="form-group col-md-12 d-none">
                                    <label>Contraseña</label>
                                    <input type="password" name="contraseña" class="form-control"
                                        placeholder="Contraseña" value="<?php echo $PersonaRol['Contrasena']; ?>">
                                </div>
                                <input type="hidden" name="NoDocumento" value="<?php echo $data->getNodocumento();  ?>">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control"
                                        value="<?php echo $data->Email ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Dirección</label>
                                    <input type="text" name="direccion" class="form-control"
                                        value="<?php echo $data->Direccion ?>">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Municipio</label>
                                    <input type="text" name="municipio" class="form-control"
                                        value="<?php echo $data->Municipio ?>">
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Fecha Nacimiento</label>
                                    <input type="date" class="form-control" name="fecha"
                                        value="<?php echo $data->FechaNacimiento ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Telefono</label>
                                    <input type="number" name="telefono" class="form-control"
                                        value="<?php echo$data->Telefono ?>">
                                </div>
                            </div>

                            <div class="form-group ">
                                <div class="form-group col-md-6">
                                    <label>Sexo</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="0"
                                                <?php if($data->Genero == "0"){ echo "checked";} ?>>
                                            Femenino
                                        </label>
                                    </div>
                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="sexo" value="1"
                                                <?php if($data->Genero == "1"){ echo "checked";} ?>>
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
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cambiar Contraseña</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form method="POST" action="<?php send('profile_password') ?>">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>Contraseña Actual</label>
                                    <input type="password" name="actual" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Contraseña Nueva</label>
                                    <input type="password" name="nueva" class="form-control">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Confirmar Contraseña Nueva</label>
                                    <input type="password" name="nueva_confirmar" class="form-control">
                                </div>
                                <input type="hidden" name="NoDocumento" value="<?php echo $data->getNodocumento();  ?>">
                            </div>

                            <button type="submit" class="btn btn-primary">Cambiar Contraseñas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>