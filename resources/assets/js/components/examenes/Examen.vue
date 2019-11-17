<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readExamen()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readExamen()">
                            </div>  

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button @click.prevent="AddExamen()" class="btn btn-primary">+ Nuevo examen ocupacional</button>   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                  </div>
                  <div class="panel panel-success">
                                <div class="panel-body div_equipo table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th v-for="i in cabezera">{{i}}</th>
                                            </tr>
                                        </thead>    
                                        <tbody>   
                                            <template v-if="lista!=''"> 
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.codigo}}</td>
                                            <td>{{ list.descripcion}}</td>
                                            <td>
                                         <a class="btn btn-default" @click.prevent="initDetailExam(list)" href="#"><img :src="`img/agrega.png`" class="img-responsive" height="20" width="20"></a>       
                                            </td>
                                            <td>
                <button class="btn btn-info btn-sm"  @click.prevent="initUpdate(list)"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm"  @click.prevent="deleteExamen(list)"> <i class="fa fa-trash"></i></button>
                                          </td>
                                            </tr>
                                             </template>
                                         <template v-else>
        	                                    <tr>
        	                        <td colspan="8" align="center">No hay resultados disponibles</td>	
        	                                    </tr>
                                        </template>
                                        </tbody>
                            </table>
                    </div>
                     </div>
                  <!--
            Modal Add
        -->
         <div class="modal fade" tabindex="-1" role="dialog" id="add_eexamen_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error.codigo}">
                        <label for="codigo" >Código:</label>
                        <input v-validate="'required'" type="text" name="codigo" id="codigo" placeholder="Codigo" :class="{'form-control': true, 'is-danger': errors.has('codigo') }" v-model="examen.codigo">
                  </div>
                  <span  v-show="errors.has('codigo')" class="help is-danger text-danger">{{ errors.first('codigo') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error.codigo">{{error_x}}</span> 

                  <div v-bind:class="{'form-group':true,'has-error':error.descripcion}">
                        <label for="descripcion" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion" id="descripcion" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion') }" v-model="examen.descripcion">
                  </div>
                  <span  v-show="errors.has('descripcion')" class="help is-danger text-danger">{{ errors.first('descripcion') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error.descripcion">{{error_x}}</span> 
                  
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click.prevent="createExamen()" class="btn btn-primary" id="envioExamen">Grabar</button>
                    </div>
                </div>
            </div>
        </div> 
     <!--
            Modal update
        -->
           <div class="modal fade" tabindex="-1" role="dialog" id="update_examen_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div v-bind:class="{'form-group':true,'has-error':error_update.descripcion}">
                        <label for="descripcion_examen_update" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion_examen_update" id="descripcion_examen_update" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion_examen_update') }" v-model="examen.descripcion_update">
                        </div>
                        <span  v-show="errors.has('descripcion_examen_update')" class="help is-danger text-danger">{{ errors.first('descripcion_examen_update') }}</span>
                        <span class="help-block text-danger" v-for="error_x in error_update.descripcion">{{error_x}}</span> 

                        <div v-bind:class="{'form-group':true,'has-error':error_update.codigo}">
                        <label for="codigo_examen_update" >Código:</label>
                        <input v-validate="'required'" type="text" name="codigo_examen_update" id="codigo_examen_update" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('codigo_examen_update') }" v-model="examen.codigo_update">
                        </div>
                       <span  v-show="errors.has('codigo_examen_update')" class="help is-danger text-danger">{{ errors.first('codigo_examen_update') }}</span>
                      <span class="help-block text-danger" v-for="error_x in error_update.codigo">{{error_x}}</span> 
                
                  </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click.prevent="updateExamen(examen.id)" class="btn btn-primary" id="envioExamen_update">Grabar</button>
                    </div>
                </div>
            </div>
        </div>

 <!--
            Modal detalle actualizar
        -->
<div class="modal" tabindex="-1" role="dialog" id="add_detallexamen_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button >
                        <h4 class="modal-title">Actualizar Sub-exámenes de: {{nombre_examen}}</h4>
                    </div>
                     <div class="modal-body">
                        <div v-bind:class="{'form-group':true,'has-error':error_detalle_update.codigo}">
                        <label for="codigoup_detalle" >Código:</label>
                        <input v-validate="'required'" type="text" name="codigoup_detalle" id="codigoup_detalle" placeholder="Código" :class="{'form-control': true, 'is-danger': errors.has('codigoup_detalle') }" v-model="subexamen.codigo_update">
                        </div>
                        <span  v-show="errors.has('codigoup_detalle')" class="help is-danger text-danger">{{ errors.first('codigoup_detalle') }}</span>
                        <span class="help-block text-danger" v-for="error_x in error_detalle_update.codigo">{{error_x}}</span>

                         <div v-bind:class="{'form-group':true,'has-error':error_detalle_update.descripcion}">
                        <label for="descripciónup_detalle" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripciónup_detalle" id="descripciónup_detalle" placeholder="Código" :class="{'form-control': true, 'is-danger': errors.has('descripciónup_detalle') }" v-model="subexamen.descripcion_update">
                        </div>
                         <span  v-show="errors.has('descripciónup_detalle')" class="help is-danger text-danger">{{ errors.first('descripciónup_detalle') }}</span>
                        <span class="help-block text-danger" v-for="error_x in error_detalle_update.descripcion">{{error_x}}</span>      
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click.prevent="actualizardetalle(iddetalle_examen)" class="btn btn-primary" id="envioDetExamen">Grabar</button>
                    </div>
                </div>
            </div>
</div>
            

 <!--
            Modal detalle de examen agrega
        -->
 <div class="modal fade" tabindex="-1" role="dialog" id="add_detailexam_model">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button >
                        <h4 class="modal-title">Agrega Sub-exámenes</h4>
                    </div>
                     <div class="modal-body">
                   
                   <div v-bind:class="{'form-group':true,'has-error':error_detalle.codigo}">
                        <label for="codigo_detalle" >Código:</label>
                        <input v-validate="'required'" type="text" name="codigo_detalle" id="codigo_detalle" placeholder="Código" :class="{'form-control': true, 'is-danger': errors.has('codigo_detalle') }" v-model="subexamen.codigo">
                    </div>
                        <span  v-show="errors.has('codigo_detalle')" class="help is-danger text-danger">{{ errors.first('codigo_detalle') }}</span>
                        <span class="help-block text-danger" v-for="error_x in error_detalle.codigo">{{error_x}}</span>

                     <div class="form-group">
                                   <label for="codigo_examen"> Exámen Principal:</label>
                                   <select class="form-control input-sm" v-model="subexamen.codigo_examen">
                                   <option :selected="true" :value="id_examen">{{nombre_examen}}</option>      
                                  </select>
                     </div>      
        
                    <div v-bind:class="{'form-group':true,'has-error':error_detalle.descripcion}">
                        <label for="descripcion_detalle" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion_detalle" id="descripcion_detalle" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion_detalle') }" v-model="subexamen.descripcion">
                    </div>
                        <span  v-show="errors.has('descripcion_detalle')" class="help is-danger text-danger">{{ errors.first('descripcion_detalle') }}</span>
                        <span class="help-block text-danger" v-for="error_x in error_detalle.descripcion">{{error_x}}</span> 
                     </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click.prevent="createDetalleExamen()" class="btn btn-primary" id="envioDetExamen">Grabar</button>
                    </div>
                    <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo2" @change="readDetailExamen()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter2" @keyup="readDetailExamen()">
                            </div>  

                        </div>
                    </div>
                </div>
            </div>
                  </div>
                    <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Codigo</th>
                                            <th>Descripcion</th>
                                            <th colspan="2">Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody> 
                                           <template v-if="lista_detalleex!=''"> 
                                            <tr v-for="(list, index) in lista_detalleex">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.codigo}}</td>
                                            <td>{{ list.descripcion}}</td>
                             <td><button class="btn btn-info btn-sm" @click.prevent="iniciarDetailExamen(list)"> <i class="fa fa-edit"></i></button></td>
                             <td><button class="btn btn-danger btn-sm" @click.prevent="deleteDetailExamen(list)"> <i class="fa fa-trash"></i></button></td>         
                                            </tr>
                                            </template>
                                             <template v-else>
                                                 <tr>
                                               <td colspan="5" align="center">No hay resultados disponibles</td>      
                                                 </tr>
                                           </template>  
                                        </tbody>
                                    </table>
                                </div>
                    </div>
                      <div class="row" >
        <div class="col-lg-8 col-xs-12">
           <nav>
      <ul class="pagination">
<li v-if="pagination2.current_page > 1"><a href="#" v-on:click.prevent="changePage2(pagination2.current_page - 1)"><span>Atras</span></a></li>
<li v-for="page in pagesNumber2" v-bind:class="[ page == isActived ? 'active' : '']">
         <a href="#" v-on:click.prevent="changePage2(page)">{{ page }}</a>
</li>

<li v-if="pagination2.current_page < pagination2.last_page">
        <a href="#" v-on:click.prevent="changePage2(pagination2.current_page + 1)"><span>Siguiente</span></a>
</li>
      </ul>
        </nav>
         </div>
      <div class="col-lg-3 col-xs-8">
       <p class="texto_resultado" v-if="total_registros2!=0 && total_reg_busqueda2!=0">{{total_reg_busqueda2}} de un total de {{total_registros2}} registros</p>
      </div>   
       <div class="col-lg-1 col-xs-4 boton_load">
       <button class="btn btn-default" v-on:click.prevent="readDetailExamen()"><i class="fa fa-spinner"></i></button>
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
       <button class="btn btn-default" v-on:click.prevent="readExamen()"><i class="fa fa-spinner"></i></button>
      </div>  
     </div>

 </div>        
 </template>
 <script>
import swal from 'sweetalert2';
import spain from 'vee-validate/dist/locale/es';
 export default{
      mounted(){

      },
      created(){
      this.readExamen();    
      this.$validator.localize('es', {
      messages: spain.messages,
      attributes: {
        descripcion: 'descripcion de exámen',
        codigo: 'codigo de exámen',
        descripcion_examen_update:'descripción',
        codigo_examen_update:'codigo',
        codigo_detalle:'codigo',
        descripcion_detalle:'descripción',
        codigoup_detalle:'código sub-detalle',
        descripciónup_detalle :'descripcion sub-detalle'
          }
       });
      },
      data(){
          return{
                examen:{
                    descripcion:'',
                    codigo:'',
                    id:'',
                    descripcion_update:'',
                    codigo_update:''
                },
                subexamen:{
                    descripcion:'',
                    codigo:'',
                    descripcion_update:'',
                    codigo_update:'',
                    codigo_examen_update:'',
                    id:'',
                    codigo_examen:'',
                    codigo_detalle_update:'',
                },
                id_examen:'',
                nombre_examen:'',
                iddetalle_examen:'',
                filter:'',
                aparecer:false,
                filter2:'',
                total_registros:'',
                total_reg_busqueda:'',
                 total_registros2:'',
                total_reg_busqueda2:'',
                cabezera:['#','Código','Descripción','Añadir sub-exámen','Acción'],
                combo:'',
                combo2:'',
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
                 pagination2:{
 		           'total'        :0,
 		           'current_page' :0,
 		           'per_page'     :0,
 		           'last_page'    :0,
 		           'from'         :0,
 		           'to'           :0,
 		        },
                error: [],
                lista: [],
                lista_detalleex:[],
                error_update:[],
                errors_x:[],
                error_detalle:[],
                error_detalle_update:[],
                errorsx_detalle:[]

          }
      },
      methods:{
        changePage2(page){
        this.pagination2.current_page=page;
        this.readDetailExamen(page);
        },
        changePage(page){
        this.pagination.current_page=page;
        this.readExamen(page);
        },
        AddExamen(){
                 this.error = [];
                $("#add_eexamen_model").modal("show");
                $('body').css('padding-right','0px');
        },
        iniciarDetailExamen(info){
           this.iddetalle_examen=info.id;
           this.subexamen.descripcion_update=info.descripcion;
           this.subexamen.codigo_update=info.codigo;
           this.subexamen.codigo_detalle_update=info.exams_id;   
           $("#add_detallexamen_model").modal({
               backdrop:'static',
               show:true
           });
           $("#add_detailexam_model").modal("hide");

        },
        initDetailExam(info){
            $("#add_detailexam_model").modal("show");
            $('body').css('padding-right','0px');
            this.id_examen=info.id;
            this.nombre_examen=info.descripcion;
            this.subexamen.codigo_examen=info.id;
            this.readDetailExamen();
        },
        createDetalleExamen(){
              var sel_thi=this;
             sel_thi.disabl(true,'envioDetExamen');
             setTimeout(function(){sel_thi.disabl(false,'envioDetExamen');}, 3000);
            axios.post('/detalle-examen', {
                descripcion:this.subexamen.descripcion,
                codigo:this.subexamen.codigo,
                exams_id:this.subexamen.codigo_examen
            })
            .then(response => {
              this.mensaje('Excelente',response.data.message,'success');
              //$("#add_detailexam_model").modal("hide");
              this.readDetailExamen();
              this.limpiar_detalle();
                    })
            .catch(error => {
                 this.error = error.response.data;
                        if(error.response.status==422){
                        	console.clear();    
                        }
                        this.$validator.errors.items.length=0;
                });
        },
        disabl(valor,id){
              $("#"+id).prop('disabled', valor);
        },
        updateExamen(info){
              axios.patch('/examen/' + info, {
                    codigo:this.examen.codigo_update,
                    descripcion:this.examen.descripcion_update
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#update_examen_model").modal("hide");
                        this.limpiar();
                        this.readExamen();
                }).catch(error=>{
                   this.error_update = error.response.data;
                   if(error.response.status==422){
                        console.clear();
                       }
                    this.$validator.errors.items.length=0;
                })
        },
        actualizardetalle(info){
               axios.patch('/detalle-examen/' + info, {
                    codigo:this.subexamen.codigo_update,
                    descripcion:this.subexamen.descripcion_update,
                    exams_id:this.subexamen.codigo_detalle_update
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#add_detallexamen_model").modal("hide");
                        this.limpiar_subdetalle();
                        this.readDetailExamen();
                }).catch(error=>{
                   this.error_detalle_update = error.response.data;
                   if(error.response.status==422){
                        console.clear();
                       }
                    this.$validator.errors.items.length=0;
                })
        },
        initUpdate(info){
                this.errors_x = [];
                this.error_update=[];
                $("#update_examen_model").modal("show");
                $('body').css('padding-right','0px');
                 this.examen.descripcion_update=info.descripcion;
                 this.examen.codigo_update=info.codigo;
                 this.examen.id=info.id;
            
        },
        deleteDetailExamen(info){
           let url_deletees="detalle-examen/"+info.id;
           var selfdel=this;
           swal({
                   title: 'Estas seguro?',
                   text: "Eliminara el sub-exámen: "+info.descripcion,
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
                       axios.delete(url_deletees).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.readDetailExamen();
                        })
                        .catch(error => {
                           selfdel.mensaje('Error','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
        },
        deleteExamen(info){
                 let url_delete="examen/"+info.id;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara el exámen: "+info.descripcion,
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
                            selfdel.readExamen();
                        })
                        .catch(error => {
                           selfdel.mensaje('Error','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
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
        changeName(valor){
             let titulo=''; 
                  if(valor=='s'){
                   titulo='Añadir nuevo exámen ocupacional';
                  }else if(valor=='u'){
                    titulo='Editar nuevo exámen ocupacional';
                  }else{
                    titulo='';
                  } 
                  return titulo;
        },
         readExamen(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listarexamen?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.examens.data,
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
        readDetailExamen(page){
      	 var valor_combo2=this.combo2;
         var valor_caja2=this.filter2;
         var codigo_examen=this.subexamen.codigo_examen;
         let url='/listardetexamen?page='+page;
         axios.get(url,{ params: { valor_combo2: valor_combo2,valor_caja2:valor_caja2, codigo_examen:codigo_examen } })
         .then(response=>{
             var arreglo=[
                this.lista_detalleex=response.data.detailexamens.data,
                this.pagination2=response.data.pagination,
                this.total_reg_busqueda2=response.data.total_reg_busqueda,
                this.total_registros2=response.data.total_registros
                ];
               return arreglo;

         })
           .catch(error=>{
            console.log(error);
         });
        },
        limpiar(){
            this.examen.descripcion='';
            this.examen.codigo='';
        },
         limpiar_detalle(){
            this.subexamen.descripcion='';
            this.subexamen.codigo='';
        },
         limpiar_subdetalle(){
            this.subexamen.descripcion_update='';
            this.subexamen.codigo_update='';
        },
        createExamen(){
              var sel_thi=this;
                sel_thi.disabl(true,'envioExamen');
                setTimeout(function(){sel_thi.disabl(false,'envioExamen');}, 3000);
                axios.post('/examen', {
                    descripcion: this.examen.descripcion,
                    codigo: this.examen.codigo
                })
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.message,'success');
                        this.limpiar();
                        $("#add_eexamen_model").modal("hide");
                        this.readExamen();
                    })
                    .catch(error => {
                        this.error = error.response.data;
                        if(error.response.status==422){
                        	console.clear();    
                        }
                        this.$validator.errors.items.length=0;
                    });
        }
      },
      computed:{
       
         isActived(){
              return this.pagination.current_page;
           },
         isActived2(){
              return this.pagination2.current_page;
           },  
         pagesNumber2(){
           if(!this.pagination2.to){
              return [];
           }

           var from=this.pagination2.current_page - 2;
           if(from<1){
               from=1;
           }

           var to=from +(2*2);
            if(to>=this.pagination2.last_page){
                to=this.pagination2.last_page
            }

            var pagesArray=[];

            while(from<=to){
                pagesArray.push(from);
                from++;
            }

            return pagesArray;

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
 <style scoped>
.table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
    border: 1px solid #afa8a8;
}

.etiqueta_error{
    color: red;
}

.div_equipo{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_equipo table {
    width:100%;
}


thead {
    background: #379e61f0;
    color: white;
}

</style>                    