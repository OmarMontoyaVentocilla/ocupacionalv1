<template>
    <div class="container-fluid" >
         <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                           <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>PACIENTE:</strong> {{lista_datos_historias.nombres_total}}</p>
                          </div>
                          <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>FECHA:</strong> {{lista_datos_historias.fecha}}</p>
                          </div>  
                         </div>
                           <div class="row">
                           <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>EDAD:</strong> {{lista_datos_historias.edad}} años</p>
                          </div>
                          <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>SEXO:</strong> {{printsexo(lista_datos_historias.sexo)}}</p>
                          </div>  
                         </div>
                         <div class="row">
                             <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>EMPRESA:</strong> {{lista_datos_historias.razon_social}}</p>
                          </div>
                          <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>CARGO:</strong> {{lista_datos_historias.descripcion_obra}}</p>
                          </div> 
                         </div>
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-6">
                                <label for="doctor"> <strong>DOCTOR:</strong> </label>
                                <select class="form-control input-sm">
                                    <option value="">Seleccione</option> 
                                    <option v-for="sel in doctor" :value="sel.id">{{sel.name}}</option>
                                </select>
                          </div>
                         </div>
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
            this.getdatoshistorias();
     },
     data(){  
          return {
              lista_datos_historias:[]
            
          }
     },
     components: {
   
     },
     props:['valor','valor2','doctor'],
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
         printsexo(info){
                 if(info==1){
                   return "MASCULINO";
                 }else if(info==2){
                   return "FEMENINO";     
                 }
        },
        getdatoshistorias(){
                    var urlhistorias='/gethistoriaocudat';
                    var valor_orden=this.valor; 
                    axios.get(urlhistorias,{ params: { valor_orden:valor_orden}})
                .then(response=>{
                    this.lista_datos_historias=response.data[0];
                })
                .catch(error=>{
                    console.log(error);
                });
         },
     }
    }
</script>
<style>

</style>
