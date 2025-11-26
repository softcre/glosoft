<?php if (empty($audios)) : ?>

<div class="alert alert-info text-center m-2">
    No hay audios registrados.
</div>

<?php else : ?>

<table id="tblAudios" class="table table-sm table-hover align-middle">
    <thead>
        <tr class=" table-success  text-center"> 
            <th scope="col" class="text-center">Archivo</th>
          <!--   <th>Duración</th> -->
            <th scope="col" class="text-center">Fecha</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody class="align-middle text-center">
        <?php foreach ($audios as $a): ?>
        <tr>
            <td><?= $a->titulo ?></td>
         <!--    <td><?= $a->duration ?> s</td> -->
            <td><?= $a->created_at ?></td>

            <td class="text-center">

                <!-- Open audio in browser tab -->
                <a class="btn btn-primary btn-sm"
                   target="_blank"
                   href="<?= base_url('uploads/audios/' . $a->titulo) ?>">
                    Reproducir
                </a>

                <!-- Delete button -->
                <button class="btn btn-danger btn-sm"
                        data-url="<?= base_url('inspecciones/deleteAudio/' . $a->id_audio) ?>"
                        data-name="<?= $a->archivo ?>"
                        onclick="eliminar(this)">
                    Eliminar
                </button>

            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
