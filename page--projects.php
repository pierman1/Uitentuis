<?php /* Template Name: Projects */ ?>
<?php get_header(); ?>
	
	<main>
        <main>
        
        <div class="projects-showcase__content-wrapper">
            <?php 
                 
                $args = array(
                    'post_type' => 'projects'
                    );
                 
                $loop = new WP_Query( $args );
                 
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                
                <div class="slide fp-slide">
                
                    <div class="projects-showcase__item">
                        <a href="<?php echo get_post_permalink()?>">
                            <figure class="projects-showcase__image">
                                <?php the_post_thumbnail( 'medium_large' );?>
                            </figure>
                            
                            <div class="projects-showcase__content">
                                <h1 class="projects-showcase__title"><?php the_title(); ?></h2>
                                
                                <?php echo the_excerpt();?>
                                
                            </div>
                        </a>
                    </div>
                </div>


            <?php endwhile;?>

            <div class="projects-showcase__nav">
                
                <img class="prev" src="<?php echo ICONS_URL ;?>/arrow_left.svg" alt="navigation projects previous">
                <img class="next" src="<?php echo ICONS_URL ;?>/arrow_right.svg" alt="navigation projects next">

            </div>

            <div class="section__link-more">
                <a href="<?php echo get_post_permalink()?>">Mo-</br>re</a>
            </div>

        </div>

    </main>

<?php get_footer(); ?>