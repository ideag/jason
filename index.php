<!DOCTYPE html>
<html <?php language_attributes(); ?>">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0"/>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <section id="about">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>

        <?php wp_nav_menu( array(
          'theme_location'  => 'social',
          'container'       => 'div',
          'container_class' => 'social',
          'fallback_cb'     => false,
          'items_wrap'      => '%3$s',
          'walker'          => new Jason_Social_Walker(),
        ) ); ?>
        </section>

        <section id="work">
          <?php wp_nav_menu( array(
            'theme_location'  => 'work',
            'container'       => false,
            'fallback_cb'     => false,
            'items_wrap'      => '%3$s',
            'walker'          => new Jason_Work_Walker(),
          ) ); ?>
        </section>

        <section id="profile">
        </section>

        <?php wp_footer(); ?>
    </body>
</html>
