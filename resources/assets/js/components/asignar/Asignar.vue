<template>
  <div class="container-fluid">
                 <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                             <div class="col-lg-3 col-md-3 col-sm-3">
                                <select class="form-control input-sm" v-model="liuser" @change="listRoles()">
                                    <option value="">Seleccione</option>
                                    <option v-for="sel in lista_user" :value="sel.id">{{sel.name}}</option>  
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                    <button @click.prevent="AddAsignar()" class="btn btn-primary">+ Asignar</button>   
                            </div>

                        </div>
                    </div>
                          <div class="panel panel-success">
                                <div class="panel-body div_asignar table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th colspan="3">Usuario</th>
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                        <template v-if="lista_all!=''">
                                            <tr v-for="(list, index) in lista_all">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ list.name}}</td>
                                            <td>
                                        <button class="btn btn-info btn-sm" @click.prevent="editrole(list)"> <i class="fa fa-edit"></i></button>
                                           </td>
                                            </tr>
                                            <template v-for="list2 in lista_all">
                                            <tr>
                                            <th colspan="3" class="fondo_rol">Rol</th>
                                            </tr>
                                            <tr v-for="(item, index) in list2.roles">
                                            <td>{{ index + 1 }}</td>
                                            <td>{{ item.name}}</td>
                                            <td>
                                            <button class="btn btn-danger btn-sm" @click.prevent="deleterole(item)"> <i class="fa fa-trash"></i></button>
                                            </td>
                                            </tr>
                                            </template>
                                        </template>
                                        <template v-else>
                                            <tr>
                                            <td colspan="3">No hay resultados disponibles</td>
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
         <div class="modal fade" tabindex="-1" role="dialog" id="add_asignar_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Asignar Rol</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                            <label for="descripcion" >Usuario:</label>
                             <select class="form-control input-sm" v-model="usuario">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in lista_user" :value="sel.id">{{sel.name}}</option>
                             </select>
                  </div>
                    <div v-bind:class="{'form-group':true}">
                            <label for="descripcion" >Rol:</label>
                             <select class="form-control input-sm" v-model="rol">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in lista_role" :value="sel.name">{{sel.name}}</option>
                            </select>
                  </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="CreatAsign" class="btn btn-primary" id="envioAsign">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
           <!--
            Modal Edit
        -->
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_asignar_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editar Rol</h4>
                    </div>
                    <div class="modal-body">
                  <div v-bind:class="{'form-group':true}">
                            <div class="checkbox" v-for="item in lista_roles_editar">
                            <label><input type="checkbox" :value="item.name" v-model="roles_arreglo">{{item.name}}</label>
                            </div> 
                  </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click.prevent="EditAsign(liid_edit)" class="btn btn-primary" id="envioAsignedit">Grabar</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
 </template>                   
<script>
import swal from 'sweetalert2';
export default{
     created(){
         this.readListAsign();
         this.listRoles();
     },
     data(){
           return {
            usuario:'',
            rol:'',
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
            error:[],
            lista_roles_editar:[],
            roles_arreglo:[],
            licant:'',
            liuser:'',
            liuser_edit:'',
            lirol_edit_antiguo:'',
            lirol_edit:'',
            liid_edit:'',
            lista_user:[],
            lista_role:[],
            lista_all:[]
           }
     },
    methods:{
        mensaje(titulo,texto,icono){
             swal({
                 type: icono,
                 title: titulo,
                 text: texto,
                 showConfirmButton: false,
                 timer: 1500
              })
       },
       EditAsign(info){
          axios.patch('/asignar-roles/' + info, {
                    roles_arreglo: this.roles_arreglo
                }).then(response=>{
                     this.mensaje('Excelente',response.data.mensaje,'success');
                        $("#edit_asignar_model").modal("hide");
                        this.listRoles();
                }).catch(error=>{
                   this.error_update = error.response.data;
                   if(error.response.status==422){
                        console.clear();
                       }
                })
       },
       editrole(info){
           $("#edit_asignar_model").modal("show");
           $('body').css('padding-right','0px');
           this.lista_roles_editar=info.roles;
           this.liid_edit=info.id;
       },
       deleterole(info){
           var  url_deletex="/asignar-roles/"+info.id;
           var  valor_nombre_rol=info.name;
           var  valor_nombre_username=this.liuser;
           var  selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara al rol: "+valor_nombre_rol,
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
                       axios.delete(url_deletex, { params: { valor_nombre_username: valor_nombre_username,valor_nombre_rol:valor_nombre_rol}}).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.listRoles();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
       },   
       listRoles(){
           var url='listarroles';
           var valor_licant=this.licant;
           var valor_liuser=this.liuser;
        axios.get(url,{ params: { valor_licant: valor_licant,valor_liuser:valor_liuser } })
         .then(response=>{
            this.lista_all=response.data.lista;
         })
           .catch(error=>{
            console.log(error);
         });
       },
       readListAsign(){
        var url='listarall';
        axios.get(url,{})
         .then(response=>{
             var arreglo=[
                this.lista_user=response.data.users,
                this.lista_role=response.data.roles
                ];
               return arreglo;

         })
           .catch(error=>{
            console.log(error);
         });
       },
       CreatAsign(){
               axios.post('/asignar-roles', {
                    usuario: this.usuario,
                    rol: this.rol
                })
                    .then(response => {
                        this.error_update=[];
                        this.listRoles();
                        this.mensaje('Excelente',response.data.mensaje,'success');
                        $("#add_asignar_model").modal("hide");        
                    })
                    .catch(error => {
                        console.log(error);
                    }); 
       }, 
       AddAsignar(){
            this.error = [];
            $("#add_asignar_model").modal("show");
            $('body').css('padding-right','0px');
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

.div_asignar{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_asignar table {
    width:100%;
}


thead, .fondo_rol {
    background: #379e61f0;
    color: white;
}

</style>
