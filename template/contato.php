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
            <h1>  Entre em contato conosco, tire suas dúvidas e </h1> <hr>
            <p>Explore algumas das melhores dicas de toda a cidade de nossos parceiros e amigos.</p>
        </div>
    </div>
</div>
<?php
$this->load->view('../../template/footer.php');
?>