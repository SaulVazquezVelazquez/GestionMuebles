<div class="content-page rtl-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Cotizaciones Pendientes</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                <?php if (empty($items)) {
                                        echo "<h3 style='text-align: center;'> <i class='ri-information-line'></i>"."Sin Registros"."</h3>";
                                    } else {        ?>
                                    <table id="datatable" class="table data-table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Folio</th>
                                                <th>Cliente</th>
                                                <th>Tipo</th>
                                                <th>Fecha Creacion</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php foreach ($items as $item) : ?>
                                            <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $item['folio_consecutivo']; ?></td>
                                                <td><?= $item['card_foreign_name']; ?></td>
                                                <td><?= $item['tipo_cotizacion']; ?></td>
                                                <td><?= $item['f_registro']; ?></td>
                                                <td>
                                                    <a href="<?= base_url();?>cotizaciones-pendientes-detalle/<?= $item['id_cotizacion']; ?>/<?= $item['id_business_partnes']; ?>"> <button type="button" class="btn btn-outline-success mt-2"><i class="ri-heart-line"></i>Detalles</button></a>
                                                </td>
                                            </tr>
                                            
                                            <?php endforeach; ?>
                                        </tbody>
                                       
                                       
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>