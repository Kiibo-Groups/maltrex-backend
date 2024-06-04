@extends('layouts.app')
@section('title') Gestion de Asignaciones @endsection
@section('page_active') Asignaciones @endsection 
@section('subpage_active') Agregar Elemento @endsection 

@section('content')
    {!! Form::model($data, ['url' => [ $form_url ],'files' => true]) !!} 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.assignments.form')
    </form>
@endsection