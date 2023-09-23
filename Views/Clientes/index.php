<?php include "Views/templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Clientes</li>
</ol>
<button type="button" class="btn btn-primary mb-2" onclick="frmCliente();"><i class="fas fa-plus"></i></button>
<div id="data">

    <table class="table table-striped table-hover" id="tblClientes">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>rut</th>
                <th>Nombre</th>
                <th>telefono</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
     
        </tbody>
    </table>
     
</div>

<!-- Modal -->
<div class="modal fade" id="nuevo_cliente" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCliente">
                    <div class="form-group">
                        <label for="rut">rut</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="rut" id="rut" placeholder="Rut">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre del Cliente">
                    </div>

                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección">
                    </div>
 
         
                    <button id="btnAccion" type="button" class="btn btn-primary" onclick="registrarCli(event);">Registrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>