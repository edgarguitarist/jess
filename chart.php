<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chart - Letras y Vida</title>
    <?php
    include "includes/scripts.php";
    include "includes/conexion.php";
    ?>

</head>

<div style='width: 100%;'>
    <canvas id='chart1' width='100' height='20'></canvas>
    <script>
        var ctx = document.getElementById('chart1');

        var data = {
            labels: ['EXCELENTE ', 'MUY BUENO ', 'BUENO ', 'REGULAR '],
            datasets: [{
                label: 'Docentes',
                data: [5, 12, 2, 8],
                backgroundColor: ['#013C8088', '#F4CE0088', '#FD770088', '#cf161688'],
                borderColor: '#ededed'
            }]
        };
        var matriz =[[],[],['   Andrea Regalado', '   Daniela Cede�o', '   Daysi Cajo', '   Evelyn Mina', '   Gabriela Galarza', '   Jorge Teran', '   Leticia Tamayo', '   Marisol Cede�o', '   Mayra Hidalgo', '   Sandra Moscol', '   Sebastian Romero', '   Troy Reyes', '   Yesenia Herrera', '   Yuliana Franco', ],[]];

        var chart1 = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: {
                legend: {
                    display: true
                },
                animation: {
                    duration: 1200,
                    easing: "easeOutQuart",
                    onComplete: function() {
                        var ctx = this.chart.ctx;

                        
                        ctx.font = '16px LatoRegular, Helvetica,sans-serif';
                        ctx.font.weight = '900';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';
                        this.data.datasets.forEach(function(dataset) {
                            for (var i = 0; i < dataset.data.length; i++) {
                                var m = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                    t = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                    mR = m.innerRadius + (m.outerRadius - m.innerRadius) / 2,
                                    sA = m.startAngle,
                                    eA = m.endAngle,
                                    mA = sA + (eA - sA) / 2;
                                var x = mR * Math.cos(mA);
                                var y = mR * Math.sin(mA);
                                ctx.fillStyle = '#000';

                                var p = String(Math.round(dataset.data[i] / t * 100)) + "%";
                                if (dataset.data[i] > 0) {
                                    //ctx.fillText(dataset.data[i], m.x + x, m.y + y-10);
                                    ctx.fillText(p, m.x + x, m.y + y + 5);
                                }
                            }
                        });
                    }
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                        return data['labels'][tooltipItem[0]['index']];
                        },
                        beforeLabel: function(tooltipItem, data) {
                        return 'No. de Docentes: ' + data['datasets'][0]['data'][tooltipItem['index']];
                        },
                        label: function(tooltipItem, data) {
                        //var multistringText = ['label 1' + tooltipItem['index'],'label 2','label 3','label 4']; //Cambiar el array por una matriz para mostrar los datos segun la key que tengan, por ejemplo: todos los docentes de excelente, luego todos los docentes de muy bueno y asi sucesivamente...      
                        
                        var multistringText = matriz[tooltipItem['index']];
                        return multistringText;
                        },
                        afterLabel: function(tooltipItem, data) {
                        var dataset = data['datasets'][0];
                        var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset['_meta'][0]['total']) * 100)
                        return 'Porcentaje: ' + percent + '%';
                        }
                    },
                    backgroundColor: '#FFF',
                    titleFontSize: 16,
                    titleFontColor: '#013C80',
                    bodyFontColor: '#000',
                    bodyFontSize: 14,
                    displayColors: false
                }
            }
        });
    </script>
</div>
<br>

<div style='width: 100%;'>
    <canvas id='chart2' width='100' height='20'></canvas>
    <script>

function formatTime(secs)
{
var hours = Math.floor(secs / (60 * 60));

var divisor_for_minutes = secs % (60 * 60);
var minutes = Math.floor(divisor_for_minutes / 60);

var divisor_for_seconds = divisor_for_minutes % 60;
var seconds = Math.ceil(divisor_for_seconds);

return hours + ":" + minutes;
}


        var ctx = document.getElementById('chart2');
        var data = {
            labels: ['<h1>Excelente</h1>', 'MUY BUENO ', 'BUENO ', 'REGULAR '],
            datasets: [{
                labels: 'Promedio',
                data: [5, 12, 2, 8],
                backgroundColor: ['#013C8088', '#F4CE0088', '#FD770088', '#cf161688'],
                borderColor: '#ededed',
                fontColor: '#000000',
                hoverOffset: 10
            }]
        };
        /*var options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    display: false,
                },
                title: {
                    display: true,
                    text: 'resultados'
                },
                tooltip: {
                    callbacks: {
                        labelColor: function(context) {
                            return {
                                borderColor: 'rgb(0, 0, 255)',
                                backgroundColor: 'rgb(255, 0, 0)',
                                borderWidth: 2,
                                borderDash: [2, 2],
                                borderRadius: 2,
                            };
                        },
                        labelTextColor: function(context) {
                            return '#543453';
                        }
                    }
                }
            }            
        };*/


        var chart2 = new Chart(ctx, {
            type: 'pie',
            data: data,
            //options: options
            options: {
                legend: {
                    position: "right",
                    display: true,
                    text
                },
                plugins: {
                    beforeDraw: function(chart) {
                        override: {
                            data.datasets.data=['perro, gato, chivo', 'tu mama', 'gg', ''];
                        }
                    }
                }
            }
        });
    </script>
</div><BR>


<div style='width: 100%;'>
    <canvas id='chart5' width='100' height='20'></canvas>
    <script>
        var ctx = document.getElementById('chart5');
        var data = {
            labels: ['EXCELENTE ', 'MUY BUENO ', 'BUENO ', 'REGULAR '],
            datasets: [{
                label: 'Promedio',
                data: [5, 12, 2, 8],
                backgroundColor: ['#013C8088', '#F4CE0088', '#FD770088', '#cf161688'],
                borderColor: '#ededed',
                fontColor: '#000000'
            }]
        };
        var options = {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'resultados'
                }
            }
        };

        var chart5 = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
</div><BR>