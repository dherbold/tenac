<?php get_header(); ?>
<div class="page-banner">
  <?php echo $selectedBg; ?>
  <?php
  // https://css-tricks.com/snippets/php/randomize-background-image/
  $img_url_prefix = get_theme_file_uri();
  $bg = array(
    $img_url_prefix . '/images/rose_grant_pedaling.jpg',
    $img_url_prefix . '/images/rose_grant_starting_line.jpg',
    $img_url_prefix . '/images/st_kievens.jpg',
    $img_url_prefix . '/images/coach_tullous.jpg',
    $img_url_prefix . '/images/fence_field.jpg',
    $img_url_prefix . '/images/spirit_world_coach_tullous.jpg'
  );

  $i = rand(0, count($bg) - 1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen
  ?>

  <div class="page-banner__bg-image" style="background-image: url(<?php echo $selectedBg; ?>);"></div>

  <div class="page-banner__content container t-center c-white">
    <div class="badge">
      <img class="logo-badge" src="/wp-content/uploads/tenac-badge.png" alt="Tenac Championship Coaching's badge logo">
    </div>
    <h3 class="headline headline--small">TENAC CHAMPIONSHIP COACHING<br />PROVIDES TRAINING STRATEGIES FOR CYCLISTS<br />OF ALL ABILITIES AND DISCIPLINES.</h3>
    <a href="#programs" class="btn btn--outline-yellow">Achieve Your Best ▾</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>

      <?php
      $today = date('Ymd');
      $homepageEvents = new WP_Query(array(
        'posts_per_page' => 3,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          )
        )
      ));

      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        get_template_part('template-parts/content', 'event');
      }
      ?>
      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event') ?>" class="btn btn--blue">View All Events</a></p>

    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 style="color: white;" class="headline headline--small-plus t-center">Tenac News</h2>
      <?php
      $homepagePosts = new WP_Query(array(
        'posts_per_page' => 3
      ));

      while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post(); ?>

        <div class="event-summary__content">
          <h5 class="event-summary__title headline headline--tiny"><a style="color: white;" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
          <p style="color: white;">
            <?php if (has_excerpt()) {
              echo get_the_excerpt();
            } else {
              echo wp_trim_words(get_the_content(), 28);
            } ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
        </div>

      <?php }
      wp_reset_postdata();
      ?>
      <p class="t-center no-margin"><a href="<?php echo site_url('/news'); ?>" class="btn btn--blue">View All News Posts</a></p>
    </div>
  </div>
</div>
<div class="borderDiv" style="height: 40px; background-color: #ffffff;"></div>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-color: #2baae2"></div>
  <div class="page-banner__content container t-center c-white">
    <h3 class="headline headline--medium">TENAC CHAMPIONSHIP COACHES</h3>
    <p>Lead by Veteran World Champion Jason Tullous, Tenac Championship Coaching is comprised of six:</p>
    <div class="one-third fp-coaches" style="text-align: center;">
      <a href="#">
        <img class="coach" src="<?php echo get_theme_file_uri('/images/coaches/jason_tullous-300x300.jpg') ?>);">
        <a href="/about-us/jason-tullous/">
          <div class="fp-coaches-btn btn btn--white">Jason Tullous</div>
        </a>
      </a>
    </div>

    <div class="one-third fp-coaches" style="text-align: center;">
      <a href="#">
        <img class="coach" src="<?php echo get_theme_file_uri('/images/coaches/benson-kit-300x300.jpg') ?>);">
        <a href="/about-us/john-benson/">
          <div class="fp-coaches-btn btn btn--white">John Benson</div>
        </a>
      </a>
    </div>

    <div class="one-third fp-coaches" style="text-align: center;">
      <a href="#">
        <img class="coach" src="<?php echo get_theme_file_uri('/images/coaches/munoz-kit-300x300.jpg') ?>);">
        <a href="/about-us/jorge-munoz/">
          <div class="fp-coaches-btn btn btn--white">Jorge Munoz</div>
        </a>
      </a>
    </div>

    <div class="one-third fp-coaches" style="text-align: center;">
      <a href="#">
        <img class="coach" src="<?php echo get_theme_file_uri('/images/coaches/chad_beyer-300x300.jpg') ?>);">
        <a href="/about-us/chad-beyer/">
          <div class="fp-coaches-btn btn btn--white">Chad Beyer</div>
        </a>
      </a>
    </div>

    <div class="one-third fp-coaches">
      <a href="#">
        <img style="max-height: 300px" class="coach" src="<?php echo get_theme_file_uri('/images/coaches/bethany_rasmussen.jpg') ?>);">
        <a href="/about-us/bethany-rasmussen/">
          <div class="fp-coaches-btn btn btn--white">Bethany Rasmussen</div>
        </a>
      </a>
    </div>

    <div class=" one-third fp-coaches">
      <a href="#">
        <img style="max-height: 300px" class="coach" src="<?php echo get_theme_file_uri('/images/coaches/welch-700x700.jpg') ?>);">
        <a href="/about-us/jeff-welch/">
          <div class="fp-coaches-btn btn btn--white">Jeff Welch</div>
        </a>
      </a>
    </div>

  </div>
</div>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-color: #ffffff"></div>
  <div class="page-banner__content container t-center c-white">

    <!-- Begin Mailchimp Signup Form -->
    <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7_dtp.css" rel="stylesheet" type="text/css">

    <div id="mc_embed_signup">
      <form action="https://goTenac.us9.list-manage.com/subscribe/post?u=f4d8da127470eb4c7094c17a3&amp;id=c0e9d05aed" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
          <h3 class="headline headline--medium">Sign-Up to receive training and event news</h3>
          <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
          <div class="mc-field-group">
            <label for="mce-EMAIL">Email Address <span class="asterisk">*</span>
            </label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div class="mc-field-group">
            <label for="mce-FNAME">First Name </label>
            <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
          </div>
          <div class="mc-field-group">
            <label for="mce-LNAME">Last Name </label>
            <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
          </div>
          <div id="mce-responses" class="clear foot">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div> <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
          <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_f4d8da127470eb4c7094c17a3_c0e9d05aed" tabindex="-1" value=""></div>
          <div class="optionalParent">
            <div class="clear foot">
              <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
              <p class="brandingLogo"><a href="http://eepurl.com/hPFAjj" title="Mailchimp - email marketing made easy and fun"><img src="https://eep.io/mc-cdn-images/template_images/branding_logo_text_dark_dtp.svg"></a></p>
            </div>
          </div>
        </div>
      </form>
    </div>
    <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
    <script type='text/javascript'>
      (function($) {
        window.fnames = new Array();
        window.ftypes = new Array();
        fnames[0] = 'EMAIL';
        ftypes[0] = 'email';
        fnames[1] = 'FNAME';
        ftypes[1] = 'text';
        fnames[2] = 'LNAME';
        ftypes[2] = 'text';
      }(jQuery));
      var $mcj = jQuery.noConflict(true);
    </script>
    <!--End mc_embed_signup-->
  </div>
</div>
<div class="borderDiv" style="height: 40px; background-color: #ffffff;"></div>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-color: #2baae2"></div>
  <div class="page-banner__content container t-center c-white">
    <h3 class="headline headline--medium">TENAC RESULTS</h3>
    <?php echo do_shortcode('[instagram-feed]'); ?>

  </div>
</div>

<div class="borderDiv" style="height: 40px; background-color: #ffffff;"></div>
<a id="programs"></a>
<div class="page-banner">
  <div class="page-banner__bg-image" style="background-color: #2baae2"></div>
  <div class="container">
    <div class="page-banner__content container t-center c-white">
      <h3 class="headline headline--medium t-center c-white">TENAC COACHING STRATEGIES</h3>
      <p class="t-center c-white">Selecting an appropriate training strategy is the first step toward achieving your goals on the bike.<br />
        Tenac training strategies are built around your goals and the time you have to devote to them. <a href="/coaching/" alt="learn more about tenac coaching programs">Learn more</a>.</p>
    </div>

    <div class="flex-container">
      <div class="flex-item">
        <ul class="package">
          <li class="header">Basic</li>
          <li class="gray">$ 129/month</li>
          <li>$49 One time Set up fee</li>
          <li>Trainingpeaks Premium Account</li>
          <li>Goal Consultation</li>
          <li>Customized Annual Training Plan</li>
          <li>Coach Communication 1x Month*</li>
          <li>Training and Data Review 1x Month</li>
          <li>Schedule Adjustments 1x Month*</li>
          <li><a href="https://inscyd.com/" target="_blank" rel="noopener">INSCYD Testing</a> @ $225/Test</li>
          <li>Private Camp w/ Coach @ $300/day**</li>
          <li>Exclusive discounts with <a href="#">Tenac Partners</a></li>
          <li>
            <p></p>
          </li>
          <li class="gray"><a class="btn btn--blue" href="/contact-us">Contact Us to Sign Up</a></li>
        </ul>
      </div>
      <div class="flex-item">
        <ul class="package">
          <li class="header">Premium</li>
          <li class="gray">$ 234/month</li>
          <li>$49 One time Set up fee</li>
          <li>Trainingpeaks Premium Account</li>
          <li>Goal Consultation</li>
          <li>Customized Annual Training Plan</li>
          <li>Coach Communication 1x Week*</li>
          <li>Training and Data Review 1x Week</li>
          <li>Schedule Adjustments 1x Week*</li>
          <li><a href="https://inscyd.com/" target="_blank" rel="noopener">INSCYD Testing</a> @ $225/Test</li>
          <li>Private Camp w/ Coach @ $300/day**</li>
          <li>Exclusive discounts with <a href="#">Tenac Partners</a></li>
          <li>
            <p></p>
          </li>
          <li class="gray"><a class="btn btn--blue" href="/contact-us">Contact Us to Sign Up</a></li>
        </ul>
      </div>
      <div class="flex-item">
        <ul class="package">
          <li class="header">Ultimate</li>
          <li class="gray">$ 374/month</li>
          <li>Set up fee waived</li>
          <li>Trainingpeaks Premium Account</li>
          <li>Goal Consultation</li>
          <li>Customized Annual Training Plan</li>
          <li>Coach Communication 2x Week*</li>
          <li>Training and Data Review 2x Week</li>
          <li>Schedule Adjustments 2x Week*</li>
          <li><a href="https://inscyd.com/" target="_blank" rel="noopener">INSCYD Testing</a> @ $225/Test</li>
          <li>Private Camp w/ Coach @ $300/day**</li>
          <li>Exclusive discounts with <a href="#">Tenac Partners</a></li>
          <li>
            <p></p>
          </li>
          <li class="gray"><a class="btn btn--blue" href="/contact-us">Contact Us to Sign Up</a></li>
        </ul>
      </div>
      <div class="flex-item">
        <ul class="package">
          <li class="header">Unlimited</li>
          <li class="gray">$ 599/month</li>
          <li>Set up fee waived</li>
          <li>Trainingpeaks Premium Account</li>
          <li>Goal Consultation</li>
          <li>Customized Annual Training Plan</li>
          <li><strong>Unlimited</strong> Coach Communication</li>
          <li><strong>Unlimited</strong> Training and Data Review</li>
          <li><strong>Unlimited</strong> Schedule Adjustments</li>
          <li><a href="https://inscyd.com/" target="_blank" rel="noopener">INSCYD Testing</a> 3x/Year</li>
          <li>Two Private Camp Days**</li>
          <li>Exclusive discounts with <a href="#">Tenac Partners</a></li>
          <li>Tenac Team Kit***</li>
          <li class="gray"><a class="btn btn--blue" href="/contact-us">Contact Us to Sign Up</a></li>
        </ul>
      </div>
    </div>
    <div class="footnotes">
      <p class="footnote">* Communication and schedule adjustments initiated by athlete.</p>
      <p class="footnote">** Private camps are held at coach's location.</p>
      <p class="footnote">*** Tenac Team Package includes hat, tshirt, annual team kit, and product from Tenac partners.</p>
    </div>

  </div>
</div>
<div class="borderDiv" style="height: 40px; background-color: #ffffff;"></div>
<?php get_footer(); ?>