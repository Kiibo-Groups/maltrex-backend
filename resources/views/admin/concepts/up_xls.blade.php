@extends('layouts.app')
@section('title') Gestion de Conceptos @endsection
@section('page_active') Conceptos @endsection 
@section('subpage_active') Carga rapida de excel @endsection 

@section('content')
    {!! Form::model($data, ['url' => [ $form_url ],'files' => true]) !!} 
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">   
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 mb-3">
                                    <label for="titulo" class="form-label"> Sube tu archivo .XLSX</label>
                                    <input type="file" class="form-control" id="file" name="file" required="">
                                </div>  
                            </div>
                        </div>

                        <div class="mt-5" style="justify-items: end;display: grid;padding:20px;">
                            <button type="submit" class="btn btn-primary mb-2 btn-pill">
                                Subir
                            </button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </form>
@endsection