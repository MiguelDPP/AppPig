<?php
   if($rol['Id'] == 1){

    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $model->put("Persona");
    $datos = $model->SQLquery();
    
?>
    <div class="container-fluid">  
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de usuarios</h4>
                </div>
                <div class="card-body">
                    <div class="col-md-12 mb-4">
                        <h3 class="text-center">Filtros</h3>
                        <div class="form-group col-md-6">
                            <label for="Lote">Cargo</label>
                            <select class="form-control" id="fCargo" data-index="4">
                                <option value="-1">Todos</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Jefe De Granja">Jefe De Granja</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="users" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>NoDocumento</th>
                                    <th>Nombre</th>
                                    <th>Genero</th>
                                    <th>Cargo</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Direccion</th>
                                    <th>Municipio</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($dato = mysqli_fetch_array($datos)){
                                    $people = new people($dato);
                                    echo $people->getData();
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }else{
    echo "<a href='".URL."' class='d-none' id='redirectSheet'></a>";
}?>
