<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div id="app">
    <video id="webcam" autoplay playsinline width="320" height="240"></video>
    <canvas id="canvas" class="d-none"></canvas>
    <audio id="snapSound" src="audio/snap.wav" preload = "auto"></audio>
    <button id="click" @click="foto">Click!</button>
    <input v-model="message">
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script type="text/javascript" src="https://unpkg.com/webcam-easy/dist/webcam-easy.min.js"></script>
<script >
    var app = new Vue({
        el: '#app',
        data: {
            message: 'Hola Vue!',
            webcam : null
        },
        methods:{
            foto(){
                // console.log('a');
                    var picture = this.webcam.snap();
                    // console.log(picture);
                    this.message=picture;
            }
        },
        mounted(){
            const webcamElement = document.getElementById('webcam');
            const click = document.getElementById('click');
            const canvasElement = document.getElementById('canvas');
            const snapSoundElement = document.getElementById('snapSound');
            this.webcam = new Webcam(webcamElement, 'user', canvasElement, snapSoundElement);
            this.webcam.start()
                .then(result =>{
                    console.log("webcam started");
                })
                .catch(err => {
                    console.log(err);
                });
            // click.addEventListener('click',function (e) {
            //     // console.log('a');
            //     var picture = webcam.snap();
            //     // console.log(picture);
            //     this.message=picture;
            // })
        }
    })


</script>
</body>
</html>
