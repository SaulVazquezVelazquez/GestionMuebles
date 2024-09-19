<div class="content-page rtl-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Validaciones Aprobadas</h4>
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
                                                <th>Folio anterior</th>
                                                <th>Fecha Aplicacion</th>
                                                <th>Factor de cotizacion</th>
                                                <th>Lista de precio Anterior</th>
                                                <th>Lista de precio Nueva</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            <?php foreach($items as $item): ?>
                                            <tr>
                                                
                                                <td><?= $item['Folio'] ?></td>
                                                <td><?= $item['Cliente'] ?></td>
                                                <td><?= $item['Fecha creacion']; ?></td>
                                                <td><?= $item['Folio anterior']; ?></td>
                                                <td><?= $item['Fecha aplicacion']; ?></td>
                                                <td><?= $item['Factor cot']; ?></td>
                                                <td><?= $item['LP Anterior']; ?></td>
                                                <td><?= $item['LP Nueva']; ?></td>
                                         
                                               
                                                <td>
                                                    <a href="<?= base_url();?>cotizaciones-pendientes-detalle"> <button type="button" class="btn btn-outline-success mt-2">Detalles</button></a>
                                                    <a href="<?= base_url()?>assets/pdf/lps/<?= $item['LP Nueva'].$item['Cliente']; ?>.pdf"  target="_blank"> <button type="button" class="btn btn-outline-success mt-2">LP</button></a>
                                                    <a href="<?= base_url()?>assets/pdf/validaciones/<?= ucfirst(strtolower($item['Cliente']))?>_<?= $item['LP Nueva']; ?>.pdf"  target="_blank"> <button type="button" class="btn btn-outline-success mt-2">Validacion</button></a>
                                                   
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