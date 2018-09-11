<form role="search" method="get" class="form-inline searchform" action="<?php echo esc_url(home_url('/')); ?>">
    <label class="sr-only" for="search-field">Buscar por:</label>
    <div class="input-group">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="search-field" class="form-control form-control-sm searchform__input" placeholder="Buscar em todo o site" required>
        <span class="input-group-append">
            <button type="submit" class="btn-sm searchform__submit">
                <span class="sr-only">Buscar no Site</span>
                <svg version="1.1"
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
                x="0px" y="0px" width="20px" height="20px" viewBox="0 0 22.2 22.2" style="enable-background:new 0 0 22.2 22.2;"
                xml:space="preserve">
                    <g><path class="st0" d="M21.8,19.3l-4.6-4.6c1.1-1.6,1.7-3.4,1.7-5.3c0-1.3-0.2-2.5-0.7-3.7c-0.5-1.2-1.2-2.2-2-3
                    c-0.8-0.8-1.8-1.5-3-2C11.9,0.2,10.7,0,9.4,0C8.1,0,6.9,0.2,5.8,0.7c-1.2,0.5-2.2,1.2-3,2c-0.8,0.8-1.5,1.8-2,3
                    C0.2,6.9,0,8.1,0,9.4c0,1.3,0.2,2.5,0.7,3.7c0.5,1.2,1.2,2.2,2,3c0.8,0.8,1.8,1.5,3,2c1.2,0.5,2.4,0.7,3.7,0.7c2,0,3.7-0.6,5.3-1.7
                    l4.6,4.6c0.3,0.3,0.7,0.5,1.2,0.5c0.5,0,0.9-0.2,1.2-0.5c0.3-0.3,0.5-0.7,0.5-1.2C22.2,20.1,22.1,19.7,21.8,19.3z M13.6,13.6
                    c-1.2,1.2-2.6,1.8-4.2,1.8c-1.6,0-3.1-0.6-4.2-1.8C4,12.5,3.4,11.1,3.4,9.4c0-1.6,0.6-3.1,1.8-4.2C6.4,4,7.8,3.4,9.4,3.4
                    c1.6,0,3.1,0.6,4.2,1.8c1.2,1.2,1.8,2.6,1.8,4.2C15.4,11.1,14.8,12.5,13.6,13.6z"/></g>
                </svg>
            </button>
        </span>
    </div>
</form>
