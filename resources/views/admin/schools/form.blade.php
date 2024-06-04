<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" @if (!$data->id) required="required" @endif>
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $data->direccion }}" @if (!$data->id) required="required" @endif>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}" @if (!$data->id) required="required" @endif>
                        </div> 
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $data->phone }}" @if (!$data->id) required="required" @endif>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <input type="text" name="proveedor" id="proveedor" class="form-control" value="{{ $data->proveedor }}" @if (!$data->id) required="required" @endif>
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