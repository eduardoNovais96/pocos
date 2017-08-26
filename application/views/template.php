<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Poços</title>
        <?php
        echo '<link rel="shortcut icon" href="'.base_url('assets/img/Logo.png').'">';
        //<!-- Bootstrap -->
        echo link_tag('assets/vendors/bootstrap/dist/css/bootstrap.min.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();
        //<!-- Font Awesome -->
        echo link_tag('assets/vendors/font-awesome/css/font-awesome.min.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();
        //<!-- NProgress -->
        echo link_tag('assets/vendors/nprogress/nprogress.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();
        //<!-- bootstrap-daterangepicker -->
        echo link_tag('assets/vendors/bootstrap-daterangepicker/daterangepicker.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();

        //<!-- Custom Theme Style -->
        echo link_tag('assets/css/custom.min.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();
        echo link_tag('assets/css/avicultura_css.css', 'stylesheet', 'text/css', 'screen');
        lnbreak();
        ?>
    </head>
    <?php if (@$this->nativesession->get('id_usuario')) { ?>
        <body class="nav-md">
            <div class="container body">
                <div class="main_container">
                    <div class="col-md-3 left_col">
                        <div class="left_col scroll-view">
                            <div class="navbar nav_title" style="border: 0;">
                                <a href="<?php echo base_url(); ?>" class="site_title">
                                    <div class="profile_pic"><img src="<?php echo base_url('assets/img/Logo.png');?>" width="50" height="50"></div>
                                    <span>SEARCH UP</span>
                                </a>
                            </div>

                            <div class="clearfix"></div>

                            <!-- menu profile quick info -->
                            <div class="profile clearfix">
                                <!--<div class="profile_pic">
                                    <img src="images/img.jpg" alt="..." class="img-circle profile_img">
                                </div> -->
                                <div class="profile_info">
                                    <span>Bem vindo, </span>
                                    <h2><?php echo $this->nativesession->get('nome_usuario');?></h2>
                                </div>
                            </div>
                            <!-- /menu profile quick info -->

                            <br />

                            <!-- sidebar menu -->
                            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                                <div class="menu_section">
                                    <h3>Menus</h3>
                                    <ul class="nav side-menu">
                                        <?php 
                                        foreach (@$this->nativesession->get('menu') as $m){ ?>
                                            <li><a><i class="<?php echo $m['miniatura']; ?>"></i> <?php echo $m['nome']; ?> <span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu">
                                                <?php foreach(@$this->nativesession->get('funcionalidades') as $f){
                                                    if($f['id_categoria'] == $m['id'])
                                                        echo '<li><a href="'.base_url($f['caminho']).'">'.$f['descricao'].'</a></li>';
                                                } ?>
                                            </ul>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- top navigation -->
                    <div class="top_nav">
                        <div class="nav_menu">
                            <nav>
                                <div class="nav toggle">
                                    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                                </div>

                                <ul class="nav navbar-nav navbar-right">
                                    <li class="">
                                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <?php echo $this->nativesession->get('nome_usuario');?>
                                            <span class=" fa fa-angle-down"></span>
                                        </a>
                                        <ul class="dropdown-menu dropdown-usermenu pull-right">
<!--                                            <li><a href="javascript:;"> Perfil</a></li>-->
                                            <li><a href="<?php echo base_url('inicial/sair'); ?>"><i class="fa fa-sign-out pull-right"></i> Sair</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- /top navigation -->

                    <!-- page content -->
                    <div class="right_col" role="main">
                        <?php echo $this->load->view($pagina); ?>
                </div>
            </div>
        </body>
        <?php
        } else 
            $this->load->view('login/logar');
        ?>
        <script type="text/javascript">
            window.base_url = <?php echo json_encode(base_url()); ?>;
        </script>
    <?php
    //<-- jQuery -->
    echo script_tag('assets/vendors/jquery/dist/jquery.min.js', 'text/javascript');
    lnbreak();
    //<!-- Bootstrap -->
    echo script_tag('assets/vendors/bootstrap/dist/js/bootstrap.min.js', 'text/javascript');
    lnbreak();
    //<!-- FastClick -->
    echo script_tag('assets/vendors/fastclick/lib/fastclick.js', 'text/javascript');
    lnbreak();
    //<!-- NProgress -->
    echo script_tag('assets/vendors/nprogress/nprogress.js', 'text/javascript');
    lnbreak();
    //<!-- Chart.js -->
    echo script_tag('assets/vendors/Chart.js/dist/Chart.min.js', 'text/javascript');
    lnbreak();
    //<!-- jQuery Sparklines -->
    echo script_tag('assets/vendors/jquery-sparkline/dist/jquery.sparkline.min.js', 'text/javascript');
    lnbreak();
    //<!-- Flot -->
    echo script_tag('assets/vendors/Flot/jquery.flot.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/Flot/jquery.flot.pie.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/Flot/jquery.flot.time.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/Flot/jquery.flot.stack.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/Flot/jquery.flot.resize.js', 'text/javascript');
    lnbreak();
    //<!-- Flot plugins -->
    echo script_tag('assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/flot-spline/js/jquery.flot.spline.min.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/flot.curvedlines/curvedLines.js', 'text/javascript');
    lnbreak();

    //<!-- DateJS -->
    echo script_tag('assets/vendors/DateJS/build/date.js', 'text/javascript');
    lnbreak();
    //<!-- bootstrap-daterangepicker -->
    echo script_tag('assets/vendors/moment/min/moment.min.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/vendors/bootstrap-daterangepicker/daterangepicker.js', 'text/javascript');
    lnbreak();

    //Input Mask
    echo script_tag('assets/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js', 'text/javascript');
    lnbreak();
    
    //<!-- Custom Theme Scripts -->
    echo script_tag('assets/js/custom.min.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/js/avicultura_javascript.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/js/jquery.maskedinput.min.js', 'text/javascript');
    lnbreak();
    echo script_tag('assets/js/jquery.maskedinput.js', 'text/javascript');
    lnbreak();

    ?>
</html>