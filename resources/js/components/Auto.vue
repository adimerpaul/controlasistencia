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
                            <i class="fa fa-automobile"></i> Crear Automovil
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
                                                    <label for="placa" class="col-sm-1 control-label">Placa</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" v-model="dato.placa" class="form-control" id="placa" placeholder="Placa" required>
                                                    </div>
                                                    <label for="tipo" class="col-sm-1 control-label">Tipo</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" v-model="dato.tipo" class="form-control" id="tipo" placeholder="Tipo" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">Uso</label>
                                                    <div class="col-sm-5">
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="USO PARTICULAR" checked v-model="dato.uso">
                                                                    USO PARTICULAR
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="USO ADUANA" v-model="dato.uso">
                                                                    USO DE ADUANA
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="USO DEL DAB" v-model="dato.uso">
                                                                    USO DEL DAB
                                                                </label>
                                                            </div>
                                                            <div class="radio">
                                                                <label>
                                                                    <input type="radio" name="optionsRadios" id="optionsRadios4" value="OTROS" v-model="dato.uso">
                                                                    OTROS
                                                                </label>
                                                            </div>
                                                    </div>
                                                    <label for="dueno" class="col-sm-1 control-label">Dueño</label>
                                                    <div class="col-sm-5">
                                                        <select name="dueno" id="dueno" class="form-control" v-model="dato.persona_id" required>
                                                            <option v-for="i in personas" v-bind:value="i.id">{{ i.apellidos }} {{ i.nombres }}</option>

                                                        </select>
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
                                                    <label for="placa2" class="col-sm-1 control-label">Placa</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" v-model="dato.placa" class="form-control" id="placa2" placeholder="Placa" required>
                                                    </div>
                                                    <label for="tipo2" class="col-sm-1 control-label">Tipo</label>
                                                    <div class="col-sm-5">
                                                        <input type="text" v-model="dato.tipo" class="form-control" id="tipo2" placeholder="Tipo" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-1 control-label">Uso</label>
                                                    <div class="col-sm-5">
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios12" value="USO PARTICULAR" checked v-model="dato.uso">
                                                                USO PARTICULAR
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios22" value="USO ADUANA" v-model="dato.uso">
                                                                USO DE ADUANA
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios32" value="USO DEL DAB" v-model="dato.uso">
                                                                USO DEL DAB
                                                            </label>
                                                        </div>
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="optionsRadios" id="optionsRadios42" value="OTROS" v-model="dato.uso">
                                                                OTROS
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <label for="dueno2" class="col-sm-1 control-label">Dueño</label>
                                                    <div class="col-sm-5">
                                                        <select name="dueno" id="dueno2" class="form-control" v-model="dato.persona_id" required>
                                                            <option v-for="i in personas" v-bind:value="i.id">{{ i.apellidos }} {{ i.nombres }}</option>

                                                        </select>
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
                                    <th>Placa</th>
                                    <th>Tipo</th>
                                    <th>Uso</th>
                                    <th>Persona</th>
                                    <th>Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(i,index) in datos" :key="index">
                                    <td>{{index+1}}</td>
                                    <td>{{i.placa}}</td>
                                    <td>{{i.tipo}}</td>
                                    <td>{{i.uso}}</td>
                                    <td>{{i.persona.apellidos}} {{i.persona.nombres}}</td>
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
        axios.get('persona').then(res=>{
            this.personas=res.data;
        });
    },
    data:function (){
        return {
            datatable:null,
            datos:[],
            dato:{uso:'USO PARTICULAR'},
            personas:[],
        }
    },
    methods:{
        crear(){
            this.dato={tipo:''};
        },
        misdatos(){
            axios.get('/auto').then(res=>{
                this.datos=res.data;
            });
        },
        guardar(){
            axios.post('/auto',this.dato).then(res=>{
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
            axios.put('/auto/'+this.dato.id,this.dato).then(res=>{
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
                    axios.delete('/auto/'+i.id).then(res=>{
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
