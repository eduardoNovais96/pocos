<?php $this->load->view('../../template/header2'); ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Custom styles for this template -->
<style type="text/css">
    #map{
        height: 320px;
        width: 100%;
    }
</style>
<input type="hidden" value="<?php echo $empresa->endereco;?>" id="address"></input>    
<div class="container-fluid" id="home">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="img-fluid" src="<?php echo base_url('template/assets/img/preto.jpg');?>" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h4>EMPRESA</h4>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col text-center titulo">
            <h1><?php echo $empresa->nome;?></h1>   
        </div>
    </div>
    <div class="row" style="margin-top:40px"> 
        <div class="col cadastrobasico">
            <ul >
                <li class="bg-cinzinhaT">TIPO: <?php echo $empresa->tipo;?></li>
                <li>INSCRIÇÃO MUNICIPAL: <?php echo $empresa->inscricao_municipal;?></li>
                <li class="bg-cinzinhaT">CNPJ: <?php echo $empresa->documento;?> </li>
                <li>ENDEREÇO: <?php echo $empresa->endereco;?></li>
                <li class="bg-cinzinhaT">DATA DE INSCRIÇÃO: <?php echo $empresa->datainscricao;?></li>
            </ul>
        </div>
        <div class="col">
            <div id="map">
            </div>
            <script>
                function initMap() {
                    // Opções do Mapa
                    var options = {
                        zoom: 16,
                        center: {lat: -21.37583, lng: -46.52556}
                    };

                    // Criar Mapa
                    var map = new google.maps.Map(document.getElementById('map'), options);

                    /*     var marker = new google.maps.Marker({
                     position: {lat:-21.37583,lng:-46.52556},
                     map: map
                     });
                     
                     var infoWindow = new google.maps.InfoWindow({
                     content: '<h1> Muz </hq>'
                     });
                     
                     marker.addListener('click',function(){
                     infoWindow.open(map,marker);
                     }); */
                    var location = document.getElementById('address').value;
                    axios.get('https://maps.googleapis.com/maps/api/geocode/json', {
                        params: {
                            address: location,
                            key: 'AIzaSyBf3o69iAeOwTGnSh0st4a7B_T3AoYJTWI'
                        }
                    }).then(function (response) {
                        console.log(response);
                        var formatted_address = response.data.results[0].formatted_address;
                        var lat = response.data.results[0].geometry.location.lat;
                        var lng = response.data.results[0].geometry.location.lng;
                        addMarker({lat: lat, lng: lng});
                        map.setCenter({lat: lat, lng: lng});
                        //for
                    });/*
                     .catch(function(error){
                     console.log(error);
                     }); */
                    addMarker({lat: -21.37583, lng: -46.52556});
                    // Criar marcador
                    function addMarker(coords) {
                        var marker = new google.maps.Marker({
                            position: coords,
                            map: map
                        });
                    }

                }
            </script>
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsMvDpBjVRd-dm3L1WhysqOLiCbwY1ZpE&callback=initMap">
            </script>

        </div>
    </div>
</div>


<?php $this->load->view('../../template/footer'); ?>
