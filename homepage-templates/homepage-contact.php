<?php
// Set to false to revert to the Contact Form 7 form.
// $use_salesforce_form = false;
$use_salesforce_form = true;
?>
<section class="homepage-contact">

    <div data-aos="fade-up" data-aos-duration="1500" class="homepage-contact-contents">

        <div class="heading-text">
            <h2>Connect with Us</h2>
            <p>Connect with us to learn more about this Shang property.</p>
        </div>

        <div class="contact-form">
            <?php if ($use_salesforce_form): ?>
                <?php get_template_part('hardcode-templates/salesforce-contact-form'); ?>
            <?php else: ?>
                <?php echo do_shortcode('[contact-form-7 id="a4ced44" title="Homepage Contact Form"]'); ?>
            <?php endif; ?>
        </div>

    </div>

</section>