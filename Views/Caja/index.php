<?php include "Views/templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Cajas</li>
</ol>
<button type="button" class="btn btn-primary mb-2" onclick="frmCaja();"><i class="fas fa-plus"></i></button>
<div id="data">

    <table class="table table-striped table-hover" id="tblCaja">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Caja</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
     
        </tbody>
    </table>
     
</div>

<!-- Modal -->
<div class="modal fade" id="nueva_caja" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
            </div>
            <div class="modal-body">
                <form method="POST" id="frmCajas">
                    <div class="form-group">
                        <label for="caja">Caja</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="caja" id="caja" placeholder="Caja">
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado">
                    </div>

 
         
                    <button id="btnAccion" type="button" class="btn btn-primary" onclick="registrarCaja(event);">Registrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>