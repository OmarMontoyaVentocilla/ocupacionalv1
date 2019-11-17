<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readEquipo()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readEquipo()">
                            </div>  

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button @click.prevent="AddEquipo()" class="btn btn-primary">+ Nuevo equipo</button>   
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
                                            <td>{{ list.descripcion_equipo}}</td>
                                            <td>{{ list.modelo}}</td>
                                            <td>{{ list.marca}}</td>
                                            <td>{{ list.nro_serie}}</td>
                                            <td>{{ list.fecha_calibracion}}</td>
                                            <td>{{ list.nombre_esp}}</td>
                                            <td>
                <button class="btn btn-info btn-sm"  @click.prevent="initUpdate(list)"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm"  @click.prevent="deleteEquipo(list)"> <i class="fa fa-trash"></i></button>
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
         <div class="modal fade" tabindex="-1" role="dialog" id="add_equipo_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error.descripcion_equipo}">
                        <label for="descripcion_equipo" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion_equipo" id="descripcion_equipo" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion_equipo') }" v-model="equipo.descripcion_equipo">
                  </div>
                  <span  v-show="errors.has('descripcion_equipo')" class="help is-danger text-danger">{{ errors.first('descripcion_equipo') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error.descripcion_equipo">{{error_x}}</span> 
                 
                  <div v-bind:class="{'form-group':true}">
                        <label for="modelo" >Modelo:</label>
                        <input type="text" name="modelo" id="modelo" placeholder="Modelo" :class="{'form-control': true}" v-model="equipo.modelo">
                  </div>
                  
                  <div v-bind:class="{'form-group':true}">
                        <label for="marca" >Marca:</label>
                        <input  type="text" name="marca" id="marca" placeholder="Marca" :class="{'form-control': true}" v-model="equipo.marca">
                  </div>
                
                 <div v-bind:class="{'form-group':true}">
                        <label for="nro_serie" >Nro. serie:</label>
                        <input type="text" name="nro_serie" id="nro_serie" placeholder="Nro. serie" :class="{'form-control': true}" v-model="equipo.nro_serie">
                  </div>
          
                  <div v-bind:class="{'form-group':true}">
                        <label for="fecha_calibracion">Fecha calibración:</label>
                        <input type="date" name="fecha_calibracion" id="fecha_calibracion" placeholder="Fecha calibración" :class="{'form-control': true}" v-model="equipo.fecha_calibracion">
                  </div>
    

                 <div v-bind:class="{'form-group':true}">
                         <label for="fecha_calibracion">Especialidad:</label>
                         <select class="form-control input-sm" v-model="equipo.especialidad_list">
                         <option v-for="value in lista_especialidad" :value="value.id">{{value.nombre_esp}}</option>
           </select>
                  </div>   
              
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createEquipo()" class="btn btn-primary" id="envioEquipo">Grabar</button>
                    </div>
                </div>
            </div>
        </div> 
     <!--
            Modal update
        -->
           <div class="modal fade" tabindex="-1" role="dialog" id="update_equipo_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div v-bind:class="{'form-group':true,'has-error':error_update.descripcion_equipo}">
                        <label for="descripcion_equipo_update" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion_equipo_update" id="descripcion_equipo_update" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion_equipo_update') }" v-model="equipo.descripcion_equipo_update">
                        </div>
                   <span  v-show="errors.has('descripcion_equipo_update')" class="help is-danger text-danger">{{ errors.first('descripcion_equipo_update') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error_update.descripcion_equipo">{{error_x}}</span> 
                 
                  <div v-bind:class="{'form-group':true}">
                        <label for="modelo_update" >Modelo:</label>
                        <input type="text" name="modelo_update" id="modelo_update" placeholder="Modelo" :class="{'form-control': true}" v-model="equipo.modelo_update">
                  </div>
                  
                  <div v-bind:class="{'form-group':true}">
                        <label for="marca_update" >Marca:</label>
                        <input  type="text" name="marca_update" id="marca_update" placeholder="Marca" :class="{'form-control': true}" v-model="equipo.marca_update">
                  </div>
                
                 <div v-bind:class="{'form-group':true}">
                        <label for="nro_serie_update">Nro. serie:</label>
                        <input type="text" name="nro_serie_update" id="nro_serie_update" placeholder="Nro. serie" :class="{'form-control': true}" v-model="equipo.nro_serie_update">
                  </div>
          
                  <div v-bind:class="{'form-group':true}">
                        <label for="fecha_calibracion_update">Fecha calibración:</label>
                        <input type="date" name="fecha_calibracion_update" id="fecha_calibracion_update" placeholder="Fecha calibración" :class="{'form-control': true}" v-model="equipo.fecha_calibracion_update">
                  </div>
    
                  <div v-bind:class="{'form-group':true}">
                         <label for="fecha_calibracion">Especialidad:</label>
                        <select class="form-control input-sm" v-model="equipo.especialidad_list_update">
                    <option v-for="value in lista_especialidad" :value="value.id">{{value.nombre_esp}}</option>
                         </select>
                  </div> 

                  </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="updateEquipo(equipo.id)" class="btn btn-primary" id="envioEquipo_update">Grabar</button>
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
       <button class="btn btn-default" v-on:click.prevent="readEquipo()"><i class="fa fa-spinner"></i></button>
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
      this.readEquipo();    
      this.$validator.localize('es', {
      messages: spain.messages,
      attributes: {
        descripcion_equipo: 'descripcion de equipo',
        descripcion_equipo_update:'descripción'
          }
       });
      this.listarEspecialidad();
      this.equipo.especialidad_list='8';
      },
      data(){
          return{
                equipo:{
                    descripcion_equipo:'',
                    modelo:'',
                    id:'',
                    marca:'',
                    nro_serie:'',
                    fecha_calibracion:'',
                    especialidad_list:'',
                    especialidad_list_update:'',
                    descripcion_equipo_update:'',
                    modelo_update:'',
                    marca_update:'',
                    nro_serie_update:'',
                    fecha_calibracion_update:''
                },
                filter:'',
                total_registros:'',
                total_reg_busqueda:'',
                cabezera:['#','Descripción','Modelo','Marca','Nro. Serie','Fecha calibración','Especialidad','Acción'],
                combo:'',
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
                error: [],
                lista: [],
                error_update:[],
                errors_x:[],
                lista_especialidad:[]
          }
      },
      methods:{
        changePage(page){
        this.pagination.current_page=page;
        this.readEquipo(page);
        },
        AddEquipo(){
                 this.error = [];
                $("#add_equipo_model").modal("show");
                $('body').css('padding-right','0px');
        },
        disabl(valor,id){
              $("#"+id).prop('disabled', valor);
        },
        updateEquipo(info){
              axios.patch('/equipo/' + info, {
                    especialidad_list:this.equipo.especialidad_list_update,
                    descripcion_equipo:this.equipo.descripcion_equipo_update,
                    modelo:this.equipo.modelo_update,
                    marca:this.equipo.marca_update,
                    nro_serie:this.equipo.nro_serie_update,
                    fecha_calibracion:this.equipo.fecha_calibracion_update
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#update_equipo_model").modal("hide");
                        this.limpiar();
                        this.readEquipo();
                }).catch(error=>{
                   this.error_update = error.response.data;
                   if(error.response.status==422){
                        console.clear();
                       }
                    this.$validator.errors.items.length=0;
                })
        },
        initUpdate(info){
                this.errors_x = [];
                this.error_update=[];
                $("#update_equipo_model").modal("show");
                $('body').css('padding-right','0px');
                 this.equipo.descripcion_equipo_update=info.descripcion_equipo;
                 this.equipo.modelo_update=info.modelo;
                 this.equipo.marca_update=info.marca;
                 this.equipo.nro_serie_update=info.nro_serie;
                 this.equipo.fecha_calibracion_update=info.fecha_calibracion;
                 this.equipo.especialidad_list_update=info.id_esp;
                 this.equipo.id=info.id_equipo;
            
        },
        deleteEquipo(info){
                 let url_delete="equipo/"+info.id_equipo;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara al CIE: "+info.descripcion_equipo,
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
                            selfdel.readEquipo();
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
                   titulo='Añadir nuevo equipo';
                  }else if(valor=='u'){
                    titulo='Editar equipo';
                  }else{
                    titulo='';
                  } 
                  return titulo;
        },
         readEquipo(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listarequipo?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.equipo.data,
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
        limpiar(){
            this.equipo.descripcion_equipo='';
            this.equipo.modelo='';
            this.equipo.marca='';
            this.equipo.nro_serie='';
            this.equipo.fecha_calibracion='';
        },
        createEquipo(){
              var sel_thi=this;
                sel_thi.disabl(true,'envioEquipo');
                setTimeout(function(){sel_thi.disabl(false,'envioEquipo');}, 3000);
                axios.post('/equipo', {
                    descripcion_equipo: this.equipo.descripcion_equipo,
                    modelo: this.equipo.modelo,
                    marca: this.equipo.marca,
                    nro_serie: this.equipo.nro_serie,
                    fecha_calibracion: this.equipo.fecha_calibracion,
                    especialidad_list: this.equipo.especialidad_list
                })
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.message,'success');
                        this.limpiar();
                        $("#add_equipo_model").modal("hide");
                        this.readEquipo();
                    })
                    .catch(error => {
                        this.error = error.response.data;
                        if(error.response.status==422){
                        	console.clear();    
                        }
                        this.$validator.errors.items.length=0;
                    });
        },
        listarEspecialidad(){
           let url_especial='listarespecialidad';
          axios.get(url_especial,{})
          .then(response=>{
              this.lista_especialidad=response.data.especialidades_combo;
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