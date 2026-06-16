<?php
/**
 * Custom Search Form
 *
 * @package RareFolk
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'rarefolk' ); ?></span>
        <input type="search" class="minimal-input" placeholder="<?php esc_attr_e( 'Search the archives...', 'rarefolk' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
</form>
