<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">   
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $data->titulo }}" @if (!$data->id) required="required" @endif>
                        </div> 

                        <div class="col-md-12 mb-3">
                            <label for="concepto" class="form-label">Concepto</label>
                            <textarea id="concepto" name="concepto" class="form-control" cols="30" rows="10" @if (!$data->id) required="required" @endif>{{ $data->concepto }}</textarea>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="card">   
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="unidad" class="form-label">Unidad</label>
                            <input type="text" name="unidad" id="unidad" class="form-control" value="{{ $data->unidad }}" @if (!$data->id) required="required" @endif>
                        </div> 
                        
                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" name="precio" id="precio" class="form-control" value="{{ $data->precio }}" @if (!$data->id) required="required" @endif>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="labour" class="form-label">Mano de obra</label>
                            <input type="number" name="labour" id="labour" class="form-control" value="{{ $data->labour }}" @if (!$data->id) required="required" @endif>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status"  id="example-select" class="form-select" required="required">
                                <option value="1" @if($data->status == 1) selected @endif>Activo</option>
                                <option value="0" @if($data->status == 0) selected @endif>Inactivo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-5" style="justify-items: end;display: grid;padding:20px;">
                    <button type="submit" class="btn btn-primary mb-2 btn-pill">
                        @if(!$data->id)
                        Agregar
                        @else 
                        Actualizar
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>