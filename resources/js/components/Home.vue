<template>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{recintos.length}}</h3>
                        <p>Recintos registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="" class="small-box-footer">más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                            {{destinos.length}}
<!--                            <sup style="font-size: 20px">%</sup>-->
                        </h3>
                        <p>Bounce Rate</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{personas.length}}</h3>
                        <p>Personas registradas</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{autos.length}}</h3>
                        <p>Auto registrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">más información <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import axios from 'axios';
export default {
    mounted() {
        console.log('Component mounted.')
    },
    data(){
        return {
            recintos:[],
            destinos:[],
            personas:[],
            autos:[],
        }
    },
    created() {
        axios.get('/recinto').then(res=>{
            this.recintos=res.data;
        });
        axios.get('/destino').then(res=>{
            this.destinos=res.data;
        });
        axios.get('/persona').then(res=>{
            this.personas=res.data;
        });
        axios.get('/auto').then(res=>{
            this.autos=res.data;
        });
    }
}
</script>
