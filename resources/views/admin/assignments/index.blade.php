
@extends('layouts.app')
@section('title') Listado de Levantamientos @endsection
@section('page_active') Levantamientos @endsection 
@section('subpage_active') Listado @endsection 

@section('content') 
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14 mb-3" style="position: relative;height: 50px;">
                        <a href="{{ Asset($link . 'create') }}" type="button" class="btn btn-success waves-effect waves-light" style="float: right;">
                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Agregar elemento
                        </a>
                    </p>

                    <table id="responsive-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr> 
                                <th>Nombre del director</th>  
                                <th>CCT</th>
                                <th>IVA</th>
                                <th>total</th>
                                <th>Asignación</th>
                                <th>status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr> 
                                    <td>
                                        {{ $row['school']['director'] }}  
                                    </td>
                                    <td>
                                        {{ $row['school']['cct'] }}  
                                    </td>
                                    <td>
                                        ${{ number_format($row['iva'],2) }}
                                    </td>
                                    <td>
                                        ${{ number_format($row['total'],2) }}
                                    </td>
                                    <td>
                                        @if ($row['manager_id'] != 0)
                                        <span class="badge bg-success rounded-pill"style="cursor:pointer;"  onclick="showMsg('<span>Asignado al Jefe de obra: <br /><hr><strong>{{$row['manager']['name']}}</strong> <br /> <small>Date:{{ $row['updated_at'] }}</small> </span>')">
                                            Asignado <i class="mdi mdi-check-all"></i> 
                                        </span>
                                        @else 
                                        <span class="badge bg-danger rounded-pill">
                                            Sin Asignar <i class="mdi mdi-close"></i> </span>
                                        @endif

                                    </td>
                                    <td>
                                        @if ($row['status'] == 1) 
                                            <span class="badge bg-success rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row['id']) }}')">
                                                Activo <i class="mdi mdi-check-all"></i> </span>
                                        @elseif($row['status'] == 2)
                                            <span class="badge bg-danger rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row['id']) }}')">
                                                Inactivo <i class="mdi mdi-close"></i> </span>
                                        @elseif($row['status'] == 3)
                                            <span class="badge bg-success rounded-pill">
                                                Evidencia enviada <i class="mdi mdi-check-all"></i> </span>
                                        @endif 
                                    </td>  
                                    <td width="17%" style="text-align: right"> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Menú <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ Asset($link . $row['id'] . '/edit') }}" class="dropdown-item">
                                                    <i class="mdi mdi-border-color"></i> Editar 
                                                </a>
                                                <a href="{{ route('assignments.print', $row['uuid']) }}" class="dropdown-item">
                                                    <i class="mdi mdi-cloud-print"></i> Imprimir Alcance
                                                </a>
                                                <a href="{{ route('assignments.print.labour', $row['uuid']) }}" class="dropdown-item">
                                                    <i class="mdi mdi-cloud-print"></i> Imprimir Mano de obra
                                                </a>
                                                <a href="{{ route('assignments.print.certificate', $row['uuid']) }}" class="dropdown-item">
                                                    <i class="mdi mdi-cloud-print"></i> Imprimir Acta de entrega
                                                </a>
                                                <div class="dropdown-divider"></div>

                                                <button type="button"
                                                    class="dropdown-item"
                                                    onclick="deleteConfirm('{{ Asset($link . 'delete/' . $row['id']) }}')">
                                                    <i class="mdi mdi-delete-forever"></i> Eliminar 
                                                </button> 
                                            </div>
                                        </div>
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
