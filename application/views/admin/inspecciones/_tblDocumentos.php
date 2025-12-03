<?php if (empty($documentos)) : ?>

    <div class="alert alert-info py-2">
        No hay documentos cargados para esta inspección.
    </div>

<?php else : ?>

<div class="table-responsive">
    <table  id="tblDocumentos" class="table table-sm table-hover align-middle">
        <thead>
            <tr class="text-center bg-secondary text-light">
                <th class="border-bottom border-primary">Tipo</th>
                <th class="border-bottom border-primary">Archivo</th>
            <th class="border-bottom border-primary">Fecha</th>
                <th class="border-bottom border-primary" style="width:90px;">Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($documentos as $doc): ?>
            <tr class="text-center">

                <!-- Tipo -->
                <td><?= esc($doc->tipo) ?></td>

                <!-- Archivo -->
                <td class="text-start">
                    <?= esc($doc->nombre_archivo) ?>
                </td>

                <!-- Fecha -->
                <td>
                    <?= date('d/m/Y H:i', strtotime($doc->created_at)) ?>
                </td>

                <!-- ACCIONES -->
                <td>

                    <div class="btn-group btn-group-sm" role="group">

                        <!-- DOWNLOAD -->
                        <a href="<?= base_url('uploads/documentos_inspecciones/' . $doc->archivo) ?>"
                           class="btn btn-success"
                           title="Descargar"
                           target="_blank">
                            <i class="bi bi-download"></i>
                        </a>

                        <!-- DELETE -->
                        <button type="button"
                                class="btn btn-danger btnDeleteDoc"
                                data-id="<?= $doc->id_documento ?>"
                                title="Eliminar documento">
                            <i class="bi bi-trash3"></i>
                        </button>

                    </div>

                </td>

            </tr>
        <?php endforeach; ?>

        </tbody>
    </table>
</div>

<?php endif; ?>
