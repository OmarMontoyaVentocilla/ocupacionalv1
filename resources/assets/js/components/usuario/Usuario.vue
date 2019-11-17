<template>
   <div class="container-fluid">
       <div class="row">
          <div class="col-lg-6 col-md-4 col-sm-3 col-xs-2">
       <button type="button" id="shows_user" :class="descripcionColor" v-on:click="mostrar=!mostrar">
        <template v-if="mostrar==false"> <i class="fa fa-plus"></i></template>
        <template v-else><i class="fa fa-times"></i></template>
      </button> 	
         </div>

          <div class="col-lg-3 col-md-4 col-sm-5 col-xs-5">
           <select class="form-control input-sm" v-model="combo" @change="getUsers()">
                 <option value="">Seleccione</option>
                 <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
           </select>
          </div>
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
            <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="getUsers()">
          </div> 
  </div><br>
     <template v-if="mostrar">
  <div class="row well agregar_usuario" >
      <div class="col-lg-12">
        <form v-on:submit.prevent="addUser()">
          <div class="form-group row">
          <div class="col-lg-3"> 
    <label for="nombre_usuario" class="etiqueta"> Nombre:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('nombre_usuario') }" type="text" id="nombre_usuario" v-model="usuario.nombre_usuario" name="nombre_usuario">
<span  v-show="errors.has('nombre_usuario')" class="help is-danger">{{ errors.first('nombre_usuario') }}</span>
          </div>

         <div class="col-lg-3"> 
    <label for="nombre_email" class="etiqueta"> Email:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('nombre_email') }" type="email" id="nombre_email" v-model="usuario.nombre_email" name="nombre_email">
<span  v-show="errors.has('nombre_email')" class="help is-danger">{{ errors.first('nombre_email') }}</span>
          </div>

         <div class="col-lg-3"> 
    <label for="nombre_password" class="etiqueta"> Contraseña:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('nombre_password') }" type="password" id="nombre_password" v-model="usuario.nombre_password" name="nombre_password">
<span  v-show="errors.has('nombre_password')" class="help is-danger">{{ errors.first('nombre_password') }}</span>
          </div> 

          <div class="col-lg-3"> 
    <label for="clave_nombre_usuario" class="etiqueta"> Usuario:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('clave_nombre_usuario') }" type="text" id="clave_nombre_usuario" v-model="usuario.clave_nombre_usuario" name="clave_nombre_usuario">
<span  v-show="errors.has('clave_nombre_usuario')" class="help is-danger">{{ errors.first('clave_nombre_usuario') }}</span>
          </div>  

          </div>  
           <button type="submit" class="btn btn-primary mb-2" id="envio_usuario">Guardar</button> 
        </form>
      </div>
  </div>
</template>

       <div class="row">
       <div class="panel panel-success">
     <div class="panel-body div1 table-responsive">
    <table class="table table-bordered table-hover table-fixed table-striped" style="background:white;">
             <thead>
           <tr>
            <th v-for="cab in cabezera" >{{cab}}</th>
           </tr>
         </thead>
         <tbody>
            <template v-if="lista!=''">
              <tr v-for="(list,index) in lista">
                  <td>{{index+1}}</td>
                  <td>{{list.name}}</td> 
                  <td>{{list.username}}</td> 
                  <td>{{list.email}}</td>
                    <td>
      <button type="button" class="btn btn-info"   v-on:click.prevent="showUser(list)"><i class="fa fa-edit"></i> Editar</button>
      <button type="button" class="btn btn-danger" v-on:click.prevent="deleteUser(list)"><i class="fa fa-trash"></i> Eliminar</button>
           </td> 
              </tr>
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

<modal>
  <h3 slot="header" class="modal-title">{{titulo}}</h3>
   
   <div slot="body">
       <form v-on:submit.prevent="editUser(usuario.id)">
        <div class="form-group">
     <label for="nombre_usuario_edit">Nombre:</label>
     <input type="text" class="form-control" id="nombre_usuario_edit" v-model="usuario.nombre_usuario_edit">
        </div>
       <div class="form-group">
     <label for="nombre_email_edit">Email:</label>
     <input type="text" class="form-control" id="nombre_email_edit" v-model="usuario.nombre_email_edit">
        </div>
         <div class="form-group">
     <label for="clave_nombre_usuario_edit">Clave usuario:</label>
     <input type="text" class="form-control" id="clave_nombre_usuario_edit" v-model="usuario.clave_nombre_usuario_edit">
        </div>
        <div class="form-group">
     <label for="actual_password">Introduce tu actual password:</label>
     <input type="password" class="form-control" id="actual_password" name="actual_password" v-model="usuario.actual_password">
        </div>
         <div class="form-group">
     <label for="nuevo_password">Introduce tu nuevo password:</label>
     <input type="password" class="form-control" id="nuevo_password" name="nuevo_password" v-model="usuario.nuevo_password">
        </div>
        <div class="form-group">
     <label for="confirm_password">Confirma tu nuevo password:</label>
     <input type="password" class="form-control" id="confirm_password" name="confirm_password" v-model="usuario.confirm_password">
        </div>
        <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar  </button>
         <button type="submit" class="btn btn-primary"> Guardar </button>
       </div>
       </form>
  </div>
</modal>

      <div class="row">
      <div class="col-lg-8 col-xs-12">
           <nav>
      <ul class="pagination">
        <li v-if="pagination.current_page > 1">
          <a href="#" v-on:click.prevent="changePage(pagination.current_page - 1)">
            <span>Atras</span>
          </a>
        </li>

        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
          <a href="#" v-on:click.prevent="changePage(page)">{{ page }}</a>
        </li>

        <li v-if="pagination.current_page < pagination.last_page">
          <a href="#" v-on:click.prevent="changePage(pagination.current_page + 1)">
            <span>Siguiente</span>
          </a>
        </li>
      </ul>
    </nav>
      </div>
      <div class="col-lg-3 col-xs-8">
       <p class="texto_resultado" v-if="total_registros!=0 && total_reg_busqueda!=0">{{total_reg_busqueda}} de un total de {{total_registros}} registros</p>
      </div>   
       <div class="col-lg-1 col-xs-4 boton_load">
       <button class="btn btn-default" v-on:click.prevent="getUsers()"><i class="fa fa-spinner"></i></button>
      </div>     

     	
</div>
   </div>
</template>

<script type="text/javascript"> 
import modal from './UsuarioEdit';
import swal from 'sweetalert2'; 
import spain from 'vee-validate/dist/locale/es';
export default{

   components: {
    modal:modal
   },
   created(){
      this.getUsers();
      this.$validator.localize('es', {
      messages: spain.messages,
      attributes: {
        nombre_usuario: 'nombre',
        nombre_email:'email',
        nombre_password:'contraseña',
        clave_nombre_usuario:'usuario'
      }
    });
   },
   data(){
   	  return{
           lista:[],
           error:'',
           errors_edit:'',
           filter:'',
           combo:'',
           titulo:'Editar Usuario',
           total_registros:'',
           usuario:{
               nombre_usuario:'',
               clave_nombre_usuario:'',
               clave_nombre_usuario_edit:'',
               nombre_usuario_edit:'',
               nombre_email:'',
               nombre_email_edit:'',
               nombre_password:'',
               nombre_password_edit:'',
               id:'',
               actual_password:'',
               nuevo_password:'',
               confirm_password:''

           },
           total_reg_busqueda:'',
           cabezera:['#','Nombre','Clave usuario','Email','Acción'],
           mostrar:false,
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
       }
   },
   methods:{
       getUsers(page){
        let valor_combo=this.combo;
        let valor_caja=this.filter;   
        let url='/listauser?page='+page;
        axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
        .then(response=>{
            var arreglo=[
                this.lista=response.data.user.data,
                this.pagination=response.data.pagination,
                this.total_reg_busqueda=response.data.total_reg_busqueda,
                this.total_registros=response.data.total_registros
                ];
               return arreglo;
        })
        .catch(error=>{
            console.log(error);
        })
       },
        changePage(page){
        this.pagination.current_page=page;
        this.getUsers(page);
       },
        disabl(valor){
        $("#envio_usuario").prop('disabled', valor);
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
       showUser(info){
       this.usuario.nombre_usuario_edit=info.name;
       this.usuario.nombre_email_edit=info.email;
       this.usuario.clave_nombre_usuario_edit=info.username;
       this.usuario.id=info.id;
       $('#myModal_user').modal('show');
       $('body').css('padding-right','0px');
     },
        editUser(id){
            var selfx = this;
            let nombre_usuario_edit= this.usuario.nombre_usuario_edit;
            let nombre_email_edit= this.usuario.nombre_email_edit;
            let actual_password= this.usuario.actual_password;
            let nuevo_password= this.usuario.nuevo_password;
            let confirm_password= this.usuario.confirm_password;
            let clave_nombre_usuario_edit=this.usuario.clave_nombre_usuario_edit;

       axios.patch('users/' + id, {
           nombre_usuario_edit:nombre_usuario_edit,
           nombre_email_edit:nombre_email_edit,
           actual_password:actual_password,
           nuevo_password:nuevo_password,
           confirm_password:confirm_password,
           clave_nombre_usuario_edit:clave_nombre_usuario_edit
           }).then(response => {  
                selfx.mensaje(response.data.mensaje, 'Excelente', 'success');
                selfx.getUsers();
                selfx.reset();
                $('#myModal_user').modal('hide');
            }, (error) => {
                this.errors_edit = error.response.data;
       });



     },
       deleteUser(info){
           let url_delete_user='/users/'+info.id;
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
                       axios.delete(url_delete_user).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.getUsers();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })  

       },
       reset(){
            this.usuario.nombre_usuario='';
            this.usuario.nombre_usuario_edit='';
            this.usuario.nombre_email='';
            this.usuario.clave_nombre_usuario='';
            this.usuario.clave_nombre_usuario_edit='';
            this.usuario.nombre_email_edit='';
            this.usuario.nombre_password='';
            this.usuario.nombre_password_edit='';
            this.usuario.actual_password='';
            this.usuario.nuevo_password='';
            this.usuario.confirm_password='';
       },
       addUser(){
           var sel_thi=this;
          sel_thi.disabl(true);
      setTimeout(function(){sel_thi.disabl(false); }, 3000);
         let url_p = '/users';
            var usuario = this.usuario;
            axios.post(url_p, usuario)
                .then((response) => {
                    this.mensaje(response.data.mensaje, 'Excelente', 'success');
                    this.getUsers();
                    this.reset();
                }, (error) => {
                    this.error = error.response.data;
                    this.mensaje('Mal','No se completo satisfactoriamente','error');
                });
       }
   },
   computed:{
      isActived(){
       return this.pagination.current_page;
     },
     filterData(){
        var filterKey=this.filter && this.filter.toLowerCase();
        var data=this.lista;
         if(filterKey){
           data=data.filter(
           	   function(item){
             return Object.keys(item).some(
             	 function(key){
                 return String(item[key]).toLowerCase().indexOf(filterKey)>=0
                 }
                 );
               }
             );
         }
         return data;
     },
     descripcionColor(){
             if(this.mostrar==false){
                 return ['btn btn-success'];
             }else{
                 return ['btn btn-danger'];
             }
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

.agregar_usuario{
background-color: rgb(34, 45, 50);
color:red;
transition: all 2s ease;
}

.etiqueta{
  color: white;
}

#shows{
  transition: all 1s ease;
}


.div1{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div1 table {
    width:100%;
}

thead {
    background: #379e61f0;
    color: white;
}


</style>