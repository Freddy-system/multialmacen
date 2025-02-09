<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <!-- <h1 class="mb-0 font-size-18">Gestión de Clubes</h1> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <script>
                        Swal.fire({
                            icon: "success",
                            title: "Éxito",
                            text: "<?php echo $_SESSION['success_message']; ?>",
                            timer: 1000,
                            showConfirmButton: true
                        });
                    </script>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['error_message'])) : ?>
                    <script>
                        toastr.error("<?php echo $_SESSION['error_message']; ?>" );
                    </script>
                    <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_messagea'])) : ?>
                    <script>
                        new Noty({
                            type: "success",
                            text: "<?php echo $_SESSION['success_messagea']; ?>",
                            timeout: 1000
                        }).show();
                    </script>
                    <?php unset($_SESSION['success_messagea']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['success_messagea1'])) : ?>
                    <script>
                        new Noty({
                            type: "error",
                            text: "<?php echo $_SESSION['success_messagea1']; ?>",
                            timeout: 1000 
                        }).show();
                    </script>
                    <?php unset($_SESSION['success_messagea1']); ?>
                <?php endif; ?>
                <?php if (isset($_SESSION['eliminado'])) : ?>
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Eliminado",
                            text: "<?php echo $_SESSION['eliminado']; ?>",
                            timer: 1000,
                            showConfirmButton: true
                        });
                    </script>
                    <?php unset($_SESSION['eliminado']); ?>
                <?php endif; ?>
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0 text-white">Lista de registro de administradores del sistema</h5>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModalLong">
                                <i class="ri-add-line align-bottom me-1"></i> Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="cambios table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Nombres y apellidos</th>
                                        <th>Documento</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Cargo</th>
                                        <th>Estado</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $datas = UserData::vercontenido();
                                    foreach ($datas as $data) { ?>
                                    <tr>
                                        <td><?= $data->nombre.", ".$data->apellido;?></td>
                                        <td><?= $data->tipodocumento.": ".$data->documento;?></td>
                                        <td><?= $data->telefono;?></td>
                                        <td><?= $data->email;?></td>
                                        <td><?= $data->cargos;?></td>
                                        <td>
                                            <?php if ($data->estado == 1) { ?>
                                                <i class="ri-check-line text-success"></i> 
                                            <?php } else { ?>
                                                <i class="ri-close-line text-danger"></i>
                                            <?php } ?>
                                        </td>
                                        <td><a  data-bs-toggle="modal"  data-bs-target="#EditarModal-<?= $data->id;?>"><i class=" ri-edit-2-fill align-bottom me-1"></i></a> <a data-bs-toggle="modal"  data-bs-target="#eliminarmodal-<?= $data->id;?>"><i class="ri-delete-bin-2-line align-bottom me-1"></i></a>
<!-- Modal Editar -->
<div class="modal fade" id="EditarModal-<?= $data->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-5">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Actualizar registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="post" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <a href="URL_DE_LA_IMAGEN" target="_blank">
                    <?php if ($data->imagen=="") {  ?>
                    <img class="imagen1" src="storage/per/logo.png" alt="">
                    <?php } else { ?>
                        <img class="imagen1" src="storage/archivo/<?= $data->imagen;?>" alt="">
                    <?php } ?>
                </a>
                  <style>.imagen1 {
                      max-width: 20%;
                      height: auto;
                      border: 2px solid #ccc;
                      border-radius: 10px;
                      box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                      display: block;
                      margin: 0 auto;
                  }
                </style>
                <div class="col-md-6">
                    <label class="form-label" for="first-name"> Rol</label>
                    <select class="form-control" required name="cargo">
                        <?php $roles = CargoData::vercontenido();
                        foreach ($roles as $rl) { ?>
                             <option <?php if ($rl->id==$data->cargo) {
                                echo "selected";
                             } ?> value="<?= $rl->id ;?>"><?= $rl->nombre ;?></option>
                        <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Nombre</label>
                    <input class="form-control" value="<?= $data->nombre;?>" name="nombre" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Apellido</label>
                    <input class="form-control" value="<?= $data->apellido;?>" name="apellido" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Tipo Doc.</label>
                    <select name="tipodocumento" class="form-control">
                        <option value="<?= $data->tipodocumento;?>"><?= $data->tipodocumento;?></option>
                        <option value="DNI">DNI</option>
                        <option value="Carnet">Carnet</option>
                    </select>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Número Doc.</label>
                    <input type="text" value="<?= $data->documento;?>" class="form-control" name="documento" required>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Teléfono</label>
                    <input class="form-control" value="<?= $data->telefono;?>" name="telefono" type="text" aria-label="First name">
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Email</label>
                    <input class="form-control" value="<?= $data->email;?>" required name="email" type="email" aria-label="First name">
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Dirección</label>
                    <textarea class="form-control" name="direccion"><?= $data->direccion;?></textarea>
                  </div>
                  <div class="col-md-8"> 
                    <label class="form-label" for="first-name"> Foto</label>
                    <input id="file-upload" class="file-input form-control" name="imagen" type="file" aria-label="Foto">
                    <input class="form-control" value="<?= $data->imagen;?>" required name="imagen1" type="hidden" aria-label="First name">
                    <span class="file-custom"></span>
                  </div>
                  <div class="col-md-4"> 
                    <div class="form-check form-switch form-switch-lg" dir="ltr">
                        <label class="form-check-label" for="customSwitchsizelg">Estado</label>
                        <input type="checkbox" name="estado" class="form-check-input form-control" <?php if ($data->estado==1) {
                            echo "checked";
                        } ?> >
                    </div>
                </div>
                <hr>
                <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Usuario</label>
                    <input class="form-control" name="usuario" type="text" aria-label="First name">
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Password</label>
                    <input class="form-control" name="password" type="password" aria-label="First name">
                  </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
            <input class="form-control" type="hidden" name="actions" value="5">
            <input class="form-control" type="hidden" name="id" value="<?= $data->id;?>">
            <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-light me-2">Guardar Cambio</button>
          </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Eliminar -->
<div class="modal fade" id="eliminarmodal-<?= $data->id;?>" tabindex="-1" aria-labelledby="modalEliminarTitulo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body text-center"> 
        <img src="storage/per/danger.gif" width="20%" alt="Advertencia" class="img-fluid mb-3">
        <h4 class="pb-2">Eliminar</h4>
        <p>¿Estás seguro de eliminar este registro?</p>
        <form class="needs-validation" novalidate method="post" action="index.php?action=registro">
          <input type="hidden" name="actions" value="6">
          <input type="hidden" name="id" value="<?= $data->id;?>">
          <div class="modal-footer justify-content-center">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
            <button class="btn btn-danger" type="submit">Eliminar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
                                    </td>

                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Registro -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-5">
      <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label" for="first-name"> Rol</label>
                    <select class="form-control" id="cargo-fieldd" required name="cargo">
                        <option value="">Eligir</option>
                    </select>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Nombre</label>
                    <input class="form-control" name="nombre" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Apellido</label>
                    <input class="form-control" name="apellido" id="validationCustom01" type="text" aria-label="First name" required>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Tipo Doc.</label>
                    <select name="tipodocumento" class="form-control">
                        <option value="">Eligir</option>
                        <option value="DNI">DNI</option>
                        <option value="Carnet">Carnet</option>
                    </select>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Número Doc.</label>
                    <input type="text" class="form-control" name="documento" required>
                  </div>
                  <div class="col-md-4"> 
                    <label class="form-label" for="first-name"> Teléfono</label>
                    <input class="form-control" name="telefono" type="text" aria-label="First name">
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Dirección</label>
                    <textarea class="form-control" name="direccion"></textarea>
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Email</label>
                    <input class="form-control" required name="email" type="email" aria-label="First name">
                  </div>
                  <div class="col-md-12"> 
                    <label class="form-label" for="first-name"> Foto</label>
                    <input id="file-upload" class="file-input form-control" name="imagen" type="file" aria-label="Foto">
                    <span class="file-custom"></span>
                  </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
              <input class="form-control" type="hidden" name="actions" value="4">
              <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-light">Guardar registro</button>
            </div>
        </form>
        
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $('#exampleModalLong').on('show.bs.modal', function() {
            if ($('#cargo-fieldd option').length <= 1) {
                    $.ajax({
                        url: 'index.php?action=apicargos',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            data.forEach(function(cargo) {
                                $('#cargo-fieldd').append($('<option>', {
                                    value: cargo.id,
                                    text: cargo.nombre
                                }));
                            });
                        }
                    });
                }
        });
    });
</script>
<script>
    flatpickr("#datePicker", {
        plugins: [
            new flatpickr.plugins.monthSelect({shorthand: true, dateFormat: "m.y", altFormat: "F Y", theme: "light"}), // or "dark"
            new flatpickr.plugins.yearSelect({shorthand: true, dateFormat: "Y", altFormat: "Y", theme: "light"}) // or "dark"
        ],
        enableTime: false,
        dateFormat: "Y",
        defaultDate: new Date(),
        onChange: function(selectedDates, dateStr, instance) {
            // Puedes manejar cambios adicionales aquí si es necesario
        }
    });
</script>