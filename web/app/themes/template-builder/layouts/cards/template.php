<?php
/**
 * Cards Layout Render Template.
 *
 * @array   $layout Layout settings (without values)
 * @array   $field Flexible content field settings
 * @bool    $is_preview True during AJAX preview
 */
?>
<div class="layout-card <?php echo ($is_preview) ? 'is-preview ' : ''; the_sub_field('css_class'); ?>" 
id="<?php the_sub_field('css_id'); ?>">
<div uk-flex class="uk-grid uk-flex-center uk-text-center">

    <?php if( have_rows('cards') ): ?>
    <?php while( have_rows('cards') ): the_row(); ?>
        <div class="uk-width-1-3">
            <img src="<?php the_sub_field('image'); ?>" <?php if ( get_sub_field( 'rounded_image' ) ): ?>
            style="border-radius:50%;"
            <?php endif; ?>>
            <div class="card-heading"><?php the_sub_field('heading');?></div>
            <div class="card-text"><?php the_sub_field('text'); ?></div>
            <?php if( have_rows('buttons') ): ?>
 
            <div class="buttons">
        
            <?php while( have_rows('buttons') ): the_row(); ?>
        
                <a href="<?php the_sub_field('button_link'); ?>" 
                <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
                target="_blank"
                <?php endif; ?>>
                <?php the_sub_field('button_text'); ?></a>
                
            <?php endwhile; ?>
        
            </div>
        
        <?php endif; ?>
    </div>
    <?php endwhile; endif; ?>

    <?php if( have_rows('cards_two') ): ?>
    <?php while( have_rows('cards_two') ): the_row(); ?>
        <div class="uk-width-1-3">
            <img src="<?php the_sub_field('image'); ?>" <?php if ( get_sub_field( 'rounded_image' ) ): ?>
            style="border-radius:50%;"
            <?php endif; ?>>
            <div class="card-heading"><?php the_sub_field('heading');?></div>
            <div class="card-text"><?php the_sub_field('text'); ?></div>
            <?php if( have_rows('buttons') ): ?>
 
            <div class="buttons">
        
            <?php while( have_rows('buttons') ): the_row(); ?>
        
                <a href="<?php the_sub_field('button_link'); ?>" 
                <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
                target="_blank"
                <?php endif; ?>>
                <?php the_sub_field('button_text'); ?></a>
                
            <?php endwhile; ?>
        
            </div>
        
        <?php endif; ?>
    </div>
    <?php endwhile; endif; ?>

    <?php if( have_rows('cards_three') ): ?>
    <?php while( have_rows('cards_three') ): the_row(); ?>
        <div class="uk-width-1-3">
            <img src="<?php the_sub_field('image'); ?>" <?php if ( get_sub_field( 'rounded_image' ) ): ?>
            style="border-radius:50%;"
            <?php endif; ?>>
            <div class="card-heading"><?php the_sub_field('heading');?></div>
            <div class="card-text"><?php the_sub_field('text'); ?></div>
            <?php if( have_rows('buttons') ): ?>
 
            <div class="buttons">
        
            <?php while( have_rows('buttons') ): the_row(); ?>
        
                <a href="<?php the_sub_field('button_link'); ?>" 
                <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
                target="_blank"
                <?php endif; ?>>
                <?php the_sub_field('button_text'); ?></a>
                
            <?php endwhile; ?>
        
            </div>
        
        <?php endif; ?>
    </div>
    <?php endwhile; endif; ?>

    <?php if( have_rows('cards_four') ): ?>
    <?php while( have_rows('cards_four') ): the_row(); ?>
        <div class="uk-width-1-4">
            <img src="<?php the_sub_field('image'); ?>" <?php if ( get_sub_field( 'rounded_image' ) ): ?>
            style="border-radius:50%;"
            <?php endif; ?>>
            <div class="card-heading"><?php the_sub_field('heading');?></div>
            <div class="card-text"><?php the_sub_field('text'); ?></div>
            <?php if( have_rows('buttons') ): ?>
 
            <div class="buttons">
        
            <?php while( have_rows('buttons') ): the_row(); ?>
        
                <a href="<?php the_sub_field('button_link'); ?>" 
                <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
                target="_blank"
                <?php endif; ?>>
                <?php the_sub_field('button_text'); ?></a>
                
            <?php endwhile; ?>
        
            </div>
        
        <?php endif; ?>
    </div>
    <?php endwhile; endif; ?>

    <?php if( have_rows('cards_five') ): ?>
    <?php while( have_rows('cards_five') ): the_row(); ?>
        <div class="uk-width-1-5">
            <img src="<?php the_sub_field('image'); ?>" <?php if ( get_sub_field( 'rounded_image' ) ): ?>
            style="border-radius:50%;"
            <?php endif; ?>>
            <div class="card-heading"><?php the_sub_field('heading');?></div>
            <div class="card-text"><?php the_sub_field('text'); ?></div>
            <?php if( have_rows('buttons') ): ?>
 
            <div class="buttons">
        
            <?php while( have_rows('buttons') ): the_row(); ?>
        
                <a href="<?php the_sub_field('button_link'); ?>" 
                <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
                target="_blank"
                <?php endif; ?>>
                <?php the_sub_field('button_text'); ?></a>
                
            <?php endwhile; ?>
        
            </div>
        
        <?php endif; ?>
    </div>
    <?php endwhile; endif; ?>

</div>

</div>

<?php while( have_rows('cards') ): the_row(); ?>
<style type="text/css">
<?php the_sub_field('custom_css'); ?>
</style>
<?php endwhile; ?>