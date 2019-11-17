<template>
    <div class="container-fluid" >
         <div class="row" v-if="accion==1">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Leyenda:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2">
                               <p> <span class="camposreq"> * </span> : Campo Obligatorio </p> 
                            </div>
                         </div>  
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Datos de Empresa:</label>   
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="ruc">RUC: <span class="camposreq"> * </span></label>
                            <input type="number" maxlength="11" class="form-control" id="ruc" v-model="ruc">
                                </div>
                              <span class="help-block text-danger" v-for="error_x in error.ruc">{{error_x}}</span>   
                                <div class="form-group">
                        <label for="razon">Razón Social: <span class="camposreq"> * </span></label>
                            <input type="text" class="form-control" id="razon" v-model="razon_social">
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.razon_social">{{error_x}}</span>
                                  <div class="form-group">
                        <label for="comercial">Nombre Comercial:</label>
                            <input type="text" class="form-control" id="comercial" v-model="nombre_comercial">
                                </div> 
                                <div class="form-group">
                        <label for="economica">Actividad Económica:</label>
                            <input type="text" class="form-control" id="economica" v-model="actividad_economica">
                                </div>
                                <div class="form-group">
                        <label for="ejecutivo">Ejecutivo de Ventas:</label>
                            <select class="form-control input-sm" v-model="ejecutivo_ventas">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in usuarios" :value="sel.id">{{sel.name}}</option>     
                            </select>
                                </div>
                            </div>
                            </div>
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Ubicación de Empresa:</label>   
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                        <label for="departamento">Departamento: <span class="camposreq"> * </span></label>
                             <select class="form-control input-sm" @change="obtener_provincias()" v-model="departamento_mod">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in departamento" :value="sel.id">{{sel.nombre}}</option>           
                            </select>
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.departamento_mod">{{error_x}}</span>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                        <label for="provincia">Provincia: <span class="camposreq"> * </span></label>
                            <select class="form-control input-sm" v-model="provincia" @change="obtener_distritos()">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in provincias_all" :value="sel.id">{{sel.nombre_prov}}</option>            
                            </select>
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.provincia">{{error_x}}</span>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                        <label for="distrito">Distrito: <span class="camposreq"> * </span></label>
                            <select class="form-control input-sm" v-model="distrit">
                                    <option value="">Seleccione</option>     
                                    <option v-for="sel in distrito_all" :value="sel.id">{{sel.nombre_distrito}}</option> 
                                    
                            </select>
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.distrit">{{error_x}}</span>
                            </div> 
                        </div>
    
                        <div class="row">
                          <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                        <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" v-model="direccion">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Contacto de Empresa:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="contacto">Contacto Nro. 1: <span class="camposreq"> * </span></label>
                            <input type="text" class="form-control" id="contacto" v-model="contacto1">
                                </div>
                            <span class="help-block text-danger" v-for="error_x in error.contacto1">{{error_x}}</span>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="contacto2">Contacto Nro. 2:</label>
                            <input type="text" class="form-control" id="contacto2" v-model="contacto2">
                                </div>
                            </div>      
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                              <label for="telefono1">Teléfono Nro. 1: <span class="camposreq"> * </span></label>
                            <input type="text" class="form-control" id="telefono1" v-model="telefono1">
                                </div>
                                 <span class="help-block text-danger" v-for="error_x in error.telefono1">{{error_x}}</span>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                               <label for="telefono2">Teléfono Nro. 2:</label>
                            <input type="text" class="form-control" id="telefono2" v-model="telefono2">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="rubro">Correo Electrónico de Empresa:</label>   
                            </div>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="email1">Email Nro. 1: <span class="camposreq"> * </span></label>
                            <input type="email" class="form-control" id="email1" v-model="email1">
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.email1">{{error_x}}</span>
                            </div>
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="email2">Email Nro. 2:</label>
                            <input type="email" class="form-control" id="email2" v-model="email2">
                                </div>
                            </div>    
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="rubro">Rubro:</label>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_mineria">Mineria</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_contruccion">Construcción</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_industria">Industria</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_comercio">Comercio</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_banca">Banca</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_logistico">Logístico aeroportuario</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_callcenter">Call Center</label>
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="rubro_otro">Otro</label>
                            </div>
                        </div><br>
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="regular">Regular:</label>   
                            </div>
                        </div>
                        <div class="row">
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="iniciofact"> Inicio de facturación:</label>
                            <input type="date" class="form-control" id="iniciofact" v-model="inicio_facturacion">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                        <label for="cortefact">Periodo de corte de facturación: <span class="camposreq"> * </span></label>
                            <select class="form-control input-sm" v-model="periodo_corte_facturacion">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in corte_facturacion" :value="sel.id">{{sel.nombre_corte_facturacion}}</option>      
                            </select>
                                </div>
                               <span class="help-block text-danger" v-for="error_x in error.periodo_corte_facturacion">{{error_x}}</span>
                            </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="form-group">
                        <label for="ordencompra">Límite de envío de orden de compra <span class="camposreq"> * </span></label>
                            <select class="form-control input-sm" v-model="limite_orden_compra">
                                    <option value="">Seleccione</option>   
                                    <option v-for="sel in envio_orden_compra" :value="sel.id">{{sel.nombre_envio_orden_compra}}</option>      
                            </select>
                                </div>
                                 <span class="help-block text-danger" v-for="error_x in error.limite_orden_compra">{{error_x}}</span>
                            </div>
                             <div class="col-lg-2 col-md-2 col-sm-2">
                                <div class="form-group">
                        <label for="diascredito">Días de crédito <span class="camposreq"> * </span></label>
                            <select class="form-control input-sm" v-model="dia_creditos_sel">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in dias_credito" :value="sel.id">{{sel.nombre_dias_credito}}</option>     
                            </select>
                                </div>
                                <span class="help-block text-danger" v-for="error_x in error.dia_creditos_sel">{{error_x}}</span>
                            </div>
                        </div>
                          <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="externo">Datos externos:</label>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                   <label for="inscripcion"> Inscripción:</label>
                                   <input type="date" class="form-control" id="inscripcion" v-model="inscripcion">
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <div class="form-group">
                                   <label for="formato_principal"> Formato Principal:</label>
                                   <select class="form-control input-sm" v-model="pagina_principal">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in formato_principal" :value="sel.id">{{sel.nombre_formato_principal}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                               <div class="form-group">
                                   <label for="observacion">Observación:</label>
                                   <textarea class="form-control" rows="5" id="observacion" v-model="observacion"></textarea>
                              </div>
                            </div>  
                        </div>
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="externo">¿Habilitar extranet?</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                        <label class="checkbox-inline"><input type="checkbox" value="1" v-model="habilitar">Habilitar extranet</label>
                            </div>
                         </div>
                         <hr>
                          <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                         <button type="button" class="btn btn-primary" @click.prevent="createEmpresa" id="envioempresa">Guardar</button>
                            </div>
                         </div>
                          </div>
                    <!-- </div> -->
                </div>
            </div>
         </div> 

         <div class="row" v-if="accion==2">
          <div class="col-md-12">
         <div class="panel panel-default">
              <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readCompany()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readCompany()">
                            </div>  
                        </div>            
                    </div>
         <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>RUC</th>
                                            <th>Descripcion</th>
                                            <th>Registrado</th>
                                            <th>Obra</th> 
                                            <th>Perfil</th>
                                            <th>Area</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.ruc}}</td>
                                            <td>{{ list.razon_social}}</td>
                                            <td>{{ list.inscripcion}}</td>
                             <td><a class="btn btn-default" @click.prevent="initObra(list)" href="#"><img :src="`img/construccion.png`" class="img-responsive" height="20" width="20"></a></td>
                             <td><a class="btn btn-default" @click.prevent="initPerfil(list)" href="#"><img :src="`img/perfil.png`" class="img-responsive" height="20" width="20"></a></td>
                             <td><a class="btn btn-default" @click.prevent="initArea(list)" href="#"><img :src="`img/area.png`" class="img-responsive" height="20" width="20"></a></td>
                             <td><button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></button></td>
                             <td><button class="btn btn-danger btn-sm" @click.prevent="deleteEmpresa(list)"> <i class="fa fa-trash"></i></button></td>            
                                            </tr>
                                        </tbody>
                            </table>
                    </div>
          </div>
          </div>
          </div>

          <div class="modal fade"  role="dialog" id="add_obra_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Obra</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                        <label for="descripcion" >Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" :class="{'form-control': true}" v-model="obra.descripcion">
                  </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createObra()" class="btn btn-primary" id="envioObra">Grabar</button>
                    </div>
                    <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista_obra">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.descripcion_obra}}</td>
                             <td><button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></button></td>
                             <td><button class="btn btn-danger btn-sm" @click.prevent="deleteObra(list)"> <i class="fa fa-trash"></i></button></td>         
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="add_perfil_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Perfil</h4>
                    </div>
                   <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                        <label for="descripcion" >Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" :class="{'form-control': true}" v-model="perfil.descripcion">
                  </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createPerfil()" class="btn btn-primary" id="envioPerfil">Grabar</button>
                    </div>
                      <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista_perfil">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.descripcion_perfil}}</td>
                             <td><button class="btn btn-info btn-sm"> <i class="fa fa-edit"></i></button></td>
                             <td><button class="btn btn-danger btn-sm" @click.prevent="deletePerfil(list)"> <i class="fa fa-trash"></i></button></td>         
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" id="add_area_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Area</h4>
                    </div>
                   <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                        <label for="descripcion" >Descripción:</label>
                        <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" :class="{'form-control': true}" v-model="area.descripcion">
                  </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createArea()" class="btn btn-primary" id="envioArea">Grabar</button>
                    </div>
                     <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista_area">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.descripcion_areas}}</td>
                                        <td><button class="btn btn-info btn-sm" > <i class="fa fa-edit"></i></button></td>
                                        <td><button class="btn btn-danger btn-sm" @click.prevent="deleteArea(list)"> <i class="fa fa-trash"></i></button></td>         
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
         <div class="row" v-if="accion==2">
            <div class="col-lg-8 col-xs-12">
           <nav>
      <ul class="pagination">
<li v-if="pagination.current_page > 1"><a href="#" v-on:click.prevent="changePage(pagination.current_page - 1)"><span>Atras</span></a></li>
<li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
         <a href="#" v-on:click.prevent="changePage(page)">{{ page }}</a>
</li>

<li v-if="pagination.current_page < pagination.last_page">
        <a href="#" v-on:click.prevent="changePage(pagination.current_page + 1)"><span>Siguiente</span></a>
</li>
      </ul>
        </nav>
         </div>
      <div class="col-lg-3 col-xs-8">
       <p class="texto_resultado" v-if="total_registros!=0 && total_reg_busqueda!=0">{{total_reg_busqueda}} de un total de {{total_registros}} registros</p>
      </div>   
       <div class="col-lg-1 col-xs-4 boton_load">
       <button class="btn btn-default" v-on:click.prevent="readCompany()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div>                 
    </div> 
           
</template>
<script>
import swal from 'sweetalert2';
import moment from 'moment';
    export default{
        created(){
           this.readCompany();
          
           var fecha= moment().format("YYYY-MM-DD"); 
           this.inicio_facturacion=fecha;  
           this.inscripcion=fecha;
        }, 
        props:['usuarios','departamento','accion'],
        data(){  
          return {
           id_obra_empresa:'',
           id_perfil_empresa:'',
           id_area_empresa:'',   
           obra: {
             descripcion:''
           },
           area:{
             descripcion:''
           },
           perfil:{
             descripcion:''
           },
           combo:'',
           filter:'',
           seleccion: [
 		                { id: '1'  , nombre: '1'   },
 		                { id: '3'  , nombre: '3'   },
 		                { id: '5'  , nombre: '5'   },
 		                { id: '10' , nombre: '10'  },
 		                { id: '15' , nombre: '15'  },
 		                { id: '20' , nombre: '20'  },
 		                { id: '100', nombre: '100' },
                        { id: '300', nombre: '300' },
                        { id: '500', nombre: '500' }
           ],
            pagination:{
 		           'total'        :0,
 		           'current_page' :0,
 		           'per_page'     :0,
 		           'last_page'    :0,
 		           'from'         :0,
 		           'to'           :0,
             },
           total_registros:'',
           total_reg_busqueda:'',  
           lista:[],
           lista_obra:[],
           lista_perfil:[],
           lista_area:[],
           ruc:'',
           razon_social:'',
           nombre_comercial:'',
           actividad_economica:'',
           ejecutivo_ventas:'',
           departamento_mod:'',
           provincia:'',
           distrit:'',
           direccion:'',
           contacto1:'',
           contacto2:'',
           telefono1:'',
           telefono2:'',
           email1:'',
           email2:'',
           rubro_mineria:'',
           rubro_contruccion:'',
           rubro_industria:'',
           rubro_comercio:'',
           rubro_banca:'',
           rubro_logistico:'',
           rubro_callcenter:'',
           rubro_otro:'',
           inscripcion:'',
           inicio_facturacion:'',
           periodo_corte_facturacion:'',
           limite_orden_compra:'',
           dia_creditos_sel:'',
           observacion:'',
           pagina_principal:'',
           habilitar:'',
           corte_facturacion:[
 		                { id: '7'  , nombre_corte_facturacion: 'Cada 7 días' },
 		                { id: '15' , nombre_corte_facturacion: 'Los 15 días'},
 		                { id: '20' , nombre_corte_facturacion: 'Los 20 días'},
 		                { id: '30' , nombre_corte_facturacion: 'Los 30 días'}
                        ],
           envio_orden_compra:[
 		                { id: '7' , nombre_envio_orden_compra: 'Cada 7 días'},
 		                { id: '15', nombre_envio_orden_compra: 'Los 15'},
 		                { id: '30', nombre_envio_orden_compra: 'Los 30'},
 		                { id: '0' , nombre_envio_orden_compra: 'Sin O/C'}
                 ],
            dias_credito:[
                        { id: '15' , nombre_dias_credito: 'Cada 15 días'},
 		                { id: '20', nombre_dias_credito: 'Cada 20 días'},
 		                { id: '30', nombre_dias_credito: 'Cada 30 días'},
 		                { id: '45' , nombre_dias_credito: 'Cada 45 días'},
                        { id: '60' , nombre_dias_credito: 'Cada 60 días'},
                        { id: '90' , nombre_dias_credito: 'Cada 90 días'},
                        { id: '0' , nombre_dias_credito: 'Contado'}
            ],
            formato_principal:[
                        { id: '1' , nombre_formato_principal: '312'},
                        { id: '16' , nombre_formato_principal: 'Anexo 16'}  
            ],
           provincias_all:[],
           distrito_all:[],
           error: []
          }
        },
        methods:{
          readCompany(page){
            var valor_combo=this.combo;
            var valor_caja=this.filter;  
            var urld='/getdata?page='+page;
             axios.get(urld,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.company.data,
                this.pagination=response.data.pagination,
                this.total_reg_busqueda=response.data.total_reg_busqueda,
                this.total_registros=response.data.total_registros
                ];
               return arreglo;

         })
           .catch(error=>{
            console.log(error);
         });

          },  
          disabl(valor,id){
              $("#"+id).prop('disabled', valor);
          },
          changePage(page){
            this.pagination.current_page=page;
            this.readCompany(page);
         },
           mensaje(titulo,texto,icono){
             swal({
                 type: icono,
                 title: titulo,
                 text: texto,
                 showConfirmButton: false,
                 timer: 1500
              })
          },
          deleteEmpresa(info){
           let url_delete="empresa/"+info.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminara ala empresa con RUC: "+info.ruc,
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Si, borrar!',
                   cancelButtonText: 'Cancelar!',
                   confirmButtonClass: 'btn btn-success',
                   cancelButtonClass: 'btn btn-danger',
                   buttonsStyling: false,
                   reverseButtons: true
          }).then((result) => {
                    if (result.value) {
                       axios.delete(url_delete).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.readCompany();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })

          },
          initObra(info){   
           $("#add_obra_model").modal("show");
           this.id_obra_empresa=info.id;
           this.readObra();
    
          },
          initPerfil(info){
           $("#add_perfil_model").modal("show");
           this.id_perfil_empresa=info.id;
           this.readPerfil();
          },
          initArea(info){
            $("#add_area_model").modal("show");
            this.id_area_empresa=info.id;
            this.readArea();
          },
          readObra(){
              var urld='/listarobra';
              var id_obra=this.id_obra_empresa;
             axios.get(urld,{ params:{ id_obra: id_obra}})
         .then(response=>{
             var arreglo=[
                this.lista_obra=response.data.obra
                ];
               return arreglo;
         })
           .catch(error=>{
            console.log(error);
         });
          },
          deleteArea(list){
               let url_delete="area/"+list.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminara la obra: "+list.descripcion_areas,
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Si, borrar!',
                   cancelButtonText: 'Cancelar!',
                   confirmButtonClass: 'btn btn-success',
                   cancelButtonClass: 'btn btn-danger',
                   buttonsStyling: false,
                   reverseButtons: true
          }).then((result) => {
                    if (result.value) {
                       axios.delete(url_delete).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.readArea();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
          },
          deletePerfil(list){
                      let url_delete="profile/"+list.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminara el perfil: "+list.descripcion_perfil,
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Si, borrar!',
                   cancelButtonText: 'Cancelar!',
                   confirmButtonClass: 'btn btn-success',
                   cancelButtonClass: 'btn btn-danger',
                   buttonsStyling: false,
                   reverseButtons: true
          }).then((result) => {
                    if (result.value) {
                       axios.delete(url_delete).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.readPerfil();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
          },
          deleteObra(list){
                     let url_delete="obra/"+list.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminara la obra: "+list.descripcion_obra,
                   type: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Si, borrar!',
                   cancelButtonText: 'Cancelar!',
                   confirmButtonClass: 'btn btn-success',
                   cancelButtonClass: 'btn btn-danger',
                   buttonsStyling: false,
                   reverseButtons: true
          }).then((result) => {
                    if (result.value) {
                       axios.delete(url_delete).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.readObra();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
          },
          readPerfil(){
            var urld='/listarprofile';
            var id_perfil=this.id_perfil_empresa;
             axios.get(urld,{params:{ id_perfil: id_perfil}})
         .then(response=>{
             var arreglo=[
                this.lista_perfil=response.data.perfil
                ];
               return arreglo;
         })
           .catch(error=>{
            console.log(error);
         });
          },
          readArea(){
          var urld='/listararea';
           var id_area=this.id_area_empresa;
             axios.get(urld,{params:{ id_area: id_area}})
         .then(response=>{
             var arreglo=[
                this.lista_area=response.data.area
                ];
               return arreglo;
         })
           .catch(error=>{
            console.log(error);
         });
          },
          createObra(){
              var sel_thi=this;
             sel_thi.disabl(true,'envioObra');
             setTimeout(function(){sel_thi.disabl(false,'envioObra');}, 3000);
            axios.post('/obra', {
                id_obra_empresa:this.id_obra_empresa,
                descripcion:this.obra.descripcion
            })
            .then(response => {
              this.mensaje('Excelente',response.data.message,'success');
              this.readObra();
                    })
            .catch(error => {
               console.log(error); 
            // this.error = error.response.data;
                        
            //             if(error.response.status==422){
            //             	console.clear();    
            //             }
                });
          },
          createPerfil(){
              var sel_thi=this;
             sel_thi.disabl(true,'envioPerfil');
             setTimeout(function(){sel_thi.disabl(false,'envioPerfil');}, 3000);
            axios.post('/profile', {
                id_perfil_empresa:this.id_perfil_empresa,
                descripcion:this.perfil.descripcion
            })
            .then(response => {
              this.mensaje('Excelente',response.data.message,'success');
              this.readPerfil();
                    })
            .catch(error => {
               console.log(error); 
            // this.error = error.response.data;
                        
            //             if(error.response.status==422){
            //             	console.clear();    
            //             }
                });
          },
         createArea(){
             var sel_thi=this;
             sel_thi.disabl(true,'envioArea');
             setTimeout(function(){sel_thi.disabl(false,'envioArea');}, 3000);
            axios.post('/area', {
                id_area_empresa:this.id_area_empresa,
                descripcion:this.area.descripcion
            })
            .then(response => {
              this.mensaje('Excelente',response.data.message,'success');
              this.readArea();
                    })
            .catch(error => {
               console.log(error); 
            // this.error = error.response.data;
                        
            //             if(error.response.status==422){
            //             	console.clear();    
            //             }
                });
         },
          createEmpresa(){
             var sel_thi=this;
             sel_thi.disabl(true,'envioempresa');
             setTimeout(function(){sel_thi.disabl(false,'envioempresa');}, 3000);
              axios.post('/empresa', {
                ruc:this.ruc,
                razon_social:this.razon_social,
                nombre_comercial:this.nombre_comercial,
                actividad_economica:this.actividad_economica,
                ejecutivo_ventas:this.ejecutivo_ventas,
                departamento_mod:this.departamento_mod,
                provincia:this.provincia,
                distrit:this.distrit,
                direccion:this.direccion,
                contacto1:this.contacto1,
                contacto2:this.contacto2,
                telefono1:this.telefono1,
                telefono2:this.telefono2,
                email1:this.email1,
                email2:this.email2,
                rubro_mineria:this.rubro_mineria,
                rubro_contruccion:this.rubro_contruccion,
                rubro_industria:this.rubro_industria,
                rubro_comercio:this.rubro_comercio,
                rubro_banca:this.rubro_banca,
                rubro_logistico:this.rubro_logistico,
                rubro_callcenter:this.rubro_callcenter,
                rubro_otro:this.rubro_otro,
                inicio_facturacion:this.inicio_facturacion,
                periodo_corte_facturacion:this.periodo_corte_facturacion,
                limite_orden_compra:this.limite_orden_compra,
                dia_creditos_sel:this.dia_creditos_sel,
                inscripcion:this.inscripcion,
                pagina_principal:this.pagina_principal,
                observacion:this.observacion,
                habilitar:this.habilitar
                })
                .then(response => {
                    this.mensaje('Excelente',response.data.message,'success');
                    })
                .catch(error => {
                      this.error = error.response.data;
                        
                        if(error.response.status==422){
                        	console.clear();    
                        }
                });
          },  
          obtener_provincias(){
           var id_departamento=this.departamento_mod;   
           var url="listarprovincia";
           axios.get(url,{ params: { id_departamento: id_departamento }})
          .then(response=>{
            this.provincias_all=response.data.provincia;
         })
           .catch(error=>{
            console.log(error);
         });
          },
          obtener_distritos(){
            var id_provincia=this.provincia;
            var urlx="listardistrito";
             axios.get(urlx,{ params: { id_provincia: id_provincia }})
          .then(response=>{
            this.distrito_all=response.data.distrito;
         })
           .catch(error=>{
            console.log(error);
         });
          }
        },
            computed:{
            isActived(){
              return this.pagination.current_page;
           },
            
             pagesNumber(){
           if(!this.pagination.to){
              return [];
           }

           var from=this.pagination.current_page - 2;
           if(from<1){
               from=1;
           }

           var to=from +(2*2);
            if(to>=this.pagination.last_page){
                to=this.pagination.last_page
            }

            var pagesArray=[];

            while(from<=to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;

     }
      }
    }
</script>
<style>
span.camposreq {
    color: red;
    font-size: 15px;
}


.row.fondo_pantalla {
    background: #00a65a;
    color: white;
    height: 40px;
    padding-top: 8px;
    margin-bottom: 10px;
    margin-top: -10px;
}

.principal_name.col-lg-12.col-md-12.col-sm-12 {
    background: #222d32;
    color: white;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-top: -10px;
    margin-bottom: 10px;
}

.row.fondo_pantalla {
    cursor: pointer;
}

</style>