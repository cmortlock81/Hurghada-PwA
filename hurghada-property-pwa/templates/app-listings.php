<?php
if (!defined('ABSPATH')) { exit; }

$listings = HPPWA_Plugin::instance()->listings;
$filters = wp_unslash($_GET);
?>
<header class="hppwa-page-head hppwa-card">
    <h1>Listings</h1>
    <p>Browse available Hurghada properties and narrow the results with the filters below.</p>
</header>
<form class="hppwa-filters hppwa-card" method="get">
    <input name="bedrooms" inputmode="numeric" placeholder="Bedrooms" value="<?php echo esc_attr($filters['bedrooms'] ?? ''); ?>">
    <input name="min_price" inputmode="numeric" placeholder="Min price" value="<?php echo esc_attr($filters['min_price'] ?? ''); ?>">
    <input name="max_price" inputmode="numeric" placeholder="Max price" value="<?php echo esc_attr($filters['max_price'] ?? ''); ?>">
    <input name="location" placeholder="Location/development" value="<?php echo esc_attr($filters['location'] ?? ''); ?>">
    <button type="submit">Filter</button>
</form>
<section class="hppwa-listings" aria-label="Property listings">
    <?php
    $q = $listings->query($filters);
    if ($q->have_posts()) :
        while ($q->have_posts()) :
            $q->the_post();
            $p = $listings->property_data(get_the_ID());
            include HPPWA_DIR . 'templates/part-card.php';
        endwhile;
    else :
        ?>
        <p class="hppwa-card">No listings found.</p>
        <?php
    endif;
    wp_reset_postdata();
    ?>
</section>
