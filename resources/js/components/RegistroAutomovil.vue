<template>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                                                <h3 class="box-title">Registro automovil</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" v-model="search" placeholder="Buscar por Placa"/>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <form action="" v-bind:class="user.tipo=='ADMIN'?'':'hidden'" >
                            <form role="form">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="inicio">Fecha inicio</label>
                                                <input type="date" v-model="date1" class="form-control" id="inicio" placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="fin">Fecha final</label>
                                                <input type="date" v-model="date2" class="form-control" id="fin" placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="actualizar">Consultar</label>
                                                <button type="button" v-on:click="actualizar" id="actualizar" class="btn btn-info" style="margin-bottom: 1em">
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
                                    <th>Fecha  hora</th>
                                    <th>Placa</th>
                                    <th>Nombres  apellidos</th>
                                    <th>Celular</th>
                                    <th>Empresa</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(i,index) in filteredAndSorted" :key="index">
                                    <td>{{moment(i.created_at).format('DD-MM-YY HH:mm:ss')}}</td>
                                    <td>{{i.auto.placa}}</td>
                                    <td>{{i.persona.nombres}} {{i.persona.apellidos}}</td>
                                    <td>{{i.persona.celular}}</td>
                                    <td>{{i.persona.targeta}}</td>
                                    <td>
                                        <template v-if="i.salida==null">
                                            <button v-if="moment(i.created_at).format('YYYY-MM-DD')==moment().format('YYYY-MM-DD')"  @click="observacion(i)" class="btn btn-warning btn-xs"><i class="fa fa-eye-slash"></i> Obs.</button>
                                            <button v-if="moment(i.created_at).format('YYYY-MM-DD')==moment().format('YYYY-MM-DD')"  @click="salida(i,index)" class="btn btn-info btn-xs"><i class="fa fa-trash"></i> Salida</button>
                                        </template>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form role="form" @submit.prevent="guardar">
                    <div class="row" v-if="observaciones.length>0">
                        <div class="col-md-12">
                            <label v-for="i in observaciones" style="display: block" class="label label-warning">En fecha:{{i.created_at|fecha}} Tuvo la observacion de :{{i.observaciones}}</label>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="placa">Placa</label>
                            <input type="text" @keyup="buscarplaca" v-model="placa" class="form-control" id="placa" placeholder="Placa" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tipo">Tipo</label>
                            <input type="text" v-model="auto.tipo" class="form-control" id="tipo" placeholder="Tipo" required>
                        </div>
                        <div class="col-md-4">
                            <label for="uso">Uso</label>
<!--                            <input type="text" v-model="auto.uso" style="text-transform: uppercase" class="form-control" id="uso" placeholder="Nombres" required>-->
                            <select name="uso" id="uso" class="form-control" required v-model="auto.uso">
                                <option value="USO PARTICULAR">USO PARTICULAR</option>
                                <option value="USO DE ADUANA">USO DE ADUANA</option>
                                <option value="USO DEL DAB">USO DEL DAB</option>
                                <option value="OTROS">OTROS</option>

                            </select>
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="ci">CI</label>
                            <input type="text" @keyup="buscar" v-model="ci" class="form-control" id="ci" placeholder="CI" required>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="expedido">Expedido</label>
                            <!--                                <input type="text" class="form-control" id="expedido" placeholder="Expedido">-->
                            <select name="expedido" id="expedido" class="form-control" v-model="dato.expedido" required>
                                <option value="CH">CHUQUISACA</option>
                                <option value="PL">LA PAZ</option>
                                <option value="CB">COCHABAMBA</option>
                                <option value="OR">ORURO</option>
                                <option value="PT">POTOSI</option>
                                <option value="TJ">TARIJA</option>
                                <option value="SC">SANTA CRUZ</option>
                                <option value="BE">BENI</option>
                                <option value="PD">PANDO</option>
                                <option value="OTROS">OTROS</option>
                            </select>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="nacionalidad">Nacionalidad</label>
                            <select name="nacionalidad" id="nacionalidad" class="form-control" v-model="dato.nacionalidad" required>
                                <option value="BOLIVIANA">BOLIVIANA</option>
                                <option value="PERU">PERU</option>
                                <option value="CHILE">CHILE</option>
                                <option value="ARGENTINA">ARGENTINA</option>
                                <option value="VENEZUELA">VENEZUELA</option>
                                <option value="BRAZIL">BRAZIL</option>
                                <option value="OTROS">OTROS</option>
                            </select>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="celular">Celular</label>
                            <input type="text" v-model="dato.celular" class="form-control" id="celular" placeholder="Celular" >
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="nombres">Nombres</label>
                            <input type="text" v-model="dato.nombres" style="text-transform: uppercase" class="form-control" id="nombres" placeholder="Nombres" required>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-4">
                            <!--                            <div class="form-group">-->
                            <label for="apellidos">Apellidos</label>
                            <input type="text" v-model="dato.apellidos" style="text-transform: uppercase" class="form-control" id="apellidos" placeholder="Apellidos" required>
                            <!--                            </div>-->
                        </div>



                        <div class="col-md-12">
                            <!--                            <div class="form-group">-->
                            <label for="motivo">Motivo</label>
                            <textarea type="text" v-model="dato.motivo" style="text-transform: uppercase" class="form-control" id="motivo" placeholder="Motivo" ></textarea>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-6">
                            <!--                            <div class="form-group">-->
                            <label for="destino">Destino</label>
                            <select name="destino" id="destino"  class="form-control" v-model="dato.destino" required>
                                <option v-for="i in destinos" v-bind:value="i.id">{{i.nombre}}</option>
                            </select>
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-6">
                            <!--                            <div class="form-group">-->
                            <label for="targeta">Empresa/Institución</label>
                            <input type="text"  v-model="dato.targeta" style="text-transform: uppercase" class="form-control" id="targeta" placeholder="Empresa/Institución" >
                            <!--                            </div>-->
                        </div>
                        <div class="col-md-6">
                            <label for="objetos">Objetos de valor</label>
                            <textarea type="text" v-model="dato.objetos" style="text-transform: uppercase" class="form-control" id="objetos" placeholder="Objetos"  ></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="observaciones">Observaciones</label>
                            <textarea type="text" v-model="dato.observaciones" style="text-transform: uppercase" class="form-control" id="observaciones" placeholder="Objetos"  ></textarea>
                        </div>
                    </div>
                    <!--                    <div class="box-body">-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label for="exampleInputPassword1">Password</label>-->
                    <!--                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
                    <!--                        </div>-->
                    <!--                        <div class="form-group">-->
                    <!--                            <label for="exampleInputFile">File input</label>-->
                    <!--                            <input type="file" id="exampleInputFile">-->

                    <!--                            <p class="help-block">Example block-level help text here.</p>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" :disabled="!registro" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Registrar Visita</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="modificar">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar observacion</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" @submit.prevent="update">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="name2" class="col-sm-2 control-label">Observacion:</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" v-model="dato.observaciones" class="form-control" id="name2" placeholder="Detallar las observaciones" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                                <button type="submit" class="btn btn-warning" > <i class="fa fa-plus-circle"></i> Modificar </button>
                            </div>
                        </form>
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
        this.misdatos();
        axios.get('/isUser').then(res=>{
            this.user=res.data;
            // console.log(this.user);
        });
        // console.log(this.dato.password);
        axios.get('/destino/1/1').then(res=>{
            this.destinos=res.data;
            // console.log(res.data)
        })

    },
    data:function (){
        return {
            placa:'',
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
            auto:[],
        }
    },
    methods:{
        foto(){
            this.conta++;
            // console.log('a');
            var picture = this.webcam.snap();
            // console.log(picture);
            // this.message=picture;
            if (this.conta==1){
                this.ima1=picture
                this.imagen1 = picture;
            }
            if (this.conta==2){
                this.ima2=picture
                this.imagen2 = picture;
            }
            if (this.conta==3){
                this.ima3=picture
                this.imagen3= picture;
            }
            if (this.conta==4){
                this.ima4=picture;
                this.imagen4 = picture;
                this.conta=0;
            }
        },
        getImage1(event){
            console.log(event.target.files[0]);
            this.imagen1 = event.target.files[0];
        },
        getImage2(event){
            this.imagen2 = event.target.files[0];
        },
        getImage3(event){
            this.imagen3 = event.target.files[0];
        },
        getImage4(event){
            this.imagen4 = event.target.files[0];
        },
        crear(){
            this.dato={tipo:''};
        },
        misdatos(){
            axios.get('/ingresoauto2/'+this.date1+'/'+this.date2).then(res=>{
                this.datos=res.data;
                // console.log(this.datos);
                // this.datatable.clear().draw();
                // let cont=0;
                // this.datos.forEach(r=>{
                //     // console.log(r);
                //     cont++;
                //     this.datatable.row.add([
                //         moment(r.created_at).format('DD-MM-YY HH:mm:ss'),
                //         r.persona.nombres+' '+r.persona.apellidos,
                //         r.id,
                //         r.destino.nombre,
                //         r.targeta==''?'--':r.targeta,
                //     ]).draw(false)
                // })
            });
        },
        guardar(){
            this.registro=false;
            axios.post('/ingresoauto',{
                placa:this.placa,
                tipo:this.auto.tipo,
                uso:this.auto.uso,
                nombres:this.dato.nombres,
                apellidos:this.dato.apellidos,
                ci:this.ci,
                celular:this.dato.celular,
                expedido:this.dato.expedido,
                nacionalidad:this.dato.nacionalidad,
                destino_id:this.dato.destino,
                targeta:this.dato.targeta,
                observaciones:this.dato.observaciones,
            }).then(res=>{
                // console.log(res.data);
                this.misdatos();
                this.auto=[];
                this.dato=[];
                this.registro=true;
                this.$toast.open({
                    message: "Dato creado",
                    type: "success",
                    duration: 3000,
                    dismissible: true
                });
            });
            // axios.get('/persona/'+this.ci).then(res=>{
            //     if (res.data.length>=1){
            //         axios.put('/persona/'+this.dato.id,this.dato).then(res=>{
            //             console.log(res.data);
            //         });
            //         // this.dato=res.data[0];
            //         var data = new  FormData();
            //         // console.log(this.imagen1);
            //         data.append('image1', this.imagen1);
            //         data.append('image2', this.imagen2);
            //         data.append('image3', this.imagen3);
            //         data.append('image4', this.imagen4);
            //         data.append('objetos', this.dato.objetos);
            //         data.append('recinto', this.dato.recinto);
            //         data.append('targeta', this.dato.targeta);
            //         data.append('motivo', this.dato.motivo);
            //         data.append('persona_id', this.dato.id);
            //         data.append('destino_id', this.dato.destino);
            //
            //         axios.post('/asistencia',data).then(res=>{
            //             // console.log(res.data);
            //             // return false;
            //             // this.misdatos();
            //             this.datos.push(res.data[0]);
            //             this.dato={};
            //             this.ci='';
            //             // $('#image1').val('');
            //             // $('#image2').val('');
            //             // $('#image3').val('');
            //             // $('#image4').val('');
            //             this.ima1='';
            //             this.ima2='';
            //             this.ima3='';
            //             this.ima4='';
            //
            //             this.imagen1='';
            //             this.imagen2='';
            //             this.imagen3='';
            //             this.imagen4='';
            //             this.registro=true;
            //             this.$toast.open({
            //                 message: "Guardado Correctamnte",
            //                 type: "success",
            //                 duration: 2000,
            //                 dismissible: true
            //             })
            //         });
            //     }else{
            //         // this.dato={};
            //         // axios.post('/persona',this.dato).then(res=>{
            //         // this.misdatos();
            //         // this.$toast.open({
            //         //     message: "Dato creado",
            //         //     type: "success",
            //         //     duration: 3000,
            //         //     dismissible: true
            //         // });
            //         // this.dato={tipo:''};
            //         // });
            //         // console.log(this.dato);
            //         this.dato.ci=this.ci;
            //
            //
            //
            //         axios.post('/persona',this.dato).then(res=>{
            //             // console.log(res.data);
            //
            //             let persona_id= res.data.id;
            //             var data = new  FormData();
            //             data.append('image1', this.imagen1);
            //             data.append('image2', this.imagen2);
            //             data.append('image3', this.imagen3);
            //             data.append('image4', this.imagen4);
            //             data.append('objetos', this.dato.objetos);
            //             data.append('recinto', this.dato.recinto);
            //             data.append('targeta', this.dato.targeta);
            //             data.append('motivo', this.dato.motivo);
            //             data.append('persona_id', persona_id);
            //             data.append('destino_id', this.dato.destino);
            //             axios.post('/asistencia',data).then(res=>{
            //                 // console.log(res.data);
            //                 this.misdatos();
            //                 this.dato={};
            //                 this.ci='';
            //                 $('#image1').val('');
            //                 $('#image2').val('');
            //                 $('#image3').val('');
            //                 $('#image4').val('');
            //                 this.registro=true;
            //                 this.$toast.open({
            //                     message: "Guardado Correctamnte",
            //                     type: "success",
            //                     duration: 2000,
            //                     dismissible: true
            //                 })
            //             });
            //             // this.misdatos();
            //             // this.$toast.open({
            //             //     message: "Dato creado",
            //             //     type: "success",
            //             //     duration: 3000,
            //             //     dismissible: true
            //             // });
            //             // this.dato={tipo:''};
            //         })
            //     }
            // })

        },
        // actualizar(){
        //     this.misdatos();
        //     this.$toast.open({
        //         message: "Datos Actualizados",
        //         type: "success",
        //         duration: 2000,
        //         dismissible: true
        //     })
        // },
        store(){

        },
        update(){
            axios.put('/ingresoauto/'+this.dato.id,this.dato).then(res=>{
                // console.log(res.data);
                // this.misdatos();
                // const index=this.datos.findIndex(item=>item.id===res.data.id);
                // this.datos[index]=res.data;

                $('#modificar').modal('hide');
                this.$toast.open({
                    message: "Dato modificado",
                    type: "warning",
                    duration: 3000,
                    dismissible: true
                });
                this.dato={tipo:''};
            })
        },
        actualizar(){
            this.misdatos();
            this.$toast.open({
                message: "Datos Actualizados",
                type: "success",
                duration: 2000,
                dismissible: true
            })
        },
        observacion(i){
            $('#modificar').modal('show');
            this.dato=i;
        },
        salida(i,index){
            this.$fire({
                title: 'Seguro de marcar salida??',
                // text: "You won't be able to revert this!",
                type: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si!'
            }).then((r) => {
                if (r.value){
                    axios.get('/ingresoauto/'+i.id).then(res=>{
                        // this.misdatos();
                        this.datos.splice(index,1);
                        // $('#modal-default').modal('hide');
                        this.$toast.open({
                            message: "marcado salida",
                            type:"info",
                            duration: 3000,
                            dismissible: true
                        });
                        this.dato={tipo:''};
                    })
                }
            })
        },
        buscar(){
            if (this.ci!=""){
                axios.get('/persona/'+this.ci).then(res=>{
                    // console.log(res.data);
                    if (res.data.length>=1){
                        this.dato=res.data[0];
                        axios.get('/obs/'+this.dato.id).then(res=>{
                            // console.log(res.data);
                            this.observaciones=res.data;
                        });
                    }else{
                        this.dato={};
                        this.observaciones={};
                    }
                })
            }else{
                this.dato={};
            }
        },
        buscarplaca(){
            if (this.placa!=""){
                axios.get('/personaauto/'+this.placa).then(res=>{
                    console.log(res.data);
                    // if (res.data.length>=1){
                    //     this.auto=res.data[0];
                    //     // console.log(res.data[0].persona);
                    //     this.dato=res.data[0].persona;
                    //     this.ci=res.data[0].persona.ci;
                    //     axios.get('/obs/'+this.dato.id).then(res=>{
                    //         // console.log(res.data);
                            this.observaciones=res.data;
                    //     });
                    // }else{
                    //     this.dato={};
                    //     this.auto={};
                    //     this.observaciones={};
                    //     this.ci='';
                    // }
                })
            }else{
                this.dato={};
                this.auto={};
                this.ci='';
            }
        },
    },
    computed:{
        reg:function (){
            // console.log(this.dato.password);
            if (this.dato.password=='' || this.dato.password==this.dato.password2)
                return false;
            else
                return true;
        },
        filteredAndSorted(){
            // function to compare names
            function compare(a, b) {
                if (a.name < b.name) return -1;
                if (a.name > b.name) return 1;
                return 0;
            }
            return this.datos.filter(user => {
                return user.auto.placa.toLowerCase().includes(this.search.toLowerCase())
            }).sort(compare)
        }
    },
    filters: {
        fecha: function (date) {
            return moment(date).format('DD-MM-YYYY');
        }
    }
}
</script>
