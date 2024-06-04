
@extends('layouts.app')
@section('title') Gestion de Asignaciones @endsection
@section('page_active') Asignaciones @endsection 
@section('subpage_active') Editar Elemento @endsection 

@section('content')
    {!! Form::model($data, ['url' => $form_url,'files' => true,'method' => 'PATCH']) !!}
    <input type="hidden" value="{{$data->id}}" name="id">
        @include('admin.assignments.form')
    </form>
@endsection