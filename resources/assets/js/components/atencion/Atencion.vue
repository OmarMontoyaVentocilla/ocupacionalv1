<template>
<div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                
                         <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="empresa">Leyenda:</label>   
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="fecha">Fecha </label>
                            <input type="date" class="form-control" id="fecha" v-model="fecha">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                        <label for="hora_inicio"> Hora inicio: </label>
                            <input type="text" class="form-control" id="hora_inicio" v-model="tiempo">
                                </div>
                            </div>
                       </div>
                       <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Servicio: </label>
                                  <select class="form-control input-sm" v-model="servicio">
                                   <option v-for="sel in seleccion_servicio" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                           </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Tipo Formato: </label>
                                  <select class="form-control input-sm" v-model="formato">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in seleccio_formatos" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                </div>
                           </div>
                       </div>
                       <div class="row">
                             <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Empresa: </label>
                                  <select class="form-control input-sm" v-model="idempresa" @change="obtener_data();obtener_protcols()">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in company" :value="sel.id">{{sel.razon_social}}</option>      
                                  </select>
                                  </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Paciente: </label>
                                  <select class="form-control input-sm" v-model="idpaciente">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in paciente" :value="sel.id">{{sel.nombres_total}}</option>      
                                  </select>
                                  </div>
                           </div>
                           
                       </div>
                       <div class="row">
                             <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Subcontrata: </label>
                                  <select class="form-control input-sm" v-model="idsubcontrata">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in company" :value="sel.id">{{sel.razon_social}}</option>      
                                  </select>
                                  </div>
                           </div>
                            
                             <div class="col-lg-6 col-md-6 col-sm-6">
                                   <div class="form-group">
                        <label for="servicio">Tipo de exámen: </label>
                                  <select class="form-control input-sm" v-model="idtipoex"  @change="obtener_protcols()" >
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in examen" :value="sel.id">{{sel.descripcion_ex}}</option>      
                                  </select>
                                  </div>
                           </div>  
                           
                       </div>
                       <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="servicio">Obra: </label>
                                  <select class="form-control input-sm" v-model="idobra">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in lista_obras" :value="sel.id">{{sel.descripcion_obra}}</option>      
                                  </select>
                                  </div>
                           </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="servicio">Perfil: </label>
                                  <select class="form-control input-sm" v-model="idperfil" @change="obtener_protcols()">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in lista_perfiles" :value="sel.id">{{sel.descripcion_perfil}}</option>      
                                  </select>
                                  </div>
                           </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                   <div class="form-group">
                        <label for="servicio">Area: </label>
                                  <select class="form-control input-sm" v-model="idarea">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in lista_area" :value="sel.id">{{sel.descripcion_areas}}</option>      
                                  </select>
                                  </div>
                           </div>
                       </div>
                       <div class="row">
                       <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="form-group">
                        <label for="servicio">Tipo de Orden: </label>
                                  <select class="form-control input-sm" v-model="idorden">
                                   <option value="">Seleccione</option>
                                   <option v-for="sel in seleccion_orden" :value="sel.id">{{sel.nombre}}</option>      
                                  </select>
                                  </div>
                       </div>
                       </div>
                    </div>
                </div>    
            </div>
         </div>
         <div class="row" >
              <div class="panel panel-success">
                                <div class="panel-body div_equipo table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                         <thead>
                                             <tr>
                                                 <th style="background:#00a65a;color:white;" colspan="4">Exámenes</th>
                                             </tr>
                                              <tr>
                                            <th>Código-ID</th>      
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Precios (S/. soles)</th>
                                             </tr>
                                         </thead>
                                         <tbody v-if="lista_precios!=undefined && lista_precios!=''">
                                               <tr v-for="listx in lista_general">
                                              <td>{{listx.id}}</td>     
                                              <td>{{listx.codigo}}</td>
                                              <td>{{listx.descripcion}}</td>
                                              <td>{{listx.precios}}</td>
                                              </tr>
                                              <tr>
                                                <td style="background:#00a65a;color:white;" colspan="3" align="right">SUBTOTAL:</td>
                                                <td><input v-model="subtotal" type="text" :readonly="true"></td>    
                                              </tr>
                                              <tr>
                                                <td style="background:#00a65a;color:white;" colspan="3" align="right">IGV:</td>
                                                <td><input v-model="igv_total" type="text" :readonly="true"></td>    
                                              </tr>
                                              <tr>
                                                <td style="background:#00a65a;color:white;" colspan="3" align="right">TOTAL:</td>
                                                <td><input v-model="total" type="text" :readonly="true"></td>    
                                              </tr>
                                              <tr>
                                                  <td colspan="4">
                                                <button type="button" class="btn btn-primary" id="envioatencion" v-on:click.prevent="createAtencion()">Grabar</button>      
                                                  </td>
                                              </tr>
                                            
                                         </tbody>
                                    </table>
                                </div>
              </div>     
         </div>
         <div class="row">
             <div class="panel panel-success">
                                <div class="panel-body table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;font-size:10.5px;color:black;">
                                  <thead>
                                            <tr>
                                            <th style="background:#00a65a;color:white;" colspan="10">ATENCIONES</th>
                                            </tr>
                                            <tr>
                                            <th>N° H.C</th>      
                                            <th>Fecha</th>
                                            <th>Paciente</th>
                                            <th>Edad</th>
                                            <th>Empresa</th>
                                            <th>Costo sin IGV</th>
                                            <th>Ejecutivo de ventas</th>
                                            <th>Perfil</th>
                                            <th>Tipo de exámen</th>
                                            <th>Acciones</th>
                                            </tr>
                                </thead> 
                                    <tbody>
                                           <tr v-for="(list, index) in lista_atenciones_ord">
                                            <th>{{list.nro_orden}}</th>      
                                            <th>{{list.fecha}}</th>
                                            <th>{{list.nombres_total}}</th>
                                            <th>{{list.edad}}</th>
                                            <th>{{list.razon_social}}</th>
                                            <th>{{list.subtotal}}</th>
                                            <th>{{list.name}}</th>
                                            <th>{{list.descripcion_perfil}}</th>
                                            <th>{{list.descripcion_ex}}</th>
                                            <th>
                                                <button class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                                                <button class="btn btn-danger btn-sm" @click.prevent="deleteordn(list)"><i class="fa fa-trash"></i></button>
                                            </th>
                                           </tr>
                                    </tbody>     
                                    </table>
                                </div>
             </div>    
         </div>
</div>


</template>
<script>
import swal from 'sweetalert2';
import moment from 'moment';
export default{
    mounted() {
        
    },
    props: ['company','paciente','examen'],
    created(){
       this.servicio="1"; 
       this.atenciones_ordenes();
       this.obtener_data(); 
       var fecha= moment().format("YYYY-MM-DD"); 
       this.fecha=fecha;   
      var self = this;  
      setInterval(function(){ 
        self.tiempo_inicio();
       }, 1000);
    },
    data(){
        return{
           seleccion_servicio: [
 		                { id: '1', nombre: 'Ocupacional'}
           ],
           servicio:'',
           lista_area:[],
           lista_atenciones_ord:[],
           lista_perfiles:[],
           lista_obras:[],
           lista_general:[],
           formato:'',
           idorden:'',
           lista_precios:[],
           seleccio_formatos:[
                { id: '1', nombre: '312'},
                { id: '16', nombre: 'Anexo 16'}
           ],
           seleccion_orden:[
                 { id: '1', nombre: 'Atención'},
                 { id: '2', nombre: 'Campaña'}
           ],
           idobra:'',
           idperfil:'',
           idarea:'',
           fecha:'',
           hora_inicio:'',
           idempresa:'',
           idpaciente:'',
           idsubcontrata:'',
           idtipoex:'',
           hour: 0,
           minutes: 0,
           seconds: 0,
        }
    },
    methods: {
         tiempo_inicio(){
          var date = new Date(Date.now());
          this.hour = date.getHours();
          this.minutes = date.getMinutes();
          this.seconds = date.getSeconds();
          this.minute = this.minute > 9? this.minutes: '0' + (this.minutes.toString());
          this.seconds = this.seconds > 9? this.seconds: '0' + (this.seconds.toString());
       },
       deleteordn(info){
                let url_deletex="orden-atencion/"+info.id;
           var selfdel=this; 
                swal({
                   title: 'Estas seguro?',
                   text: "Eliminar la orden: "+info.nro_orden,
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
                       axios.delete(url_deletex).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.atenciones_ordenes();
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
        atenciones_ordenes(){
                 var urldataxxx="listatent";
            axios.get(urldataxxx,{})
                .then(response=>{
                  this.lista_atenciones_ord=response.data;
                })
                .catch(error=>{
                console.log(error);
            });
        },
         disabl(valor,id){
              $("#"+id).prop('disabled', valor);
        },
        createAtencion(){
            let filtros = this.lista_general.filter(x => x.precios >0);
            var arreglo_ids=[];
            var arreglo_precios=[];
            for(var xx of filtros){
                 arreglo_ids.push(xx.id);
                 arreglo_precios.push(xx.precios);
            }

          var servicio=this.servicio;
          var fecha=this.fecha;
          var hora_inicio=this.tiempo;
          var empresa_id=this.idempresa;
          var area_id=this.idarea;
          var profile_id=this.idperfil;
          var id_paciente=this.idpaciente;
          var obra_id=this.idobra;
          var tipoexam_id=this.idtipoex;
          var id_subcontrata=this.idsubcontrata;
          var idformato=this.formato;
          var subtotal=this.subtotal;
          var igv=this.igv_total;
          var idorden=this.idorden; 
          var total=this.total;
          var examenes_vendidos=arreglo_ids.join();
          var examenes_vendidos_precios=arreglo_precios.join();

           var sel_thi=this;
           sel_thi.disabl(true,'envioatencion');
           setTimeout(function(){sel_thi.disabl(false,'envioatencion');}, 3000);
           axios.post('/orden-atencion', {
              servicio:servicio,
              fecha:fecha,
              hora_inicio:hora_inicio,
              empresa_id:empresa_id,
              area_id:area_id,
              profile_id:profile_id,
              obra_id:obra_id,
              idorden:idorden,
              tipoexam_id:tipoexam_id,
              id_subcontrata:id_subcontrata,
              idformato:idformato,
              id_paciente:id_paciente,
              subtotal:subtotal,
              igv:igv,
              total:total,
              examenes_vendidos:examenes_vendidos,
              examenes_vendidos_precios:examenes_vendidos_precios
            })
            .then(response => {
              this.mensaje('Excelente',response.data.mensaje,'success');
              this.atenciones_ordenes();
                  
            })
            .catch(error => {
                   console.log(error)
            })

        },
       obtener_data(){
           var urldata="listadata";
            axios.get(urldata,{ params: { idempresa: this.idempresa }})
                .then(response=>{
                  this.lista_area=response.data.area;
                  this.lista_perfiles=response.data.perfil;
                  this.lista_obras=response.data.obra;
                  
                  
                  for(var i of response.data.formato){
                        this.formato=i.pagina; 
                  }
                 
                })
                .catch(error=>{
                console.log(error);
            });
       },
       obtener_protcols(){
         var url_data="/listarprotocols";
         var id_empresa=this.idempresa;
         var id_perfil=this.idperfil;
         var id_tipoexamen=this.idtipoex; 
    
         var url_dataxx="/listprotempresa";

         var arreglo=[];
         axios.get(url_dataxx,{ params: { id_empresa: id_empresa,id_perfil:id_perfil,id_tipoexamen:id_tipoexamen }})
                .then(response=>{
                     
                     if(id_tipoexamen==1){
                        for(var i of response.data){
                              var array_datos_p=i.datos_preocupacional.split(',').map(Number); 
                              arreglo.push(array_datos_p);
                        }
                     }else if(id_tipoexamen==2){
                        for(var i of response.data){
                              var array_datos_p=i.datos_periodico.split(',').map(Number); 
                              arreglo.push(array_datos_p);
                        }
                
                     }else if(id_tipoexamen==3){
                         for(var i of response.data){
                              var array_datos_p=i.datos_retiro.split(',').map(Number); 
                              arreglo.push(array_datos_p);
                        }

                     }else if(id_tipoexamen==4){
                         for(var i of response.data){
                              var array_datos_p=i.datos_visita.split(',').map(Number); 
                              arreglo.push(array_datos_p);
                        }

                     }else if(id_tipoexamen==5){
                         for(var i of response.data){
                              var array_datos_p=i.datos_reubicacion.split(',').map(Number); 
                              arreglo.push(array_datos_p);
                        }

                     }else{
                         arreglo=[];
                     }
                 
                 var array_d=[];
                 for(var j of arreglo){
                   var xxx= array_d.concat(j);
                   
                 }
                  
                 this.lista_precios=xxx;
                 
                })
                .catch(error=>{
                console.log(error);
            }); 
        
        axios.get(url_data,{ params: { id_empresa: id_empresa }})
                .then(response=>{
                   var arreglo_id=[]; 
                   var arreglo_codigo=[];
                   var arreglo_descripcion=[];
                   var general=[]; 
                  for(var x of response.data.listaprotcolosss){
                    arreglo_id.push(x.id);  
                    arreglo_codigo.push(x.codigo_examen);
                    arreglo_descripcion.push(x.descripcion_examen);
                  }
                 
        
               var jsonx=[];
               for (var i = 0; i < arreglo_codigo.length; i++) {
                jsonx.push({"id":arreglo_id[i],"codigo":arreglo_codigo[i],"descripcion":arreglo_descripcion[i],"precios":this.lista_precios[i]});
               };

               var lista = {
                   exaprecios:jsonx
                };
                console.log(lista);
                var result4222 = lista.exaprecios.filter(x => (x.precios>0 && x.precios!=undefined )); 
                this.lista_general=result4222
                })
                .catch(error=>{
                console.log(error);
            }); 
        

       }
    },
    computed:{
       tiempo(){
          return this.hour+":"+this.minutes+":"+this.seconds;
      },
      subtotal(){
          return this.lista_precios.reduce(function(total, item){
                    return total +  parseFloat(item); 
          },0);
      },
      igv_total(){
        var igv_total= (this.subtotal * 18)/100;
        return  igv_total;   
      },
      total(){
        return this.subtotal + this.igv_total;
      }
    }
}
</script>
<style>

.principal_name.col-lg-12.col-md-12.col-sm-12 {
    background: #222d32;
    color: white;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-top: -10px;
    margin-bottom: 10px;
}
</style>