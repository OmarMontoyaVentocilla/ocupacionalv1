<template>
	
<div class="container-fluid">
  <div class="row">
          <div class="col-lg-6 col-md-4 col-sm-3 col-xs-2">
       <button type="button" id="shows" :class="descripcionColor" v-on:click="mostrar=!mostrar">
        <template v-if="mostrar==false"> <i class="fa fa-plus"></i></template>
        <template v-else><i class="fa fa-times"></i></template>
      </button> 	
         </div>

          <div class="col-lg-3 col-md-4 col-sm-5 col-xs-5">
           <select class="form-control input-sm" v-model="combo" @change="getEditorial()">
                 <option value="">Seleccione</option> 
                 <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
           </select>
          </div>
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
            <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="getEditorial()">
          </div> 
  </div><br>
<template v-if="mostrar">
  <div class="row well agregar_editorial" >
      <div class="col-lg-12">
        <form v-on:submit.prevent="addEditorial()">
          <div class="form-group row">
          <div class="col-lg-4"> 
    <label for="nombre_editorial" class="etiqueta"> Nombre:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('nombre_editorial') }" type="text" id="nombre_editorial" v-model="editorial.nombre_editorial" name="nombre_editorial">
<span  v-show="errors.has('nombre_editorial')" class="help is-danger">{{ errors.first('nombre_editorial') }}</span>
          </div>
          </div>  
           <button type="submit" class="btn btn-primary mb-2" id="envio3">Guardar</button> 
        </form>
      </div>
  </div>
</template>


<modal>
  <h3 slot="header" class="modal-title">{{titulo}}</h3>
   
   <div slot="body">
   <form v-on:submit.prevent="editEditorial(editorial.id)">
     <div class="form-group">
      <label for="nombre_editorial_edit">Nombre:</label>
     <input type="text" class="form-control" id="nombre_editorial_edit" v-model="editorial.nombre_editorial_edit">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"> Cerrar  </button>
   <button type="submit" class="btn btn-primary"> Guardar </button>
   </div>
   </form>
  </div>
</modal>

  <div class="row">
     <div class="panel panel-success">
     <div class="panel-body div1 table-responsive">
    <table class="table table-bordered table-hover table-fixed table-striped" style="background:white;">
         <thead>
           <tr>
            <th v-for="cab in cabecera" >{{cab}}</th>
           </tr>
         </thead>
         <tbody>
         <template v-if="lista!=''">
         <tr v-for="(list,index) in lista">
           <td >{{index+1}}</td>
           <td >{{list.nombre_editorial}}</td>
           <td>
      <button type="button" class="btn btn-info"   v-on:click.prevent="showEditorial(list)"><i class="fa fa-edit"></i> Editar</button>
      <button type="button" class="btn btn-danger" v-on:click.prevent="deleteEditorial(list)"><i class="fa fa-trash"></i> Eliminar</button>
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
       <button class="btn btn-default" v-on:click.prevent="getEditorial()"><i class="fa fa-spinner"></i></button>
      </div>     

     	
</div>
  
</div>

</template>
<script type="text/javascript">

import {Spinner} from 'spin.js';
import swal from 'sweetalert2';
import modal from './EditEditorial';
import spain from 'vee-validate/dist/locale/es';

export default{
   components: {
    modal:modal
   },
   data(){
   	  return{
   	  	 titulo:'Editar Editorial',
   	  	 filter:'',
         combo:'',
         total_registros:'',
         total_reg_busqueda:'',
         cabecera:['#','Nombre Editorial','Acción'],
         editorial: {
     			nombre_editorial:'',
                nombre_editorial_edit:'',
     			      id:''
 		},
 		lista:[],
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
		 error:'',
		 errors_edit: '',
		 mostrar:false
   	  }
   },
   created(){
    //this.loading();
   this.getEditorial();
  
   this.$validator.localize('es', {
      messages: spain.messages,
      attributes: {
        nombre_editorial: 'nombre'
      }
    });

   },
   mounted(){
   },
   methods:{
      getEditorial(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listaredi?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.editorial.data,
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
        this.getEditorial(page);

     },
     showEditorial(info){
       this.editorial.nombre_editorial_edit=info.nombre_editorial;
       this.editorial.id=info.id;
      $('#myModal3').modal('show');
      $('body').css('padding-right','0px');
     },
     editEditorial(info){
      var selfx = this;
      var nombre_editorial_edit = this.editorial.nombre_editorial_edit;
       axios.patch('editorial/' + info, {nombre_editorial_edit:nombre_editorial_edit}).then(response => {  
                selfx.mensaje(response.data.mensaje, 'Excelente', 'success');
                selfx.getEditorial();
                selfx.reset();
                $('#myModal3').modal('hide');
            }, (error) => {
                this.errors_edit = error.response.data;
       });
     },
     filtro(page){
     
     },
     disabl(valor){
        $("#envio3").prop('disabled', valor);
     },
     reset(){
        this.editorial.nombre_editorial='';
        this.editorial.nombre_editorial_edit='';
     },
     addEditorial(){
      var sel_thi=this;
      sel_thi.disabl(true);
      setTimeout(function(){sel_thi.disabl(false); }, 3000);
         let url_p = '/editorial';
            var editorial = this.editorial;
            axios.post(url_p, editorial)
                .then((response) => {
                    this.mensaje(response.data.mensaje, 'Excelente', 'success');
                    this.getEditorial();
                    this.reset();
                }, (error) => {
                    this.error = error.response.data;
                    this.mensaje('Mal','No se completo satisfactoriamente','error');
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
     deleteEditorial(info){
          let url_delete="editorial/"+info.id;
          var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara a "+info.nombre_editorial,
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
                            selfdel.getEditorial();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
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

#wrapper {
  margin-top: 60px;
}

.texto_resultado{
  margin: 28px 0px;
  color: blue;
}

.boton_load{
  margin: 22px 0px;
}

.agregar_editorial{
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