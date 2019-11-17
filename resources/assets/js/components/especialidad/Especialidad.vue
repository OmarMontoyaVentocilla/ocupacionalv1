<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readEspecialidad()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readEspecialidad()">
                            </div>  

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button @click.prevent="AddEspecialidad()" class="btn btn-primary">+ Nueva especialidad</button>   
                            </div>

                        </div>            
                    </div>
                            <div class="panel panel-success">
                                <div class="panel-body div_especialidad table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr >
                                            <th>#</th>
                                            <th>Especialidad</th>
                                            <th>Acción</th>
                                           
                                            </tr>
                                        </thead>    
                                        <tbody>  
                                            <template v-if="lista!=''">   
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.nombre_esp}}</td>
                                            <td>
                <button class="btn btn-info btn-sm"  @click.prevent="initUpdate(list)"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm"  @click.prevent="deleteEspecialidad(list)"> <i class="fa fa-trash"></i></button>
                                          </td>
                                            </tr>
                                            </template>
                                            <template v-else>
                                             <tr>
        	                        <td colspan="3" align="center">No hay resultados disponibles</td>	
        	                                </tr>
                                           </template> 
                                        </tbody>
                            </table>
                    </div>
                     </div>
                </div>
            </div>
        </div>

        <!--
            Modal Add
        -->
         <div class="modal fade" tabindex="-1" role="dialog" id="add_especialidad_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error.nombre_esp}">
                        <label for="nombre_esp" >Especialidad:</label>
                        <input v-validate="'required'" type="text" name="nombre_esp" id="nombre_esp" placeholder="Especialidad" :class="{'form-control': true, 'is-danger': errors.has('nombre_esp') }" v-model="especialidad.nombre_esp">
                  </div>
                  <span  v-show="errors.has('nombre_esp')" class="help is-danger text-danger">{{ errors.first('nombre_esp') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error.nombre_esp">{{error_x}}</span> 

                
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createEspecialidad()" class="btn btn-primary" id="envioEsp">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
            <!--
            Modal Edit
        -->
          <div class="modal fade" tabindex="-1" role="dialog" id="update_especialidad_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error_update.nombre_esp}">
                            <label for="nombre_esp_update">Especialidad:</label>
                        <input type="text" name="nombre_esp_update" id="nombre_esp_update" placeholder="Especialidad" class="form-control" v-model="especialidad.nombre_esp_update">
                  </div>
                   <span class="help-block text-danger" v-for="error_x in error_update.nombre_esp">{{error_x}}</span> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="updateEspecialidad(especialidad.id)" class="btn btn-primary" id="envioEsp_update">Grabar</button>
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
       <button class="btn btn-default" v-on:click.prevent="readEspecialidad()"><i class="fa fa-spinner"></i></button>
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
          this.readEspecialidad();
          
           this.$validator.localize('es', {
            messages: spain.messages,
      attributes: {
        nombre_esp: 'especialidad'
          }
       });
       },
      data(){
           return {
                especialidad: {
                   nombre_esp: '',
                   nombre_esp_update:'',
                   id:'' 

                },
                filter:'',
                total_registros:'',
                total_reg_busqueda:'',
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
                error_update:[],
                errors_x:[],
                lista:[]
            }
      },
      methods:{
           readEspecialidad(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listarespecialidad?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.especialidad.data,
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
                  this.especialidad.nombre_esp='';
                  this.especialidad.nombre_esp_update='';
        },
        updateEspecialidad(info_id){      
                axios.patch('/especialidad/' + info_id, {
                    nombre_esp: this.especialidad.nombre_esp_update,
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#update_especialidad_model").modal("hide");
                        this.limpiar();
                        this.readEspecialidad();
                }).catch(error=>{
                   this.error_update = error.response.data;
                   console.log(this.error_update);
                   if(error.response.status==422){
                        console.clear();
                       }
                })
        },
         changePage(page){
        this.pagination.current_page=page;
        this.readEspecialidad(page);
        },
        initUpdate(index){
                this.errors_x = [];
                this.error_update=[];
                $("#update_especialidad_model").modal("show");
                $('body').css('padding-right','0px');
                this.especialidad.nombre_esp_update = index.nombre_esp;
                this.especialidad.id=index.id;
        },
        deleteEspecialidad(info){
                  let url_delete="especialidad/"+info.id;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara la especialidad: "+info.nombre_esp,
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
                            selfdel.readEspecialidad();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
        },
        AddEspecialidad(){
                this.error = [];
                $("#add_especialidad_model").modal("show");
                $('body').css('padding-right','0px');
        },
        createEspecialidad(){
                  var sel_thi=this;
                sel_thi.disabl(true,'envioEsp');
                setTimeout(function(){sel_thi.disabl(false,'envioEsp');}, 3000);
                axios.post('/especialidad', {
                    nombre_esp: this.especialidad.nombre_esp
                })
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.message,'success');
                        this.limpiar();
                        $("#add_especialidad_model").modal("hide");
                        this.readEspecialidad();
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
                   titulo='Añadir nueva especialidad';
                  }else if(valor=='u'){
                    titulo='Editar especialidad';
                  }else{
                    titulo='';
                  } 
                  return titulo;
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

.div_especialidad{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_especialidad table {
    width:100%;
}


thead {
    background: #379e61f0;
    color: white;
}

</style>
