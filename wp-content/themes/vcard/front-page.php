<?php get_header(); ?>

<section class="home-section hero-section">
    <div class="video-background">
        <?php 
        $video = get_field('hero_video');
        if($video): ?>
            <video autoplay muted loop playsinline>
                <source src="<?php echo esc_url($video['url']); ?>" type="video/mp4">
            </video>
        <?php endif; ?>
        <div class="overlay"></div> </div>

    <div class="container relative z-10 text-center">
        <h1 class="main-title"><?php the_field('hero_title'); ?></h1>
        <p class="hero-desc"><?php the_field('hero_subtitle'); ?></p>
        
        <a href="<?php the_field('hero_btn_link'); ?>" class="mega-btn">
            <?php the_field('hero_btn_label'); ?> <i class="fa-solid fa-arrow-left"></i>
        </a>
    </div>
</section>

<section class="home-section benefits-section" id="benefits">
    <div class="container">
        <div class="benefits-content">
            <h2 class="section-title"><?php the_field('benefits_title'); ?></h2>
            <div class="benefits-text">
                <?php the_field('benefits_content'); ?>
            </div>
        </div>
    </div>
</section>

<section class="home-section showcase-section" id="cards">
    <div class="container">
        <h2 class="section-title text-center">מבחר דוגמאות</h2>
        
        <div class="cards-grid-display">
            <?php
            $args = array(
                'post_type' => 'my-card',
                'posts_per_page' => 6, // נציג 6 כרטיסים לדוגמה
            );
            $query = new WP_Query($args);
            
            if($query->have_posts()): while($query->have_posts()): $query->the_post(); 
                $role = get_field('card_role');
                $logo = get_field('card_logo');
                $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            
            <article class="lethal-card" onclick="location.href='<?php the_permalink(); ?>'">
                <div class="card-image" style="background-image: url('<?php echo $thumb ? $thumb : get_template_directory_uri().'/assets/images/default-bg.jpg'; ?>');">
                    <div class="card-overlay"></div>
                </div>
                
                <div class="card-details">
                    <?php if($logo): ?>
                        <img src="<?php echo $logo['url']; ?>" class="mini-logo" alt="logo">
                    <?php endif; ?>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo $role; ?></p>
                    <span class="view-btn">צפה בכרטיס</span>
                </div>
            </article>

            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</section>

<section class="home-section cta-section" id="i-want-card">
    <div class="container">
        <div class="cta-box">
            <h2><?php the_field('cta_title'); ?></h2>
            <p><?php the_field('cta_content'); ?></p>
            <a href="#contact-footer" class="outline-btn">צור כרטיס משלך עכשיו</a>
        </div>
    </div>
</section>

<div id="contact-footer"></div>
<?php get_footer(); ?>