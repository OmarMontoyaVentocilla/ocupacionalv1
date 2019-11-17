<template>
    <div class="container-fluid" >
         <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <div class="row">
                           <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>PACIENTE:</strong> {{lista_datos_dermatologia.nombres_total}}</p>
                          </div>
                          <div class="col-lg-6 col-md-6 col-xs-6">
                           <p><strong>FECHA:</strong> {{lista_datos_dermatologia.fecha}}</p>
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
                          </div><br>   
                          <div class="row">
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <button class="btn btn-primary" v-on:click.prevent="imprimirder()">IMPRIMIR</button>
                            </div>
                            <div class="col-lg-1 col-md-1 col-xs-1">
                              <button class="btn btn-primary">IMPRIMIR SIN LOGO</button>
                            </div>  
                          </div><br>
                         <div class="row">
                             <div class="col-lg-12 col-md-12 col-xs-12">
                                 <ul class="nav nav-tabs">
                                   <li class="active"><a data-toggle="tab" href="#home">Screen Dermatologico</a></li>
                                  <li><a data-toggle="tab" href="#menu1">Evaluacion Dermatologico</a></li>
                                   
                                </ul>
                             </div> 
                         </div>
                         <div class="row">
                              <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                   <div class="row"> 
                                   <div class="col-lg-12 col-md-12 col-xs-12"><br>   
                                   <table class="table table-striped">
                                       <tr>
                                           <td colspan="4" class="estilo_tablita_titulo">I. Para el trabajador (orientado por el médico):</td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"></td>
                                           <td style="padding:3px 3px 3px 3px;"><button type="button" class="btn btn-primary btn-sm">SI</button></td>
                                           <td style="padding:3px 3px 3px 3px;"><button type="button" class="btn btn-primary btn-sm">NO</button></td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>1. Sufre Ud. enfermedades de la piel</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td class="fondoColumna"><p>Si respondió sí, qué diagnóstico tiene?</p></td>
                                           <td><input type="text" class="form-control"></td>
                                           <td colspan="2" class="fondoColumna"></td>
                                           
                                       </tr>
                                        <tr>
                          <td colspan="2"><p>2 Actualmente tiene alguna lesión (ampolla, escamas, rascado) en la piel</p></td>
                                        <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td class="fondoColumna"><p>Si respondió sí, dónde se localiza?</p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                        <tr>
                                           <td class="fondoColumna"><p>Desde cuándo tiene la lesión?</p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>3. Presenta algún cambio de coloración en la piel</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>4. Estas lesiones se repiten varias veces al año</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>5. Ud. tiene enrojecimiento de alguna zona del cuerpo?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td class="fondoColumna"><p>Si respondió sí ¿dónde se localiza? </p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>6 . ¿Tiene comezón o piel seca?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td class="fondoColumna"><p>Si respondió sí ¿dónde se localiza? </p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>7. Presenta hinchazón en parte de su cuerpo</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td class="fondoColumna"><p>Si respondió sí ¿dónde se localiza? </p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>8. ¿Sufre de Rinitis Alérgica o Asma?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>9. ¿Usa EPP?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                           <td class="fondoColumna"><p>Si respondió sí, qué tipo de protección usa</p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>10. ¿Presenta cambios en las uñas?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>11. ¿Está tomando alguna medicación?</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                       <tr>
                                           <td colspan="2"><p>12. Presenta lunares de características anormales:</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                         <tr>
                                           <td class="fondoColumna"><p>Si respondió si, detalle localización:</p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>Asimetría (Una mitad del lunar no coincide con la otra)</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>Borde desigual o irregular</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                           <td colspan="2"><p>Color no uniforme</p></td>
                                           <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                           <td>
                                       <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                           <td class="fondoColumna"><p>Diámetro</p></td>
                                           <td><input type="text" class="form-control"></td>
                                            <td colspan="2" class="fondoColumna"></td>
                                       </tr>
                                       <tr>
                                           <td colspan="4">Describa en caso de tener alguna respuesta positiva:</td>
                                       </tr>
                                       <tr>
                                           <td colspan="4">
                                               <div class="form-group">
                                                    <textarea class="form-control" placeholder="Escriba su respuesta" rows="5" id="comment"></textarea>
                                                </div>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td colspan="4" class="estilo_tablita_titulo">II. Para médicos:</td>
                                       </tr>
                                       <tr>
                                           <td colspan="4">
                                                <table class="table table-striped">
                                                        <tr>
                                                            <td  class="estilo_tablita_titulo">Fototipo</td>
                                                            <td  class="estilo_tablita_titulo">Riesgo a la radiación UV	</td>
                                                            <td  class="estilo_tablita_titulo">FPS (recomendado)</td>
                                                            <td  class="estilo_tablita_titulo">Marcar (x)</td>
                                                        </tr>
                                                         <tr>
                                                            <td  class="">Fototipo: I</td>
                                                            <td  class="">Alto y extremo</td>
                                                            <td  class="">Mínimo 50	</td>
                                                            <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                           <td  class="">Fototipo: II</td>
                                                            <td  class="">Alto y extremo</td>
                                                            <td  class="">Mínimo 50	</td>
                                                            <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td  class="">Fototipo: III</td>
                                                            <td  class="">Moderado</td>
                                                            <td  class="">Mínimo 50	</td>
                                                             <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td  class="">Fototipo: IV</td>
                                                            <td  class="">Moderado</td>
                                                            <td  class="">Mínimo 30	</td>
                                                             <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td  class="">Fototipo: V</td>
                                                            <td  class="">Bajo</td>
                                                            <td  class="">Mínimo 30	</td>
                                                            <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                         <tr>
                                                            <td  class="">Fototipo: VI</td>
                                                            <td  class="">Bajo</td>
                                                            <td  class="">Mínimo 30	</td>
                                                            <td  class=""><div class="radio">
                                                            <label><input type="radio" name="optradio"></label>
                                                             </div>
                                                            </td>
                                                        </tr>
                                                </table>
                                           </td>
                                          
                                       </tr>
                                       <tr>
                                     <td colspan="2" class="fondoColumna">1. ¿El trabajador al examen físico presenta alguna lesión sugerente de Dermatopatía?</td>
                                          <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                        <tr>
                                     <td colspan="2" class="fondoColumna">2. ¿El trabajador necesita ser evaluado por médico dermatólogo para la realización de pruebas ampliatorias?</td>
                                          <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">Si</label>
                                        </div>
                                        </td>
                                        <td>
                                        <div class="radio">
                                                <label><input type="radio" name="optradio">No</label>
                                        </div>
                                        </td>
                                       </tr>
                                         <tr>
                                           <td colspan="4" class="estilo_tablita_titulo">CONCLUSIONES</td>
                                       </tr>
                                        <tr>
                                           <td colspan="4">
                                               <div class="form-group">
                                                    <textarea class="form-control" placeholder="Escriba una conclusion" rows="5" id="comment"></textarea>
                                                </div>
                                           </td>
                                       </tr>
                                  </table>
                                   </div>
                                   </div> 
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                        <div class="row"> 
                                   <div class="col-lg-12 col-md-12 col-xs-12"><br> 
                                        <table class="table table-striped">
                                            <tr>
                                           <td colspan="2" class="estilo_tablita_titulo">LOCALIZACION DE LESIONES:</td>
                                       </tr>  
                                         <tr>
                                           <td class="fondoColumna">CABEZA</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr>
                                        <tr>
                                           <td class="fondoColumna">TRONCO</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr>  
                                        <tr>
                                           <td class="fondoColumna">EXTREMIDADES</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr>
                                         <tr>
                                           <td colspan="2" class="estilo_tablita_titulo">PRUEBAS ESPECIALES:</td>
                                       </tr> 
                                        <tr>
                                           <td><strong>EXAMEN</strong></td>
                                           <td><strong>RESULTADO</strong></td>
                                       </tr> 
                                        <tr>
                                           <td class="fondoColumna">LUZ DE WOOD</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr> 
                                         <tr>
                                           <td class="fondoColumna">NIKOLSKY</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr> 
                                         <tr>
                                           <td class="fondoColumna">DESCRIPCIÓN</td>
                                          <td><input type="text" class="form-control"></td>
                                       </tr>    
                                        </table>
                                   </div>
                                        </div>
                                </div>
                            
                            </div>  
                             </div>      
                         </div>

                    </div>
                </div>
            </div>
        </div>
        <imprmir></imprmir>
        <div class="row">
                 <div class="col-md-12">
                        <button class="btn btn-primary" id="guardarderma">Guardar</button>
                 </div>
        </div>
    </div>
</template>
<script>
import swal from 'sweetalert2';
import imprmir from './Imprimir';
export default{
    created(){
            this.getdatostriaje();
    },
     data(){  
          return {
              lista_datos_dermatologia:[]
            
          }
    },
    components: {
     imprmir:imprmir
    },
    props:['valor','valor2','atendido','doctor'],
    methods:{
            imprimirder(){
               $('#imprimirDerma').modal('show');
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
             getdatostriaje(){
                    var urldermatologia='/getdermadat';
                    var valor_orden=this.valor; 
                    axios.get(urldermatologia,{ params: { valor_orden:valor_orden}})
                .then(response=>{
                    this.lista_datos_dermatologia=response.data[0];
                })
                .catch(error=>{
                    console.log(error);
                });
            },
    },
    computed:{
        
    }
}

</script>
<style scoped>
  .estilo_tablita_titulo{
    background-color: #00a65a;
    color: white;
    padding: 3px 3px 3px 3px;
  }

  .fondoColumna{
    background-color: rgba(84, 82, 71, 0.2);
    color: #000;   
  }
</style>
