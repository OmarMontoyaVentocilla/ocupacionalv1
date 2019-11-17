<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{titulo}}</div>

                    <div class="panel-body">
                        <div v-for="lis in lista">
                           <p>{{lis.descripcion}}</p>
                       </div>
                        
                    </div>
                    <div class="panel-body">
                        {{cadena}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created(){
           console.log("componente creado");
        },
        mounted() {
            console.log('Componente listo');
            this.ver_data();
        },
        props: [
         'message',
         'cadena'
        ],
        data(){
            return {
                'animal':['perro','gatos','cocodrilo'],
                'titulo':"Hola esto es un ejemplo",
                'lista':[]
            }
        },
        methods:{
            ver_data(){
               var data_blade= JSON.parse(this.message);
               this.lista=data_blade.entidades;
               //console.log(this.lista);
            }
        }
    }
</script>
