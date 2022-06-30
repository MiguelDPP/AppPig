<?php
$admin = false;
    if($rol['Id'] == 1){
        $admin = true;
    }

       models("Races");
       $obj = new conexion();
       $con = $obj->predetermined();
       $model = new Models($con);
       $model->put("Raza");
       $datos = $model->SQLquery();
?>
<?php
if($admin == true){ ?>
    <!-- Modal -->
<div class="modal fade" id="modalRaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Gestor Raza</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php send("race"); ?>" id="formdevo" class="forms-sample">
            <input type="hidden" name="IdRaza" value="" id="IdRaza">
            <input type="hidden" name="Estado" value="1" id="Estado">
            <div class="form-group">
                <label for="exampleTextarea1">Nombre</label>
                <input type="text" class="form-control" name="Nombre" id="Nombre">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" name="Descripcion" id="Descripcion">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form> 
        </div>
    </div>
  </div>
</div>
    <!-- Modal delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel">Comirmar eliminacion</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php send("race"); ?>" id="formdevo" class="forms-sample">
            <p>¿Desea Eliminar este registro?</p>
            <input type="hidden" name="IdRaza" value="" id="IdRazaDelete">
            <input type="hidden" name="Estado" value="3">
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form> 
        </div>
    </div>
  </div>
</div>
<?php } ?>


    <div class="container-fluid">
        <!-- <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <h4>Hi, welcome back!</h4>
                    <span>Datatable</span>
                </div>
            </div>
        </div>     -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Lista de razas</h4>
                    <?php
                    if($admin == true){ ?>
                    <button data-toggle="modal" id="add" data-target="#modalRaza" class="btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Añadir</button>
                    <button data-toggle="modal" id="edit" data-target="#modalRaza" class="d-none btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Edit</button>
                    <button data-toggle="modal" id="deleteButton" data-target="#modalDelete" class="d-none btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Delete</button>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($dato = mysqli_fetch_array($datos)){
                                    $race = new race($dato);
                                    echo $race->getData($admin);
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var add = document.getElementById("add"), Nombre = document.getElementById("Nombre"), Descripcion = document.getElementById("Descripcion"),
            Estado = document.getElementById("Estado"), IdRaza = document.getElementById("IdRaza"), edit = document.getElementById("edit"), 
            IdRazaDelete = document.getElementById("IdRazaDelete"), deleteButton = document.getElementById("deleteButton");

        var buttons = document.getElementsByClassName("edit");
        var buttonsDelete = document.getElementsByClassName("delete");

        for(var i=0; i < buttons.length; i++){
            buttons[i].onclick = (event) => {
                var tag = event.target;
                if(tag.tagName == "I"){
                    tag = tag.parentElement;
                }else if(tag.tagName == "DIV"){
                    tag = tag.firstChild;
                }
                var DataNombre = tag.parentElement.parentElement.parentElement.children[0].innerText;
                var DataDescripcion = tag.parentElement.parentElement.parentElement.children[1].innerText;
                Nombre.value = DataNombre;
                Descripcion.value = DataDescripcion;
                Estado.value = "2";
                IdRaza.value = tag.value;
                edit.click();
            }
            buttonsDelete[i].onclick = (event) => {
                var tag = event.target;
                if(tag.tagName == "I"){
                    tag = tag.parentElement;
                }else if(tag.tagName == "DIV"){
                    tag = tag.firstChild;
                }
                IdRazaDelete.value = tag.value;
                deleteButton.click();
            }
        }
        add.onclick = () => {
            Estado.value = "1";
            IdRaza.value = "";
            clearCampos();
        }
        function clearCampos(){
            Nombre.value = "";
            Descripcion.value = "";
        }
    </script>
