<?php $svgID = uniqid(); ?>

<form role="search" method="get" class="row g-1 align-items-center searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="col">
        <label class="visually-hidden" for="search-field">Buscar por:</label>
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="search-field" class="form-control form-control-sm searchform__input" placeholder="Buscar em todo o site" required>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-sm searchform__submit" aria-labelledby="<?php echo $svgID; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" role="img">
                <title id="<?php echo $svgID; ?>">Buscar no Site</title>
                <!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
            </svg>
        </button>
    </div>
</form>
