<template>
 <div class="container-fluid">
                 <div class="row" v-if="accion==1">
                <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="form-group">
                           <label for="persona">Empresa</label>
                                <v-select label="razon_social"  :options="listaempresa" v-model="idempresa"></v-select>
                          </div>
                          <div class="form-group">
                    <button type="button" @click.prevent="creatCatalog" class="btn btn-primary" id="envioCatalogo">Grabar</button>
                          </div>
                            
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
                 </div>
                 <div class="row" v-if="accion==1">
                     <div class="panel panel-success">
                                <div class="panel-body div_equipo table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                         <thead>
                                              <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Detalles</th>
                                             </tr>
                                             <tr>
                                                 <td colspan="3"><strong>Exámenes con detalles</strong></td>
                                             </tr>
                                         </thead>
                                         <tbody> 
                                             <tr v-for="(list,index) in listexamsrela">
                                            <template v-if="index%2==0">
                                            <td>{{list.codigo_examen}}</td>
                                            <td>{{list.descripcion_examen}}</td>
                                            </template>
                                            <template v-if="index%2==0"> 
                                            <td>
                                                <table class="table table-bordered table-striped" style="background:white;">
                                                     <thead>
                                                            <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                             <th>Inscribir</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                    <tr v-for="(item) in list.subexamemes">
                                                        <td>{{item.codigo}}</td>
                                                        <td>{{item.descripcion}}</td>
                                    <td><input type="checkbox" v-model="inscrito" v-bind:id="'valor'+item.id" :value="'onx'+item.id"></td>
                                                    </tr>
                                                      </tbody>
                                                </table>
                                            </td>
                                            </template>
                                            <template v-if="index%2!=0">
                                            <td>{{list.codigo_examen}}</td>
                                            <td>{{list.descripcion_examen}}</td>
                                            </template>
                                            <template v-if="index%2!=0">
                                            <td>
                                                <table  class="table table-bordered table-striped" style="background:white;">
                                                      <thead>
                                                            <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                             <th>Inscribir</th>
                                                            </tr>
                                                      </thead>
                                                       <tbody>
                                                    <tr v-for="(item) in list.subexamemes">
                                                        <td>{{item.codigo}}</td>
                                                        <td>{{item.descripcion}}</td>
                                                        <td>
                                                            <input type="checkbox" v-model="inscrito" v-bind:id="'valor'+item.id" :value="'onx'+item.id">
                                                        </td>
                                                    </tr>
                                                         </tbody>
                                                </table>
                                            </td>
                                            </template>
                                            
                                             </tr>
                                             <tr>
                                                 <td colspan="3"><strong>Exámenes sin detalles</strong></td>
                                             </tr>
                                             <tr v-for="(lis,index) in listexamsinrela">
                                                 <td>{{lis.codigo_examen}}</td>
                                                 <td>{{lis.descripcion_examen}}</td>
                                                 <td><a href="/examen" class="">Agregue un detalle porfavor para ser inscrito.</a></td>
                                             </tr>
                                        </tbody>
                                    </table>
                                </div>
                     </div>
                 </div>
                 <div class="row"  v-if="accion==2">
                       <div class="col-md-12">
             <div class="panel panel-default">  
                        <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="readCatalogoEmpresa()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input type="text" class="form-control" placeholder="Buscar" v-model="filter" @keyup="readCatalogoEmpresa()">
                            </div>  
                        </div>            
                    </div>
                        <div class="panel panel-success">
                                <div class="panel-body div_diagnostico table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Empresa</th>
                                            <th>Acción</th>     
                                            </tr>
                                        </thead>    
                                        <tbody>    
                                            <tr v-for="(list, index) in listacatalogos">
                                            <td>{{ list.id}}</td>
                                            <td>{{ list.razon_social}}</td>
                             <td>
                                 <button class="btn btn-info btn-sm" @click.prevent="initcatalogo(list)"> <i class="fa fa-edit"></i></button>
                                 <button class="btn btn-danger btn-sm" @click.prevent="deletecatalogo(list)"> <i class="fa fa-trash"></i></button>
                             </td>
                                   
                                            </tr>
                                        </tbody>
                            </table>
                    </div>
          </div>
          </div>
          </div>
            <div class="modal fade" role="dialog" id="update_catalogo">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Cátalogo por empresa</h4>
                    </div>
                   <div class="modal-body">
                          <div class="panel panel-success">
                                <div class="panel-body div_equipo table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                         <thead>
                                              <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Detalles</th>
                                             </tr>
                                             <tr>
                                                 <td colspan="3"><strong>Exámenes con detalles</strong></td>
                                             </tr>
                                         </thead>
                                         <tbody> 
                                             <tr v-for="(list,index) in listexamsrela">
                                            <template v-if="index%2==0">
                                            <td>{{list.codigo_examen}}</td>
                                            <td>{{list.descripcion_examen}}</td>
                                            </template>
                                            <template v-if="index%2==0"> 
                                            <td>
                                                <table class="table table-bordered table-striped" style="background:white;">
                                                     <thead>
                                                            <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                             <th>Inscribir</th>
                                                            </tr>
                                                      </thead>
                                                      <tbody>
                                                    <tr v-for="(item) in list.subexamemes">
                                                        <td>{{item.codigo}}</td>
                                                        <td>{{item.descripcion}}</td>
                                    <td><input type="checkbox" v-model="inscrito_update" v-bind:id="'valor'+item.id" :value="'onx'+item.id"></td>
                                                    </tr>
                                                      </tbody>
                                                </table>
                                            </td>
                                            </template>
                                            <template v-if="index%2!=0">
                                            <td>{{list.codigo_examen}}</td>
                                            <td>{{list.descripcion_examen}}</td>
                                            </template>
                                            <template v-if="index%2!=0">
                                            <td>
                                                <table  class="table table-bordered table-striped" style="background:white;">
                                                      <thead>
                                                            <tr>
                                                            <th>Código</th>
                                                            <th>Descripción</th>
                                                             <th>Inscribir</th>
                                                            </tr>
                                                      </thead>
                                                       <tbody>
                                                    <tr v-for="(item) in list.subexamemes">
                                                        <td>{{item.codigo}}</td>
                                                        <td>{{item.descripcion}}</td>
                                                        <td>
                                                            <input type="checkbox" v-model="inscrito_update" v-bind:id="'valor'+item.id" :value="'onx'+item.id">
                                                        </td>
                                                    </tr>
                                                         </tbody>
                                                </table>
                                            </td>
                                            </template>
                                            
                                             </tr>
                                        </tbody>
                                    </table>
                                </div>
                     </div>
                   <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click.prevent="updateCatalogue(id_catalogo)" id="">Grabar</button>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>

                 </div>
                    <div class="row" v-if="accion==2">
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
       <button class="btn btn-default" v-on:click.prevent="readCatalogoEmpresa()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div>






  </div>
</template>
<script>
import swal from 'sweetalert2';
import vSelect from 'vue-select';
export default{
    created(){
       this.getCompanyList();
       this.getexamenesrrelacionados();
       this.getexamenesnorelacionados();
       this.readCatalogoEmpresa();
    },
    components: {
        'vSelect':vSelect
    },
    props:['company','accion'],
    data(){
        return{
           listaempresa:[],
           idempresa:{id: "", razon_social: "Seleccione empresa"},
           listexamsrela:[],
           listexamsinrela:[],
           inscrito:[],
           id_catalogo:'',
           inscrito_update:[],
           exams_id_update:[],
           combo:'',
           filter:'',
           listacatalogos:[],
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
           total_registros:'',
           total_reg_busqueda:''
        }
    },
     methods:{
         getCompanyList(){
            this.listaempresa=this.company;
        },
        updateCatalogue(info){
       var inscrito_update= this.inscrito_update;
       var exams_id_update= this.exams_id_update;
    
           var v_checkbox_up=[];
           var v_exam_up=[]; 
           for(let i of this.inscrito_update){
               var respuesta_chec= i.split("x");
               var valor_checkboxup=respuesta_chec[0];
               var valor_examenup=respuesta_chec[1]; 
               v_checkbox_up.push(valor_checkboxup);
               v_exam_up.push(valor_examenup);
          }  
              axios.patch('/catalogo-empresa/' + info, {
                     inscrito_update:inscrito_update,
                     v_checkbox_up:v_checkbox_up,
                     v_exam_up:v_exam_up
                }).then(response=>{
                    this.mensaje('Excelente',response.data.mensaje,'success');
                    $("#update_catalogo").modal("hide");
                     this.readCatalogoEmpresa();
                }).catch(error=>{
                  console.log(error);
                })
        },
        initcatalogo(info){
            this.id_catalogo=info.id;
            var idcatalogox=this.id_catalogo;
            $("#update_catalogo").modal("show");
            var urld='/detallecatalogo';
             axios.get(urld,{ params: { idcatalogox: idcatalogox } })
         .then(response=>{
              var arreglo_incripciones=[];
              var arreglo_exams=[];
              for(let i of response.data){
               arreglo_incripciones.push(i.inscrito);
               arreglo_exams.push(i.examens_id);
              }
              this.inscrito_update=arreglo_incripciones;
              this.exams_id_update=arreglo_exams;
             
         })
           .catch(error=>{
            console.log(error);
         });
        },
        deletecatalogo(info){
           let url_delete="catalogo-empresa/"+info.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminar el catalogo: "+info.razon_social,
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
                            selfdel.readCatalogoEmpresa();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
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
         disabl(valor,id){
              $("#"+id).prop('disabled', valor);
        },
         changePage(page){
            this.pagination.current_page=page;
            this.readCatalogoEmpresa(page);
         },
        creatCatalog(){
           var valor_empresa=this.idempresa.id;
           var inscrito=this.inscrito;
           var v_checkbox=[];
           var v_exam=[]; 
           for(let i of this.inscrito){
               var respuesta_chec= i.split("x");
               var valor_checkbox=respuesta_chec[0];
               var valor_examen=respuesta_chec[1];
           
           v_checkbox.push(valor_checkbox);
           v_exam.push(valor_examen);
           }  
           var sel_thi=this;
           sel_thi.disabl(true,'envioCatalogo');
           setTimeout(function(){sel_thi.disabl(false,'envioCatalogo');}, 3000);
           axios.post('/catalogo-empresa', {
                valor_empresa:valor_empresa,
                inscrito:inscrito,
                v_checkbox:v_checkbox,
                v_exam:v_exam
            })
            .then(response => {
                   if(response.data.tipo=='exito'){
                         this.mensaje('Excelente',response.data.mensaje,'success');
                         this.inscrito='';
                         
                   }else if(response.data.tipo=='mal'){
                         this.mensaje('Alerta!',response.data.mensaje,'error');
                         this.inscrito='';
                   }
                   this.inscrito='';
                   this.readCatalogoEmpresa();
                  
            })
            .catch(error => {
                   console.log(error)
            })   
        },
        getexamenesrrelacionados(){
            let url='/listaralldetexamen';
            axios.get(url,{})
         .then(response=>{
             var data=response.data.lista_examens_relacionados;
             var arreglo=[];
             for(let i of data){

               var id_examen = i.id_examen;
               var codigo_examen = i.codigo_examen;
               var descripcion_examen = i.descripcion_examen;
              
               var res_idex = i.id_subexamen.split("/");
               var res_codigex = i.codigo_subexamen.split("/");
               var res_descripex = i.descripcion_subbexamen.split("/");
               
               var json=[];
               for (var i = 0; i < res_idex.length; i++) {
                json.push({"id":res_idex[i],"codigo":res_codigex[i],"descripcion":res_descripex[i]});
               };

               var lista = {
                   id_examen:id_examen,
                   codigo_examen:codigo_examen, 
                   descripcion_examen:descripcion_examen,
                   subexamemes:json
                };
                arreglo.push(lista);
             }

            this.listexamsrela=arreglo
         })
           .catch(error=>{
            console.log(error);
         });
        },
        getexamenesnorelacionados(){
           let url2='/listaralldetexamen';
            axios.get(url2,{})
         .then(response=>{
             this.listexamsinrela=response.data.lista_examens_sinrelacion;
         })
           .catch(error=>{
            console.log(error);
         });
        },
       readCatalogoEmpresa(page){
            var valor_combo=this.combo;
            var valor_caja=this.filter;  
            var urld='/listarcatalogos?page='+page;
             axios.get(urld,{ params: { valor_combo: valor_combo,valor_caja:valor_caja } })
         .then(response=>{
             var arreglo=[
                this.listacatalogos=response.data.catalogos.data,
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
<style>
.row.fondo_pantalla {
    background: #00a65a;
    color: white;
    height: 40px;
    padding-top: 8px;
    margin-bottom: 10px;
    margin-top: -10px;
}

.row.fondo_pantalla {
    cursor: pointer;
}


</style>