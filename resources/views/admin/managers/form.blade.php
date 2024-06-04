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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}" @if (!$data->id) required="required" @endif>
                        </div> 
                    </div>

                    <div class="row">
                       
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Telefono</label>
                            <input type="tel" name="phone" id="phone" class="form-control" value="{{ $data->phone }}" @if (!$data->id) required="required" @endif>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <input type="text" name="address" id="address" class="form-control" value="{{ $data->address }}" @if (!$data->id) required="required" @endif>
                        </div> 
                    </div> 

                    <div class="row">
                        
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" value="{{ $data->password }}" @if (!$data->id) required="required" @endif>
                        </div> 

                        <div class="col-md-6 mb-3">
                            <label for="pic_profile" class="form-label">Imagen de perfíl</label>
                            <input type="file" name="pic_profile" id="pic_profile" class="form-control" value="{{ $data->pic_profile }}" @if (!$data->id) required="required" @endif>
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