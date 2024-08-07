
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
                                <th># Levantamiento</th>
                                <th>Concepto</th>
                                <th>Antes</th>
                                <th>Inter</th>
                                <th>Despues</th>
                                <th>status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr> 
                                    <td>#{{ $row['assignments_id'] }}</td>
                                    <td>
                                        @if ($row['concept'])
                                            {{ $row['concept']['titulo'] }}
                                        @else
                                         Indefinido
                                        @endif 
                                    </td>
                                    <td>
                                        <a href="{{ url('getEvidence/'.$row['id'].'/before') }}">
                                            <i class="mdi mdi-cloud-download-outline"></i>
                                            &nbsp; Descargar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('getEvidence/'.$row['id'].'/during') }}">
                                            <i class="mdi mdi-cloud-download-outline"></i>
                                            &nbsp; Descargar
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ url('getEvidence/'.$row['id'].'/after') }}">
                                            <i class="mdi mdi-cloud-download-outline"></i>
                                            &nbsp; Descargar
                                        </a>
                                    </td>
                                    <td>
                                        @if ($row['status'] == 1) 
                                            <span class="badge bg-success rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row['id']) }}')">
                                                Activo <i class="mdi mdi-check-all"></i> </span>
                                        @else 
                                            <span class="badge bg-danger rounded-pill" onclick="confirmAlert('{{ Asset($link . 'status/' . $row['id']) }}')">
                                                Inactivo <i class="mdi mdi-close"></i> </span>
                                        @endif

                                    </td>  
                                    <td width="17%" style="text-align: right"> 
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary  dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Menú <i class="mdi mdi-chevron-down"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="{{ url('viewEvidence/'.$row['id']) }}" class="dropdown-item">
                                                    <i class="mdi mdi-border-color"></i> Ver Graficas 
                                                </a>
                                                <a href="{{ route('evidences.print', $row['id']) }}" target="_blank" class="dropdown-item">
                                                    <i class="mdi mdi-cloud-print"></i> Imprimir Formato de Evidencias
                                                </a>
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
