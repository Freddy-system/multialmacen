<?php function formato_soles($monto) {
    $simbolo_moneda = "S/ ";
    $monto_formateado = number_format($monto, 2, '.', ',');
    $monto_formateado = $simbolo_moneda . $monto_formateado;
    return $monto_formateado;
} ?>
<div class="main-content"> 
    <div class="page-content">
        <div class="container-fluid"> 
            <div class="row">
                <div class="col">
                    <div class="h-100">
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <?php $personas = count(ClienteData::vercontenido()); ?>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Articulos</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i><?= $personas;?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?= $personas;?>"><?= $personas;?></span>  </h4>
                                                <a href="articulo" class="text-decoration-underline">Articulos</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-success rounded fs-3">
                                                    <i class="ri-file-settings-line text-success"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <?php $personas = count(ClienteData::vercontenido()); ?>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Colaboradores</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-danger fs-14 mb-0">
                                                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i> <?= $personas;?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?= $personas;?>"><?= $personas;?></span></h4>
                                                <a href="cliente" class="text-decoration-underline">Colaboradores</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-info rounded fs-3">
                                                    <i class="ri-user-heart-fill text-info"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div><!-- end col -->

                            <div class="col-xl-4 col-md-6">
                                <!-- card -->
                                <div class="card card-animate">
                                    <div class="card-body">
                                        <?php $user = count(UserData::vercontenido()); ?>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">TOTAL DE ADMINISTRADORES</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <h5 class="text-success fs-14 mb-0">
                                                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i><?= $user; ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-end justify-content-between mt-4">
                                            <div>
                                                <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?= $user; ?>"><?= $user; ?></span> </h4>
                                                <a href="usuario" class="text-decoration-underline">Administrador</a>
                                            </div>
                                            <div class="avatar-sm flex-shrink-0">
                                                <span class="avatar-title bg-soft-warning rounded fs-3">
                                                    <i class="ri-admin-fill text-warning"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>                      
                           </div>
                        </div> <!-- end row-->
                        <style>
                            .container {
                                max-width: 800px;
                                margin: 20px auto;
                                padding: 20px;
                                background-color: #fff;
                                border-radius: 8px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                            }
                            label {
                                font-size: 18px;
                                font-weight: bold;
                                margin-bottom: 10px;
                            }
                            select {
                                padding: 10px;
                                font-size: 12px;
                                border-radius: 5px;
                                border: 1px solid #ccc;
                                width: 100%;
                                max-width: 300px;
                            }
                            #chart {
                                margin-top: 20px;
                            }
                        </style>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                        <?php
                                        $base = Database::getInstance();
                                        $con = $base->getConnection();
                                        $query = "SELECT MONTH(fecha) AS mes, YEAR(fecha) AS anio, accion, SUM(cantidad) as cantidad_total FROM proceso GROUP BY anio, mes, accion";
                                        $result = mysqli_query($con, $query);
                                        $data = array(
                                            'compra' => array_fill(1, 12, 0), // Inicializa un array con 12 elementos con valor 0
                                            'venta' => array_fill(1, 12, 0) // Inicializa un array con 12 elementos con valor 0
                                        );
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            switch ($row['accion']) {
                                                case 1:
                                                    $data['compra'][$row['mes']] = $row['cantidad_total'];
                                                    break;
                                                case 2:
                                                    $data['venta'][$row['mes']] = $row['cantidad_total'];
                                                    break;
                                            }
                                        }
                                        ?>
                                    <div class="container">
                                        <label for="chartType">Selecciona el tipo de gráfico:</label>
                                        <select id="chartType">
                                            <option value="bar">Gráfico de Barras</option>
                                            <option value="line">Gráfico de Líneas</option>
                                            <option value="area">Gráfico de Área</option>
                                            <option value="pie">Gráfico de Torta</option>
                                        </select>
                                        <div id="chart"></div>
                                    </div>

                                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                                <script>
                                    var chartTypeSelect = document.getElementById('chartType');
                                    var chart;

                                    function renderChart(chartType) {
                                        if (chart) {
                                            chart.destroy();
                                        }

                                        var options = {
                                            // Configuración del gráfico
                                            chart: {
                                                type: chartType,
                                                height: 400,
                                                toolbar: {
                                                    show: false
                                                }
                                            },
                                            // Datos del gráfico
                                            series: [{
                                                name: 'Compras',
                                                data: <?= json_encode(array_values($data['compra'])) ?>
                                            }, {
                                                name: 'Ventas',
                                                data: <?= json_encode(array_values($data['venta'])) ?>
                                            }],
                                            // Configuración del eje X
                                            xaxis: {
                                                categories: <?= json_encode(array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic')) ?>
                                            },
                                            // Configuración del eje Y
                                            yaxis: {
                                                title: {
                                                    text: 'Cantidad',
                                                    style: {
                                                        color: '#333',
                                                        fontSize: '16px'
                                                    }
                                                },
                                                labels: {
                                                    style: {
                                                        colors: '#333',
                                                        fontSize: '14px'
                                                    }
                                                }
                                            },
                                            // Configuración de la leyenda
                                            legend: {
                                                position: 'top',
                                                horizontalAlign: 'center',
                                                offsetY: -20,
                                                labels: {
                                                    colors: '#333',
                                                    fontSize: '14px'
                                                }
                                            },
                                            // Configuración de la cuadrícula
                                            grid: {
                                                borderColor: '#ccc'
                                            }
                                        };

                                        if (chartType === 'pie') {
                                            // Configuración adicional para el gráfico de pie
                                            options.labels = <?= json_encode(array_keys($data['compra'])) ?>;
                                            options.chart.type = 'pie';
                                            options.chart.sparkline = {
                                                enabled: true
                                            };
                                        }

                                        // Crear el gráfico
                                        chart = new ApexCharts(document.querySelector("#chart"), options);
                                        chart.render();
                                    }

                                    // Evento de cambio de selección del tipo de gráfico
                                    chartTypeSelect.addEventListener('change', function () {
                                        renderChart(this.value);
                                    });

                                    // Renderizar el gráfico inicialmente
                                    renderChart(chartTypeSelect.value);
                                </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>