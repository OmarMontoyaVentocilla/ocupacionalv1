<template>
<div class="container-fluid" >
         <div class="row">
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
                             <label for="empresa">Datos de paciente:</label>   
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Tipo documento: <span class="camposreq"> * </span></label>
                                  <select class="form-control input-sm" v-model="tipodocumento">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in tipo_doc" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="inscripcion"> Número documento: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="num_documento" v-model="num_documento">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                 <label for="appater"> Apellido Paterno: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="ap_paterno" v-model="ap_paterno">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="apmater"> Apellido Materno: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="ap_materno" v-model="ap_materno">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                 <div class="form-group">
                                 <label for="appater"> Nombres: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="nombres" v-model="nombres">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                 <label for="sexo"> Sexo: <span class="camposreq"> * </span></label>
                                  <select class="form-control input-sm" v-model="sexo_valor">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in sexo" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="telefono"> Telefono </label>
                                   <input type="text" class="form-control" id="telefono" v-model="telefono">
                                </div>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="fecha_nacimiento">Fecha nacimiento: </label>
                                  <input type="date" class="form-control" id="fecha_nacimiento" v-model="fecha_nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="edad">Edad: </label>
                                 <input type="number" class="form-control" id="edad" v-model="calculateage">
                                </div>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Estado civil: </label>
                                  <select class="form-control input-sm" v-model="estadocivil_valor">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in estado_civil" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="tipo_documento">Grado instrucción: </label>
                                  <select class="form-control input-sm" v-model="gradoinstruc_valor">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in grado_instruccion" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                       </div>
                        <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Lugar de Residencia Actual:</label>   
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Pais: </label>
                                  <select class="form-control input-sm" v-model="pais_valor">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in pais" :value="sel.id">{{sel.nombre_pais}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                        <label for="edad">Dirección: </label>
                                 <input type="text" class="form-control" id="direccion_actual" v-model="direccion_actual">
                                </div>
                            </div>
                       </div>
                         <div class="row" v-if="pais_valor==177">
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                        <label for="departamento">Departamento: </label>
                             <select class="form-control input-sm" @change="obtener_provincias()" v-model="departamento_mod">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in departamento" :value="sel.id">{{sel.nombre}}</option>           
                            </select>
                                </div>
                             </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                             <div class="form-group">
                        <label for="provincia">Provincia: </label>
                            <select class="form-control input-sm" v-model="provincia" @change="obtener_distritos()">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in provincias_all" :value="sel.id">{{sel.nombre_prov}}</option>            
                            </select>
                                </div>
                             </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="distrito">Distrito: </label>
                            <select class="form-control input-sm" v-model="distrit">
                                    <option value="">Seleccione</option>     
                                    <option v-for="sel in distrito_all" :value="sel.id">{{sel.nombre_distrito}}</option> 
                                    
                            </select>
                                </div>
                             </div>
                         </div>   


                          <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Lugar de Nacimiento:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Pais: </label>
                                  <select class="form-control input-sm" v-model="pais_valor_nacimiento">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in pais" :value="sel.id">{{sel.nombre_pais}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                        <label for="edad">Dirección: </label>
                                 <input type="text" class="form-control" id="direccion_actual" v-model="direccion_ncimiento">
                                </div>
                            </div>
                       </div>
                       <div class="row" v-if="pais_valor_nacimiento==177">
                           <div class="col-lg-4 col-md-4 col-sm-4">
                             <div class="form-group">
                        <label for="departamento">Departamento: </label>
                             <select class="form-control input-sm" @change="obtener_provincias2()" v-model="departamento_mod2">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in departamento" :value="sel.id">{{sel.nombre}}</option>           
                            </select>
                                </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="provincia">Provincia: </label>
                            <select class="form-control input-sm" v-model="provincia2" @change="obtener_distritos2()">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in provincias_all2" :value="sel.id">{{sel.nombre_prov}}</option>            
                            </select>
                                </div>
                           </div>
                           <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="distrito">Distrito: </label>
                            <select class="form-control input-sm" v-model="distrit2">
                                    <option value="">Seleccione</option>     
                                    <option v-for="sel in distrito_all2" :value="sel.id">{{sel.nombre_distrito}}</option> 
                                    
                            </select>
                                </div>
                           </div>
                       </div>
                       <div class="row">
                 <div class="col-lg-12 col-md-12 col-sm-12">
         <button type="button" class="btn btn-primary" @click.prevent="createPacient" id="enviopaciente">Guardar</button>       
                </div>
                       </div>
                    </div>
                </div>
            </div>
         </div>

  <div class="row">
          <div class="col-md-12">
         <div class="panel panel-default">
              <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readPaciente()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readPaciente()">
                            </div>  
                        </div>            
               </div> <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Nombres completos</th>
                                            <th>Nro. Documento</th>
                                            <th>Historia Clínica</th>
                                            <th>Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.nombres_total}}</td>
                                            <td>{{list.nro_documento}}</td>
                                            <td>{{list.hc}}</td>
                                            <td>
                                 <button class="btn btn-info btn-sm" @click.prevent="initPaciente(list)"> <i class="fa fa-edit"></i></button>
                                 <button class="btn btn-danger btn-sm" @click.prevent="deletePaciente(list)"> <i class="fa fa-trash"></i></button>
                                            </td>
                                            </tr>
                                        </tbody>
                            </table>
                    </div>
          </div>
         </div>
         </div>



         <div class="modal fade"  role="dialog" id="update_paciente">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar paciente con historia clínica: {{data_update.hc}} </h4>
                    </div>
                    <div class="modal-body">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Leyenda:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                               <p> <span class="camposreq"> * </span> : Campo Obligatorio </p> 
                            </div>
                         </div>  
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Datos de paciente:</label>   
                            </div>
                        </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Tipo documento: <span class="camposreq"> * </span></label>
                                  <select class="form-control input-sm" v-model="data_update.tipo_documento">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in tipo_doc" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                             <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="inscripcion"> Número documento: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="num_documento" v-model="data_update.numero_documento">
                                </div>
                            </div>
                       </div>
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                 <label for="appater"> Apellido Paterno: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="ap_paterno" v-model="data_update.apellido_paterno">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="apmater"> Apellido Materno: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="ap_materno" v-model="data_update.apellido_materno">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                 <div class="form-group">
                                 <label for="appater"> Nombres: <span class="camposreq"> * </span></label>
                                   <input type="text" class="form-control" id="nombres" v-model="data_update.nombres">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                 <label for="sexo"> Sexo: <span class="camposreq"> * </span></label>
                                  <select class="form-control input-sm" v-model="data_update.sexo">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in sexo" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                   <label for="telefono"> Telefono </label>
                                   <input type="text" class="form-control" id="telefono" v-model="data_update.telefono">
                                </div>
                            </div>
                       </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="fecha_nacimiento">Fecha nacimiento: </label>
                                  <input type="date" class="form-control" id="fecha_nacimiento" v-model="data_update.fecha_nacimiento">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="edad">Edad: </label>
                                 <input type="number" class="form-control" id="edad" v-model="edad_update">
                                </div>
                            </div>
                       </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Estado civil: </label>
                                  <select class="form-control input-sm" v-model="data_update.estado_civil">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in estado_civil" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="tipo_documento">Grado instrucción: </label>
                                  <select class="form-control input-sm" v-model="data_update.grado_instruccion">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in grado_instruccion" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                            </div>
                       </div>

                             <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Lugar de Residencia Actual:</label>   
                            </div>
                        </div>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Pais: </label>
                                  <select class="form-control input-sm" v-model="data_update.pais_actual">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in pais" :value="sel.id">{{sel.nombre_pais}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                        <label for="edad">Dirección: </label>
                                 <input type="text" class="form-control" id="direccion_actual" v-model="data_update.direccion_actual">
                                </div>
                            </div>
                       </div>

                        <div class="row" v-if="data_update.pais_actual==177">
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                        <label for="departamento">Departamento: </label>
                             <select class="form-control input-sm" @change="obtener_provincias3()" v-model="data_update.departamento_actual">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in departamento" :value="sel.id">{{sel.nombre}}</option>           
                            </select>
                                </div>
                             </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                        <label for="departamento">Provincia: </label>
                             <select class="form-control input-sm" @change="obtener_distrito3()" v-model="data_update.provincia_actual">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in data_update.provinciaupdate" :value="sel.id">{{sel.nombre_prov}}</option>           
                            </select>
                                </div>
                             </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="distrito">Distrito: </label>
                            <select class="form-control input-sm" v-model="data_update.distrito_actual">
                                    <option value="">Seleccione</option>     
                                    <option v-for="sel in data_update.distritoupdate" :value="sel.id">{{sel.nombre_distrito}}</option> 
                                    
                            </select>
                                </div>
                             </div>
                        </div>     
                            <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Lugar de Nacimiento:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="tipo_documento">Pais: </label>
                                  <select class="form-control input-sm" v-model="data_update.pais_nacimiento">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in pais" :value="sel.id">{{sel.nombre_pais}}</option>      
                                  </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                  <div class="form-group">
                        <label for="edad">Dirección: </label>
                                 <input type="text" class="form-control" id="direccion_actual" v-model="data_update.direccion_nacimiento">
                                </div>
                            </div>
                       </div>
                       
                        <div class="row" v-if="data_update.pais_nacimiento==177">
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                        <label for="departamento">Departamento: </label>
                             <select class="form-control input-sm" @change="obtener_provincias4()" v-model="data_update.departamento_nacimiento">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in departamento" :value="sel.id">{{sel.nombre}}</option>           
                            </select>
                                </div>
                             </div>
                              <div class="col-lg-4 col-md-4 col-sm-4">
                                    <div class="form-group">
                        <label for="departamento">Provincia: </label>
                             <select class="form-control input-sm" @change="obtener_distrito4()" v-model="data_update.provincia_nacimiento">
                                     <option value="">Seleccione</option> 
                                     <option v-for="sel in data_update.provincianacimientoupdate" :value="sel.id">{{sel.nombre_prov}}</option>           
                            </select>
                                </div>
                             </div>
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="distrito">Distrito: </label>
                            <select class="form-control input-sm" v-model="data_update.distrito_nacimiento">
                                    <option value="">Seleccione</option>     
                                    <option v-for="sel in data_update.distritonacimientoupdate" :value="sel.id">{{sel.nombre_distrito}}</option> 
                                    
                            </select>
                                </div>
                             </div>
                        </div>  
               



                    </div>
                    </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="updatepaciente(data_update.id)" class="btn btn-primary" id="">Grabar</button>
                    </div>
                    </div>
                </div>
            </div>
         </div>

  </div>  

 <div class="row">
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
       <button class="btn btn-default" v-on:click.prevent="readPaciente()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div> 





     </div>                         
</template>
<script>
import swal from 'sweetalert2';
import moment from 'moment';
export default{
    created(){
       var fecha= moment().format("YYYY-MM-DD"); 
       this.fecha_nacimiento=fecha;  
       this.readPaciente();
    },
    props:['pais','departamento'],
    data(){
        return {
            tipo_doc: [
 		                { id: '1'  , nombre: 'DNI'   },
 		                { id: '2'  , nombre: 'Carnet Extranjería'},
 		                { id: '3'  , nombre: 'Pasaporte'}
           ],
           sexo:[
                        { id: '1'  , nombre: 'Masculino'   },
 		                { id: '2'  , nombre: 'Femenino'}
           ],
            estado_civil:[
                        { id: '1'  , nombre: 'Soltero'},
                        { id: '2'  , nombre: 'Casado'},
                        { id: '3'  , nombre: 'Divorciado'},
                        { id: '4'  , nombre: 'Viudo'},
                        { id: '5'  , nombre: 'Conviviente'}
           ],
            grado_instruccion:[
                        { id: '1'  , nombre: 'Analfabeto'   },
                        { id: '2'  , nombre: 'Primaria completa'},
                        { id: '3'  , nombre: 'Primaria incompleta'},
                        { id: '4'  , nombre: 'Secundaria completa'},
                        { id: '5'  , nombre: 'Secundaria incompleta'},
                        { id: '6'  , nombre: 'Técnico completo'},
                        { id: '7'  , nombre: 'Técnico incompleto'},
                        { id: '8'  , nombre: 'Universitario completo'},
                        { id: '9'  , nombre: 'Universitario incompleto'}
           ],
            pagination:{
 		           'total'        :0,
 		           'current_page' :0,
 		           'per_page'     :0,
 		           'last_page'    :0,
 		           'from'         :0,
 		           'to'           :0,
            },
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
           data_update:{
             tipo_documento:'',
             numero_documento:'',
             apellido_paterno:'',
             apellido_materno:'',
             nombres:'',
             sexo:'',
             telefono:'',
             provinciaupdate:[],
             distritoupdate:[],
             provincianacimientoupdate:[],
             distritonacimientoupdate:[],
             fecha_nacimiento:'',
             edad:'',
             hc:'',
             id:'',
             estado_civil:'',
             grado_instruccion:'',
             pais_actual:'',
             direccion_actual:'',
             departamento_actual:'',
             provincia_actual:'',
             distrito_actual:'',
             pais_nacimiento:'',
             direccion_nacimiento:'',
             departamento_nacimiento:'',
             provincia_nacimiento:'',
             distrito_nacimiento:''
           }, 
           combo:'',
           lista:[],
           filter:'',
           total_registros:'',
           total_reg_busqueda:'',  
           pais_valor:'',
           provincias_all:[],
           provincias_all2:[],
           distrito_all:[],
           distrito_all2:[],
           provincia:'',
           provincia2:'',
           tipodocumento:'',
           pais_valor_nacimiento:'',
           direccion_ncimiento:'',
           sexo_valor:'',
           departamento_mod:'',
           departamento_mod2:'',
           telefono:'',
           distrit:'',
           distrit2:'',
           nombres:'',
           estadocivil_valor:'',
           gradoinstruc_valor:'',
           num_documento:'',
           direccion_actual:'',
           ap_paterno:'',
           ap_materno:'',
           fecha_nacimiento:'',
           edad:''
        }
    },
    methods: {
      
      obtener_provincias(){
            var id_departamentox=this.departamento_mod;   
           var urlx="listarprovincia";
           axios.get(urlx,{ params: { id_departamento: id_departamentox }})
          .then(response=>{
            this.provincias_all=response.data.provincia;
         })
           .catch(error=>{
            console.log(error);
         });
      },
      updatepaciente(info){
            axios.patch('/paciente/' + info, {
                    tipo_documento:this.data_update.tipo_documento,
                    num_documento:this.data_update.numero_documento,
                    ap_paterno:this.data_update.apellido_paterno,
                    ap_materno:this.data_update.apellido_materno,
                    nombres:this.data_update.nombres,
                    sexo:this.data_update.sexo,
                    fecha_nacimiento:this.data_update.fecha_nacimiento,
                    edad:this.edad_update,
                    pais_actual:this.data_update.pais_actual,
                    pais_nacimiento:this.data_update.pais_nacimiento,
                    telefono:this.data_update.telefono,
                    estado_civil:this.data_update.estado_civil,
                    grado_instru:this.data_update.grado_instruccion,
                    direccion_actual:this.data_update.direccion_actual,
                    departamento_actual:this.data_update.departamento_actual,
                    provincia_actual:this.data_update.provincia_actual,
                    distrito_actual:this.data_update.distrito_actual,
                    direccion_nacimiento:this.data_update.direccion_nacimiento,
                    departamento_nacimiento:this.data_update.departamento_nacimiento,
                    provincia_nacimiento:this.data_update.provincia_nacimiento,
                    distrito_nacimiento:this.data_update.distrito_nacimiento
                }).then(response=>{
                    this.mensaje('Excelente',response.data.mensaje,'success');
                    $("#update_paciente").modal("hide");
                     this.readPaciente();
                }).catch(error=>{
                  console.log(error);
                })
      },
      deletePaciente(info){
           let url_delete="paciente/"+info.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminará al paciente: "+info.nombres_total,
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
                            selfdel.readPaciente();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })

      },
      initPaciente(info){
             $('#update_paciente').modal("show");
             this.data_update.tipo_documento=info.tipo_documento;
             this.data_update.numero_documento=info.nro_documento;
             this.data_update.apellido_paterno=info.ap_paterno;
             this.data_update.apellido_materno=info.ap_materno;
             this.data_update.nombres=info.nombres;
             this.data_update.sexo=info.sexo;
             this.data_update.telefono=info.telefono;
             this.data_update.fecha_nacimiento=info.fecha_nacimiento;
             this.data_update.edad=info.edad;
             this.data_update.hc=info.hc;
             this.data_update.id=info.id;
             this.data_update.estado_civil=info.estado_civil;
             this.data_update.grado_instruccion=info.grado_instruccion;
             this.data_update.pais_actual=info.pais_residenciaactual_id;
             this.data_update.direccion_actual=info.direccion_residenciaactual;
             this.data_update.departamento_actual=info.departament_residenciaactual_id;
             this.data_update.provincia_actual=info.province_residenciaactual_id;
             this.data_update.distrito_actual=info.distrit_residenciaactual_id;
             this.data_update.pais_nacimiento=info.pais_nacimiento_id;
             this.data_update.direccion_nacimiento=info.direccion_nacimiento;
             this.data_update.departamento_nacimiento=info.departament_nacimiento_id;
             this.data_update.provincia_nacimiento=info.province_nacimiento_id;
             this.data_update.distrito_nacimiento=info.distrit_nacimiento_id;
//obtener provincias
 var urlxx="listarprovincia";
axios.get(urlxx,{ params: { id_departamento: this.data_update.departamento_actual }})
.then(response=>{
this.data_update.provinciaupdate=response.data.provincia;
})
.catch(error=>{
console.log(error);
 });

//obtenrer distritos 
var urlx2dx="listardistrito";
axios.get(urlx2dx,{ params: { id_provincia: this.data_update.provincia_actual }})
.then(response=>{
this.data_update.distritoupdate=response.data.distrito;
})
.catch(error=>{
console.log(error);
});

///////////////////////////////////////////////////////////////////
//obtener provincias
 var urlxxx="listarprovincia";
axios.get(urlxxx,{ params: { id_departamento: this.data_update.departamento_nacimiento }})
.then(response=>{
this.data_update.provincianacimientoupdate=response.data.provincia;
})
.catch(error=>{
console.log(error);
 });

//obtenrer distritos 
var urlx2dxx="listardistrito";
axios.get(urlx2dxx,{ params: { id_provincia: this.data_update.provincia_nacimiento }})
.then(response=>{
this.data_update.distritonacimientoupdate=response.data.distrito;
})
.catch(error=>{
console.log(error);
});

      },
       readPaciente(page){
            var valor_combo=this.combo;
            var valor_caja=this.filter;  
            var urld='/listarpacientes?page='+page;
             axios.get(urld,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.paciente.data,
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
       changePage(page){
            this.pagination.current_page=page;
            this.readPaciente(page);
       },
      disabl(valor,id){
              $("#"+id).prop('disabled', valor);
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
      createPacient(){
          var sel_thi=this;
          sel_thi.disabl(true,'enviopaciente');
          setTimeout(function(){sel_thi.disabl(false,'enviopaciente');}, 3000); 
           axios.post('/paciente', {
                    tipo_documento:this.tipodocumento,
                    num_documento:this.num_documento,
                    ap_paterno:this.ap_paterno,
                    ap_materno:this.ap_materno,
                    nombres:this.nombres,
                    sexo:this.sexo_valor,
                    telefono:this.telefono,
                    fecha_nacimiento:this.fecha_nacimiento,
                    edad:this.calculateage,
                    estado_civil:this.estadocivil_valor,
                    grado_instru:this.gradoinstruc_valor,
                    pais_actual:this.pais_valor,
                    direccion_actual:this.direccion_actual,
                    departamento_actual:this.departamento_mod,
                    provincia_actual:this.provincia,
                    distrito_actual:this.distrit,
                    pais_nacimiento:this.pais_valor_nacimiento,
                    direccion_nacimiento:this.direccion_ncimiento,
                    departamento_nacimiento:this.departamento_mod2,
                    provincia_nacimiento:this.provincia2,
                    distrito_nacimiento:this.distrit2
            })
            .then(response => {
              this.mensaje('Excelente',response.data.mensaje,'success');
              this.readPaciente();
                    })
            .catch(error => {
               console.log(error); 
                });
      },
      obtener_provincias2(){
           var id_departamento2=this.departamento_mod2;   
           var urlxx="listarprovincia";
           axios.get(urlxx,{ params: { id_departamento: id_departamento2 }})
          .then(response=>{
            this.provincias_all2=response.data.provincia;
         })
           .catch(error=>{
            console.log(error);
         });
      },
      obtener_provincias3(){
          var id_departamento_update=this.data_update.departamento_actual; 
           var urlxx="listarprovincia";
            axios.get(urlxx,{ params: { id_departamento: id_departamento_update }})
          .then(response=>{
            this.data_update.provinciaupdate=response.data.provincia;
         })
           .catch(error=>{
            console.log(error);
         });
         
      },
      obtener_provincias4(){
            var urlxxx="listarprovincia";
            axios.get(urlxxx,{ params: { id_departamento: this.data_update.departamento_nacimiento }})
            .then(response=>{
            this.data_update.provincianacimientoupdate=response.data.provincia;
            })
            .catch(error=>{
            console.log(error);
            });
      },
       obtener_distritos(){
            var id_provinciax=this.provincia;
            var urlx2="listardistrito";
             axios.get(urlx2,{ params: { id_provincia: id_provinciax }})
          .then(response=>{
            this.distrito_all=response.data.distrito;
         })
           .catch(error=>{
            console.log(error);
         });
          },
        obtener_distritos2(){
           var id_provinciax2=this.provincia2;
            var urlx2d="listardistrito";
             axios.get(urlx2d,{ params: { id_provincia: id_provinciax2 }})
          .then(response=>{
            this.distrito_all2=response.data.distrito;
         })
           .catch(error=>{
            console.log(error);
         });
        },
        obtener_distrito3(){
            var urlx2dx="listardistrito";
            axios.get(urlx2dx,{ params: { id_provincia: this.data_update.provincia_actual }})
                .then(response=>{
            this.data_update.distritoupdate=response.data.distrito;
                })
                .catch(error=>{
                console.log(error);
            });
        },
        obtener_distrito4(){
              var urlx2dxx="listardistrito";
                axios.get(urlx2dxx,{ params: { id_provincia: this.data_update.provincia_nacimiento }})
                .then(response=>{
                this.data_update.distritonacimientoupdate=response.data.distrito;
                })
                .catch(error=>{
                console.log(error);
                });
        }  

    },
    computed: {
        calculateage(){
            var years = moment().diff(this.fecha_nacimiento, 'years',false);
            return years;
        },
        edad_update(){
            var yearsup = moment().diff(this.data_update.fecha_nacimiento, 'years',false);
            return yearsup;
        },
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