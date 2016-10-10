<?php /* Template Name: Home */ ?>
<?php get_header(); ?>
<main id="fullpage">
    <section class="section section-showcase">
        
        <div class="section-showcase__carousel">
            <img data-src="<?php echo IMG_URL;?>/project_damstraat.jpg">
        </div>

        <?php 
             
             $args = array(
              'post_type' => 'projects',
              'tax_query' => array(
                array(
                  'taxonomy' => 'projects_category',
                  'field' => 'slug',
                  'terms' => 'featured-project'
                )
              )
            );
            $products = new WP_Query( $args );
            if( $products->have_posts() ) {
              while( $products->have_posts() ) {
                $products->the_post();
                ?>
        
            <div class="section-showcase__content-inner">
                
                <h1 class="section-showcase__title"><?php the_title(); ?></h1>
                
                <p class="section-showcase__text">
                    <?php echo the_field('introduction', $post->ID)?>
                </p>

            </div>
        <?php
              }
            }
            ?>

            <div class="section__link-more">
                <a href="<?php echo get_post_permalink()?>">Mo-</br>re</a>
            </div>
    </section>

    <section class="section section-research">
        
        <div class="section-research__content-wrapper">
            <?php 
                 
                $args = array(
                    'post_type' => 'research'
                    );
                 
                $loop = new WP_Query( $args );
                 
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                
                <div class="section-research__item">
                    
                    <a href="<?php echo get_post_permalink()?>">
                        
                        <div class="section-research__image-wrapper">
                            <span><?php echo get_the_date('m-d');?></span>
                            <img data-src="<?php echo the_field('featured_image', $post->ID)?>">
                        </div>

                        <h3 class="section-research__title"><?php the_title(); ?></h3>
                        
                        <p class="section-research__text">
                            <span>
                                <?php 
                                    $author_id = $post->post_author; 
                                    echo the_author_meta('user_nicename', $author_id );
                                ?>
                                -
                            </span>
                            
                            <?php echo the_field('introduction', $post->ID)?>
                        </p>

                    </a>

                </div>


                <?php endwhile;?>
                <div class="section__link-more">
                    <a href="<?php echo get_post_permalink()?>">Mo-</br>re</a>
                </div>
        </div>
    </section>

    <section class="section section-projects">
        
        <div class="section-projects__content-wrapper">
            <?php 
                 
                $args = array(
                    'post_type' => 'projects'
                    );
                 
                $loop = new WP_Query( $args );
                 
                while ( $loop->have_posts() ) : $loop->the_post();
            ?>
                
                <div class="slide fp-slide">
                
                    <div class="section-projects__item">
                        <a href="<?php echo get_post_permalink()?>">
                            <figure class="section-projects__image">
                                <?php the_post_thumbnail( 'medium_large' );?>
                            </figure>
                            
                            <div class="section-projects__content">
                                <h1 class="section-projects__title"><?php the_title(); ?></h2>
                                
                                <?php echo the_excerpt();?>
                                
                            </div>
                        </a>
                    </div>
                </div>


            <?php endwhile;?>

            <div class="section-projects__nav">
                
                <img class="prev" src="<?php echo ICONS_URL ;?>/arrow_left.svg" alt="navigation projects previous">
                <img class="next" src="<?php echo ICONS_URL ;?>/arrow_right.svg" alt="navigation projects next">

            </div>

            <div class="section__link-more">
                <a href="<?php echo get_post_permalink()?>">Mo-</br>re</a>
            </div>

        </div>
    </section>
    
    <section class="section section-about">
        
        <div class="section-about__content-wrapper">
                
            <h1 class="section-about__title">Solar Made</h2>
            
            <p class="section-about__content"><?php echo the_field('about_us', '5'); ?></p>

            <div class="section-about__social-links">
                    <a href="">Blog</a>
                    <a href="">Instagram</a>
                    <a href="">Facebook</a>
            </div>

        </div>

    </section>

    <section class="section section-contact">
        
        <div class="section-contact__content-wrapper">
                
            <h1 class="section-contact__title">Solar Made</h2>
            
            <div class="section-contact__content">
                <p>West-Indisch Pakhuis</p>
                <p>’s-Gravenhekje 1a</p>
                <p>1011 TG Amsterdam</p>
                <p>The Netherlands</p>
                <p>Tel: <a href="tel:+31205213100">+31 20 521 31 00</a></p>
                <p><a href="mailto:ruud@solarmade.nl">ruud@solarmade.nl</a></p>
            </div>

            <div class="section-contact__social-links">
                    <a href="">Blog</a>
                    <a href="">Instagram</a>
                    <a href="">Facebook</a>
            </div>

            <a href="#showcase" class="section-contact__back-button">
                Back to the top
            </a>

        </div>

    </section>
    
  
</main>

<button class="section__arrow-down">
    <img src="<?php echo ICONS_URL; ?>/arrow_down.svg">
</button>
<?php get_footer(); ?>