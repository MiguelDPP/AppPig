<?php
    $no = $_SESSION['url_s'][1];
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    models("animals");
    $model->put("Lotes");
    $verificar = $model->SQLqueryDuos("Id", $no);
    $datas = mysqli_fetch_array($verificar);
    $model->put("Detalle_Registro_Animal");
    $datos = $model->SQLqueryDuos("Lote",$no);
?>
<?php
if(mysqli_num_rows($verificar) > 0){ ?>
    <!-- Modal -->
<div class="modal fade" id="modalRaza" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="exampleModalLabel">Gestor de lotes</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="<?php send("lot"); ?>" id="formdevo" class="forms-sample">
            <input type="hidden" name="IdLote" value="" id="IdLote">
            <input type="hidden" name="Estado" value="1" id="Estado">
            <div class="form-group">
                <label for="exampleTextarea1">Nombre</label>
                <input type="text" class="form-control" name="Nombre" id="Nombre">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" name="Descripcion" id="Descripcion" value=" ">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        <form method="POST" action="<?php send("lot"); ?>" id="formdevo" class="forms-sample">
            <p>¿Desea Eliminar este registro?</p>
            <input type="hidden" name="IdLote" value="" id="IdLoteDelete">
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
                    <h4 class="card-title">Animales del lote <?php echo $datas["Nombre"]; ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="users" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Descripcion</th>
                                    <th>Peso</th>
                                    <th>Color</th>
                                    <th>Precio</th>
                                    <th>EstaMuerto</th>
                                    <th>Fecha Fallecimiento</th>
                                    <th>Esta Vendido</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($dato = mysqli_fetch_array($datos)){
                                        $animal = new animal($dato);
                                        echo $animal->getData();
                                    }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php }else {
        echo "<a href='".URL."sheet/lot' class='d-none' id='redirectListUser'></a>";
    }
    
    ?>