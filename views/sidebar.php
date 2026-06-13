<?php defined( 'ABSPATH' ) || exit; ?>
<div class="cg-pane-small">
		<div class="cg-panel cg-cache-brand-panel">
			<img class="cg-cache-icon" src="<?php echo esc_url( plugins_url('images/cache.png', dirname( __FILE__ ) ) ); ?>" alt="" />
			<h3><?php esc_html_e( 'Cache by Folium', 'cache-performance' ); ?></h3>
			<p><?php esc_html_e( 'Full-page cache, CDN rewriting and database cleanup for calmer WordPress performance.', 'cache-performance' ); ?></p>
			<?php if ( $cacheSize > 0 ) : ?>
				<div class="cg-btn-dark"><?php printf( esc_html__( 'Current cached files: %s', 'cache-performance' ), esc_html( $cacheSize ) ); ?></div>
			<?php endif; ?>
			<a class="cg-panel-link" target="_blank" rel="noopener" href="https://foliumstudio.co.uk/plugins/folium-cache/"><?php esc_html_e( 'View plugin page', 'cache-performance' ); ?></a>
		</div>

        <div class="cg-pane-head cg-brand-card">
			<img src="<?php echo esc_url( plugins_url('images/banner.png', dirname( __FILE__ ) ) ); ?>" alt="" />
			<h3><?php esc_html_e( 'WooCommerce-aware caching is next', 'cache-performance' ); ?></h3>
			<p><?php esc_html_e( 'Variant-safe caching for cart, checkout, currency and session-aware stores is the direction for Cache by Folium.', 'cache-performance' ); ?></p>
        </div>

        <div class="cg-pane-head cg-brand-card">
			<h3><?php esc_html_e( 'Part of the Folium suite', 'cache-performance' ); ?></h3>
			<p><?php esc_html_e( 'Pair it with Featherweight for request cleanup, and keep heavier performance work under one Folium Studio roof.', 'cache-performance' ); ?></p>
			<a class="cg-card-link" target="_blank" rel="noopener" href="https://foliumstudio.co.uk"><?php esc_html_e( 'Visit Folium Studio', 'cache-performance' ); ?></a>
        </div>
    </div>
