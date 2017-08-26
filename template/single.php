<?php $this->load->view('../../template/header2'); ?>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- Custom styles for this template -->
<style type="text/css">
    #map{
        height: 320px;
        width: 100%;
    }
</style>
<input type="hidden" value="<?php echo $empresa->endereco; ?>" id="address"></input>
<input type="hidden" value="<?php echo $nomeEmpresa ?>" id="nome"></input> 
<div class="container-fluid" id="home">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="img-fluid" src="<?php echo base_url('template/assets/img/preto.jpg'); ?>" alt="">
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
            <h1><?php echo $empresa->nome; ?></h1>   
        </div>
    </div>
    <div class="row" style="margin-top:40px"> 
        <div class="col cadastrobasico">
            <ul>
                <li class="bg-cinzinhaT">TIPO: <?php echo $empresa->tipo; ?></li>
                <li>INSCRIÇÃO MUNICIPAL: <?php echo $empresa->inscricao_municipal; ?></li>
                <li class="bg-cinzinhaT">CNPJ: <?php echo $empresa->documento; ?> </li>
                <li>ENDEREÇO: <?php echo $empresa->endereco; ?></li>
                <li class="bg-cinzinhaT">DATA DE INSCRIÇÃO: <?php echo $empresa->datainscricao; ?></li>
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
                            //AIzaSyBf3o69iAeOwTGnSh0st4a7B_T3AoYJTWI;
                            key: ''
                        }
                    }).then(function (response) {
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
           <?php /*<script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsMvDpBjVRd-dm3L1WhysqOLiCbwY1ZpE&callback=initMap">
            </script> */ ?>

        </div>
    </div>
    <div class="row facebook">
            <div id="facebook" class=" col text-center titulo">
               <h1>Facebook<h1><hr>
            </div>
    </div>
    <div class="row facebook justify-content-center">
        <div style="padding:10px;" class="col-md-2 text-center colborder"><img id="imagem"> </div>
        <div class="col-md-6 ">
            <div class="row">
                <div class="col colborder"><p id="no">NOME: </p> </div>
                <div id="estrela" style="padding:10px;" class="col-md colborder"> </div>
            </div>
            <div class="row">
                <div class="col bg-cinzinhaT colborder">
                    <p id="about">SOBRE: </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md colborder">
                    <p id="email">EMAIL: </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md bg-cinzinhaT colborder">
                    <p id="phone">TELEFONE: </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md colborder">
                    <p id="site">WEBSITE: </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    token = 'EAACEdEose0cBAPCUa4uxWoyzEnD95mB9ZAV84RLAnAWPHueuao80XnK4umENZBcVjxSoCWf8CZBZBGhnIpQJ4BZCBlzCP0La9gmZBvRSjK1vZC1LBIEuU1cdaXZAmjmAZCMt7Ixri8OIhmeSDIrZCApdhTPZCktBN2eeNf0dYBJNTzZC3hJ99nBpgBvQbKi5uNu0dZCHxy8RICSJEsQZDZD';
    axios.get('https://graph.facebook.com/search', {
        params: {
            q: document.getElementById('nome').value,
            type: 'page',
            access_token: token
        }
    }).then(function (response) {
      //  console.log(response);
        if (response.data.data.length) {
           $(".facebook").css('display','flex');
            //document.getElementById("facebook").innerHTML = ''
            console.log(response.data.data[0].id);
            info(response.data.data[0].id);
        }
        // image(response.data.data[0].id);
        //for
    });

    /* function image(id){
     axios.get('https://graph.facebook.com/'+id+'/picture',{
     params:{
     type:'large',
     access_token:token
     }
     }).then(function(response){
     console.log(response);
     document.getElementById("foto").innerHTML = '<img src="'+response.data.picture.data+'">'
     });
     }; */


    function info(id) {
        axios.get('https://graph.facebook.com/' + id, {
            params: {
                fields: 'overall_star_rating,name,bio,about,emails,website,phone,picture.type(large)',
                access_token: token
            }
        }).then(function (response) {
            ///console.log(response);
            console.log(response);
            if (response.data.about) {
                $('#about').append(response.data.about);
            }
            if (response.data.name) {
                $('#no').append(response.data.name);
            }
            if (response.data.emails) {
                $('#email').append(response.data.emails);
            }
            if (response.data.phone) {
                $('#phone').append(response.data.phone);
            }
            if (response.data.website) {
                $('#site').append(response.data.website);
            }
            
            var estrelas = Math.round(Number(response.data.overall_star_rating));
            var i = 0;
            for(;i<estrelas;i++) {
 
                $('#estrela').append('<i class="fa fa-star yellow"></i> ');
            }
            for(;i<5;i++) {
                console.log("absurdo");
                $('#estrela').append('<i class="fa fa-star-o yellow"></i> ');
            }
          
            	//glyphicon glyphicon-star
            $('#imagem').attr('src',response.data.picture.data.url);
                console.log(response.data.about);
                console.log(response.data.name);
                console.log(response.data.email);
                console.log(response.data.website);
               // document.getElementById("foto").innerHTML = '<img src="' + response.data.picture.data.url + '">'
            
            //for
        });
    }
    ;
</script>


<?php $this->load->view('../../template/footer'); ?>
