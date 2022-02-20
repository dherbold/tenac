<h5 class="event-summary__title headline headline--small">
  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</h5>
<span>
  <?php
  $eventDate = new DateTime(get_field('event_date'));
  echo $eventDate->format('M')
  ?></span>
<span><?php echo $eventDate->format('d') ?></span>
<span><?php echo $eventDate->format('Y') ?></span>
<p>
  <?php if (has_excerpt()) {
    echo get_the_excerpt();
  } else {
    echo wp_trim_words(get_the_content(), 24);
  } ?>
</p>