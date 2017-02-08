<div class="row" id="home-banners">
    <div class="col-xs-12 col-md-4">
        <?php if (!dynamic_sidebar('banner')) : endif; ?>
    </div>
    <div class="col-xs-12 col-md-8">
        <?php
            if (shortcode_exists('image-carousel')) {
                echo do_shortcode('[image-carousel twbs="3"]');
            }
        ?>
    </div>
</div>
<div class="clear-fix"></div>
