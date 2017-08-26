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
                        <h4>FALE CONOSCO</h4>
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
            <h1>  Entre em contato conosco, tire suas dúvidas e nos diga sua sugestão</h1> <hr>
            <p>Nos mande sua mensagem para que possua uma melhor experiência.</p>
        </div>

    </div>
    <br>
    <form action="<?= base_url('alertas/contatos/salvar') ?>#" method="post">
        <div class="row">
            <div class="col-md-6">   
                <?php 
                if(@$msg)
                    echo $msg; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control" id="nome" name="nome" placeholder="Nome" required="" type="text">
            </div>
        </div>    

        <br>
        <div class="row">
            <div class="col-md-6">
                <input class="form-control data" id="telefone" name="telefone" placeholder="Telefone" required="" type="text">
            </div>
        </div>
        <br>
        <div class="row"> 
            <div class="col-md-6">
                <input class="form-control" id="email" name="email" placeholder="Email" required="" type="text">
            </div>
        </div>
        <br>
        
        <div class="row">
            <div class="col-md-6">
<!--                <input class="form-control" id="mensagem" name="mensagem" placeholder="Mensagem" required="" type="text">-->
                
                <textarea class="form-control" rows="5" id="mensage" name="mensagem" placeholder="Mensagem" required=""></textarea>

            </div>
        </div>
        <Br>
             <div class="row"
                   <div style="text-align: center;">
                 <div class="col-md-6">
                    <button class="btn btn-default" type="reset">Cancelar</button>
                    <button class="btn btn-success" type="submit">Enviar</button>
                 </div>
                 </div>

 </div>
        </div>
    </form>
    <?php
    $this->load->view('../../template/footer.php');
    ?>