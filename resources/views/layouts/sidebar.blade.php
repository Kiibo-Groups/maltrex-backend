
<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        
         <!-- User box -->
         <div class="user-box text-center">

            <img src="{{ asset('assets/images/users/'.Auth::guard()->user()->logo) }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            
            <p class="text-white left-user-info">{{ Auth::guard()->user()->name  }} </p>

            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{ url('account') }}" class="text-white left-user-info">
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a href="{{ url('/logout') }}" class="text-white">
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Principal</li>
                
                <li>
                    <a href="{{ route('dash') }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>&nbsp;Dashboard </span>
                    </a>
                </li> 
                <li>
                    <a href="{{ url('account') }}">
                        <i class="dripicons-user-id"></i>
                        <span>&nbsp;Mi Cuenta </span>
                    </a>
                </li> 

                <li class="menu-title mt-2">Navegación</li>
                {{--                 
                <li>
                    <a href="{{ url('/subaccounts') }}">
                        <i class="mdi mdi-card-account-details"></i>
                        <span>&nbsp;SubCuentas</span>
                    </a>
                </li> --}}

                <li>
                    <a href="#scools" data-bs-toggle="collapse">
                        <i class="mdi mdi-school"></i>
                        <span> Escuelas </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="scools">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('schools') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ route('schools.create') }}">Agregar Elemento</a>
                            </li> 
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#assignments" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-network"></i>
                        <span> Levantamientos </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="assignments">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('assignments') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ route('assignments.create') }}">Crear Levantamiento</a>
                            </li> 
                        </ul>
                    </div>
                </li>
 

                <li>
                    <a href="#manager" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-tie-outline"></i>
                        <span> Jefes de obra </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="manager">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('managers') }}">Listado</a>
                            </li>
                            <li>
                                <a href="{{ route('managers.create') }}">Agregar elemento</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#evidence" data-bs-toggle="collapse">
                        <i class="mdi mdi-printer"></i>
                        <span> Evidencias </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="evidence">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('evidence') }}">Listado</a>
                            </li> 
                        </ul>
                    </div>
                </li>

                 

                <li class="menu-title mt-2">Extras</li>

                <li>
                    <a href="{{ route('concepts') }}">
                        <i class="mdi mdi-cog"></i>
                        <span>&nbsp;Conceptos </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/ajustes') }}">
                        <i class="mdi mdi-cog"></i>
                        <span>&nbsp;Ajustes </span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

         
    </div>
    <!-- Sidebar -left -->

</div>