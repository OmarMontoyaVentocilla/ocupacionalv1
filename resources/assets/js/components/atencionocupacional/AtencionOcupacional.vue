<template>
   <div class="container-fluid">
   <div class="row">
                            <div class="principal_name col-lg-12 col-md-12 col-sm-12">
                             <label for="emp44eresa">Busqueda de atenciones:</label>   
                            </div>
</div>    
  <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <div class="form-group">
                        <label for="fecha">Fecha Inicio: </label>
                            <input type="date" class="form-control" id="" v-model="fecha_inicio" @keyup="getordenes()">
         </div>
      </div>
       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
          <div class="form-group">
                        <label for="fecha">Fecha Final: </label>
                            <input type="date" class="form-control" id="" v-model="fecha_final" @keyup="getordenes()">
         </div>
      </div>
       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
            <div class="form-group">
                        <label for="fecha">Código: </label>
                            <input type="text" class="form-control" id="" v-model="codigo" @keyup="getordenes()">
         </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  
        <div class="form-group">
                        <label for="fecha">Apellido Paterno: </label>
                            <input type="text" class="form-control" id="" v-model="nombres" @keyup="getordenes()">
         </div>
           
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  
        <div class="form-group">
                      <label for="servicio">Empresa: </label>
                        <select class="form-control input-sm" v-model="idempreesa" @change="getordenes()">
                            <option value="">Seleccione</option>
                            <option v-for="sel in lista_empresas" :value="sel.id">{{sel.razon_social}}</option>  
                        </select>
         </div>
           
      </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">  
        <div class="form-group">
                      <label for="servicio">Subcontrata: </label>
                                  <select class="form-control input-sm" v-model="idsubcontrata" @change="getordenes()">
                                   <option value="">Seleccione</option>
                            <option v-for="sel in lista_empresas" :value="sel.id">{{sel.razon_social}}</option>             
                                  </select>
         </div>
           
      </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4">
         <label for="servicio">Página: </label>
         <select class="form-control input-sm" v-model="combo" @change="getordenes()">
             <option value="">Seleccione</option> 
             <option v-for="sel in seleccion" :value="sel.id">{{sel.nombre}}</option>
        </select>
    </div>                 
 </div> 
 <br> 
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="panel panel-default">
         <div class="panel panel-success">
      <div id="parent">
			<table id="fixTable" class="table table-bordered table-hover">
				<thead>
					<tr>
                        <th colspan="34" style="background-color:rgb(0, 166, 90); color:white;">LISTA DE ATENCIONES</th>
                    </tr>
                    <tr>
                        <th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Ver exámenes</th> 
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Codigo</th>
                        <th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Paciente</th>
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Fecha</th>
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">H. Inicio</th>
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Empresa</th>
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">Subcontrata</th>
						<th align="center" style="background-color:rgb(0, 166, 90); color:white;font-size:11px;">T. Examen</th>  
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Diagn</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Triaje</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Antec</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">HOcu</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Medic</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Neuro</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Derma</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Exam 7D</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Altura</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Exam EKG</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Oftalm</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Audio</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Psico</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Odont</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Musc</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Radio</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Ecogr</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Espiro</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">S. Respi</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Sens</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Labor</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Docu</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Interc</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">C.Nor</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Imprim</th>
                        <th align="center" style="background-color:rgb(34, 45, 50); color:white;">Imprim S.F</th>
					</tr>
				</thead>
				<tbody>
                        <tr v-for="(list, index) in lista_ordenes">
                        <td style="font-size:11px;"><button class="btn btn-default btn-sm" :id="'boton'+list.id" v-on:click.prevent="examnes_vend(list.examenes_vendidos,list.id)">Ver</button></td>     
                        <td style="font-size:11px;">{{list.nro_orden}}</td>
                        <td style="font-size:11px;">{{list.nombres_total}}</td>
                        <td style="font-size:11px;">{{list.fecha}}</td>
                        <td style="font-size:11px;">{{list.hora_inicio}}</td>
                        <td style="font-size:11px;">{{list.razon_social}}</td>
                        <td style="font-size:11px;">{{nombresubcontrata(list.id_subcontrata)}}</td>
                        <td style="font-size:11px;">{{list.descripcion_ex}}</td>
						<td>
                            
        <a target="_blank"  v-bind:id="area_medicina+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/diag.png`" class="img-responsive" height="20" width="20">
        </a>
                       </td>
						<td>
        <a target="_blank" v-bind:id="area_medicina+'-'+list.id+'w'" class="btn btn-default" :href="'/triaje/'+ list.id" style="display:none;"> 
            <img :src="`img/ocupacional/tri.jpg`" class="img-responsive" height="20" width="20">
        </a>
                       </td>
						<td>
        <a target="_blank" v-bind:id="area_medicina+'-'+list.id+'x'" class="btn btn-default" :href="'/antecedentes/'+ list.id" style="display:none;">
            <img :src="`img/ocupacional/ante.png`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_medicina+'-'+list.id+'y'" class="btn btn-default" :href="'/historia/'+ list.id" style="display:none;">
            <img :src="`img/ocupacional/ho.png`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_medicina+'-'+list.id+'z'" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/med.gif`" class="img-responsive" height="20" width="20">
        </a>                    
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_neurologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/neuro.png`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
                        <td>
        <a target="_blank" v-bind:id="area_dermatologia+'-'+list.id" class="btn btn-default" :href="'/dermatologia/'+ list.id" style="display:none;">
            <img :src="`img/ocupacional/piel.png`" class="img-responsive" height="20" width="20">
        </a>                    
    
                        </td>
						<td>
         <a target="_blank" v-bind:id="area_examen7d+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/7d.jpg`" class="img-responsive" height="20" width="20">
        </a>                    
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_examenestructural+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/altuestruc.png`" class="img-responsive" height="20" width="20">
        </a>
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_cardiologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/ekg.png`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_oftalmologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/oft.png`" class="img-responsive" height="20" width="20">
        </a>                    
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_audiometria+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/audio.png`" class="img-responsive" height="20" width="20">
        </a>                     
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_psicologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/psicolo.jpg`" class="img-responsive" height="20" width="20">
        </a>                     
                        </td>
                        <td>
         <a target="_blank" v-bind:id="area_odontologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/odonto.png`" class="img-responsive" height="20" width="20">
        </a>                     
                        </td>
						<td>
         <a target="_blank" v-bind:id="area_musculoesqueletico+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/musculo.jpg`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
          <a target="_blank" v-bind:id="area_radiologia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/rx.jpg`" class="img-responsive" height="20" width="20">
        </a>                  
                        </td>
						<td>
           <a target="_blank" v-bind:id="area_ecografia+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/eco.png`" class="img-responsive" height="20" width="20">
        </a>                     
                        </td>
						<td>
            <a target="_blank" v-bind:id="area_espirometria+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/ESPIROMETRIA.jpg`" class="img-responsive" height="20" width="20" >
        </a>                  
                        </td>
						<td>
           <a target="_blank" v-bind:id="area_sistemarespiratorio+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/sresp.jpg`" class="img-responsive" height="20" width="20">
        </a>                    
                        </td>
						<td>
             <a target="_blank" v-bind:id="area_psicosensometrica+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/psicosensome.png`" class="img-responsive" height="20" width="20">
        </a>                 
                        </td>
                        <td>
            <a target="_blank" v-bind:id="area_examenlaboratorio+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/lab.png`" class="img-responsive" height="20" width="20">
        </a> 
                       </td>
						<td>
        <a target="_blank" v-bind:id="area_documentos+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/doc.png`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
        <a target="_blank" v-bind:id="area_interconsulta+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/inter.png`" class="img-responsive" height="20" width="20">
        </a>                     
                        </td>
						<td>
         <a target="_blank" v-bind:id="arra_cuestionarionordico+'-'+list.id" class="btn btn-default" href="#" style="display:none;">
            <img :src="`img/ocupacional/cnordi.jpg`" class="img-responsive" height="20" width="20">
        </a>                   
                        </td>
						<td>
          <a  class="btn btn-default" href="#">
            <img :src="`img/ocupacional/imprimir.gif`" class="img-responsive" height="20" width="20">
        </a>                  
                        </td>
						<td>
         <a class="btn btn-default" href="#">
            <img :src="`img/ocupacional/imprimirbn.gif`" class="img-responsive" height="20" width="20">
        </a>                    
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
      <!-- <div class="col-lg-3 col-xs-8">
       <p class="texto_resultado" v-if="total_registros!=0 && total_reg_busqueda!=0">{{total_reg_busqueda}} de un total de {{total_registros}} registros</p>
      </div>    -->
      <div class="col-lg-3 col-xs-8"></div>
       <div class="col-lg-1 col-xs-4 boton_load">
       <button class="btn btn-default" v-on:click.prevent="getordenes()"><i class="fa fa-spinner"></i></button>
      </div>  

        </div> 
<div class="row">
  <div class="col-lg-4"></div>  
  <div class="col-lg-4">
      <table class="table table-bordered">
          <tbody>
              <td><strong>LEYENDA:</strong></td>
              <td class="atendido">&nbsp;</td>
              <td class="letra">&nbsp;Atendidos</td>
              <td class="revisado">&nbsp;</td>
              <td class="letra">&nbsp;Revisado</td>
              <td class="auditado">&nbsp;</td>
              <td class="letra">&nbsp;Auditado</td>
          </tbody>
      </table>
  </div>
  <div class="col-lg-4"></div>  
</div>
   </div>

   
</template>
<script>
import moment from 'moment';
import tableHeadFixer from './tableHeadFixer.js';
export default {
    mounted() {
      $("#fixTable").tableHeadFixer({"head" : false, "left" : 1}); 
    
    },
    created() {
          this.obtener_empresas();
          var fecha= moment().format("YYYY-MM-DD"); 
          this.fecha_inicio=fecha;
          this.fecha_final=fecha;  
          this.getordenes();
    },
    data(){
        return {
          fecha_inicio:'',
          fecha_final:'',
          lista_empresas:[],
          lista_ordenes:[],
          idempreesa:'',
          triaje_atendido:'',
          idsubcontrata:'',
          lista_exavendidos:[],
          nombres:'',
          id:'',
          pagination:{
 		           'total'        :0,
 		           'current_page' :0,
 		           'per_page'     :0,
 		           'last_page'    :0,
 		           'from'         :0,
 		           'to'           :0,
             },
         combo:'',
         filter:'',
         codigo:'',
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
         total_reg_busqueda:'',
         area_medicina:1,
         area_medicina2:1,
         area_medicina3:1,
         area_medicina4:1,
         area_musculoesqueletico:2,
         area_psicologia:3,
         area_oftalmologia:4,
         area_audiometria:5,
         area_espirometria:6,
         area_radiologia:7,
         area_cardiologia:8,
         area_odontologia:9,
         area_examenlaboratorio:10,
         area_documentos:11,
         arra_cuestionarionordico:12,
         area_neurologia:13,
         area_interconsulta:16,
         area_dermatologia:14,
         area_psicosensometrica:15,
         area_examen7d:17,
         area_examenestructural:18,
         area_ecografia:19,
         area_sistemarespiratorio:20
        }
    },
    methods:{
        changePage(page){
            this.pagination.current_page=page;
            this.getordenes(page);
         },
         examnes_vend(info,id){
             this.id=id; 
            var array_ex= info.split(',').map(Number);
             var urlconsulta="lisareasocupacionale";
             var arreglo_xxx=[];
             var sinduplicados = [];


            var urlatenciones="lisatenciones";
            var triaje_atendido="";
            axios.get(urlatenciones,{params: {id:id}}) 
            .then(response=>{ 
               if(response.data.triaje!=''){
                  triaje_atendido=response.data.triaje[0].atendido;
               }else{
                   console.log("vacio");
               }
                
            })
            .catch(error=>{
                console.log(error);
            }); 


             axios.get(urlconsulta,{params: {array_ex:array_ex}})
                .then(response=>{
                    for(let i of response.data){
                       for(let x of i){
                          arreglo_xxx.push(x.exams_id);  
                       }
                    }
                  var sinduplicados = arreglo_xxx.filter(function(elem, pos) {
                        return arreglo_xxx.indexOf(elem) == pos;
                  });  

        
                   
                    var xarea_medicina=1;
                    var xarea_musculoesqueletico=2;
                    var xarea_psicologia=3;
                    var xarea_oftalmologia=4;
                    var xarea_audiometria=5;
                    var xarea_espirometria=6;
                    var xarea_radiologia=7;
                    var xarea_cardiologia=8;
                    var xarea_odontologia=9;
                    var xarea_examenlaboratorio=10;
                    var xarea_documentos=11;
                    var xarra_cuestionarionordico=12;
                    var xarea_neurologia=13;
                    var xarea_interconsulta=16;
                    var xarea_dermatologia=14;
                    var xarea_psicosensometrica=15;
                    var xarea_examen7d=17;
                    var xarea_examenestructural=18;
                    var xarea_ecografia=19;
                    var xarea_sistemarespiratorio=20;

                  for(let y of sinduplicados){
                         if(xarea_medicina==y){

                               var id_med=String(this.area_medicina+'-'+id);   //diagnostico
                               var id_med2=String(this.area_medicina+'-'+id+'w');  //triaje 
                               var id_med3=String(this.area_medicina+'-'+id+'x'); //antecedentes
                               var id_med4=String(this.area_medicina+'-'+id+'y');  //hocupacional
                               var id_med5=String(this.area_medicina+'-'+id+'z');  //medicna
                               $("#"+id_med).css("display","block");
                               $("#"+id_med2).css("display","block");
                               if(triaje_atendido=='on'){
                                   $("#"+id_med2).css("background-color","#F7FE2E");
                               }

                               $("#"+id_med3).css("display","block");
                               $("#"+id_med4).css("display","block");
                               $("#"+id_med5).css("display","block");

                         }else if(xarea_musculoesqueletico==y){
                             var id_muscu=String(this.area_musculoesqueletico+'-'+id);
                             $("#"+id_muscu).css("display","block");
                          
                         }else if(xarea_psicologia==y){
                              var id_muscu=String(this.area_psicologia+'-'+id);
                             $("#"+id_muscu).css("display","block");
                            
                         }else if(xarea_oftalmologia==y){
                               var id_oftalm=String(this.area_oftalmologia+'-'+id);
                               $("#"+id_oftalm).css("display","block");
                             
                         }else if(xarea_audiometria==y){
                                 var id_audiome=String(this.area_audiometria+'-'+id);
                               $("#"+id_audiome).css("display","block");
                            
                         }else if(xarea_espirometria==y){
                               var id_espiro=String(this.area_espirometria+'-'+id);
                               $("#"+id_espiro).css("display","block");
                               
                         }else if(xarea_radiologia==y){
                               var id_radiolo=String(this.area_radiologia+'-'+id);
                               $("#"+id_radiolo).css("display","block");
                             
                         }else if(xarea_cardiologia==y){
                        
                             var id_cardiolo=String(this.area_cardiologia+'-'+id);
                               $("#"+id_cardiolo).css("display","block");
                          
                         }else if(xarea_odontologia==y){

                             var id_odontol=String(this.area_odontologia+'-'+id);
                               $("#"+id_odontol).css("display","block");
                         
                         }else if(xarea_examenlaboratorio==y){
                           

                              var id_laboratorio=String(this.area_examenlaboratorio+'-'+id);
                               $("#"+id_laboratorio).css("display","block");
                           
                         }else if(xarea_documentos==y){
                        
                              var id_document=String(this.area_documento+'-'+id);
                               $("#"+id_document).css("display","block");
                            
                         }else if(xarra_cuestionarionordico==y){
                                var id_cuestiona=String(this.arra_cuestionarionordico+'-'+id);
                                $("#"+id_cuestiona).css("display","block");
                            
                         }else if(xarea_neurologia==y){
                        
                               var id_neurolo=String(this.area_neurologia+'-'+id);
                                $("#"+id_neurolo).css("display","block");
                        
                         }else if(xarea_interconsulta==y){
                         
                               var id_interconsul=String(this.area_interconsulta+'-'+id);
                                $("#"+id_interconsul).css("display","block");
                        
                         }else if(xarea_dermatologia==y){
                                
                                 var id_dermatol=String(this.area_dermatologia+'-'+id);
                                $("#"+id_dermatol).css("display","block");
                                
                         }else if(xarea_psicosensometrica==y){
                        
                                var id_psiconse=String(this.area_psicosensometrica+'-'+id);
                                $("#"+id_psiconse).css("display","block");
                           
                         }else if(xarea_examen7d==y){
                        
                                var id_ex7d=String(this.area_examen7d+'-'+id);
                                $("#"+id_ex7d).css("display","block");
                       
                         }else if(xarea_examenestructural==y){
                                var id_exestruct=String(this.area_examenestructural+'-'+id);
                                $("#"+id_exestruct).css("display","block");
                           
                         }else if(xarea_ecografia==y){
                              
                                var id_ecograf=String(this.area_ecografia+'-'+id);
                                $("#"+id_ecograf).css("display","block");
                           
                         }else if(xarea_sistemarespiratorio==y){

                                 var id_sistresp=String(this.area_sistemarespiratorio+'-'+id);
                                $("#"+id_sistresp).css("display","block");
                           
                         }else{
                             console.log("-------");
                         }
                  }

                })
                .catch(error=>{
                console.log(error);
            }); 
         },
        obtener_empresas(){
               var urlempresa="getdata";
            axios.get(urlempresa,{})
                .then(response=>{
                  this.lista_empresas=response.data.company.data;
                })
                .catch(error=>{
                console.log(error);
            });
        },
        nombresubcontrata(id_subcontrata){  
            var respuesta=[];
              for(let i of this.lista_empresas){
                     if(id_subcontrata==i.id){
                          respuesta.push(i.razon_social);
                     }else{
                         respuesta.push("mal");
                     }
                   
              }
              var found = respuesta.find(function(element) {
                    return element != 'mal';
              });
              
              if(found==null){
               return "No hay subcontrata"; 
              }else{
                return found;  
              }
         },
        getordenes(page){
            var urlempresa='/listarordenes?page='+page;  
            var valor_combo=this.combo;
            var valor_nombre=this.nombres;
            var valor_codigo=this.codigo;
            var valor_idempresa=this.idempreesa;
            var valor_idsubcontrata=this.idsubcontrata;
            var valor_fecha=this.fecha_inicio;
            var valor_fechafinal=this.fecha_final;
            axios.get(urlempresa,{params: { valor_combo: valor_combo,valor_nombre:valor_nombre,
            valor_codigo:valor_codigo,valor_idempresa:valor_idempresa,valor_idsubcontrata:valor_idsubcontrata,
            valor_fecha:valor_fecha,valor_fechafinal:valor_fechafinal } })
                .then(response=>{
                   
                  this.lista_ordenes=response.data.atenciones.data;
                  this.pagination=response.data.pagination;
                  this.total_reg_busqueda=response.data.total_reg_busqueda;
                  this.total_registros=response.data.total_registros;
              
                })
                .catch(error=>{
                console.log(error);
            });
        }
    },
    computed:{
         isActived(){
              return this.pagination.current_page;
         },
        //  valorcelda(){
        //      return  this.area_medicina+"-"+this.id;  
        //  },
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
#parent {
height: 312px;
}
			
#fixTable {
width: 1800px !important;
border-collapse: collapse;
}

.atendido{
   background-color: #F7FE2E;
   width: 30px;
}
.revisado{
  background-color: #FAAB76;
  width: 30px;  
}
.auditado{
 background-color: #00CC00;
 width: 30px;
}

.letra{
    width: 85px;
}
.principal_name{
    background: #222d32;
    color: white;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-top: -10px;
    margin-bottom: 10px;
}
</style>

