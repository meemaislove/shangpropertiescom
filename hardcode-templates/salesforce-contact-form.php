<?php
// Salesforce Web-to-Lead form, styled to match the CF7 homepage form.
$thank_you_url = home_url('/thank-you/');
$property_name = 'Shang Properties';
?>
<style>
    /* Scoped so nothing leaks into the CF7 form or the rest of the page */
    form.sales--force__form select.wpcf7-select {
        display: block;
        width: 100%;
        appearance: none;
        -webkit-appearance: none;
        /* Match height, border, padding, background to your CF7 text inputs */
    }
    form.sales--force__form .g-recaptcha {
        margin-bottom: 25px;
    }
</style>

<div class="wpcf7 sf-contact">
  <div>
    <form class="sales--force__form"
          action="https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8"
          method="post">

      <input type="hidden" name="oid" value="00D2w00000QudXN">
      <input type="hidden" name="recordType" id="recordType" value="0122w000002IZuY">
      <input type="hidden" name="lead_source" value="Website - Shangproperties">
      <input type="hidden" name="retURL" value="<?= esc_url($thank_you_url); ?>">
      <input type="hidden" name="Hotel_Type__c" value="<?= esc_attr($property_name); ?>">

      <span class="wpcf7-form-control-wrap">
        <input class="wpcf7-form-control wpcf7-text" type="text" name="first_name"
               maxlength="40" placeholder="First Name*" required>
      </span>

      <span class="wpcf7-form-control-wrap">
        <input class="wpcf7-form-control wpcf7-text" type="text" name="last_name"
               maxlength="80" placeholder="Last Name*" required>
      </span>

      <span class="wpcf7-form-control-wrap">
        <input class="wpcf7-form-control wpcf7-text wpcf7-email" type="email" name="email"
               placeholder="Email*" required>
      </span>

      <span class="wpcf7-form-control-wrap">
        <input class="wpcf7-form-control wpcf7-text wpcf7-tel" type="tel" name="phone"
               placeholder="Mobile Number*" required>
      </span>

      <span class="wpcf7-form-control-wrap">
        <select class="wpcf7-form-control wpcf7-select" id="00N2w00000b6P0N"
                name="00N2w00000b6P0N" title="Subject" required>
          <option value="" disabled selected>Subject*</option>
          <option value="General Inquiry">General Inquiry</option>
          <option value="Unit Reservation">Unit Reservation</option>
        </select>
      </span>

      <span class="wpcf7-form-control-wrap">
        <textarea class="wpcf7-form-control wpcf7-textarea" name="description"
                  cols="40" rows="10" maxlength="2000" placeholder="Remarks*" required></textarea>
      </span>

      <input type="hidden" name="captcha_settings"
             value='{"keyname":"SPI_reCAPTCHA","fallback":"true","orgId":"00D2w00000QudXN","ts":""}'>
      <div class="g-recaptcha" data-sitekey="6Ldx_CEnAAAAAI_CVznzu--GDTQGg9f-m_b2egzf"></div>

      <input class="wpcf7-form-control wpcf7-submit standard-btn custom-yellow"
             type="submit" value="Submit">
    </form>
  </div>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>