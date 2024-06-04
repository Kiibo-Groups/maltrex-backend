<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                   <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" @if (!$data->id) required="required" @endif>
                    </div> 

                    <div class="col-md-3 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ $data->username }}" @if (!$data->id) required="required" @endif>
                    </div>

                    
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $data->email }}" @if (!$data->id) required="required" @endif>
                    </div> 
                   </div>

                   <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status"  id="example-select" class="form-select" required="required">
                                <option value="0" @if($data->status == 0) selected @endif>Activo</option>
                                <option value="1" @if($data->status == 1) selected @endif>Inactivo</option>
                            </select>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            @if($data->id)
                            <label for="new_password" class="form-label">Cambiar contraseña <small>(Solo si desea hacerlo)</small> </label>
                            <input type="password" name="new_password" class="form-control">
                            @else
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" required="required">
                            @endif
                        </div> 

                        
                        <div class="col-md-12 mb-3">
                            <label for="inputEmail6">Asignar Permisos <small>(Ver/Editar)</small> </label>
                            <select name="perm[]" class="form-select selectize-close-btn" multiple="true">
                                @foreach(DB::table('perm')->get() as $p)
                                <option value="{{ $p->name }}" @if(in_array($p->name,$array)) selected @endif>{{ $p->name }}</option>
                                @endforeach
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