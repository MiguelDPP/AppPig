<?php
$admin = false;
    if($rol['Id'] == 1){
        $admin = true;
    }

       models("foods");
       $obj = new conexion();
       $con = $obj->predetermined();
       $model = new Models($con);
       $model->put("ComidaComprada");
       $datos = $model->SQLquery();
       $model->put("Lotes");
       $Lotes = $model->SQLquery();
?>  
<?php
if($admin == true){ ?>
    <!-- Modal -->
<div class="modal fade" id="modalRaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Gestor Alimentos</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php send("food"); ?>" id="formdevo" class="forms-sample">
            <input type="hidden" name="IdAlimento" value="" id="IdAlimento">
            <input type="hidden" name="Estado" value="1" id="Estado">
            <div class="form-group">
                <label for="Nombre">Nombre</label>
                <input type="text" class="form-control" name="Nombre" id="Nombre">
            </div>
            <div class="form-group">
                <label for="Cantidad">Cantidad</label>
                <input type="number" class="form-control" name="Cantidad" id="Cantidad">
            </div>
            <div class="form-group">
                <label for="Precio">Precio</label>
                <input type="number" class="form-control" name="Precio" id="Precio">
            </div>
            <div class="form-group">
                <label for="FechaCompra">Fecha de compra</label>
                <input type="date" class="form-control" name="FechaCompra" id="FechaCompra">
            </div>
            <div class="form-group">
                <label for="Lote">Lote</label>
                <select class="form-control" name="Lote" id="Lote">
                    <?php 
                        while($data = mysqli_fetch_array($Lotes)){
                            echo "<option value='{$data["Id"]}'>{$data["Nombre"]}</option>";
                        }
                    ?>
                    
                </select>
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
        <h5 class="modal-title text-white" id="exampleModalLabel">Confirmar Eliminar</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php send("food"); ?>" id="formdevo" class="forms-sample">
            <p>¿Desea Eliminar este registro?</p>
            <input type="hidden" name="IdAlimentoDelete" value="" id="IdAlimentoDelete">
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
                    <h4 class="card-title">Lista de alimentos</h4>
                    <?php
                    if($admin == true){ ?>
                    <button data-toggle="modal" id="add" data-target="#modalRaza" class="btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Añadir</button>
                    <button data-toggle="modal" id="edit" data-target="#modalRaza" class="d-none btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Edit</button>
                    <button data-toggle="modal" id="deleteButton" data-target="#modalDelete" class="d-none btn btn-icons btn-rounded btn-primary"><i class="mdi mdi-plus-box"></i> Delete</button>
                    <?php } ?>
                </div>
                <div class="card-body">
                    <div class="col-md-12 mb-4">
                        <h3 class="text-center">Filtros</h3>
                        <div class="form-group col-md-6">
                            <label for="Lote">Lote</label>
                            <select class="form-control" id="fLote" data-index="0">
                                <option value="-1">Todos</option>
                                <?php 
                                $model->put("Lotes");
                                $Lotes = $model->SQLquery();
                                    while($dat = mysqli_fetch_array($Lotes)){
                                        echo "<option value='{$dat["Nombre"]}'>{$dat["Nombre"]}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="users" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>Lote</th>
                                    <th>Nombre</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Fecha de compra</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($dato = mysqli_fetch_array($datos)){
                                    $food = new food($dato);
                                    echo $food->getData($admin);
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
        var add = document.getElementById("add"), Nombre = document.getElementById("Nombre"), Cantidad = document.getElementById("Cantidad"), 
            Estado = document.getElementById("Estado"), IdAlimento = document.getElementById("IdAlimento"), edit = document.getElementById("edit"), 
            IdAlimentoDelete = document.getElementById("IdAlimentoDelete"), deleteButton = document.getElementById("deleteButton"),
            Lote = document.getElementById("Lote"), Precio = document.getElementById("Precio"), FechaCompra = document.getElementById("FechaCompra");

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
                var tagLote = tag.parentElement.parentElement.parentElement.children[0];
                var DataNombre = tag.parentElement.parentElement.parentElement.children[1].innerText;
                var DataCantidad = tag.parentElement.parentElement.parentElement.children[2].innerText;
                var DataPrecio = tag.parentElement.parentElement.parentElement.children[3].innerText;
                var DataFechaCompra = tag.parentElement.parentElement.parentElement.children[4].innerText;
                // Nombre.value = DataNombre;
                Estado.value = "2";
                BuscarSelect(tagLote.getAttribute("idlote"));
                Nombre.value = DataNombre;
                Cantidad.value = DataCantidad;
                Precio.value = DataPrecio;
                FechaCompra.value = DataFechaCompra;
                IdAlimento.value = tag.value;
                edit.click();
            }
            buttonsDelete[i].onclick = (event) => {
                var tag = event.target;
                if(tag.tagName == "I"){
                    tag = tag.parentElement;
                }else if(tag.tagName == "DIV"){
                    tag = tag.firstChild;
                }
                IdAlimentoDelete.value = tag.value;
                deleteButton.click();
            }
        }
        add.onclick = () => {
            Estado.value = "1";
            IdAlimento.value = "";
            clearCampos();
            
        }
        function BuscarSelect(id){
            for(let i=0; i<Lote.children.length; i++){
                if(Lote.children[i].value == id){
                    Lote.children[i].setAttribute("selected","");
                    let Data = Lote.parentElement.children[1].firstChild.firstChild.firstChild;
                    Data.innerText = Lote.children[i].innerHTML;
                }else{
                    Lote.children[i].removeAttribute("selected");
                }
            }
        }
        function clearCampos(){
            Nombre.value = "";
            Cantidad.value = "";
            Precio.value = "";
            FechaCompra.value = "";
            Lote.parentElement.children[1].firstChild.firstChild.firstChild.innerText = Lote.children[0].innerHTML;
            for(let i=0; i<Lote.children.length; i++){
                Lote.children[i].removeAttribute("selected");
            }
        }
    </script>
