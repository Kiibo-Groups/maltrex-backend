
@extends('layouts.app')
@section('title') Listado de Evidencias @endsection
@section('page_active') Evidencias @endsection 
@section('subpage_active') Graficas @endsection 
  
@section('content') 
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Promedio % Completado</h4>
                    <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Conceptos</h4>
                    <div id="pie-chart">
                        <div id="pie-chart-container" class="flot-chart" style="height: 260px;"></div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Total de conceptos</h4>
                    <div id="horizontal-bar-chart" class="ct-chart ct-golden-section"></div>
                </div>
            </div>
        </div>

        
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Escuela</h4> 
                    <div class="mt-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck1">
                            <label class="form-check-label" for="customCheck1" disabled>24 de Febrero</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck2">
                            <label class="form-check-label" for="customCheck2" disabled>Eugenia</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck2">
                            <label class="form-check-label" for="customCheck2" disabled>MARIANO ESCOBEDO</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="customCheck2">
                            <label class="form-check-label" for="customCheck2" disabled>Prof. Anastacio</label>
                        </div>
                    </div>


                    <div class="mt-5">
                        <h4 class="header-title mt-0">Promedio Total</h4> 
                        <div style="display: block;text-align: center;padding: 50px;border: 1px solid #e1e1e1;">
                            Promedio de %<br />
                            <h1>99.67</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection


@section('js')
<!--Morris Chart-->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Dashboar init js-->
<script>
 

// Bar Chart
var options_bar = {
    series: [{
        name: "'Promedio % Completado",
        data: [
            {
                x: 'Eugenio',
                y: 100
            }, {
                x: 'MARIANO ESCOBEDO',
                y: 100
            }, {
                x: 'Prof. Anastacio',
                y: 100
            }, {
                x: '24 de Febrero',
                y: 100
            }
        ]
    }],
        chart: {
        type: 'bar',
        height: 380
    },
    xaxis: {
        type: 'category',
        group: {
            style: {
                fontSize: '10px',
                fontWeight: 700
            }
        }
    }
};

var chart_bar = new ApexCharts(document.querySelector("#morris-bar-example"), options_bar);
chart_bar.render();


// PIE Chart
var options_pie_chart = {
    series: [
        13,
        7,
        7,
        3
    ],
    chart: {
        width: 500,
        type: 'pie',
    },
    labels: [
        "24 de Febrero",
        "Mariano Escobedo",
        "Prof. Anastacio",
        "Eugenio"
    ],
    responsive: [{
        breakpoint: 480,
        options: {
        chart: {
            width: 300
        },
        legend: {
            position: 'bottom'
        }
        }
    }]
};

var pie_chart = new ApexCharts(document.querySelector("#pie-chart-container"), options_pie_chart);
pie_chart.render();
      

// Horizontal bar char
var options_horizontal_char = {
    series: [{
        data: [
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
            100,
        ]
    }],
        chart: {
        type: 'bar',
        height: 780
    },
    plotOptions: {
        bar: {
            borderRadius: 4,
            borderRadiusApplication: 'end',
            horizontal: true,
        }
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: [
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
            '24D01',
        ],
    }
};

var Bar_chart_horizontal = new ApexCharts(document.querySelector("#horizontal-bar-chart"), options_horizontal_char);
Bar_chart_horizontal.render();
    
</script>
@endsection