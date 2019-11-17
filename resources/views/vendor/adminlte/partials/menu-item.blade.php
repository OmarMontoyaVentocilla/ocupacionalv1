<section class="sidebar">
 <div class="user-panel">
      {{-- <div class="pull-left image">
        <img src="https://www.gravatar.com/avatar/3a3f005073010c93a078057f127411a7?d=mm" class="img-circle" alt="User Image">
      </div> --}}
      <div class="pull-left image">
         {{-- <p></p>  --}}
        <a href="#"><i class="fa fa-circle text-success"></i> Usuario: {{ Auth::user()->name }}</a>
      </div>
</div>
 <ul data-widget="tree" class="sidebar-menu tree">
 {{-- <li class="header">MENÚ</li> --}}

 {{-- <li><a href="{{url('autor')}}"><i class="fa fa-fw fa-file "></i><span>Autor</span></a></li>
 <li><a href="{{url('editorial')}}"><i class="fa fa-fw fa-file "></i><span>Editorial</span></a></li>
 <li><a href="{{url('idioma')}}"><i class="fa fa-fw fa-file "></i><span>Idioma</span></a></li>
 <li><a href="{{url('categoria')}}"><i class="fa fa-fw fa-file "></i><span>Categoria</span></a></li> --}}



<li class="treeview ">
    <a href="#">
        <i class="fa fa-fw fa-share "></i><span>Administración</span><span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu"> 
        <li><a href="{{url('empresa')}}"><i class="fa fa-fw fa-building "></i><span>Empresa</span></a></li>
        <li><a href="{{url('examen')}}"><i class="fa fa-fw fa-file "></i><span>Exámenes Ocupacionales</span></a></li>
        <li><a href="{{url('catalogo-empresa')}}"><i class="fa fa-fw fa-file "></i><span>Cátalogo por empresa</span></a></li>
        <li><a href="{{url('protocolo')}}"><i class="fa fa-fw fa-file "></i><span>Protocolos</span></a></li>
        <li><a href="{{url('diagnostics')}}"><i class="fa fa-fw fa-file "></i><span>Diagnóstico</span></a></li>
        <li><a href="{{url('especialidad')}}"><i class="fa fa-fw fa-file "></i><span>Especialidad</span></a></li>
        <li><a href="{{url('equipo')}}"><i class="fa fa-fw fa-file "></i><span>Equipo</span></a></li>
        <li><a href="{{url('doctor')}}"><i class="fa fa-fw fa-file "></i><span>Doctor</span></a></li>
    </ul>
</li>


<li class="treeview">
    <a href="#">
        <i class="fa fa-fw fa-share "></i><span>Usuarios y permisos</span><span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i></span>
    </a>
    <ul class="treeview-menu">
        <li><a href="{{url('roles')}}"><i class="fa fa-fw fa-lock"></i><span>Roles</span></a></li>
        <li><a href="{{url('asignar-roles')}}"><i class="fa fa-fw fa-lock"></i><span>Asignar roles</span></a></li>
        <li><a href="{{url('permissions')}}"><i class="fa fa-fw fa-lock"></i><span>Permisos</span></a></li>
        <li><a href="{{url('users')}}"><i class="fa fa-fw fa-lock"></i><span>Usuario</span></a></li>
    </ul>
</li>

<li class="treeview">
  <a href="#">
      <i class="fa fa-fw fa-share "></i><span>Admisión</span><span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i></span>
  </a>
  <ul class="treeview-menu">
      <li><a href="{{url('paciente')}}"><i class="fa fa-fw fa-address-card-o"></i><span>Filiación</span></a></li>
      <li><a href="{{url('orden-atencion')}}"><i class="fa fa-fw fa-desktop"></i><span>Orden Atención - Campaña</span></a></li>
  </ul>
</li>


<li class="treeview">
  <a href="#">
      <i class="fa fa-fw fa-share "></i><span>Atenciones</span><span class="pull-right-container">
      <i class="fa fa-angle-left pull-right"></i></span>
  </a>
  <ul class="treeview-menu">
      <li><a href="{{url('atencion-ocupacional')}}"><i class="fa fa-clipboard"></i><span>Ocupacional</span></a></li>
      <li><a href="{{url('')}}"><i class="fa fa-clipboard"></i><span>Campaña</span></a></li>
  </ul>
</li>
{{-- <li class="treeview">
    <a href="#">
     <i class="fa fa-fw fa-share "></i><span>Multilevel</span><span class="pull-right-container">
     <i class="fa fa-angle-left pull-right"></i></span>
   </a>
   <ul class="treeview-menu">
      <li><a href="#"><i class="fa fa-fw fa-circle-o "></i> <span>Level One</span></a></li>
      <li class="treeview">
    <a href="#">
       <i class="fa fa-fw fa-circle-o "></i> <span>Level One</span> <span class="pull-right-container">
       <i class="fa fa-angle-left pull-right"></i></span>
    </a>
   <ul class="treeview-menu">
     <li>
      <a href="#">
        <i class="fa fa-fw fa-circle-o "></i> <span>Level Two</span>
      </a>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-fw fa-circle-o "></i> <span>Level Two</span> <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i></span>
      </a>
      <ul class="treeview-menu">
    <li><a href="#"><i class="fa fa-fw fa-circle-o "></i> <span>Level Three</span></a></li>
    <li><a href="#"><i class="fa fa-fw fa-circle-o "></i> <span>Level Three</span></a></li>
    </ul>
  </li>
  </ul>
   </li>
    <li>
      <a href="#"><i class="fa fa-fw fa-circle-o "></i> <span>Level One</span></a></li>
  </ul>
</li> --}}
   {{-- <li class="header">LABELS</li>
   <li><a href="#"><i class="fa fa-fw fa-circle-o text-red"></i> <span>Important</span></a></li>
   <li><a href="#"><i class="fa fa-fw fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
   <li><a href="#"><i class="fa fa-fw fa-circle-o text-aqua"></i> <span>Information</span></a></li> --}}
 </ul>
</section>

