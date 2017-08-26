<?php
$this->load->view('../../template/header2.php');
?>
<div class="container-fluid">
    <div class="row">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img class="img-fluid" src="<?php echo base_url('template/assets/img/preto.jpg'); ?>" alt="">
                    <div class="carousel-caption d-none d-md-block">
                        <h4>EMPRESAS</h4>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col texto text-center">
            <h1>  Você está interessado em ? </h1> <hr>
            <p>Explore algumas das melhores dicas de toda a cidade de nossos parceiros e amigos.</p>
        </div>
    </div>
    <?php for ($i = 0; $i < count($empresas); $i+=2) { ?>
        <div class="row">
            <div class="col paginaisso colpagination bg-cinzinhaT">
                <a href="<?php echo base_url('site/empresa/detalhes/' . $empresas[$i]->id); ?>"><?php echo $empresas[$i]->nome; ?></a>
            </div>
            <?php
            if (count($empresas) % 2 == 0) {
                ?>
                <div class="col paginaisso colpagination">
                    <a href="<?php echo base_url('site/empresa/detalhes/' . $empresas[$i]->id); ?>"><?php echo $empresas[$i + 1]->nome; ?></a>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="row">
        <p>Total de Registros: <?php echo $total; ?></p>
    </div>
    <?php echo $paginacao; ?>
</div>
<?php
$this->load->view('../../template/footer.php');
?>