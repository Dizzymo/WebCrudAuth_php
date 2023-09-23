<?php include "Views/templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Usuarios</li>
</ol>
<button type="button" class="btn btn-primary mb-2" onclick="frmUsuario();"><i class="fas fa-plus"></i></button>
<div id="data">

    <table class="table table-striped table-hover" id="tblUsuarios">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Nombre</th>
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
<div class="modal fade" id="frmUsuario" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Usuario</h5>
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> -->
            </div>
            <div class="modal-body">
                <form method="POST" id="frmUsuarios">
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="row" id="claves">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="clave">Contraseña</label>
                                <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmar">Confirmar Contraseña</label>
                                <input type="password" class="form-control" name="confirmar" id="confirmar" placeholder="Confirmar Contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="caja">Caja</label>
                      <select class="form-control" name="caja" id="caja">
                        <?php foreach ($data['cajas'] as $row) { ?>
                        <option value = "<?= $row['id']; ?>"><?= $row['caja']; ?></option>
                        <?php } ?>
                         
                      </select>
                    </div>
                    <button id="btnAccion" type="button" class="btn btn-primary" onclick="registrarUser(event);">Registrar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/templates/footer.php"; ?>