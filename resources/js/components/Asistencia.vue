<template>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div>
                    <div class="box-body">
                        <button type="button"  @click="crear" class="btn btn-primary" style="margin-bottom: 1em" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-user"></i> Crear persona
                        </button>
                        <button type="button" v-on:click="actualizar" class="btn btn-info" style="margin-bottom: 1em">
                            <i class="fa fa-refresh"></i>
                        </button>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Crear</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" @submit.prevent="guardar()">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label">Nombre completo</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.nombre" class="form-control" id="name" placeholder="Nombre" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular" class="col-sm-2 control-label">Celular</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.celular" class="form-control" id="celular" placeholder="Celular" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-2 control-label">CI</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.ci" class="form-control" id="inputEmail3" placeholder="CI" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> <i class="fa fa-trash"></i> Cancelar</button>
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-plus-circle"></i> Guardar </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="modificar">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">modificar</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" @submit.prevent="update">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <label for="name2" class="col-sm-2 control-label">Nombre completo</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.nombre" class="form-control" id="name2" placeholder="Nombre" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="celular2" class="col-sm-2 control-label">Celular</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.celular" class="form-control" id="celular2" placeholder="Celular" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail32" class="col-sm-2 control-label">CI</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" v-model="dato.ci" class="form-control" id="inputEmail32" placeholder="Ci" required>
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
                                    <th>Fecha hora</th>
                                    <th>Persona</th>
                                    <th>Objetos</th>
                                    <th>Observacion</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(i,index) in datos" :key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{i.created_at}}</td>
                                    <td>{{i.persona.nombre}}</td>
                                    <td>{{i.objetos}}</td>
                                    <td>{{i.observaciones}}</td>
                                    <td>
                                        <button @click="modificar(i)" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button>
                                        <button @click="eliminar(i)" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
    import Vue from "vue";

    export default {
        mounted() {
            // console.log('Component mounted.');
            // $('#example1').DataTable()
            // this.datatable = $('#example1').DataTable({});
            this.misdatos();
            // console.log(this.dato.password);
        },
        data:function (){
            return {
                datatable:null,
                datos:[],
                dato:{tipo:''}
            }
        },
        methods:{
            crear(){
                this.dato={tipo:''};
            },
            misdatos(){
                axios.get('/asistencia').then(res=>{
                    this.datos=res.data;
                    console.log(this.datos);
                });
            },
            guardar(){
                axios.post('/persona',this.dato).then(res=>{
                    this.misdatos();
                    $('#modal-default').modal('hide');
                    this.$toast.open({
                        message: "Dato creado",
                        type: "success",
                        duration: 3000,
                        dismissible: true
                    });
                    this.dato={tipo:''};
                })
            },
            update(){
                axios.put('/persona/'+this.dato.id,this.dato).then(res=>{
                    // console.log(res.data);
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
            modificar(i){
                $('#modificar').modal('show');
                this.dato=i;
            },
            eliminar(i){
                this.$fire({
                    title: 'Seguro de eliminar??',
                    // text: "You won't be able to revert this!",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si!'
                }).then((r) => {
                    if (r.value){
                        axios.delete('/persona/'+i.id).then(res=>{
                            this.misdatos();
                            // $('#modal-default').modal('hide');
                            this.$toast.open({
                                message: "Dato Eliminado",
                                type:"error",
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
        }
    }
</script>
