<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readDoctor()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readDoctor()">
                            </div>  

                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button @click.prevent="AddDoctor()" class="btn btn-primary">+ Nuevo doctor</button>   
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
                                            <td>{{ list.name}}</td>
                                            <td>{{ list.cmp}}</td>
                                            <td><img :src="'img/'+list.firma"></td>
                                            <td>
                <button class="btn btn-info btn-sm"  @click.prevent="initUpdate(list)"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm"  @click.prevent="deleteDoctor(list)"> <i class="fa fa-trash"></i></button>
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
         <div class="modal fade" tabindex="-1" role="dialog" id="add_doctor_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('s')}}</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                        <label for="usuario" >Usuario:</label>
                                <select class="form-control input-sm" v-model="doctor.nombre_doctor">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in user" :value="sel.id">{{sel.name}}</option>
                                </select>           
                  </div>
                 
                   <!-- <span class="help-block text-danger" v-for="error_x in error.nombre_doctor">{{error_x}}</span>  -->
                 
                  <div v-bind:class="{'form-group':true}">
                        <label for="cmp" >CMP:</label>
                        <input type="text" name="cmp" id="cmp" placeholder="CMP" :class="{'form-control': true}" v-model="doctor.cmp">
                  </div>
                  <div class="form-group">
                 <input type="file" id="intfile" v-on:change="onFileChange"  class="form-control filestyle"  accept="image/*">   
                   </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="createDoctor()" class="btn btn-primary" id="envioDoctor">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
        </div> 

     <!--
            Modal update
        -->
           <div class="modal fade" tabindex="-1" role="dialog" id="update_doctor_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">{{changeName('u')}}</h4>
                    </div>
                    <div class="modal-body">
                        <div v-bind:class="{'form-group':true}">
                        <label for="nombre_doctor_update" >Usuario:</label>
                         <select class="form-control input-sm" v-model="doctor.nombre_doctor_update">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in user" :value="sel.id">{{sel.name}}</option>
                         </select>   
                     
                        </div>

                 
                  <div v-bind:class="{'form-group':true}">
                        <label for="cmp" >Cmp:</label>
                        <input type="text" name="cmp" id="cmp" placeholder="cmp" :class="{'form-control': true}" v-model="doctor.cmp_update">
                  </div>
                    <div class="form-group">
                 <input type="file" id="intfile2" v-on:change="onFileChange2"  class="form-control filestyle"  accept="image/*">   
                   </div>
                  <div class="form-group">
                      <img :src="'img/'+foto_mostrar">
                  </div>
                  
                  </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="updateDoctor(doctor.id)" class="btn btn-primary" id="envioDoctor_update">Grabar</button>
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
       <button class="btn btn-default" v-on:click.prevent="readDoctor()"><i class="fa fa-spinner"></i></button>
      </div>  
     </div>
  
 </div>        
 </template>
 <script>
import swal from 'sweetalert2';
import spain from 'vee-validate/dist/locale/es';
 export default{
      mounted(){
        $("#intfile").filestyle({buttonText: "Archivo",buttonName: "btn-primary"});
        $("#intfile2").filestyle({buttonText: "Archivo",buttonName: "btn-primary"});
      },
      created(){
      this.readDoctor();    
    //   this.$validator.localize('es', {
    //   messages: spain.messages,
    //   attributes: {
    //     nombre_doctor: 'nombre de doctor',
    //     nombre_doctor_update:'nombre'
    //       }
    //    });
      },
      props:['user'],
      data(){
          return{
                doctor:{
                    nombre_doctor:'',
                    cmp:'',
                    id:'',
                    nombre_doctor_update:'',
                    cmp_update:''
                },
                filter:'',
                image: '',
                image_update:'',
                foto_mostrar:'',
                total_registros:'',
                total_reg_busqueda:'',
                cabezera:['#','Nombre','CMP','Firma','Acción'],
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
                errors_x:[]
          }
      },
      methods:{
        changePage(page){
        this.pagination.current_page=page;
        this.readDoctor(page);
        },
        onFileChange(e){
                  let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                    return;
                    this.createImage(files[0]);
        },
        onFileChange2(e){
                  let files = e.target.files || e.dataTransfer.files;
                    if (!files.length)
                    return;
                    this.createImage2(files[0]);
        },
        createImage(file) { 
                  let reader = new FileReader();
                  let vm = this;
                  reader.onload = (e) => {
                    vm.image = e.target.result;
                  };
                  reader.readAsDataURL(file);
        },
        createImage2(file) { 
                  let reader = new FileReader();
                  let vm = this;
                  reader.onload = (e) => {
                    vm.image_update = e.target.result;
                  };
                  reader.readAsDataURL(file);
        },
        AddDoctor(){
                 this.error = [];
                $("#add_doctor_model").modal("show");
                $('body').css('padding-right','0px');
        },
        disabl(valor,id){
              $("#"+id).prop('disabled', valor);
        },
        updateDoctor(info){
              axios.patch('/doctor/' + info, {
                    nombre_doctor:this.doctor.nombre_doctor_update,
                    cmp:this.doctor.cmp_update,
                    image_update:this.image_update
                }).then(response=>{
                        this.mensaje('Excelente',response.data.message,'success');
                        $("#update_doctor_model").modal("hide");
                        this.limpiar();
                        $("#intfile2").filestyle('clear');
                        this.readDoctor();
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
                $("#update_doctor_model").modal("show");
                $('body').css('padding-right','0px');
                 this.doctor.nombre_doctor_update=info.idsuariod;
                 this.doctor.cmp_update=info.cmp;
                 this.doctor.id=info.id;
                 this.foto_mostrar=info.firma;
            
        },
        deleteDoctor(info){
                 let url_delete="doctor/"+info.id;
                 var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara s registro?",
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
                            selfdel.readDoctor();
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
                   titulo='Añadir nuevo doctor';
                  }else if(valor=='u'){
                    titulo='Editar doctor';
                  }else{
                    titulo='';
                  } 
                  return titulo;
        },
         readDoctor(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/getdoctor?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.doctor.data,
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
            this.doctor.nombre_doctor='';
            this.doctor.cmp='';
         
        },
        createDoctor(){
              var sel_thi=this;
                sel_thi.disabl(true,'envioDoctor');
                setTimeout(function(){sel_thi.disabl(false,'envioDoctor');}, 3000);
                axios.post('/doctor', { 
                    nombre_doctor: this.doctor.nombre_doctor,
                    cmp: this.doctor.cmp,
                    image:this.image
                })
                    .then(response => {
                        this.error_update=[];
                    	this.mensaje('Excelente',response.data.mensaje,response.data.tipo);
                        this.limpiar();
                        $("#add_doctor_model").modal("hide");
                        $("#intfile").filestyle('clear');
                        this.readDoctor();
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