<template>
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de asistencia</h3>
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
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Fecha  hora</th>
                                    <th>Nombres  apellidos</th>
                                    <th>Id</th>
                                    <th>Entrada y salida</th>
                                    <th>Tarjeta</th>
                                </tr>
                                </thead>
                                <tbody>
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
                            <label v-for="i in observaciones" class="label label-warning">En fecha:{{i.created_at|fecha}} Tuvo la observacion de :{{i.observaciones}}</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="ci">CI</label>
                                <input type="text" @keyup="buscar" v-model="ci" class="form-control" id="ci" placeholder="CI" required>
<!--                            </div>-->
                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-6">
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
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="celular">Celular</label>
                                <input type="text" v-model="dato.celular" class="form-control" id="celular" placeholder="Celular" >
<!--                            </div>-->
                        </div>
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="nombres">Nombres</label>
                                <input type="text" v-model="dato.nombres" class="form-control" id="nombres" placeholder="Nombres" required>
<!--                            </div>-->
                        </div>
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="apellidos">Apellidos</label>
                                <input type="text" v-model="dato.apellidos" class="form-control" id="apellidos" placeholder="Apellidos" required>
<!--                            </div>-->
                        </div>
                        <div class="col-md-12">
<!--                            <div class="form-group">-->
                                <label for="motivo">Motivo</label>
                                <textarea type="text" v-model="dato.motivo" class="form-control" id="motivo" placeholder="Motivo" ></textarea>
<!--                            </div>-->
                        </div>
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="destino">Destino</label>
                                <select name="destino" id="destino" class="form-control" v-model="dato.destino" required>
                                    <option v-for="i in destinos" v-bind:value="i.id">{{i.nombre}}</option>
                                </select>
<!--                            </div>-->
                        </div>
                        <div class="col-md-6">
<!--                            <div class="form-group">-->
                                <label for="targeta">Empresa/Institución</label>
                                <input type="text"  v-model="dato.targeta" class="form-control" id="targeta" placeholder="Empresa/Institución" >
<!--                            </div>-->
                        </div>
                        <div class="col-md-12">
<!--                            <div class="form-group">-->
                                <label for="objetos">Objetos de valor</label>
                                <textarea type="text" v-model="dato.objetos" class="form-control" id="objetos" placeholder="Objetos"  ></textarea>
<!--                            </div>-->
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
                        <button type="submit" class="btn btn-success btn-block"><i class="fa fa-plus-circle"></i> Registrar Visita</button>
                    </div>
                </form>
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
                user:{},
                datatable:null,
                datos:[],
                destinos:[],
                dato:{},
                ci:'',
                date1:moment().format('YYYY-MM-DD'),
                date2:moment().format('YYYY-MM-DD'),
                observaciones:[],

            }
        },
        methods:{
            crear(){
                this.dato={tipo:''};
            },
            misdatos(){
                axios.get('/asistencia/'+this.date1+'/'+this.date2).then(res=>{
                    this.datos=res.data;
                    // console.log(this.datos);
                    this.datatable.clear().draw();
                    let cont=0;
                    this.datos.forEach(r=>{
                        // console.log(r);
                        cont++;
                        this.datatable.row.add([
                            moment(r.created_at).format('DD-MM-YY HH:mm:ss'),
                            r.persona.nombres+' '+r.persona.apellidos,
                            r.id,
                            r.destino.nombre,
                            r.targeta==''?'--':r.targeta,
                        ]).draw(false)
                    })
                });
            },
            guardar(){
                axios.get('/persona/'+this.ci).then(res=>{
                    // console.log(res.data);
                    if (res.data.length>=1){
                        // this.dato=res.data[0];
                        axios.post('/asistencia',{
                            objetos:this.dato.objetos,
                            recinto:this.dato.recinto,
                            targeta:this.dato.targeta,
                            motivo:this.dato.motivo,
                            persona_id:this.dato.id,
                            destino_id:this.dato.destino
                        }).then(res=>{
                            // console.log(res.data);
                            this.misdatos();
                            this.dato={};
                            this.ci='';
                            this.$toast.open({
                                message: "Guardado Correctamnte",
                                type: "success",
                                duration: 2000,
                                dismissible: true
                            })
                        });
                    }else{
                        // this.dato={};
                        // axios.post('/persona',this.dato).then(res=>{
                            // this.misdatos();
                            // this.$toast.open({
                            //     message: "Dato creado",
                            //     type: "success",
                            //     duration: 3000,
                            //     dismissible: true
                            // });
                            // this.dato={tipo:''};
                        // });
                        // console.log(this.dato);
                        this.dato.ci=this.ci;
                        axios.post('/persona',this.dato).then(res=>{
                            // console.log(res.data);

                            let persona_id= res.data.id;

                            axios.post('/asistencia',{
                                objetos:this.dato.objetos,
                                recinto:this.dato.recinto,
                                targeta:this.dato.targeta,
                                motivo:this.dato.motivo,
                                persona_id:persona_id,
                                destino_id:this.dato.destino
                            }).then(res=>{
                                // console.log(res.data);
                                this.misdatos();
                                this.dato={};
                                this.ci='';
                                this.$toast.open({
                                    message: "Guardado Correctamnte",
                                    type: "success",
                                    duration: 2000,
                                    dismissible: true
                                })
                            });
                            // this.misdatos();
                            // this.$toast.open({
                            //     message: "Dato creado",
                            //     type: "success",
                            //     duration: 3000,
                            //     dismissible: true
                            // });
                            // this.dato={tipo:''};
                        })
                    }
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
        },
        computed:{
            reg:function (){
                // console.log(this.dato.password);
                if (this.dato.password=='' || this.dato.password==this.dato.password2)
                    return false;
                else
                    return true;
            }
        },
        filters: {
            fecha: function (date) {
                return moment(date).format('DD-MM-YYYY');
            }
        }
    }
</script>
