<template>
	
<div class="container-fluid">
<div class="row">
  <button class="btn btn-primary" @click="test()">Testear</button>
</div><br>
  <div class="row">
          <div class="col-lg-6 col-md-4 col-sm-3 col-xs-2">
       <button type="button" id="shows" :class="descripcionColor" v-on:click="mostrar=!mostrar">
        <template v-if="mostrar==false"> <i class="fa fa-plus"></i></template>
        <template v-else><i class="fa fa-times"></i></template>
      </button> 	
         </div>
 
          <div class="col-lg-3 col-md-4 col-sm-5 col-xs-5">
           <select class="form-control input-sm" v-model="combo" @change="getAutor()">
                 <option value="">Seleccione</option>
                 <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
           </select>
          </div>
           <div class="col-lg-3 col-md-4 col-sm-4 col-xs-5">
            <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="getAutor()">
          </div> 
  </div><br>
<template v-if="mostrar">
  <div class="row well agregar_autor" >
      <div class="col-lg-12">
        <form v-on:submit.prevent="addAutor()">
          <div class="form-group row">
          <div class="col-lg-4"> 
    <label for="nombre_autor" class="etiqueta"> Nombre:</label>
<input v-validate="'required'" :class="{'form-control': true, 'is-danger': errors.has('nombre_autor') }" type="text" id="nombre_autor" v-model="autor.nombre_autor" name="nombre_autor">
<span  v-show="errors.has('nombre_autor')" class="help is-danger">{{ errors.first('nombre_autor') }}</span>
          </div>
          </div>  
           <button type="submit" class="btn btn-primary mb-2" id="envio">Guardar</button> 
        </form>
      </div>
  </div>
</template>


<modal>
  <h3 slot="header" class="modal-title">{{titulo}}</h3>
   
   <div slot="body">
   <form v-on:submit.prevent="editAutor(autor.id)">
     <div class="form-group">
      <label for="nombre_autor_edit">Nombre:</label>
     <input type="text" class="form-control" id="nombre_autor_edit" v-model="autor.nombre_autor_edit">
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
           <td >{{list.nombre_autor}}</td>
           <td>
      <button type="button" class="btn btn-info" v-if="edit==1"  v-on:click.prevent="showAutor(list)"><i class="fa fa-edit"></i> Editar</button>
      <button type="button" class="btn btn-danger" v-if="del==1"  v-on:click.prevent="deleteAutor(list)"><i class="fa fa-trash"></i> Eliminar</button>
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
       <button class="btn btn-default" v-on:click.prevent="getAutor()"><i class="fa fa-spinner"></i></button>
      </div>     

     	
</div>
  
</div>

</template>
<script type="text/javascript">

import swal from 'sweetalert2';
import modal from './EditAutor';
import spain from 'vee-validate/dist/locale/es';

export default{
   components: {
    modal:modal
   },
   props: ['add','edit','del'],
   data(){
   	  return{
   	  	 titulo:'Editar Autor',
   	  	 filter:'',
         combo:'',
         total_registros:'',
         total_reg_busqueda:'',
         cabecera:['#','Nombre autor','Acción'],
         autor: {
     			      nombre_autor:'',
                nombre_autor_edit:'',
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
  
   this.getAutor();
  
   this.$validator.localize('es', {
      messages: spain.messages,
      attributes: {
        nombre_autor: 'nombre'
      }
    });

    //this.$validator.localize('es');
  // var overlay = document.getElementById("overlay");
  // window.addEventListener('load', function(){
  // overlay.style.display = 'none';
//})  
   },
   mounted(){
    
   },
   methods:{
      getAutor(page){
      	 var valor_combo=this.combo;
         var valor_caja=this.filter;
         let url='/listar?page='+page;
         axios.get(url,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.lista=response.data.autor.data,
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
      test(){
        return swal("Agregar: "+ this.add + " Editar: " + this.edit + " Eliminar: " + this.del);     
      },
      changePage(page){
        this.pagination.current_page=page;
        this.getAutor(page);

     },
     showAutor(info){
       this.autor.nombre_autor_edit=info.nombre_autor;
       this.autor.id=info.id;
      $('#myModal').modal('show');
      $('body').css('padding-right','0px');
     },
     editAutor(info){
      var selfx = this;
      var nombre_autor_edit = this.autor.nombre_autor_edit;
       axios.patch('autor/' + info, {nombre_autor_edit:nombre_autor_edit}).then(response => {  
                selfx.mensaje(response.data.mensaje, 'Excelente', 'success');
                selfx.getAutor();
                selfx.reset();
                $('#myModal').modal('hide');
            }, (error) => {
                this.errors_edit = error.response.data;
       });
     },
     filtro(page){
     
     },
     disabl(valor){
        $("#envio").prop('disabled', valor);
     },
     reset(){
        this.autor.nombre_autor='';
        this.autor.nombre_autor_edit='';
     },
     addAutor(){
      var sel_thi=this;
      sel_thi.disabl(true);
      setTimeout(function(){sel_thi.disabl(false); }, 3000);
         let url_p = '/autor';
            var autor = this.autor;
            axios.post(url_p, autor)
                .then((response) => {
                    this.mensaje(response.data.mensaje, 'Excelente', 'success');
                    this.getAutor();
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
     deleteAutor(info){
          let url_delete="autor/"+info.id;
          var selfdel=this;
          swal({
                   title: 'Estas seguro?',
                   text: "Eliminara a "+info.nombre_autor,
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
                            selfdel.getAutor();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
     },
     loading(){

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

.agregar_autor{
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
#shows:active{
  
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
/*button.swal2-cancel.btn.btn-danger {
    margin-right: 7px;
}*/

/*body{
    width: 100%;
  
    overflow-x: hidden;
}*/

/*.spinner{
    width: 80px;
    height: 80px;   
    border: 2px solid #f3f3f3;
    border-top:3px solid #f25a41;
    border-radius: 100%;
    position: absolute;
    top:0;
    bottom:0;
    left:0;
    right: 0;
    margin: auto;
    animation: spin 1s infinite linear;
}

@keyframes spin {
    from{
        transform: rotate(0deg);
    }to{
        transform: rotate(360deg);
    }
}

#overlay{
  height:100%;
  width:100%;
  background:rgba(29, 27, 27, 0.37);
  position:fixed;
  left:0;
  top:0;
 }*/

</style>