<?php
/**
 * Hero Layout Render Template.
 *
 * @array   $layout Layout settings (without values)
 * @array   $field Flexible content field settings
 * @bool    $is_preview True during AJAX preview
 */
?>
<div class="layout-hero <?php echo ($is_preview) ? 'is-preview ' : ''; the_sub_field('css_class'); ?>" 
<?php if(get_sub_field('css_id')){ ?>
id="<?php the_sub_field('css_id'); ?>"
<?php } ?>
style="
background: url(<?php the_sub_field('image'); ?>) no-repeat; 
background-size: cover;
background-position: center center;
min-height: 450px;
<?php if(get_sub_field('position')){ ?>
align-items:<?php the_sub_field('position'); ?>;
<?php }
if( have_rows('margin') ):
    while( have_rows('margin') ): the_row(); ?>
    <?php if(get_sub_field('top')){ ?>
margin-top:<?php the_sub_field('top'); ?>px;
    <?php } 
    if(get_sub_field('right')){ ?>
margin-right:<?php the_sub_field('right'); ?>px; 
    <?php } 
    if(get_sub_field('bottom')){ ?>
margin-bottom:<?php the_sub_field('bottom'); ?>px; 
    <?php }
    if(get_sub_field('left')){ ?>
margin-left:<?php the_sub_field('left'); ?>px; 
    <?php } ?>
<?php endwhile;
endif;
if( have_rows('padding') ):
    while( have_rows('padding') ): the_row(); ?>
    <?php if(get_sub_field('top')){ ?>
padding-top:<?php the_sub_field('top'); ?>px;
    <?php } 
    if(get_sub_field('right')){ ?>
padding-right:<?php the_sub_field('right'); ?>px; 
    <?php } 
    if(get_sub_field('bottom')){ ?>
padding-bottom:<?php the_sub_field('bottom'); ?>px; 
    <?php }
    if(get_sub_field('left')){ ?>
padding-left:<?php the_sub_field('left'); ?>px; 
    <?php } ?>
<?php endwhile;
endif;
?>

">
    
    <div class="banner-heading"
    style="font-weight:<?php the_sub_field('heading_font_weight'); ?>;
    text-align:<?php the_sub_field('heading_text_alignment'); ?>;
    color:<?php the_sub_field('heading_text_color'); ?>;
    font-size:<?php the_sub_field('heading_text_size'); ?>px;
    letter-spacing:<?php the_sub_field('heading_letter_spacing'); ?>px;
    line-height:<?php the_sub_field('heading_line_height'); ?>px;
    "
    ><?php the_sub_field('heading'); ?></div>
    <div class="banner-text"
    style="font-weight:<?php the_sub_field('text_font_weight'); ?>;
    text-align:<?php the_sub_field('text_alignment'); ?>;
    color:<?php the_sub_field('text_color'); ?>;
    font-size:<?php the_sub_field('text_size'); ?>px;
    letter-spacing:<?php the_sub_field('text_letter_spacing'); ?>px;
    line-height:<?php the_sub_field('text_line_height'); ?>px;
    "
    ><?php the_sub_field('text'); ?></div>
    <?php if( have_rows('buttons') ): ?>
 
        <div class="buttons">
    
        <?php while( have_rows('buttons') ): the_row(); ?>
    
            <a 
            style="font-weight:<?php the_sub_field('button_font_weight'); ?>;
            text-align:<?php the_sub_field('button_alignment'); ?>;
            color:<?php the_sub_field('button_color'); ?>;
            background-color: <?php the_sub_field('button_background_color'); ?>;
            font-size:<?php the_sub_field('button_size'); ?>px;
            letter-spacing:<?php the_sub_field('button_letter_spacing'); ?>px;
            line-height:<?php the_sub_field('button_line_height'); ?>px;
            border-width:<?php the_sub_field('border_width'); ?>px;
            border-color: <?php the_sub_field('border_color'); ?>;
            border-style: <?php the_sub_field('border_style'); ?>;
            <?php
            if( have_rows('border_radius') ):
            while( have_rows('border_radius') ): the_row(); ?>
            <?php if(get_sub_field('top_left')){ ?>
                border-top-left-radius:<?php the_sub_field('top_left'); ?>px;
            <?php } 
            if(get_sub_field('top_right')){ ?>
                border-top-right-radius:<?php the_sub_field('top_right'); ?>px; 
            <?php } 
            if(get_sub_field('bottom_right')){ ?>
                border-bottom-right-radius:<?php the_sub_field('bottom_right'); ?>px; 
            <?php }
            if(get_sub_field('bottom_left')){ ?>
                border-bottom-left-radius:<?php the_sub_field('bottom_left'); ?>px; 
            <?php } ?>
            <?php endwhile;
            endif; ?>
            "
            href="<?php the_sub_field('button_link'); ?>" 
            <?php if ( get_sub_field( 'open_in_new_tab' ) ): ?>
            target="_blank"
            <?php endif; ?>>
            <?php the_sub_field('button_text'); ?></a>
            
        <?php endwhile; ?>
    
        </div>
    
    <?php endif; ?>

</div>

<style type="text/css">
<?php the_sub_field('custom_css'); ?>
</style>