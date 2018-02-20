<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field">Buscar por:</label>
    <div class="input-group">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="search-field" class="search-field form-control form-control-sm" placeholder="Buscar em todo o site" required>
        <span class="input-group-append">
            <button type="submit" class="search-submit btn btn-primary btn-sm" title="Buscar">&rarrhk;</button>
        </span>
    </div>
</form>
