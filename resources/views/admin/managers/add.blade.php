@extends('layouts.app')
@section('title') Gestion de Jefes de obra @endsection
@section('page_active') Jefes de obra @endsection 
@section('subpage_active') Agregar Elemento @endsection 

@section('content')
    {!! Form::model($data, ['url' => [ $form_url ],'files' => true]) !!} 
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @include('admin.managers.form')
    </form>
@endsection