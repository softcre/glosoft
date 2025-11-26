<?php if (empty($audios)) : ?>

<div class="alert alert-info text-center m-2">
    No hay audios registrados.
</div>

<?php else : ?>

<table id="tblAudios" class="table table-sm table-hover align-middle">
    <thead>
        <tr class=" table-success  text-center"> 
          <th scope="col" class="text-center">Titulo</th>
          <th scope="col" class="text-center">Archivo</th>
          <th scope="col" class="text-center">Fecha</th>
          <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody class="align-middle text-center">
        <?php foreach ($audios as $a): ?>
        <tr>
            <td><?= $a->descripcion ?></td>
            <td><?= $a->titulo ?></td>
         
            <td><?= $a->created_at ?></td>

            <td class="text-center">

                <!-- Open audio in browser tab -->
                <a class="btn btn-primary btn-sm"
                   target="_blank"
                   href="<?= base_url('assets/uploads/audios/' . $a->titulo) ?>"  title='Reproducir'>
                    <i class="bi bi-play-circle"></i>
                   
                </a>

                <!-- Delete button -->
                <!-- <button class="btn btn-danger btn-sm"
                        data-url="<?= base_url('inspecciones/deleteAudio/' . $a->id_audio) ?>"
                        data-name="<?= $a->archivo ?>"
                        onclick="eliminar(this)">
                    Eliminar
                </button> -->
              <button type="button" class="btn btn-danger btn-sm" title="Eliminar" data-url="<?= base_url(INSPECCIONES_PATH . '/eliminarAudio/' . $a->id_audio) ?>" data-name="<?= $a->id_audio; ?>" onclick="eliminarAudio(this)">
                <i class="bi bi-trash-fill"></i>
              </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
