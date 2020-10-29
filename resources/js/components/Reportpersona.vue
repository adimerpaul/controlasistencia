<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Reporte Control de personas</h3>
                    </div>
                    <div class="box-body">
                        <form role="form" v-bind:class="user.tipo=='ADMIN'||user.tipo2=='SUPERVISOR'?'':'hidden'">
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
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Persona</th>
                                    <th>Celular</th>
                                    <th>Hora entrada</th>
                                    <th>Hora salida</th>
                                    <th>Registrado por:</th>
                                    <th>Estado</th>
                                    <th>Pertenencias</th>
                                    <th>Recinto</th>
                                    <th>Observado</th>
                                </tr>
                                </thead>
                                <tbody>
<!--                                <tr v-for="(i,index) in datos" :key="index">-->
<!--                                    <td>{{index+1}}</td>-->
<!--                                    <td>{{i.persona.apellidos}} {{i.persona.nombres}}</td>-->
<!--                                    <td>{{i.persona.celular}}</td>-->
<!--                                    <td>{{i.created_at|fecha}}</td>-->
<!--                                    <td>{{i.salida}}</td>-->
<!--                                    <td>{{i.user.name}}</td>-->
<!--                                    <td><span class="label" v-bind:class="i.estado=='INGRESADO'?'label-success':'label-warning'">{{i.estado}}</span></td>-->
<!--                                    <td>{{i.objetos}}</td>-->
<!--                                    <td>{{i.observaciones}}</td>-->
<!--                                </tr>-->
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
import Vue from "vue";
import moment from "moment";

export default {
    mounted() {
        // console.log('Component mounted.');
        // $('#example1').DataTable()
        // this.datatable = $('#example1').DataTable({});
        this.datatable = $('#example1').DataTable({
            "order": [[ 0, "asc" ]],
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
        });
        // console.log('aa');
        // console.log(this.dato.password);
    },
    data:function (){
        return {
            user:{},
            datatable:null,
            datos:[],
            dato:{tipo:''},
            date1:moment().format('YYYY-MM-DD'),
            date2:moment().format('YYYY-MM-DD'),
            moment:moment,

        }
    },
    methods:{
        // crear(){
        //     this.dato={tipo:''};
        // },
        misdatos(){
            // axios.get('/asistencia').then(res=>{
            //     this.datos=res.data;
            //     console.log(this.datos);
            // });


            axios.get('/asistencia3/'+this.date1+'/'+this.date2).then(res=>{
                this.datos=res.data;
                this.datatable.clear().draw();
                let cont=0;
                this.datos.forEach(r=>{
                    console.log(r);
                    cont++;
                    this.datatable.row.add([
                        cont,
                        r.persona.nombres+' '+r.persona.apellidos,
                        r.persona.celular,
                        moment(r.created_at).format('DD-MM-YY HH:mm:ss'),
                        moment(r.salida).format('DD-MM-YY HH:mm:ss'),
                        // r.salida,
                        r.user.name,
                        r.estado,
                        r.objetos,
                        r.recinto,
                        r.observaciones,
                    ]).draw(false)
                })
            });
        },
        guardar(){
            // axios.post('/persona',this.dato).then(res=>{
            //     this.misdatos();
            //     $('#modal-default').modal('hide');
            //     this.$toast.open({
            //         message: "Dato creado",
            //         type: "success",
            //         duration: 3000,
            //         dismissible: true
            //     });
            //     this.dato={tipo:''};
            // })
        },
        update(){
            axios.put('/asistencia/'+this.dato.id,this.dato).then(res=>{
                console.log(res.data);
                this.misdatos();
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
        salida(i){
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
                    axios.get('/asistencia/'+i.id).then(res=>{
                        this.misdatos();
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
            return moment(date).format('DD-MM-YYYY HH:mm:ss ');
        }
    }
}
</script>
