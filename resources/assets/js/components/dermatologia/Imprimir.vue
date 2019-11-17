<template> 
<div class="modal fade" id="imprimirDerma" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <button class="btn btn-primary" v-on:click.prevent="print('cuerpo_derma')">imprimir</button>
          </div>
          <div class="modal-body" id="cuerpo_derma">
            <div style="page-break-after: always;">
                 <h3>NDA #1</h3>
                <img src="img/foto_clinica.png" style="display: block; width: 100%; height: 100%;">
                <p>This project is top secret. You are the only one in the world to ever know about this project 
             (outside of yours truly).</p>
            </div>

            <div style="page-break-after: always;">
                 <h3>NDA #2</h3>
                <p>This project is top secret. You are the only one in the world to ever know about this project 
             (outside of yours truly).</p>
            </div>
            
          </div>
        </div>
      </div>
 </div>    
</template>
<script>
    export default{
        created(){

        },
        methods:{
            print(nombre){
                    var ficha = document.getElementById(nombre);
                    console.log(ficha.innerHTML);
                    var ventimp = window.open();
                    ventimp.document.write( ficha.innerHTML );
                    ventimp.document.close();
                    //ventimp.print();
                    //ventimp.close();
                    setTimeout(function() {
                    ventimp.print();
                    ventimp.close();
                    }, 250);
            }
        }
    }
</script>
<style>
* {
    -webkit-print-color-adjust: exact !important;   /* Chrome, Safari */
     color-adjust: exact !important;                 /*Firefox*/
}

@media print {
 .page-break-after{
     display: block !important;
     
 }
 }
</style>
