@extends("layouts.app")

@section('title') Dashboard | Maltrex @endsection

@section('page_active') Dashboard @endsection 
@section('subpage_active') Home @endsection 


@section('css') 
@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="header-title mt-0 mb-4">Escuelas Registradas</h4>

                    <div class="widget-chart-1"> 
                        <div class="widget-chart-box-1 float-end" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#000"
                                    data-bgColor="#e1e1e1" value="58"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                  
                    <h4 class="header-title mt-0 mb-4">Jefes de obra activos</h4>

                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-end" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#000"
                                    data-bgColor="#e1e1e1" value="15"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
 

        <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                  
                    <h4 class="header-title mt-0 mb-4">Levantamientos/Asignaciones</h4>

                    <div class="widget-chart-1">
                         
                        <div class="widget-chart-box-1 float-end" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#000"
                                    data-bgColor="#e1e1e1" value="35"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15"/>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->
 

      
    </div>
    <!-- end row -->

    <div class="row"> 
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0">Promedio % Completado</h4>
                    <div id="morris-bar-example" dir="ltr" style="height: 280px;" class="morris-chart"></div>
                </div>
            </div>
        </div><!-- end col -->
 
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    
                    <h4 class="header-title mt-0 mb-3">Ultimos Conceptos realizados</h4>

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Escuela</th>
                                <th>Jefe/Obra</th>
                                <th>Concepto</th>
                                <th>Avance</th>
                                <th>Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mariano Escobedo</td>
                                    <td>Miguel angel</td>
                                    <td>24D01</td>
                                    <td>100.00</td> 
                                    <td>01/01/2017</td>
                                </tr> 
                                <tr>
                                    <td>1</td>
                                    <td>24 de Febrero</td>
                                    <td>Miguel angel</td>
                                    <td>24D02</td>
                                    <td>100.00</td> 
                                    <td>01/01/2017</td>
                                </tr> 
                                <tr>
                                    <td>1</td>
                                    <td>Eugenio</td>
                                    <td>Adrian Quezada</td>
                                    <td>24D04</td>
                                    <td>100.00</td> 
                                    <td>01/01/2017</td>
                                </tr> 
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
            
        </div><!-- end col --> 
    </div>
    <!-- end row -->

     
</div>
@endsection

@section('js')
<!--Morris Chart-->
<script src="{{ asset('assets/libs/morris.js06/morris.min.js') }}"></script>
<!-- Dashboar init js-->
<script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
@endsection