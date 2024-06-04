 
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">   
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="school_id" class="form-label">Escuela</label>
                            <select name="school_id" id="school_id" class="form-select">
                                @foreach ($schools as $sch)
                                    <option value="{{ $sch->id }}" @if($data->school_id == $sch->id) selected @endif>{{ $sch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" required="required">
                                <option value="1" @if($data->status == 1) selected @endif>Activo</option>
                                <option value="0" @if($data->status == 0) selected @endif>Inactivo</option>
                            </select>
                        </div>
                    </div>

                    <hr />
                    <div class="row">
                       
                        <div class="col-md-12 mb-3">
                            <button type="button" id="add-concept" class="btn btn-success waves-effect waves-light" style="float: right;">
                                <i class="fe-plus-square"></i>
                                Agregar Concepto
                            </button>
                        </div> 
                        

                        <div id="wrap_content_concepts" class="row">
                            @if ($data->id)
                                @foreach ($assigns as $item)
                                <section class="row" id="element_wrap_{{ $item->id }}"> 
                                    <div class="col-md-2 mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" name="cantidad[]" id="cantidad" class="form-control" value="{{ $item->cantidad }}" @if (!$data->id) required="required" @endif>
                                    </div> 
            
                                    <div class="col-md-6 mb-3">
                                        <label for="concepto" class="form-label">Concepto</label>
                                        <select name="concepts[]" class="form-select">
                                            @foreach ($concepts as $cons)
                                                <option value="{{ $cons->id }}" @if($item->concepto == $cons->id) selected @endif>{{ $cons->titulo }} | ({{ $cons->unidad }})</option>
                                            @endforeach
                                        </select>
                                    </div> 

                                    <div class="col-md-2 mb-3" style="padding-top: 28px !important;">
                                        <button type="button" class="btn btn-danger waves-effect waves-light" onClick="delElementAjax('{{ $item->id }}')">
                                            <i class="fe-trash"></i>
                                            Eliminar Concepto
                                        </button>
                                    </div>
                                </section>
                                @endforeach
                            @else
                            <section class="row">
                                <div class="col-md-2 mb-3">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" name="cantidad[]" id="cantidad" class="form-control" value="{{ $data->cantidad }}" @if (!$data->id) required="required" @endif>
                                </div> 
        
                                <div class="col-md-6 mb-3">
                                    <label for="concepto" class="form-label">Concepto</label>
                                    <select name="concepts[]" class="form-select">
                                        @foreach ($concepts as $cons)
                                            <option value="{{ $cons->id }}" @if($data->concepto == $cons->id) selected @endif>{{ $cons->titulo }} | ({{ $cons->unidad }})</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </section>
                            @endif
                        </div>
                    </div> 

                    <hr />

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="manager_id" class="form-label">Asignación <br /> <small>(Puedes asignar este levantamiento o puedes dejarlo en blanco <span style="color:red">No es requerido</span> )</small> </label>
                            <select name="manager_id" id="manager_id" class="form-select">
                                <option value="">Sin Asignar</option>
                                @foreach ($managers as $mans)
                                <option value="{{ $mans->id }}" @if($data->manager_id == $mans->id) selected @endif>{{ $mans->name }}</option>
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
 
@section('js')
    
<script> 
    !function ($) {
        "use strict";

        let containerW  = document.getElementById('wrap_content_concepts');
        let btnAddStrat = document.getElementById('add-concept');
        let AddCST = 0;

         // Agregado de elementos para ESTRATIGRAFIA
         btnAddStrat.addEventListener('click', () => {
            AddCST++;
            let containerStrat = '<section class="row" id="element_wrap_'+AddCST+'">'
                +'<div class="col-md-2 mb-3">'
                    +'<label for="cantidad" class="form-label">Cantidad</label>'
                    +'<input type="number" name="cantidad[]" id="cantidad" class="form-control" required="required">'
                +'</div> '
                +'<div class="col-md-6 mb-3">'
                    +'<label for="concepto" class="form-label">Concepto</label>'
                    +'<select name="concepts[]" class="form-select">'
                        +'@foreach ($concepts as $cons)'
                            +'<option value="{{ $cons->id }}">{{ $cons->titulo }} | ({{ $cons->unidad }})</option>'
                        +'@endforeach'
                    +'</select>'
                +'</div> '
                +'<div class="col-md-2 mb-3" style="padding-top: 28px !important;">'
                    +'<button type="button" class="btn btn-danger waves-effect waves-light" onClick="delElement('+AddCST+')">'
                        +'<i class="fe-trash"></i>'
                        +'Eliminar Concepto'
                    +'</button>'
                +'</div>'
            +'</section>'; 

            containerW.insertAdjacentHTML('beforeend', containerStrat);
        });

    }(window.jQuery);

    function delElement(id){ document.getElementById("element_wrap_"+id).remove() }
    
    function delElementAjax(id)
    {
        // Solicitud para obtener Sondeos
        postData('{{ route("assignments.trashConcept") }}', { conceptId: id })
        .then(data => {
            if (data.status == true) {
                document.getElementById("element_wrap_"+id).remove()
                console.log(data); // JSON data parsed by `data.json()` call
            }
        });
    }

 
    async function postData(url = '', data = {}) {
        const token = document.head.querySelector("[name~=csrf-token][content]").content;

        // Opciones por defecto estan marcadas con un *
        const response = await fetch(url, {
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, *cors, same-origin
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": token
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return response.json(); // parses JSON response into native JavaScript objects
    }
</script>
@endsection