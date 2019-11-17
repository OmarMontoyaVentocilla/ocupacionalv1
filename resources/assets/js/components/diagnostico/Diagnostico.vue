<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readDiagnosticos()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readDiagnosticos()">
                            </div>  

                            <div class="col-lg-2 col-md-2 col-sm-2">
                                    <button @click.prevent="AddDiagnosticos()" class="btn btn-primary">+ Nuevo diagnostico</button>   
                            </div>

                             <div class="col-lg-2 col-md-2 col-sm-2">
                       <!-- <a v-bind:href="'/export/'"><button class="btn btn-success"><i class="fa fa-file-excel-o"></i></button></a> -->
                            <button class="btn btn-success" @click.prevent="report()"><i class="fa fa-file-excel-o"></i></button>
                            </div>

                        </div>            
                    </div>
                            <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr >
                                            <th>#</th>
                                            <th>CIE10</th>
                                            <th>Descripcion</th>
                                            <th>Recomendaciones</th>
                                            <th colspan="2">Acción</th>
                                           
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.cie10}}</td>
                                            <td>{{ list.descripcion}}</td>
                                            <td>{{ list.recomendaciones}}</td>
                                            <td><button class="btn btn-info btn-sm"  @click.prevent="initUpdate(list)"> <i class="fa fa-edit"></i></button></td>
                                            <td><button class="btn btn-danger  btn-sm"  @click.prevent="deleteDiagnsotic(list)"> <i class="fa fa-trash"></i></button></td>
                                            </tr>
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
         <div class="modal fade" tabindex="-1" role="dialog" id="add_diagnostic_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error.descripcion}">
                            <label for="descripcion" >Descripción:</label>
                        <input v-validate="'required'" type="text" name="descripcion" id="descripcion" placeholder="Descripción" :class="{'form-control': true, 'is-danger': errors.has('descripcion') }" v-model="diagnostico.descripcion">
                  </div>
                  <span  v-show="errors.has('descripcion')" class="help is-danger text-danger">{{ errors.first('descripcion') }}</span>
                   <span class="help-block text-danger" v-for="error_x in error.descripcion">{{error_x}}</span> 


                    <div v-bind:class="{'form-group':true,'has-error':error.cie10}">
                            <label for="cie10" >CIE 10:</label>
                        <input v-validate="'required'" type="text" name="cie10" id="cie10" placeholder="CIE 10" :class="{'form-control': true, 'is-danger': errors.has('cie10') }" v-model="diagnostico.cie10">
                  </div>
                   <span  v-show="errors.has('cie10')" class="help is-danger text-danger">{{ errors.first('cie10') }}</span>
                  <span class="help-block text-danger" v-for="error_x in error.cie10">{{error_x}}</span> 

                  <div v-bind:class="{'form-group':true,'has-error':error.recomendaciones}">
                            <label for="recomendaciones" >Recomendación:</label>
                        <input  type="text" name="recomendaciones" id="recomendaciones" placeholder="Recomendacion" class="form-control" v-model="diagnostico.recomendaciones">
                  </div>
                  <span class="help-block text-danger" v-for="error_x in error.recomendaciones">{{error_x}}</span> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createDiagnostico" class="btn btn-primary" id="envioDiag">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
            <!--
            Modal Edit
        -->
          <div class="modal fade" tabindex="-1" role="dialog" id="update_diagnostic_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error_update.descripcion}">
                            <label for="descripcion_update">Descripción:</label>
                        <input type="text" name="descripcion_update" id="descripcion_update" placeholder="Descripción" class="form-control" v-model="diagnostico.descripcion_update">
                  </div>
                   <span class="help-block text-danger" v-for="error_x in error_update.descripcion">{{error_x}}</span> 

                    <div v-bind:class="{'form-group':true,'has-error':error_update.cie10}">
                            <label for="cie10_update">CIE 10:</label>
                        <input type="text" name="cie10_update" id="cie10_update" placeholder="CIE 10" class="form-control" v-model="diagnostico.cie10_update">
                  </div>
                  <span class="help-block text-danger" v-for="error_x in error_update.cie10">{{error_x}}</span> 

                  <div v-bind:class="{'form-group':true,'has-error':error_update.recomendaciones}">
                            <label for="recomendaciones_update">Recomendación:</label>
                        <input type="text" name="recomendaciones_update" id="recomendaciones_update" placeholder="Recomendacion" class="form-control" v-model="diagnostico.recomendaciones_update">
                  </div>
                  <span class="help-block text-danger" v-for="error_x in error_update.recomendaciones">{{error_x}}</span> 

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="updateDiagnostico(diagnostico.id)" class="btn btn-primary" id="envioDiag_update">Grabar</button>
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
       <button class="btn btn-default" v-on:click.prevent="readDiagnosticos()"><i class="fa fa-spinner"></i></button>
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
          this.readDiagnosticos();
          
           this.$validator.localize('es', {
            messages: spain.messages,
      attributes: {
        descripcion: 'descripcion',
        cie10:'cie 10',
        recomendaciones:'recomendacion'
      }
      
    });
       },
      data(){
           return {
                diagnostico: {
                   descripcion: '',
                   descripcion_update:'',
                   cie10:'',
                   cie10_update:'',
                   recomendaciones:'',
                   recomendaciones_update:'',
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
           readDiagnosticos(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listardiagnostico?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.diagnostico.data,
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
        report(){
            return  window.location.href="/export";        
        },
        limpiar(){
                  this.descripcion='';
                  this.descripcion_update='';
                  this.cie10='';
                  this.cie10_update='';
                  this.recomendaciones='';
                  this.recomendaciones_update='';
        },
        updateDiagnostico(info_id){      
                axios.patch('/diagnostics/' + info_id, {
                    descripcion: this.diagnostico.descripcion_update,
                    cie10: this.diagnostico.cie10_update,
                    recomendaciones: this.diagnostico.recomendaciones_update
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#update_diagnostic_model").modal("hide");
                        this.limpiar();
                        this.readDiagnosticos();
                }).catch(error=>{
                   this.error_update = error.response.data;
                   if(error.response.status==422){
                        console.clear();
                       }
                })
        },
         changePage(page){
        this.pagination.current_page=page;
        this.readDiagnosticos(page);
        },
        initUpdate(index){
                this.errors_x = [];
                this.error_update=[];
                $("#update_diagnostic_model").modal("show");
                $('body').css('padding-right','0px');
                this.diagnostico.descripcion_update = index.descripcion;
                this.diagnostico.recomendaciones_update=index.recomendaciones;
                this.diagnostico.cie10_update=index.cie10;
                this.diagnostico.id=index.id;
        },
        deleteDiagnsotic(info){
                  let url_delete="diagnostics/"+info.id;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara al CIE: "+info.cie10,
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
                            selfdel.readDiagnosticos();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
        },
        AddDiagnosticos(){
                this.error = [];
                $("#add_diagnostic_model").modal("show");
                $('body').css('padding-right','0px');
        },
        createDiagnostico(){
                  var sel_thi=this;
                sel_thi.disabl(true,'envioDiag');
                setTimeout(function(){sel_thi.disabl(false,'envioDiag');}, 3000);
                axios.post('/diagnostics', {
                    descripcion: this.diagnostico.descripcion,
                    cie10: this.diagnostico.cie10,
                    recomendaciones: this.diagnostico.recomendaciones
                })
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.message,'success');
                        this.limpiar();
                        $("#add_diagnostic_model").modal("hide");
                        this.readDiagnosticos();
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
                   titulo='Añadir nuevo diagnostico';
                  }else if(valor=='u'){
                    titulo='Editar diagnostico';
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

.div_diagnostico{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_diagnostico table {
    width:100%;
}


thead {
    background: #379e61f0;
    color: white;
}

</style>
