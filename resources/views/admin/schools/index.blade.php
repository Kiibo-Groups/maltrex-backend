
@extends('layouts.app')
@section('title') Listado de Escuelas @endsection
@section('page_active') Escuelas @endsection 
@section('subpage_active') Listado @endsection 

@section('content') 
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <p class="text-muted font-14 mb-3" style="position: relative;height: 50px;">
                        <a href="{{ Asset($link . 'create') }}" type="button" class="btn btn-success waves-effect waves-light" style="float: right;">
                            <span class="btn-label"><i class="mdi mdi-check-all"></i></span>Agregar elemento
                        </a>
                    </p>

                    <table id="responsive-datatable" class="table dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Nombre</th> 
                                <th>Director</th>
                                <th>Direccion</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Proveedor</th>
                                <th>status</th>
                                <th style="text-align: right">Opciones</th>
                            </tr> 
                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>
                                        {{ $row->name }}    
                                    </td>
                                    <td>
                                        {{ $row->director }}
                                    </td>
                                    <td>
                                        {{ $row->direccion }}
                                    </td>
                                    <td>
                                       {{ $row->email }}
                                    </td>
                                    <td>
                                       {{ $row->phone }}
                                    </td>
                                    <td>
                                        {{ $row->proveedor }}
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
                                            data-original-title="Editar"><i
                                                class="mdi mdi-border-color"></i></a>

                                        <button type="button"
                                            class="btn m-b-15 ml-2 mr-2 btn-md  btn btn-danger waves-effect waves-light"
                                            data-toggle="tooltip" data-placement="top"
                                            data-original-title="Eliminar"
                                            onclick="deleteConfirm('{{ Asset($link . 'delete/' . $row->id) }}')"><i
                                                class="mdi mdi-delete-forever"></i></button> 
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
