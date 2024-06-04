
@extends('layouts.app')
@section('title') Listado de Evidencias @endsection
@section('page_active') Evidencias @endsection 
@section('subpage_active') Listado @endsection 

@section('content') 
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                     

                    <table id="responsive-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr> 
                                <th>Jefe de obra</th>
                                <th>Antes</th>
                                <th>Despues</th>
                                <th>status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>
                                        {{ $row->managers_id }}    
                                    </td>
                                    <td>
                                        <i class="mdi mdi-tooltip-image"></i>
                                    </td>
                                    <td>
                                        <i class="mdi mdi-tooltip-image"></i>
                                    </td>
                                    <td>
                                        @if ($row->status == 1) 
                                            <span class="badge bg-success rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">
                                                Activo <i class="mdi mdi-check-all"></i> </span>
                                        @else 
                                            <span class="badge bg-danger rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row->id) }}')">
                                                Inactivo <i class="mdi mdi-close"></i> </span>
                                        @endif

                                    </td>  
                                    <td width="17%" style="text-align: right"> 
                                        <a href="{{ Asset($link . $row->id . '/edit') }}"
                                            class="btn btn-success waves-effect waves-light btn m-b-15 ml-2 mr-2 btn-md"
                                            data-toggle="tooltip" data-placement="top"
                                            data-original-title="Editar">
                                            <i class="mdi mdi-cloud-download-outline"></i>
                                            &nbsp; Descargar
                                        </a> 
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
