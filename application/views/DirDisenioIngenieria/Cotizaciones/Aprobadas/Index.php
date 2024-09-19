<div class="content-page rtl-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Cotizaciones Aprobadas</h4>
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
                                                <th>Folio</th>
                                                <th>Cliente</th>
                                                <th>Fecha Creacion</th>
                                                <th>Estatus</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                        <?php foreach ($items as $item) : ?>
                                            <tr>
                                                <td><?= $item['folio_consecutivo']; ?></td>
                                                <td><?= $item['card_foreign_name']; ?></td>
                                                <td><?= $item['f_registro']; ?></td>
                                                <td><?= $item['estatus']; ?></td>
                                                <td>
                                                    <a href="<?= base_url();?>cotizaciones-aprobada-detalle/<?= $item['id_cotizacion']; ?>/<?= $item['id_business_partnes']; ?>"> <button type="button" class="btn btn-outline-success mt-2">Revisar</button></a>
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