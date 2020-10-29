<template>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box">
                    <div class="box-header">
<!--                        <h3 class="box-title">Control de asistencia</h3>-->
                    </div>
                    <div class="box-body">
                        <form action="" v-bind:class="user.tipo=='ADMIN'||user.tipo2=='SUPERVISOR'?'':'hidden'" >
                            <form role="form" @submit.prevent="buscar">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inicio">Carnet de identidad</label>
                                                <input type="text" v-model="search" class="form-control" id="inicio" placeholder="Ingrese carnet de identidad" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="actualizar">Consultar</label>
                                                <button type="submit" id="actualizar" class="btn btn-info" style="margin-bottom: 1em">
                                                    <i class="fa fa-refresh"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </form>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombres  apellidos</th>
                                    <th>Ci</th>
                                    <th>Celular</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(i,index) in datos" :key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{i.nombres}} {{i.apellidos}}</td>
                                    <td>{{i.ci}}</td>
                                    <td>{{i.celular}}</td>
                                    <td>
                                        <button  @click="historial(i)" class="btn btn-warning btn-xs"><i class="fa fa-history"></i> Historia.</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Historial de asistencia </h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example10" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Fecha  hora</th>
                                    <th>Salida</th>
                                    <th>Nombres  apellidos</th>
                                    <th>Objetos</th>
                                    <th>Observaciones</th>
                                    <th>Fotos</th>
                                    <th>Unidad</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(i,index) in historiales" :key="index">
                                    <td>{{moment(i.created_at).format('DD-MM-YY HH:mm:ss')}}</td>
                                    <td>{{i.salida}}</td>
                                    <td>{{i.persona.nombres}} {{i.persona.apellidos}}</td>
                                    <td>{{i.objetos}}</td>
                                    <td>{{i.observaciones}}</td>
                                    <td>
                                        <a v-if="i.image1!=''" target="_blank" v-bind:href="i.image1">
                                            Imagen1
                                        </a>
                                        <a v-if="i.image2!=''" target="_blank" v-bind:href="i.image2">
                                            Imagen2
                                        </a>
                                        <a v-if="i.image3!=''" target="_blank" v-bind:href="i.image3">
                                            Imagen3
                                        </a>
                                        <a v-if="i.image4!=''" target="_blank" v-bind:href="i.image4">
                                            Imagen4
                                        </a>
                                    </td>
                                    <td>
                                        {{i.destino.nombre}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<script>
    import axios from 'axios';
    import moment from "moment"
    export default {
        mounted() {
            // console.log('Component mounted.');
            // $('#example1').DataTable()
            // const webcamElement = document.getElementById('webcam');
            // const click = document.getElementById('click');
            // const canvasElement = document.getElementById('canvas');
            // const snapSoundElement = document.getElementById('snapSound');
            // this.webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
            // this.webcam.start()
            //     .then(result =>{
            //         console.log("webcam started");
            //     })
            //     .catch(err => {
            //         console.log(err);
            //     });
            this.datatable = $('#example1').DataTable({
                "order": [[ 0, "desc" ]],
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'pdf', 'print'
                ]
            });
            // this.misdatos();
            axios.get('/isUser').then(res=>{
                this.user=res.data;
                // console.log(this.user);
            });
            // // console.log(this.dato.password);
            // axios.get('/destino/1/1').then(res=>{
            //     this.destinos=res.data;
            //     // console.log(res.data)
            // })

        },
        data:function (){
            return {
                registro:true,
                boolphoto:false,
                search:'',
                ima1:'',
                ima2:'',
                ima3:'',
                ima4:'',
                conta:0,
                message: 'Hola Vue!',
                webcam : null,
                user:{},
                imagen1 : null,
                imagen2 : null,
                imagen3 : null,
                imagen4 : null,
                datatable:null,
                datos:[],
                destinos:[],
                dato:{},
                ci:'',
                date1:moment().format('YYYY-MM-DD'),
                date2:moment().format('YYYY-MM-DD'),
                observaciones:[],
                moment:moment,
                historiales:[],
            }
        },
        methods:{
            // foto(){
            //     this.conta++;
            //     // console.log('a');
            //     var picture = this.webcam.snap();
            //     // console.log(picture);
            //     // this.message=picture;
            //     if (this.conta==1){
            //         this.ima1=picture
            //         this.imagen1 = picture;
            //     }
            //     if (this.conta==2){
            //         this.ima2=picture
            //         this.imagen2 = picture;
            //     }
            //     if (this.conta==3){
            //         this.ima3=picture
            //         this.imagen3= picture;
            //     }
            //     if (this.conta==4){
            //         this.ima4=picture;
            //         this.imagen4 = picture;
            //         this.conta=0;
            //     }
            // },
            // getImage1(event){
            //     console.log(event.target.files[0]);
            //     this.imagen1 = event.target.files[0];
            // },
            // getImage2(event){
            //     this.imagen2 = event.target.files[0];
            // },
            // getImage3(event){
            //     this.imagen3 = event.target.files[0];
            // },
            // getImage4(event){
            //     this.imagen4 = event.target.files[0];
            // },
            // crear(){
            //     this.dato={tipo:''};
            // },
            // misdatos(){
            //     axios.get('/asistencia2/'+this.date1+'/'+this.date2).then(res=>{
            //         this.datos=res.data;
            //         // console.log(this.datos);
            //         // this.datatable.clear().draw();
            //         // let cont=0;
            //         // this.datos.forEach(r=>{
            //         //     // console.log(r);
            //         //     cont++;
            //         //     this.datatable.row.add([
            //         //         moment(r.created_at).format('DD-MM-YY HH:mm:ss'),
            //         //         r.persona.nombres+' '+r.persona.apellidos,
            //         //         r.id,
            //         //         r.destino.nombre,
            //         //         r.targeta==''?'--':r.targeta,
            //         //     ]).draw(false)
            //         // })
            //     });
            // },
            historial(i){
                axios.get('/buscarasistencia/'+i.id).then(res=>{
                    // console.log(res.data);
                    this.historiales=res.data;
                });

            },
            buscar(){
                this.historiales=[];
                if (this.search!=""){
                    axios.get('/buscar/'+this.search+'/ci').then(res=>{
                        // console.log(res.data);
                        this.datos=res.data;
                        // if (res.data.length>=1){
                        //     this.dato=res.data[0];
                        //     axios.get('/obs/'+this.dato.id).then(res=>{
                        //         // console.log(res.data);
                        //         this.observaciones=res.data;
                        //     });
                        // }else{
                        //     this.dato={};
                        //     this.observaciones={};
                        // }
                    })
                }else{
                    this.datos=[];
                }
            },
        },
        computed:{

        },
        filters: {
            fecha: function (date) {
                return moment(date).format('DD-MM-YYYY');
            }
        }
    }
</script>
