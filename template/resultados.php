<?php /* Template Name: Resultados */ ?>
<?php
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$path = get_template_directory_uri();
?>
<?php
/*	
<ul class="nav nav-tabs" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#messages" role="tab">Messages</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Settings</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel">...</div>
  <div class="tab-pane" id="profile" role="tabpanel">...</div>
  <div class="tab-pane" id="messages" role="tabpanel">...</div>
  <div class="tab-pane" id="settings" role="tabpanel">...</div>
</div>
*/
?>
<div class="container">
<?php
$query = new WP_Query(array(
    'post_type' => 'competicoes',
    'paged' => $paged,
    'posts_per_page' => 7,
    'post_status' => 'publish',
));
if ($query->have_posts()):
while ($query->have_posts()):
	$query->the_post(); 
	$images = acf_photo_gallery('galeria', get_the_ID());
	$aux =  count($images);;
	?>
		
		<div class="row">
		<div class="col texto">
		 <h1> <?php the_title() ; ?> </h1>
		 <ul class="nav nav-tabs" role="tablist">
  	<li class="nav-item">
   	 <a class="nav-link active" data-toggle="tab" href="#res" role="tab">Resultados</a>
  	</li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#sco" role="tab">Score</a>
  </li>
  <?php if($aux):?>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#gal" role="tab">Galeria</a>
  </li>
  <?php endif; ?>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="res" role="tabpanel">	<p> <?php the_content(); ?> </p> </div>
  <div class="tab-pane" id="sco" role="tabpanel">...</div>
    <?php if($aux):?>
 		 <div class="tab-pane" id="gal" role="tabpanel">
 		 <div class="row margintopsm">
 		 	<div class="col text-center">
 		 		<div id="carouselExampleControls" class="carousel" data-ride="carousel">
 		 		<div class="carousel-inner" role="listbox">
 		 		<?php foreach($images as $image): 
 		 			  $thumbnail_image_url= $image['thumbnail_image_url']; //Get the thumbnail size image url 150px by 150px
 		 		?>
 		 		<div class="carousel-item active">
 		 		<?php endforeach; ?>
 		 </div>
 		 </div>
 		 </div>
  <?php endif; ?>
</div>
		
    </div>
    </div>
<?php endwhile;
 if (function_exists(custom_pagination)) {
    custom_pagination($query->max_num_pages, "", $paged);
}
wp_reset_postdata();
endif
?>
</div>
<?php
get_footer(); ?>
