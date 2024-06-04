
@extends('layouts.app')
@section('title') Gestion de Jefes de obra @endsection
@section('page_active') Jefes de obra @endsection 
@section('subpage_active') Editar Elemento @endsection 

@section('content')
    {!! Form::model($data, ['url' => $form_url,'files' => true,'method' => 'PATCH']) !!}
    <input type="hidden" value="{{$data->id}}" name="id">
        @include('admin.managers.form')
    </form>
@endsection