<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">

                            <div class="col-lg-4">
                                <select class="form-control input-sm" v-model="combo" @change="readPermisos()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readPermisos()">
                            </div>  

                            <div class="col-lg-4">
                                    <button @click.prevent="AddPermiso()" class="btn btn-primary">+ Nuevo Permiso</button>   
                            </div>

                        </div>            
                    </div>
                            <div class="panel panel-success">
                                <div class="panel-body div_role table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr><th v-for="cab in cabezera">{{cab}}</th></tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in lista">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.name }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm"  @click.prevent="initUpdate(list)">Editar</button>
                                                <button class="btn btn-danger  btn-sm"  @click.prevent="deletePermiso(list)">Borrar</button>
                                            </td>
                                            </tr>
                                        </tbody>
                            </table>
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
       <button class="btn btn-default" v-on:click.prevent="readPermisos()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div>



        <div class="modal fade" tabindex="-1" role="dialog" id="add_permiso_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true,'has-error':error.name}">
                            <label for="name">Nombre:</label>
                        <input type="text" name="name" id="name" placeholder="Nombre de permiso" class="form-control" v-model="permiso.name">
                  </div>
                   <span class="help-block text-danger" v-for="error_x in error.name">{{error_x}}</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createPermiso" class="btn btn-primary" id="envio_grabar_per">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
       

         <div class="modal fade" tabindex="-1" role="dialog" id="update_permiso_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div v-bind:class="{'form-group':true,'has-error':error_update.name}">
                            <label>Nombre:</label>
                            <input type="text" placeholder="Nombre de permiso" class="form-control"  v-model="permiso.update_permiso">
                        </div>
                         <span class="help-block text-danger" v-for="error_permiso in error_update.name">{{error_permiso}}</span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="button" @click.prevent="updatePermiso(permiso.id)" class="btn btn-primary" id="envio_actualizar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
import swal from 'sweetalert2';
    export default {
        created()
        {
            this.readPermisos();
        },
        data(){
            return {
                permiso: {
                   name: '',
                   update_permiso:'',
                   id:''  
                },
                cabezera:['#','Permiso','Acción'],
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
                lista:[],
                update_permiso:{}
            }
        },
        methods: {
            AddPermiso(){
                this.error = [];
                $("#add_permiso_model").modal("show");
                $('body').css('padding-right','0px');
            },
            changePage(page){
                 this.pagination.current_page=page;
                 this.readPermisos(page);
           },
            disabl(valor,id){
              $("#"+id).prop('disabled', valor);
          },
            initUpdate(index){
                this.errors_x = [];
                this.error_update=[];
                $("#update_permiso_model").modal("show");
                $('body').css('padding-right','0px');
                this.permiso.update_permiso = index.name;
                this.permiso.id=index.id;
            },
            updatePermiso(info_id){
               axios.patch('/permissions/' + info_id, {
                    name: this.permiso.update_permiso
                })
                    .then(response => {
                        this.mensaje('Excelente',response.data.message,'success');
                        $("#update_permiso_model").modal("hide");
                        this.readPermisos();

                    })
                    .catch(error => {
                        this.error_update = error.response.data;
                        if(error.response.status==422){
                        	console.clear();
                        }
                    });
            },
            deletePermiso(info){

                 let url_delete="permissions/"+info.id;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara a "+info.name,
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
                            selfdel.readPermisos();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
            },
            readPermisos(page){
                let valor_combo=this.combo;
                let valor_caja=this.filter;
                let url_permisos='/listarpermisos?page='+page;
                axios.get(url_permisos,{ params: { valor_combo: valor_combo,valor_caja:valor_caja}})
                    .then(response => {
                        console.log(response);
                         var arreglo=[
                        this.lista=response.data.permisos.data,
                        this.pagination=response.data.pagination,
                        this.total_reg_busqueda=response.data.total_reg_busqueda,
                        this.total_registros=response.data.total_registros
                        ];
                       return arreglo;
                    });
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
            createPermiso(){
                var sel_thi=this;
                sel_thi.disabl(true,'envio_grabar_per');
                setTimeout(function(){sel_thi.disabl(false,'envio_grabar_per');}, 3000);
                axios.post('/permissions', {name: this.permiso.name})
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.message,'success');
                        this.reset();
                        $("#add_permiso_model").modal("hide");
                        this.readPermisos();
                    })
                    .catch(error => {
                        console.log(error);
                        // this.error = error.response.data;
                        // if(error.response.status==422){
                        // 	console.clear();
                        // }
                    });
            },
            reset(){
                this.permiso.name = '';        
            },
             changeName(valor){
                let titulo=''; 
                  if(valor=='s'){
                   titulo='Añadir nuevo permiso';
                  }else if(valor=='u'){
                    titulo='Editar Permiso';
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


.texto_resultado{
  margin: 28px 0px;
  color: blue;
}

.boton_load{
  margin: 22px 0px;
}

.div_role{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_role table {
    width:100%;
}

thead {
    background: #379e61f0;
    color: white;
}

</style>
