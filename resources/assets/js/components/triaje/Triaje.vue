<template>
     <div class="container-fluid" >
         <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                           <p><strong>PACIENTE:</strong> {{lista_datos_triaje.nombres_total}}</p>
                          </div> 
                         </div>
                         <div class="row" v-if="atendido_data!='on'">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="sistolica"><strong>Sistólica (mmHg)</strong></label>
                            <input type="text" class="form-control" id="sistolica" v-model="sistolica"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="diastolica"><strong>Diastólica (mmHg)</strong></label>
                            <input type="text" class="form-control" id="diastolica" v-model="diastolica"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="freccardiaca"><strong>F.Cardiaca (min)</strong></label>
                            <input type="text" class="form-control" id="freccardiaca" v-model="freccardiaca"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="frecrespiratoria"><strong>F.Respiratoria (min)</strong></label>
                            <input type="text" class="form-control" id="frecrespiratoria" v-model="frecrespiratoria"> 
                                </div>
                        </div>
                         </div>
                            <div class="row" v-if="atendido_data!='on'">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="stao2"><strong>Sat O2</strong></label>
                            <input type="text" class="form-control" id="stao2" v-model="stao2"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="talla"><strong>Talla (cm)</strong></label>
                            <input type="text" class="form-control" id="talla" v-model="talla"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="peso"><strong>Peso (Kg)</strong></label>
                            <input type="text" class="form-control" id="peso" v-model="peso"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="imc"><strong>IMC</strong></label>
                            <input type="text" class="form-control" id="imc" v-model="medirimc" :style="descriptionStyles"> 
                                </div>
                        </div>
                         </div>
                            <div class="row" v-if="atendido_data!='on'">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="pabdominal"><strong>P.Abdominal (cm)</strong></label>
                            <input type="text" class="form-control" id="pabdominal" v-model="pabdominal"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pte"><strong>PTE (cm)</strong></label>
                            <input type="text" class="form-control" id="pte" v-model="pte"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pti"><strong>PTI (cm)</strong></label>
                            <input type="text" class="form-control" id="pti" v-model="pti"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="temperatura"><strong>Temperatura</strong></label>
                            <input type="text" class="form-control" id="temperatura" v-model="temperatura"> 
                                </div>
                        </div>
                         </div>
                            <div class="row" v-if="atendido_data!='on'">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="cintura"><strong>Cintura (cm)</strong></label>
                            <input type="text" class="form-control" id="cintura" v-model="cintura"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pcadera"><strong>P. Cadera (cm)</strong></label>
                            <input type="text" class="form-control" id="pcadera" v-model="pcadera"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="icc"><strong>ICC</strong></label>
                            <input type="text" class="form-control" id="icc" v-model="mediricc" :style="descriptionicc"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="ptoraxico"><strong>P. Toraxico en reposo (cm)</strong></label>
                            <input type="text" class="form-control" id="ptoraxico" v-model="ptoraxico"> 
                                </div>
                        </div>
                         </div>
                         <div class="row" v-if="atendido_data!='on'">
                             <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                              <button type="button" class="btn btn-primary" @click.prevent="addtriaje()" id="addtriaje">Guardar</button>
                              </div>
                             </div>
                         </div>
                    </div>
                </div>
            </div> 
         </div>

         <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select class="form-control input-sm" v-model="combo" @change="gethistorialxxx()">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>



<div class="modal fade" tabindex="-1" role="dialog" id="update_triaje_model">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                       <h3>Actualizar triaje</h3>
                    </div>
                     <div class="modal-body">
                        <div class="row">
                           <div class="col-lg-12 col-md-12 col-xs-12">
                           <p><strong>PACIENTE:</strong> {{lista_datos_triaje.nombres_total}}</p>
                          </div> 
                         </div>
                         <div class="row" >
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="sistolica"><strong>Sistólica (mmHg)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_sistolica" v-model="triaje_update.sistolica"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="diastolica"><strong>Diastólica (mmHg)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_diastolica" v-model="triaje_update.diastolica"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="freccardiaca"><strong>F.Cardiaca (min)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_fcardiaca" v-model="triaje_update.fcardiaca"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="frecrespiratoria"><strong>F.Respiratoria (min)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_frespiratoria" v-model="triaje_update.frespiratoria"> 
                                </div>
                        </div>
                         </div>
                            <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="stao2"><strong>Sat O2</strong></label>
                            <input type="text" class="form-control" id="triaje_update_sato2" v-model="triaje_update.sato2"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="talla"><strong>Talla (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_talla" v-model="triaje_update.talla"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="peso"><strong>Peso (Kg)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_peso" v-model="triaje_update.peso"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="imc"><strong>IMC</strong></label>
                            <input type="text" class="form-control" id="triaje_update_imc" v-model="medirimc_update" :style="description_updateStyles"> 
                                </div>
                        </div>
                         </div>
                            <div class="row">
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="pabdominal"><strong>P.Abdominal (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_pabdominal" v-model="triaje_update.pabdominal"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pte"><strong>PTE (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_pte" v-model="triaje_update.pte"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pti"><strong>PTI (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_pti" v-model="triaje_update.pti"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="temperatura"><strong>Temperatura</strong></label>
                            <input type="text" class="form-control" id="triaje_update_temperatura" v-model="triaje_update.temperatura"> 
                                </div>
                        </div>
                         </div>
                            <div class="row" >
                        <div class="col-lg-3 col-md-3 col-xs-3">
                               <div class="form-group">
                               <label for="cintura"><strong>Cintura (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_cintura" v-model="triaje_update.cintura"> 
                              </div>   
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="pcadera"><strong>P. Cadera (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_pcadera" v-model="triaje_update.pcadera"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                               <label for="icc"><strong>ICC</strong></label>
                            <input type="text" class="form-control" id="triaje_update_icc" v-model="mediricc_update" :style="descriptionicc_update"> 
                                </div>
                        </div>
                          <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                               <label for="ptoraxico"><strong>P. Toraxico en reposo (cm)</strong></label>
                            <input type="text" class="form-control" id="triaje_update_ptoraxico" v-model="triaje_update.ptoraxico"> 
                                </div>
                        </div>
                         </div>
                         <!-- <div class="row" >  
                            <div class="col-lg-3 col-md-3 col-xs-3">
                            
                            </div>
                         </div> -->
                         <div class="row" >
                             <div class="col-lg-3 col-md-3 col-xs-3">
                                 <div class="form-group">
                              <button type="button" class="btn btn-primary" @click.prevent="update_triaje(triaje_update.id)">Guardar</button>
                              </div>
                             </div>
                         </div>
                    </div>
                </div>    
            </div>
</div>            



         <div class="panel panel-success">
                                <div class="panel-body div_triaje table-responsive">
                                    <table class="table table-bordered table-striped" style="background:white;">
                                        <thead>
                                            <tr>
                                            <th colspan="3">Historial de triaje</th>
                                            </tr>
                                            <tr>
                                            <th>Fecha</th>
                                            <th>Doctor</th>
                                            <th>Accion</th>
                                            </tr>
                                        </thead>    
                                        <tbody>   
                                            <template v-if="lista_historial!=''"> 
                                            <tr v-for="(list, index) in lista_historial">
                                            <td>{{ list.fecha}}</td>
                                            <td>{{ list.name}}</td>
                                            <td>
                <button class="btn btn-info btn-sm" v-on:click.prevent="inittriaje(list)"> <i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" v-on:click.prevent="deletetriaje(list)"> <i class="fa fa-trash"></i></button>
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
</template>
<script>
import swal from 'sweetalert2';
export default{
    created(){
        this.getdatostriaje();
        this.gethistorialxxx();

         for(let yy of this.atendido){
              var atendido=yy.atendido;
             }
    
           this.atendido_data=atendido;
    },
    props:['valor','valor2','atendido'],
    data(){  
          return {
            lista_datos_triaje:[],
            lista_historial:[],
            triaje_update:{
                     id:'',
                     sistolica:'',
                     diastolica:'',
                     fcardiaca:'',
                     frespiratoria:'',
                     sato2:'',
                     talla:'',
                     peso:'',
                     pabdominal:'',
                     pte:'',
                     pti:'',
                     temperatura:'',
                     cintura:'',
                     pcadera:'',
                     ptoraxico:''
            },
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
            combo:'',
            atendido_data:'',
            total_registros:'',
            sistolica:'',
            diastolica:'',
            freccardiaca:'',
            frecrespiratoria:'',
            stao2:'',
            talla:'',
            peso:'',
            edad:'',
            sexo:'',
            imc:'',
            pabdominal:'',
            pte:'',
            pti:'',
            temperatura:'',
            cintura:'',
            pcadera:'',
            icc:'',
            ptoraxico:'',
            
          }
     },
    methods:{
         gethistorialxxx(page){
             var valor_combo=this.combo;
             var idpaciente="";
             for(let x of this.valor2){
                idpaciente=x.id_paciente;
             }

             var urlhistorialtriaje='/getdatostriaj?page='+page;
             axios.get(urlhistorialtriaje,{ params: { valor_combo: valor_combo,idpaciente:idpaciente } })
            .then(response=>{
                console.log(response);
             var arreglo=[
                this.lista_historial=response.data.triaje.data,
                this.pagination=response.data.pagination,
                this.total_registros=response.data.total_registros
                ];
               return arreglo;

         })
           .catch(error=>{
            console.log(error);
         });
               
         },
         inittriaje(info){
             this.triaje_update.sistolica=info.sistolica;
             this.triaje_update.diastolica=info.diastolica;
             this.triaje_update.fcardiaca=info.fcardiaca;
             this.triaje_update.frespiratoria=info.fcrespiratoria;
             this.triaje_update.sato2=info.sto2;
             this.triaje_update.talla=info.talla;
             this.triaje_update.peso=info.peso;
             this.triaje_update.pabdominal=info.pabodminal;
             this.triaje_update.pte=info.pte;
             this.triaje_update.pti=info.pti;
             this.triaje_update.temperatura=info.temperatura;
             this.triaje_update.cintura=info.cintura;
             this.triaje_update.pcadera=info.pcadera;
             this.triaje_update.ptoraxico=info.ptoraxico;
             this.triaje_update.id=info.id;
             $('#update_triaje_model').modal('show');
         },
         update_triaje(info){
              axios.patch('/triaje/' + info, {
                        sistolica:this.triaje_update.sistolica,
                        diastolica:this.triaje_update.diastolica,
                        fcardiaca:this.triaje_update.fcardiaca,
                        frespiratoria:this.triaje_update.frespiratoria,
                        sato2:this.triaje_update.sato2,
                        talla:this.triaje_update.talla,
                        peso:this.triaje_update.peso,
                        pabdominal:this.triaje_update.pabdominal,
                        pte:this.triaje_update.pte,
                        pti:this.triaje_update.pti,
                        temperatura:this.triaje_update.temperatura,
                        cintura:this.triaje_update.cintura,
                        pcadera:this.triaje_update.pcadera,
                        ptoraxico:this.triaje_update.ptoraxico,
                        imc:this.medirimc_update,
                        icc:this.mediricc_update
                }).then(response=>{
                     this.mensaje('Excelente',response.data.message,'success');
                        $("#update_triaje_model").modal("hide");
                        this.gethistorialxxx();
                }).catch(error=>{
                   console.log(error);
                })
         },
         deletetriaje(info){
                let url_deletetri="triaje/"+info.id;
          var selfdel=this;
          swal({
                   title: '¿Estás seguro?',
                   text: "",
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
                       axios.delete(url_deletetri).then(response => {
                            selfdel.mensaje('Excelente',response.data.mensaje,'success');
                            selfdel.gethistorialxxx();
                        })
                        .catch(error => {
                           selfdel.mensaje('Eror','No se elimino','warning');
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {
                       selfdel.mensaje('','Su registro esta a salvo','success');
                    }
            })
         },
         changePage(page){
            this.pagination.current_page=page;
            this.gethistorialxxx(page);
        },
         getdatostriaje(){
            var urltriiaje='/gettriajedat';
            var valor_orden=this.valor; 
             axios.get(urltriiaje,{ params: { valor_orden:valor_orden}})
         .then(response=>{
             this.lista_datos_triaje=response.data[0];
         })
           .catch(error=>{
            console.log(error);
         });
         },
          disabl(valor){
           $("#addtriaje").prop('disabled', valor);
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
          addtriaje(){
            var sel_thi=this;
            sel_thi.disabl(true);
            setTimeout(function(){sel_thi.disabl(false); }, 3000);
            let url_tri = '/triaje';
            axios.post(url_tri,{
                            sistolica:this.sistolica,
                            diastolica:this.diastolica,
                            freccardiaca:this.freccardiaca,
                            frecrespiratoria:this.frecrespiratoria,
                            stao2:this.stao2,
                            talla:this.talla,
                            peso:this.peso,
                            imc:this.medirimc,
                            pabdominal:this.pabdominal,
                            pte:this.pte,
                            pti:this.pti,
                            temperatura:this.temperatura,
                            cintura:this.cintura,
                            pcadera:this.pcadera,
                            icc:this.mediricc,
                            ptoraxico:this.ptoraxico,
                            idcomprobante:this.lista_datos_triaje.id,
                            idpaciente:this.lista_datos_triaje.idpaciente
            })
                .then((response) => {
                    this.mensaje(response.data.mensaje, 'Excelente', 'success');
                    this.gethistorialxxx();
                   
                })
                .catch(error => {
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

      },
      medirimc(){
          var altura = (this.talla)/100;
          var peso= this.peso;
          var respuesta='';
           if(altura!='' && peso!=''){
                respuesta=(peso / (altura*altura)).toFixed(2);
           }else{
                respuesta='';
           }
         
          return respuesta;
       },
       medirimc_update(){
          var altura = (this.triaje_update.talla)/100;
          var peso= this.triaje_update.peso;
          var respuesta='';
           if(altura!='' && peso!=''){
                respuesta=(peso / (altura*altura)).toFixed(2);
           }else{
                respuesta='';
           }
         
          return respuesta;
       },
      mediricc(){
         var cintura=this.cintura;
         var cadera=this.pcadera;
         if(cintura!='' && cadera!=''){
            var resp=(cintura/cadera).toFixed(2);
         }
         return resp; 
      },
      mediricc_update(){
         var cintura=this.triaje_update.cintura;
         var cadera=this.triaje_update.pcadera;
         if(cintura!='' && cadera!=''){
            var resp=(cintura/cadera).toFixed(2);
         }
         return resp; 
      },
      descriptionicc() {
         this.sexo=this.lista_datos_triaje.sexo;
         this.edad=this.lista_datos_triaje.edad;
         if(this.sexo==1){    //mujeres
            if(this.mediricc>=0.85){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else{
                return '';   
            }
         }else if(this.sexo==2){  //hombrees
            if(this.mediricc>=0.94){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else{
                return '';   
            }
         }else{
            return '';       
         }

      },
      descriptionicc_update() {
         this.sexo=this.lista_datos_triaje.sexo;
         this.edad=this.lista_datos_triaje.edad;
         if(this.sexo==1){    //mujeres
            if(this.mediricc_update>=0.85){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else{
                return '';   
            }
         }else if(this.sexo==2){  //hombrees
            if(this.mediricc_update>=0.94){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else{
                return '';   
            }
         }else{
            return '';       
         }

      },
      descriptionStyles() {
            if(this.medirimc > 40){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else if(this.medirimc >= 35 && this.medirimc <= 40){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc >= 30 && this.medirimc <= 34.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc >= 25 && this.medirimc <= 29.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc >= 25 && this.medirimc <= 29.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc >= 18.50 && this.medirimc <= 24.99){
                return '';   
            }else if(this.medirimc >= 17 && this.medirimc <= 18.49){
                return '';   
            }else if(this.medirimc >= 16 && this.medirimc <= 16.99){
                return '';   
            }else if(this.medirimc < 16){
                return '';   
            }   
      },
      description_updateStyles() {
            if(this.medirimc_update > 40){
                return { 'background-color':'red' ,'color': 'white' }; 
            }else if(this.medirimc_update >= 35 && this.medirimc_update <= 40){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc_update >= 30 && this.medirimc_update <= 34.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc_update >= 25 && this.medirimc_update <= 29.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc_update >= 25 && this.medirimc_update <= 29.99){
                return { 'background-color':'red' ,'color': 'white' };   
            }else if(this.medirimc_update >= 18.50 && this.medirimc_update <= 24.99){
                return '';   
            }else if(this.medirimc_update >= 17 && this.medirimc_update <= 18.49){
                return '';   
            }else if(this.medirimc_update >= 16 && this.medirimc_update <= 16.99){
                return '';   
            }else if(this.medirimc_update < 16){
                return '';   
            }   
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

.div_triaje{
     overflow-y:scroll;
     height:400px;
     width:100%;
     background: #ecf0f5;
}

.div_triaje table {
    width:100%;
}


thead {
    background: #379e61f0;
    color: white;
}
</style>