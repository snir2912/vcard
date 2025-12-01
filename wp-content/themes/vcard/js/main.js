/**
 * Main JavaScript File
 * מטפל בלוגיקה של התפריט, החיפוש והאינטראקציות באתר
 */

jQuery(document).ready(function($) {
    
    // משתנים גלובליים לשימוש חוזר
    var hamburgerBtn = $('.hamburger-btn');
    var mobileMenu = $('.mobile-menu-overlay');
    var body = $('body');

    /* -----------------------------------------
       1. לוגיקה של תפריט המבורגר (Mobile Menu)
       ----------------------------------------- */
    hamburgerBtn.on('click', function(e) {
        e.preventDefault();
        $(this).toggleClass('active');
        mobileMenu.toggleClass('active');
        body.toggleClass('no-scroll');
    });

    /* -----------------------------------------
       2. לוגיקה של חיפוש (Search Modal)
       ----------------------------------------- */
    var searchTrigger = $('.search-trigger');
    var searchModal = $('.search-modal-overlay');
    var closeSearch = $('.close-search');
    var searchInput = $('.search-field');

    searchTrigger.on('click', function(e) {
        e.preventDefault();
        searchModal.addClass('open');
        setTimeout(function(){ searchInput.focus(); }, 300);
    });

    closeSearch.on('click', function(e) {
        e.preventDefault();
        searchModal.removeClass('open');
    });

    $(document).keyup(function(e) {
        if (e.key === "Escape") { 
            searchModal.removeClass('open');
            // סגירת תפריט ב-ESC
            hamburgerBtn.removeClass('active');
            mobileMenu.removeClass('active');
            body.removeClass('no-scroll');
        }
    });

    /* -----------------------------------------
       3. גלילה חלקה וסגירת תפריט (Smooth Scroll) - התיקון שלך!
       ----------------------------------------- */
    
    // מזהה כל לחיצה על קישור שמתחיל ב-# (קישורי עוגן)
    $('a[href^="#"]').on('click', function(e) {
        var target = $(this.hash); // המטרה שאליה רוצים להגיע
        
        // אם המטרה קיימת בעמוד
        if (target.length) {
            e.preventDefault(); // מבטל את הקפיצה המיידית המכוערת

            // א. סגירת התפריט (אם הוא פתוח)
            hamburgerBtn.removeClass('active');
            mobileMenu.removeClass('active');
            body.removeClass('no-scroll');

            // ב. חישוב המיקום (כולל קיזוז של ההדר הסטיקי - נניח 100px)
            var headerOffset = 100; 
            var targetPosition = target.offset().top - headerOffset;

            // ג. ביצוע האנימציה
            $('html, body').animate({
                scrollTop: targetPosition
            }, 800, 'swing'); // 800ms = מהירות הגלילה, swing = סוג האנימציה
        }
    });

});