<?php get_header(); ?>
​

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<main>
	
	<div class="single-project">
		
		<div class="single-project__grid">
			
			<div class="single-project__grid single-project__grid--introduction">
				
				<h1><?php echo the_title();?></h1>
			
				<p><?php echo the_field('introduction');?></p>

			</div>
			
			<figure>
				<?php the_post_thumbnail( 'medium_large' );?>
			</figure>

			<div class=""




	</div>

</main>



<?php endwhile; // end of the loop. ?>
<?php include('footer.php'); ?>