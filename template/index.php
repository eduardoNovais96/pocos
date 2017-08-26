<?php
$this->load->view('../../template/header.php');
?>
<div class="container-fluid" id="home">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="img-fluid" src="<?php echo base_url('template/assets/img/night-2569778_1920.jpg');?>" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>INVISTA EM SEU POTENCIAL</h3>
                        <h2>EMPREENDED<span class="red">O</span>R</h2>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="img-fluid" src="<?php echo base_url('template/assets/img/night-1450087_1920.jpg');?>" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>INVISTA EM SEU POTENCIAL</h3>
                        <h2>EMPREENDED<span class="red">O</span>R</h2>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col texto text-center">
            <h1>  Por que fazer marketing na internet? </h1> <hr>
            <p> Além de proporcionar grandes benefícios para a sociedade, o marketing colabora para que a imagem corporativa de uma
                empresa seja bem vista por seus consumidores, colaboradores, fornecedores e mídia.</p>
        </div>
    </div>
    <div class="row"> 
        <div class="col colgrid text-center">
            <h1>01.</h1>
            <h2>AUSÊNCIA DE BARREIRAS GEOGRÁFICAS</h2>
            <p>
                Se você tem um negócio e vende produtos ou serviços, e se esse
                seu negócio está na internet, você pode vender produtos para o
                Brasil e até para o mundo inteiro, sem ficar limitado a uma
                localidade.
                <br>
                <br>
                <br>
            </p>
            <?php // <button class="btn btn-primary">Leia Mais</button> ?>
        </div>
        <div class="col colgrid text-center">
            <h1>02.</h1>
            <h2>AUSÊNCIA DE BARREIRAS TEMPORAIS</h2>
            <p>
                Além de vender meu produto para o mundo todo, minha loja
                na internet está aberta 24 horas por dia, 7 dias por semana,
                não tem sábado, domingo ou feriado. Você está com sua loja
                aberta o tempo todo e o tempo todo essas pessoas,
                independente do dia e do horário, podem consumir o teu
                conteúdo.
            </p>
           <?php // <button class="btn btn-primary">Leia Mais</button> ?>
        </div>
        <div class="col colgrid text-center">
            <h1>03.</h1>
            <h2>CUSTO-BENEFÍCIO</h2>
            <p>
                Ao realizar uma campanha de divulgação com a internet
                você consegue, com um mesmo orçamento, abranger um
                número de pessoas bem maior do que usando uma mídia
                tradicionalmente, uma mídia offline. Então o custo-benefício
                da divulgação nas mídias digitais é muito interessante.
            </p>
             <?php  // <button class="btn btn-primary">Leia Mais</button> ?>
        </div>
    </div>
</div>
<?php $this->load->view('../../template/footer.php'); ?>