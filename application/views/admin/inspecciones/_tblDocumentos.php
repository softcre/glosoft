<?php if (empty($documentos)) : ?>

    <div class="alert alert-info py-2">
        No hay documentos cargados para esta inspección.
    </div>

<?php else : ?>

<div class="table-responsive">
    <table id="tblDocumentos" class="table table-sm table-hover align-middle">
        <thead>
            <tr class="table-success  text-center">
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Archivo</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center" style="width:100px;">Acciones</th>
            </tr>
        </thead>

        <tbody>

        <?php foreach ($documentos as $doc): ?>
            <tr class="text-center" id="docRow_<?= $doc->id_documento ?>">

                <!-- Tipo -->
                <td><?= htmlspecialchars($doc->tipo, ENT_QUOTES, 'UTF-8') ?></td>

                <!-- Archivo -->
                <td class="text-start">
                    <?= htmlspecialchars($doc->archivo, ENT_QUOTES, 'UTF-8') ?>
                </td>

                <!-- Fecha -->
                <td>
                    <?= date('d/m/Y H:i', strtotime($doc->created_at)) ?>
                </td>

                <!-- ACCIONES -->
                <td>
                    <div class="btn-group btn-group-sm" role="group">

                        <!-- DOWNLOAD -->
                        <a href="<?= base_url('assets/uploads/documentos_inspecciones/' . $doc->archivo) ?>"
                           class="btn btn-success"
                           title="Descargar"
                           target="_blank">
                            <i class="bi bi-download"></i>
                        </a>

                        <!-- DELETE -->
                        <button type="button"
                                class="btn btn-danger btnDeleteDoc"
                                data-url="<?= base_url(INSPECCIONES_PATH . '/eliminarDocumento/' . $doc->id_documento) ?>"
                                data-name="<?= $doc->id_documento ?>"
                                data-nombre="<?= htmlspecialchars($doc->archivo, ENT_QUOTES, 'UTF-8') ?>"
                                onclick="eliminarDocumento(this)"
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
