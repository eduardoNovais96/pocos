<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../../../favicon.ico">

        <title>SEARCH UP</title>
        <link rel="shortcut icon" href="<?php echo base_url('assets/img/Logo.png'); ?>">

        <!-- Bootstrap core CSS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url('template/assets/js/navfade.js') ?>"></script>
        <link href="<?php echo base_url('template/dist/css/bootstrap.css'); ?>" rel="stylesheet">    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php /* wp_head();  */ ?>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div id="logo" class="navbar-brand navlinksA"> <img class="logo" src="<?php echo base_url('template/assets/img/logo.svg'); ?>"> <span class="textlogo"> SEARCH UP </span> </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul id="ulnav" class="navbar-nav navlinksA mx-auto">
                    <li  class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('site'); ?>"> Home </a><span class="separador">|</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('site/busca/listar'); ?>">Empresas</a><span class="separador">|</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('contato'); ?>"> Contato </a>  </a>
                    </li>
                </ul>
                <ul id="search" class="navbar-nav navlinksA search">
                    <li class="nav-item ">
                        <button type="button" class="btn trans" data-toggle="modal" data-target="#myModal"> <i class="fa fa-search"></i></button>
                    </li>
                </ul>
            </div>

        </nav>


        <!--CB-modal -->
        <!-- Button trigger modal -->
        <!-- Button trigger modal -->



        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <?php echo form_open(base_url('site/busca')); ?>
                <div class="row fakenav bg-white">
                    <div class="col">
                    </div>
                    <div class="col-md-8">
                        <input placeholder="Digite sua busca e pressione Enter" class="fill placeholder" type="text" name="busca"/>
                    </div>
                    <div class="col">
                        <button  type="button" class="fechamodal close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>


    <!--modal-->

