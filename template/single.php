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
                            key: 'AIzaSyBf3o69iAeOwTGnSh0st4a7B_T3AoYJTWI'
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
             <script async defer
              src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDsMvDpBjVRd-dm3L1WhysqOLiCbwY1ZpE&callback=initMap">
              </script>

        </div>
    </div>
    <?php if (!empty($empresa->receita_data_situacao) || !empty($empresa->receita_telefone) || !empty($empresa->receita_email) || !empty($empresa->receita_tipo) || !empty($empresa->receita_capital_social)) { ?>
        <div class="row receitaX">
            <div  id="botoes" class="col text-center titulo">
                <h1>Receita<h1><hr>
                        </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <?php if (!empty($empresa->receita_situacao)) { ?>
                            <div class="col-md-auto receita" >
                                    <button class="btn trans active btn-receita" onclick="exibirsituacao($(this))"> Situação </button>
                                    <input type="hidden" id="situacao" value="<?php echo $empresa->receita_situacao; ?>">
                                    <input type="hidden" id="datas" value="<?php echo $empresa->receita_data_situacao; ?>">
                                    <input type="hidden" id="motivo" value="<?php echo $empresa->receita_motivo_situacao; ?>">
                            </div>
                            <?php } ?>
                            <?php if (!empty($empresa->receita_telefone)) { ?>
                                <div class="col-md-auto receita" >
                                    <button class="btn trans btn-receita" onclick="exibirtelefone($(this))"> Telefone </button>
                                    <input type="hidden" id="fone" value="<?php echo $empresa->receita_telefone; ?>">
                                </div>
                            <?php } ?>
                            <?php if (!empty($empresa->receita_capital_social)) { ?>
                                <div class="col-md-auto receita" >
                                    <button class="btn trans btn-receita" onclick="exibircapital($(this))"> Capital Social </button>
                                    <input type="hidden" id="capital" value="<?php echo $empresa->receita_capital_social;?>">
                                </div>
                            <?php } ?>
                            <?php if (!empty($empresa->receita_tipo)) { ?>
                                <div class="col-md-auto receita" >
                                    <button class="btn trans btn-receita" onclick="exibirtipo($(this))"> Tipo </button>
                                    <input type="hidden" id="tipo" value="<?php echo $empresa->receita_tipo;?>">
                                </div>
                            <?php } ?>
                            <?php if (!empty($empresa->receita_email)) { ?>
                                <div class="col-md-auto receita" >
                                    <button class="btn trans btn-receita" onclick="exibiremail($(this))"> Email </button>
                                    <input type="hidden" id="email" value="<?php echo $empresa->receita_email;?>">
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row bg-cinzinhaT" style="margin-top:40px;height:150px">
                            <div style="padding:20px" id="inform" class="col receitasY text-center">
                                <p><?php echo $empresa->receita_situacao; ?></p>
                                <p><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $empresa->receita_data_situacao; ?></p>
                                <p><?php echo $empresa->receita_motivo_situacao; ?></p>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row facebook">
                        <div id="facebook" class=" col text-center titulo">
                            <h1>Facebook<h1><hr>
                                    </div>
                                    </div>
                                    <div class="row facebook justify-content-center">
                                        <div style="padding:20px;" class="col-md-2 text-center colborder"><img id="imagem"> </div>
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
                                        token = 'EAACEdEose0cBAJGgEZC5DmozcdWDYrFTcd2lZC8ZBJbK4jiCDNEYpk5ZA3JG1IwBKarel62tK0Qi9loWlN9PNf1cPcHTyh6OeXOv8nbyzOMEPg6BF1sGS4l2Tm9N9esfEW4GUIvdZBZABrUGa42GnCW8eWrtYyjKSmzupxjKlgZCRy250iQLcZBe7DUIZAIMyYuI6nJlwOdvMHQZDZD';
                                        console.log(document.getElementById('nome').value);
                                        axios.get('https://graph.facebook.com/search', {
                                            params: {
                                                q: document.getElementById('nome').value,
                                                type: 'page',
                                                access_token: token
                                            }
                                        }).then(function (response) {
                                            console.log(response);
                                            if (response.data.data.length) {
                                                $(".facebook").css('display', 'flex');
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
                                                    fields: 'overall_star_rating,name,bio,about,emails,website,phone,picture.type(large),posts',
                                                    access_token: token
                                                }
                                            }).then(function (response) {
                                                ///console.log(response);
                                                
                                                buscarPalavrasMaisUsadas(response.data.posts.data);
                                                
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
                                                for (; i < estrelas; i++) {

                                                    $('#estrela').append('<i class="fa fa-star yellow"></i> ');
                                                }
                                                for (; i < 5; i++) {
                                                    
                                                    $('#estrela').append('<i class="fa fa-star-o yellow"></i> ');
                                                }

                                                //glyphicon glyphicon-star
                                                $('#imagem').attr('src', response.data.picture.data.url);
                                                
                                                // document.getElementById("foto").innerHTML = '<img src="' + response.data.picture.data.url + '">'

                                                //for
                                            });
                                        }
                                        ;
                                      function exibircapital(ele){
                                        $('.btn-receita').removeClass('active');
                                        ele.addClass('active');
                                        document.getElementById('inform').innerHTML = '<p><i class="fa fa-money" aria-hidden="true"></i> '+document.getElementById('capital').value+'</p>';
                                      }
                                      function exibiremail(ele){
                                        $('.btn-receita').removeClass('active');
                                        ele.addClass('active');
                                        document.getElementById('inform').innerHTML = '<p><i class="fa fa-envelope" aria-hidden="true"></i> '+document.getElementById('capital').value+'</p>';
                                      }
                                      function exibirtelefone(ele){
                                        $('.btn-receita').removeClass('active');
                                        ele.addClass('active');
                                        document.getElementById('inform').innerHTML = '<p><i class="fa fa-phone" aria-hidden="true"></i> '+document.getElementById('fone').value+'</p>';
                                      }
                                      function exibirtipo(ele){
                                        $('.btn-receita').removeClass('active');
                                        ele.addClass('active');
                                        document.getElementById('inform').innerHTML = '<p>'+document.getElementById('tipo').value+'</p>';
                                      }
                                      function exibirsituacao(ele){
                                        $('.btn-receita').removeClass('active');
                                        ele.addClass('active');
                                        document.getElementById('inform').innerHTML = '<p>'+document.getElementById('situacao').value+'</p>'+'<p><i class="fa fa-calendar" aria-hidden="true"></i> '+document.getElementById('datas').value+'</p>'+'<p>'+document.getElementById('motivo').value+'</p>';
                                      }
                                      
                                      function buscarPalavrasMaisUsadas(posts) {
                                            
                                            var textoComPosts = '';
                                            posts.forEach(function(post){
                                                
                                                if(post.message)
                                                    textoComPosts += post.message.toLowerCase();
                                            });
                                          
                                            var wordCounts = [];
                                            var words = textoComPosts.split(/\b/);

                                            for(var i = 0; i < words.length; i++)
                                                wordCounts[words[i]] = (wordCounts[words[i]] || 0) + 1;
                                            
                                            console.log(wordCounts);
                                      }
                                    </script>
                                    


                                    <?php $this->load->view('../../template/footer'); ?>
