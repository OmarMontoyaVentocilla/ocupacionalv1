<template>
        <div class="container-fluid">
                 <div class="row" v-if="accion==1">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                           <div class="form-group">
                           <label for="persona">Empresa</label>
                                <v-select label="razon_social" :on-change="getprofiles"  :options="listaempresa" v-model="idempresa"></v-select>
                          </div>  
                          <div class="form-group">
                           <label for="subcontrata">Subcontrata</label>
                                <v-select label="razon_social"  :options="listasubcontrata" v-model="idsubcontrata"></v-select>
                          </div>
                          <div class="form-group">
                           <label for="subcontrata">Perfil</label>
                                <v-select label="descripcion_perfil"  :options="lista_profiles" v-model="idperfil"></v-select>
                          </div>
                            <div class="form-group">
                           <label for="subcontrata">Estado</label>
                                <v-select label="nombre"  :options="lista_estados" v-model="idestado"></v-select>
                          </div>
                           <div class="form-group">
                           <label for="descripcion">Descripción</label>
                        <input  type="text" name="descripcion" class="form-control" id="descripcion" placeholder="Descripción" v-model="descripcion"> 
                          </div>
                          <div class="form-group">
                           <label for="fechaini">Fecha Inicial:</label>
                         <input type="date" class="form-control" id="fechaini" v-model="inicio_vigencia">
                          </div>  
                          <div class="form-group">
                           <label for="fechafinal">Fecha Final:</label>
                        <input type="date" class="form-control" id="fechafinal" v-model="final_vigencia">
                          </div>  
<label class="radio-inline"><input type="radio" value="1" v-model="facturar_tipo">Facturar por empresa</label>
<label class="radio-inline"><input type="radio" value="2" v-model="facturar_tipo">Facturar por subcontrata</label> 
                         <br><br>
                        <div class="form-group">
             <button type="button" class="btn btn-primary" @click.prevent="createProtocolo" id="envioprotocolo">Guardar</button>
                            </div>                                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  </div>

                   <div class="row" v-if="accion==1">
                         <div class="col-md-12">
         <div class="panel panel-default">
         <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Pre Ocupacional</th>
                                            <th>Periódico</th> 
                                            <th>Retiro</th>
                                            <th>Visita</th>
                                            <th>Reubicación</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista_prtocolos">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.descripcion_examen}}</td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="preocu[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="periodico[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="retiro[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="visita[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="levantamiento[index]"></td>
                                            </tr>
                                            <tr v-if="lista_prtocolos!=''">
                                            <td style="background-color:#00a65a;color:white;" colspan="2" align="center">Total Completo</td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalpreocu"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalocu"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalretiro"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalvisita"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalreubicacion"></td>
                                            </tr>
                                        </tbody>
                            </table>
                    </div>
          </div>
          </div>
          </div>
                   </div>
                   
                   <div class="row" v-if="accion==2">
                    <div class="col-md-12">
         <div class="panel panel-default">
              <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="getproto()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="getproto()">
                            </div>  
                        </div>            
              </div>


                         <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>Codigo</th>
                                            <th>Empresa</th>
                                            <th>Subcontrata</th>
                                            <th>Perfil</th>
                                            <th>EMPO</th>
                                            <th>EMOA</th>
                                            <th>EMOR</th>
                                            <th>VIS</th>
                                            <th>REUB</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista_allprot">
                                            <td>{{ list.codigo_protocolo}}{{ list.id}}</td>
                                            <td>{{ list.razon_social}}</td>
                                            <td>{{ nombresubcontrata(list.subcontrata) }}</td>
                                            <td>{{ list.descripcion_perfil}}</td>
                                            <td>{{ list.total_preocupacional}}</td>
                                            <td>{{ list.total_periodico}}</td>
                                            <td>{{ list.total_retiro}}</td>
                                            <td>{{ list.total_visita}}</td>
                                            <td>{{ list.total_reubicacion}}</td>
                             <td><button class="btn btn-info btn-sm" @click.prevent="initpro(list)"> <i class="fa fa-edit"></i></button></td>
                             <td><button class="btn btn-danger btn-sm" @click.prevent="deletepro(list)"> <i class="fa fa-trash"></i></button></td>         
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
        </div>
                     </div>

   

<div class="modal fade" role="dialog" id="updateprotocol">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar protocolo {{contador_protcolos}}</h4>
                    </div>
                   <div class="modal-body">
                         <div class="row">
                             <div class="col-lg-12"> 
                                <div class="form-group">
                           <label for="descripcion">Descripción</label>
<input  type="text" name="descripcion" class="form-control" id="descripcion_up" placeholder="Descripción" v-model="data_update.descripcion"> 
                               </div>
                                <div class="form-group">
                           <label for="fechaini">Fecha Inicial:</label>
                             <input type="date" class="form-control" id="fechaini_up" v-model="data_update.vigencia_inicial">
                          </div>  
                          <div class="form-group">
                           <label for="fechafinal">Fecha Final:</label>
                           <input type="date" class="form-control" id="fechafinal_up" v-model="data_update.vigencia_final">
                          </div> 
                           <div class="form-group">
                           <label for="subcontrata">Estado</label>
                               <select class="form-control input-sm" v-model="data_update.estado_protocolo">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in lista_estados" :value="sel.id">{{sel.nombre}}</option>
                            </select>
                          </div>
<label class="radio-inline"><input type="radio" value="1" v-model="data_update.factura_protocolo">Facturar por empresa</label>
<label class="radio-inline"><input type="radio" value="2" v-model="data_update.factura_protocolo">Facturar por subcontrata</label>  
                             </div>
                         </div>
                         <div class="row">
                         <div class="col-lg-12 col-md-12">
         <div class="panel panel-default">
         <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Pre Ocupacional</th>
                                            <th>Periódico</th> 
                                            <th>Retiro</th>
                                            <th>Visita</th>
                                            <th>Reubicación</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in data_update.lista_protocolos">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.descripcion_examen}}</td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="data_update.datos_preocupacional[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="data_update.datos_periodico[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="data_update.datos_retiro[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="data_update.datos_visita[index]"></td>
                                            <td><input autocomplete="off" type="number" class="form-control" id=""  min="0"  v-model="data_update.datos_reubicacion[index]"></td>
                                            </tr>
                                            <tr v-if="data_update.lista_protocolos!=''">
                                            <td style="background-color:#00a65a;color:white;" colspan="2" align="center">Total Completo</td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalpreocu_up"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalocu_up"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalretiro_up"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalvisita_up"></td>
                                            <td style="background-color:#00a65a;color:white;"><input autocomplete="off" type="number" class="form-control"   :readonly="true" id="" v-model="totalreubicacion_up"></td>
                                            </tr>
                                        </tbody>
                            </table>
                    </div>
          </div>
          </div>
          </div>
                   </div>

                   <div class="modal-footer">
                        <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button"  class="btn btn-primary" id="" @click.prevent="updatepro(data_update.id)">Grabar</button>
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
       <button class="btn btn-default" v-on:click.prevent="getproto()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div> 
        </div> 
        
        </div>             
</template>
<script>
import vSelect from 'vue-select';
import moment from 'moment';
import swal from 'sweetalert2';
    export default{
      mounted(){

      },
      created(){
          this.getCompany();
          var fecha= moment().format("YYYY-MM-DD"); 
           this.inicio_vigencia=fecha;  
           this.final_vigencia=fecha;
           this.getproto();
      },
      components: {
        'vSelect':vSelect
      },
      props:['company','accion'],
      data(){
          return{
              listaempresa:[],
              lista_profiles:[],
              lista_prtocolos:[],
              preocu:[], 
              lista_allprot:[],
              periodico:[], 
              retiro:[],
              listar_empresas:[],
              visita:[], 
              levantamiento:[],
              lista_estados:[
                  { id: '1'  , nombre: 'Afiliada' },
 		          { id: '2'  , nombre: 'En proceso' },
 		          { id: '3'  , nombre: 'No afiliada' }
              ],
              descripcion:'',
              inicio_vigencia:'',
              final_vigencia:'',
              idempresa:{id: "", razon_social: "Seleccione empresa"},
              idperfil:{id: "", descripcion_perfil: "Seleccione perfil"},
              idestado:{id: "", nombre: "Seleccione estado"},
              valor_empresa:'',
              facturar_tipo:'',
              listasubcontrata:[],
              idsubcontrata:{id: "", razon_social: "Seleccione subcontrata"},
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
              contador_protcolos:'',
              data_update:{
                  codigo_protocolo:'',
                  lista_protocolos:[],
                  lista_perfiles:[],
                  codigo_empresa:'',
                  codigo_perfil:'',
                  datos_periodico:[],
                  datos_preocupacional:[],
                  datos_retiro:[],
                  datos_reubicacion:[],
                  datos_visita:[],
                  descripcion:'',
                  descripcion_perfil:'',
                  estado_protocolo:'',
                  factura_protocolo:'',
                  id:'',
                  razon_social:'',
                  subcontrata:'',
                  total_periodico:'',
                  total_preocupacional:'',
                  total_retiro:'',
                  total_reubicacion:'',
                  total_visita:'',
                  vigencia_final:'',
                  vigencia_inicial:''
              }
          }
     },
     methods:{
        getCompany(){
            this.listaempresa=this.company;
            this.listasubcontrata=this.company;
        },
         changePage(page){
            this.pagination.current_page=page;
            this.getproto(page);
         },
         updatepro(info){
            axios.patch('/protocolo/' + info, {
                    descripcion:this. data_update.descripcion,
                    vigencia_inicial:this.data_update.vigencia_inicial,
                    vigencia_final:this.data_update.vigencia_final,
                    estado_protocolo:this.data_update.estado_protocolo,
                    factura_protocolo:this.data_update.factura_protocolo,
                    datos_preocupacional:this.data_update.datos_preocupacional.join(),
                    datos_periodico:this.data_update.datos_periodico.join(),
                    datos_retiro:this.data_update.datos_retiro.join(),
                    datos_visita:this.data_update.datos_visita.join(),
                    datos_reubicacion:this.data_update.datos_reubicacion.join(),
                    totalpreocu_up:this.totalpreocu_up,
                    totalocu_up:this.totalocu_up,
                    totalretiro_up:this.totalretiro_up,
                    totalvisita_up:this.totalvisita_up,
                    totalreubicacion_up:this.totalreubicacion_up
                }).then(response=>{
                    this.mensaje('Excelente',response.data.mensaje,'success');
                    $("#updateprotocol").modal("hide");
                     this.getproto();
                }).catch(error=>{
                  console.log(error);
                })
         },
         initpro(info){
            this.data_update.codigo_protocolo=info.codigo_protocolo;
            this.data_update.codigo_empresa=info.codigo_empresa;
            this.data_update.codigo_perfil=info.codigo_perfil;
           
            
            this.data_update.descripcion=info.descripcion;
            this.data_update.descripcion_perfil=info.descripcion_perfil;
            this.data_update.estado_protocolo=info.estado_protocolo;
            this.data_update.factura_protocolo=info.factura_protocolo;
            this.data_update.id=info.id;
            this.data_update.razon_social=info.razon_social;
            this.data_update.subcontrata=info.subcontrata;
            this.data_update.total_periodico=info.total_periodico;
            this.data_update.total_preocupacional=info.total_preocupacional;
            this.data_update.total_retiro=info.total_retiro;
            this.data_update.total_reubicacion=info.total_reubicacion;
            this.data_update.total_visita=info.total_visita;
            this.data_update.vigencia_final=info.vigencia_final;
            this.data_update.vigencia_inicial=info.vigencia_inicial;
            $('#updateprotocol').modal('show');

            var pro1='/listarprofiles';
            var pro2='/listarprotocols';
             axios.get(pro1,{ params: { id_empresa: this.data_update.codigo_empresa } })
                 .then(response=>{
                    this.data_update.lista_perfiles=response.data;
            })
                .catch(error=>{
                    console.log(error);
            });

            axios.get(pro2,{ params: { id_empresa: this.data_update.codigo_empresa } })
                .then(response=>{
                this.data_update.lista_protocolos=response.data.listaprotcolosss;
                this.contador_protcolos=response.data.contadorprotocolos;

           var arrayup_periodico=info.datos_periodico.split(',').map(Number);
           var arrayup_preocupacional=info.datos_preocupacional.split(',').map(Number);
           var arrayup_retiro=info.datos_retiro.split(',').map(Number);
           var arrayup_reubicacion=info.datos_reubicacion.split(',').map(Number);
           var arrayup_visita=info.datos_visita.split(',').map(Number);
            ////////////////////////////
            
            var longitud_nueva=this.contador_protcolos;

            arrayup_periodico.length=longitud_nueva;
            var xx=[];
            for(var i of arrayup_periodico){
                        if(i==undefined){
                            xx.push(0);
                        }
                }
           this.data_update.datos_periodico=info.datos_periodico.split(',').map(Number).concat(xx);
           
              ////////////////////////////
            arrayup_preocupacional.length=longitud_nueva;
            var xx2=[];
            for(var i of arrayup_preocupacional){
                        if(i==undefined){
                            xx2.push(0);
                        }
            }
            this.data_update.datos_preocupacional=info.datos_preocupacional.split(',').map(Number).concat(xx2);
            
             ////////////////////////////
            arrayup_retiro.length=longitud_nueva;
            var xx3=[];
            for(var i of arrayup_retiro){
                        if(i==undefined){
                            xx3.push(0);
                        }
            }
            this.data_update.datos_retiro=info.datos_retiro.split(',').map(Number).concat(xx3);

             ////////////////////////////
            arrayup_reubicacion.length=longitud_nueva;
            var xx4=[];
            for(var i of arrayup_reubicacion){
                        if(i==undefined){
                            xx4.push(0);
                        }
            }
            this.data_update.datos_reubicacion=info.datos_reubicacion.split(',').map(Number).concat(xx4);
           
              ////////////////////////////

            arrayup_visita.length=longitud_nueva;
            var xx5=[];
            for(var i of arrayup_visita){
                        if(i==undefined){
                            xx5.push(0);
                        }
            }
            this.data_update.datos_visita=info.datos_visita.split(',').map(Number).concat(xx5);

            })
                .catch(error=>{
                console.log(error);
            });
  
             
            

              
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
        getproto(page){
           var valor_combo=this.combo;
           var valor_caja=this.filter;
           var ulrprot='/listarprotcls?page='+page;   
            axios.get(ulrprot,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
            var arreglo=[  
            this.lista_allprot=response.data.protocolos.data,
            this.listar_empresas=response.data.company,
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
        nombresubcontrata(id_subcontrata){  
            var respuesta=[];
              for(let i of this.listar_empresas){
                     if(id_subcontrata==i.id){
                          respuesta.push(i.razon_social);
                     }else{
                         respuesta.push("mal");
                     }
                   
              }
              var found = respuesta.find(function(element) {
                    return element != 'mal';
              });
              
              if(found==null){
               return "No hay subcontrata"; 
              }else{
                return found;  
              }
         }, 
        createProtocolo(){
             var sel_thi=this;
             sel_thi.disabl(true,'envioprotocolo');
             setTimeout(function(){sel_thi.disabl(false,'envioprotocolo');}, 3000);
             var valor_empresa=this.valor_empresa;
             var valor_subcontrata=this.idsubcontrata.id;
             var valor_perfil=this.idperfil.id;
             var valor_estado=this.idestado.id;
             var valor_descripcion=this.descripcion;
             var valor_inicio_vig=this.inicio_vigencia;
             var valor_final_vig=this.final_vigencia;
             var valor_facturar_tipo=this.facturar_tipo;
             var valor_preocupacional=this.totalpreocu;
             var valor_ocupacional=this.totalocu;
             var valor_retiro=this.totalretiro;
             var valor_visita=this.totalvisita;
             var valor_levantamiento=this.totalreubicacion;
          
             var array_preocupacional= this.preocu.map(Number);
             var array_periodico= this.periodico.map(Number);
             var array_retiro=this.retiro.map(Number);
             var array_visita= this.visita.map(Number);
             var array_levantamiento= this.levantamiento.map(Number);

            
            //tamaño de la longitud del arreglo:
             var longitud=this.cantidadprotocolos;

            array_preocupacional.length=longitud;
            array_periodico.length=longitud;
            array_retiro.length=longitud;
            array_visita.length=longitud;
            array_levantamiento.length=longitud;

            var x=[];
            var x2=[];
            var x3=[];
            var x4=[];
            var x5=[];

                for(var i of array_preocupacional){
                        if(i==undefined){
                            x.push(0);
                        }
                }
            Array.prototype.push.apply(array_preocupacional, x);
            var result = array_preocupacional.filter(x => x!=undefined); 

            var datos_preocupacional_x=result.join();
            /////////////////////////////////////////////////////////////             
            
                for(var i of array_periodico){
                        if(i==undefined){
                            x2.push(0);
                        }
                }

            Array.prototype.push.apply(array_periodico, x2);
            var result2 = array_periodico.filter(x => x!=undefined); 
            var datos_periodico_x=result2.join();

             /////////////////////////////////////////////////////////////  
                for(var i of array_retiro){
                        if(i==undefined){
                            x3.push(0);
                        }
                }

            Array.prototype.push.apply(array_retiro, x3);
            var result3 = array_retiro.filter(x => x!=undefined); 
            var datos_retiro_x=result3.join();
             /////////////////////////////////////////////////////////////

               for(var i of array_visita){
                        if(i==undefined){
                            x4.push(0);
                        }
                }

            Array.prototype.push.apply(array_visita, x4);
            var result4 = array_visita.filter(x => x!=undefined); 
            var datos_visita_x=result4.join();
             /////////////////////////////////////////////////////////////

              for(var i of array_levantamiento){
                        if(i==undefined){
                            x5.push(0);
                        }
                }

            Array.prototype.push.apply(array_levantamiento, x5);
            var result5 = array_levantamiento.filter(x => x!=undefined); 
            var datos_levantamiento_x=result5.join();


             axios.post('/protocolo', {
                valor_empresa:valor_empresa,
                valor_subcontrata:valor_subcontrata,
                valor_perfil:valor_perfil,
                valor_estado:valor_estado,
                valor_descripcion:valor_descripcion,
                valor_inicio_vig:valor_inicio_vig,
                valor_final_vig:valor_final_vig,
                valor_facturar_tipo:valor_facturar_tipo,
                valor_preocupacional:valor_preocupacional,
                valor_ocupacional:valor_ocupacional,
                valor_retiro:valor_retiro,
                valor_visita:valor_visita,
                valor_levantamiento:valor_levantamiento,
                array_preocupacional:datos_preocupacional_x,
                array_periodico:datos_periodico_x,
                array_retiro:datos_retiro_x,
                array_visita:datos_visita_x,
                array_levantamiento:datos_levantamiento_x
            })
            .then(response => {
             this.mensaje('Excelente',response.data.mensaje,'success');
             this.getproto();
                    })
            .catch(error => {
                });
        },
        deletepro(info){
                            let url_delete="protocolo/"+info.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminara el protocolo de la empresa: "+info.razon_social,
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
                            selfdel.getproto();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
        },
            
        getprofiles(response){
            var id_empresa=response.id;
            this.valor_empresa=response.id;
            var urld='/listarprofiles';
            var urld2='/listarprotocols';
             axios.get(urld,{ params: { id_empresa: id_empresa } })
         .then(response=>{
            this.lista_profiles=response.data;
         })
           .catch(error=>{
            console.log(error);
         });

        axios.get(urld2,{ params: { id_empresa: id_empresa } })
         .then(response=>{
            this.lista_prtocolos=response.data.listaprotcolosss;
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

     },
     
     totalpreocu_up(){
            return this.data_update.datos_preocupacional.reduce(function(total, item){
                      return total +  parseFloat(item); 
                   },0);
     },

    totalpreocu(){         
       return this.preocu.reduce(function(total, item){
                      return total +  parseFloat(item); 
                  },0);
    },
    totalreubicacion_up(){
         return this.data_update.datos_reubicacion.reduce(function(total, item){
                    return total +  parseFloat(item); 
                  },0);
    },    
    totalreubicacion(){
         return this.levantamiento.reduce(function(total, item){
                    return total +  parseFloat(item); 
                  },0);
    },
    totalocu_up(){
         return this.data_update.datos_periodico.reduce(function(total, item){
                   return total +  parseFloat(item); 
                  },0);
    },
    totalocu(){
         return this.periodico.reduce(function(total, item){
                   return total +  parseFloat(item); 
                  },0);
    },
    totalretiro_up(){
          return this.data_update.datos_retiro.reduce(function(total, item){
                    return total +  parseFloat(item); 
                 },0);
    },
    totalretiro(){
          return this.retiro.reduce(function(total, item){
                    return total +  parseFloat(item); 
                 },0);
    },
    totalvisita_up(){
          return this.data_update.datos_visita.reduce(function(total, item){
                    return total +  parseFloat(item); 
                 },0);
    },
    totalvisita(){
          return this.visita.reduce(function(total, item){
                    return total +  parseFloat(item); 
                 },0);
    },
    cantidadprotocolos(){
        return this.lista_prtocolos.length;
    }
    }    
    }
</script>
<style>

.row.fondo_pantalla {
    background: #00a65a;
    color: white;
    height: 40px;
    padding-top: 8px;
    margin-bottom: 10px;
    margin-top: -10px;
}

.row.fondo_pantalla {
    cursor: pointer;
}

</style>