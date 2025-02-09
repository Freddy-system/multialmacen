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
                            <h5 class="card-title mb-0 text-white">Lista de registro de Articulos</h5>
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#showModal">
                                <i class="ri-add-line align-bottom me-1"></i> Nuevo registro
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="cambios table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Articulo</th>
                                        <th>Categoria</th>
                                        <th>Código</th>
                                        <th>Precio de Compra</th>
                                        <th>Precio de lista</th>
                                        <th>Precio 1</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $datas = ArticuloData::vercontenido();
                                    foreach ($datas as $data) { ?>
                                    <tr>
                                        <td><?= $data->nombre;?></td>
                                        <td><?= $data->categorias;?></td>
                                        <td><?= $data->codigo;?></td>
                                        <td><?= $data->preciocompra;?></td>
                                        <td><?= $data->precio1;?></td>
                                        <td><?= $data->precio2;?></td>
                                        <td><a  data-bs-toggle="modal"  data-bs-target="#EditarModal-<?= $data->id;?>"><i class=" ri-edit-2-fill align-bottom me-1"></i></a> <a data-bs-toggle="modal"  data-bs-target="#eliminarmodal-<?= $data->id;?>"><i class="ri-delete-bin-2-line align-bottom me-1"></i></a>
<!-- Modal Editar -->
<div class="modal fade" id="EditarModal-<?= $data->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Actualizar registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-10">
                            <label for="basiInput" class="form-label">nombre del Articulo / Producto / Material <b style="color: #FF0000;">*</b></label>
                            <input type="text" value="<?= $data->nombre;?>" required name="nombre" class="form-control" id="basiInput">
                        </div>
                        <div class="col-md-4">
                            <label for="basiInput" class="form-label">Categoria <b style="color: #FF0000;">*</b></label>
                            <select  name="categoria" required class="form-select rounded-pill">
                                <option selected value="">Seleccionar</option>
                            <?php $cartegoriasdata = CategoriaData::vercontenido();
                            foreach ($cartegoriasdata as $category) { ?>
                                <option <?php if ($category->id==$data->categoria) {
                                    echo "selected";
                                } ?> value="<?= $category->id;?>"><?= $category->nombre;?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="basiInput" class="form-label">Precio de compra</label>
                            <input type="text"  value="<?= $data->preciocompra;?>" name="preciocompra" class="form-control" id="basiInput">
                        </div>
                        <div class="col-md-3">
                            <label for="basiInput" class="form-label">Precio de lista</label>
                            <input type="text" name="precio1" value="<?= $data->precio1;?>" class="form-control" id="basiInput">
                        </div>
                        <div class="col-md-3">
                            <label for="basiInput" class="form-label">Precio de 1</label>
                            <input type="text" name="precio2"  value="<?= $data->precio2;?>" class="form-control" id="basiInput">
                        </div>
                        <div class="col-md-3">
                            <label for="basiInput" class="form-label">Precio de 2</label>
                            <input type="text" name="precio3"  value="<?= $data->precio3;?>" class="form-control" id="basiInput">
                        </div>
                        <div class="col-md-6">
                            <label for="basiInput" class="form-label">Imagen</label>
                            <input type="file" name="imagen" class="form-control" id="basiInput">
                            <input class="form-control" value="<?= $data->imagen;?>" required name="imagen1" type="hidden" aria-label="First name">
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                            <label for="basiInput" class="form-label">Código</label>
                            <input type="text" required name="codigo" value="<?= $data->codigo;?>" class="form-control" id="basiInput">
                        </div>
                    </div>
                </div>
               <div class="col-md-2" href="URL_DE_LA_IMAGEN" target="_blank">
                    <div style="width: 100%; height: 100%;">
                        <?php if ($data->imagen=="") {  ?>
                            <img class="imagen1" src="storage/per/logo.png" alt="">
                        <?php } else { ?>
                            <img class="imagen1" src="storage/archivo/<?= $data->imagen;?>" alt="">
                        <?php } ?>
                    </div>
                </div>
                    <style>
                        .imagen1 {
                            width: 100%; /* Ancho al 100% del contenedor */
                            height: auto; /* Altura automática para mantener la proporción */
                            border: 2px solid #ccc;
                            border-radius: 10px;
                            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                            display: block;
                            margin: 0 auto;
                        }
                    </style>
            </div>
            </div>
         
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
            <input class="form-control" type="hidden" name="actions" value="17">
            <input class="form-control" type="hidden" name="id" value="<?= $data->id;?>">
            <button type="button" class="btn btn-outline-light me-2" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-light me-2">Guardar Cambio</button>
          </div>
        </form>
        </div>
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
          <input type="hidden" name="actions" value="18">
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
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
        <h5 class="modal-title text-white" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form enctype="multipart/form-data" method="POST" class="tablelist-form" autocomplete="off" action="index.php?action=registro">
        <div class="modal-body bg-light">
            <div class="row">
                <div class="col-md-8">
                    <label for="basiInput" class="form-label">nombre del Articulo / Producto / Material <b style="color: #FF0000;">*</b></label>
                    <input type="text" required name="nombre" class="form-control" id="basiInput">
                </div>
                <div class="col-md-4">
                    <label for="basiInput" class="form-label">Categoria <b style="color: #FF0000;">*</b></label>
                    <select  name="categoria" required class="form-select rounded-pill">
                        <option selected value="">Seleccionar</option>
                    <?php $cartegoriasdata = CategoriaData::vercontenido();
                    foreach ($cartegoriasdata as $category) { ?>
                        <option  value="<?= $category->id;?>"><?= $category->nombre;?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="basiInput" class="form-label">Precio de compra</label>
                    <input type="text" name="preciocompra" class="form-control" id="basiInput">
                </div>
                <div class="col-md-3">
                    <label for="basiInput" class="form-label">Precio de lista</label>
                    <input type="text" name="precio1" class="form-control" id="basiInput">
                </div>
                <div class="col-md-3">
                    <label for="basiInput" class="form-label">Precio de 1</label>
                    <input type="text" name="precio2" class="form-control" id="basiInput">
                </div>
                <div class="col-md-3">
                    <label for="basiInput" class="form-label">Precio de 2</label>
                    <input type="text" name="precio3" class="form-control" id="basiInput">
                </div>
                <div class="col-md-6">
                    <label for="basiInput" class="form-label">Imagen</label>
                    <input type="file" name="imagen" class="form-control" id="basiInput">
                </div>
                <div class="col-md-2">
                </div>
                <div class="col-md-4">
                    <label for="basiInput" class="form-label">Código</label>
                    <input type="text" required name="codigo" class="form-control" id="basiInput">
                </div>
            </div>
          </div>
          <div class="modal-footer bg-info d-flex justify-content-between pb-0">
              <input class="form-control" type="hidden" name="actions" value="16">
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