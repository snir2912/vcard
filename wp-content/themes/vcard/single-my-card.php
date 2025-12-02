<?php
/**
 * Template Name: Digital Card Template
 * Post Type: my-card
 */

// --- 1. שליפת שדות ACF ומשתנים ---
$bg_color       = get_field('card_bg_color') ?: '#111111'; // צבע הרקע
$text_color     = get_field('card_text_color') ?: '#FFFFFF'; // צבע הטקסט (שם, סלוגן)
$btn_bg_color   = get_field('btn_bg_color') ?: '#1C1C1C'; // רקע כפתור
$icon_color     = get_field('icon_color') ?: '#FFD700'; // צבע אייקון וטקסט כפתור

$banner = get_field('card_banner');
$logo   = get_field('card_logo');
$name   = get_field('card_name') ?: get_the_title();
$role   = get_field('card_role');
$about_content = get_field('about_content'); 

// URL נוכחי לשיתוף
$current_url = get_permalink();
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo esc_html($name); ?> - כרטיס ביקור דיגיטלי</title>
    
    <?php wp_head(); ?> 
    
    <style>
        /* הגדרת רקע כללי לדף שיתאים לצבע הכרטיס */
        body.digital-card-page { 
            background-color: <?php echo $bg_color; ?>; 
            margin: 0;
            font-family: 'Alef', sans-serif;
        }

        /* 1. רקע לאזור התוכן */
        .digital-card-wrapper .card-content {
            background-color: <?php echo $bg_color; ?>;
            color: <?php echo $text_color; ?>;
            position: relative;
            padding-bottom: 30px;
        }
        
        /* 2. צבעי טקסט (שם, סלוגן) */
        .card-name, 
        .card-role {
            color: <?php echo $text_color; ?> !important;
        }
        
        /* קו מפריד (אם קיים) או בורדר עליון לשיתוף בצבע הטקסט */
        .share-area {
            border-top: 1px solid <?php echo $text_color; ?>;
            opacity: 0.8;
        }
        .share-area h3 {
             color: <?php echo $text_color; ?> !important;
        }

        /* 3. כפתורים ראשיים */
        .digital-card-wrapper .action-btn { 
            background-color: <?php echo $btn_bg_color; ?> !important; 
            background: <?php echo $btn_bg_color; ?> !important;
            border: 1px solid rgba(255,255,255,0.1);
            /* חובה להגדיר בורדר תחתון שקוף או בצבע בסיס כדי שהמעבר יעבוד */
            border-bottom: 4px solid transparent; 
        }
        
        /* צבע הטקסט והאייקון בכפתור */
        .digital-card-wrapper .action-btn .btn-label,
        .digital-card-wrapper .action-btn .icon-wrap,
        .digital-card-wrapper .action-btn i { 
            color: <?php echo $icon_color; ?> !important; 
        }
        
        /* --- תיקון: הובר על כפתורים --- */
        .digital-card-wrapper .action-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            /* הבורדר התחתון מקבל את צבע האייקון! */
            border-bottom-color: <?php echo $icon_color; ?> !important; 
        }
        
        /* 4. כפתורי שיתוף */
        .digital-card-wrapper .share-icons a {
             background-color: <?php echo $btn_bg_color; ?> !important;
             color: <?php echo $icon_color; ?> !important;
             border: 1px solid rgba(255,255,255,0.05);
             transition: all 0.3s ease;
        }

        .digital-card-wrapper .share-icons a:hover {
            background-color: <?php echo $icon_color; ?> !important; 
            color: <?php echo $btn_bg_color; ?> !important; 
            transform: rotate(360deg);
        }

        /* --- 5. תיקון: פוטר קרדיט (היפוך צבעים) --- */
        .card-footer-credit {
            /* רקע הפוטר = צבע הטקסט של האתר */
            background-color: <?php echo $text_color; ?> !important;
            padding: 15px;
            text-align: center;
        }
        
        .card-footer-credit a {
            /* צבע הלינק בפוטר = צבע הרקע של האתר */
            color: <?php echo $bg_color; ?> !important;
            font-weight: bold;
            text-decoration: none;
        }

        /* התאמות למודל אודות */
        .vcard-modal .close-modal:hover,
        .vcard-modal h2 { 
            color: <?php echo $icon_color; ?> !important; 
        }
    </style>
</head>

<body <?php body_class('digital-card-page'); ?>>

<div class="digital-card-wrapper">
    
    <?php if($banner): ?>
    <div class="card-banner" style="background-image: url('<?php echo esc_url($banner['url']); ?>');"></div>
    <?php else: ?>
    <div class="card-banner" style="background-color: #333;"></div>
    <?php endif; ?>

    <div class="card-content">
        <div class="card-logo">
            <?php if($logo): ?>
                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($name); ?>">
            <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/default-user.png" alt="Logo">
            <?php endif; ?>
        </div>

        <h1 class="card-name"><?php echo esc_html($name); ?></h1>
        <?php if($role): ?>
            <p class="card-role"><?php echo esc_html($role); ?></p>
        <?php endif; ?>

        <div class="buttons-grid">
            <?php if( have_rows('card_links') ): ?>
                <?php while( have_rows('card_links') ): the_row(); 
                    $type = get_sub_field('link_type'); 
                    $input_val = get_sub_field('link_url');
                    $label = get_sub_field('link_label');
                    $icon_class = get_sub_field('link_icon'); 

                    $final_url = '';
                    $target = '_blank';
                    $extra_class = ''; 

                    switch ($type) {
                        case 'google':
                            $final_url = $input_val;; 
                            $target = '_blank'; 
                            if(empty($icon_class)) $icon_class = 'fa-brands fa-google';
                            break;
                            
                        case 'instagram':
                            $final_url = $input_val;; 
                            $target = '_blank'; 
                            if(empty($icon_class)) $icon_class = 'fa-brands fa-instagram';
                            break;
                            
                        case 'facebook':
                            $final_url = $input_val;; 
                            $target = '_blank'; 
                            if(empty($icon_class)) $icon_class = 'fa-brands fa-facebook-f';
                            break;

                        case 'popup':
                            $final_url = '#'; 
                            $target = '_self';
                            $extra_class = 'js-open-about'; 
                            if(empty($icon_class)) $icon_class = 'fa-solid fa-info-circle';
                            break;

                        case 'phone':
                            $clean_num = preg_replace('/[^0-9+]/', '', $input_val);
                            $final_url = 'tel:' . $clean_num;
                            $target = '_self';
                            if(empty($icon_class)) $icon_class = 'fa-solid fa-phone';
                            break;

                        case 'email':
                            $final_url = 'mailto:' . $input_val;
                            $target = '_self';
                            if(empty($icon_class)) $icon_class = 'fa-solid fa-envelope';
                            break;

                        case 'whatsapp':
                            $clean_wa = preg_replace('/[^0-9]/', '', $input_val);
                            if (substr($clean_wa, 0, 1) == '0') {
                                $clean_wa = '972' . substr($clean_wa, 1);
                            }
                            $final_url = 'https://wa.me/' . $clean_wa;
                            if(empty($icon_class)) $icon_class = 'fa-brands fa-whatsapp';
                            break;
                            
                        case 'waze':
                             $final_url = $input_val;
                             if(empty($icon_class)) $icon_class = 'fa-brands fa-waze';
                             break;

                        default: 
                            $final_url = $input_val;
                            if(empty($icon_class)) $icon_class = 'fa-solid fa-globe';
                            break;
                    }
                ?>
                
                <a href="<?php echo esc_url($final_url); ?>" class="action-btn wow-effect <?php echo $extra_class; ?>" target="<?php echo $target; ?>">
                    <div class="icon-wrap"><i class="<?php echo esc_attr($icon_class); ?>"></i></div>
                    <span class="btn-label"><?php echo esc_html($label); ?></span>
                </a>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <div class="share-area">
            <h3>שתף את הכרטיס</h3>
            <div class="share-icons">
                <a href="https://wa.me/?text=<?php echo urlencode('היי, הנה הכרטיס שלי: ' . $current_url); ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="copy-link-btn" data-link="<?php echo $current_url; ?>"><i class="fa-solid fa-link"></i></a>
            </div>
        </div>

        <div class="card-footer-credit">
            <a href="<?php echo home_url(); ?>">נוצר ע"י VCARD</a>
        </div>
    </div> 

</div>

<div id="aboutModal" class="vcard-modal">
    <div class="modal-content-wrap">
        <span class="close-modal">&times;</span>
        <div class="modal-body">
            <h2>אודות <?php echo esc_html($name); ?></h2>
            <div class="modal-text">
                <?php 
                if($about_content) {
                    echo wp_kses_post($about_content); 
                } else {
                    echo '<p>לא הוזן מידע אודות.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($) {
    // 1. פתיחת פופאפ
    $('.js-open-about').on('click', function(e) {
        e.preventDefault();
        $('#aboutModal').css('display', 'flex').hide().fadeIn(300).addClass('open');
    });

    // 2. סגירה
    $('.close-modal').on('click', function() {
        $('#aboutModal').fadeOut(300, function(){ $(this).removeClass('open'); });
    });

    $(window).on('click', function(event) {
        if ($(event.target).is('#aboutModal')) {
            $('#aboutModal').fadeOut(300, function(){ $(this).removeClass('open'); });
        }
    });

    // 3. העתקה
    $('.copy-link-btn').on('click', function(e) {
        e.preventDefault();
        var link = $(this).data('link');
        navigator.clipboard.writeText(link).then(function() {
            alert('הקישור הועתק ללוח!');
        }, function(err) {
            console.error('שגיאה: ', err);
        });
    });
});
</script>

</body>
</html>