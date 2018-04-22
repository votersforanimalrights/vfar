<?php
$className = '';
$suppress = array(
  'about-us',
  'may2circus',
  'launch',
  'donate',
  'launch-party-waiting-list',
  'volunteer',
  'events',
  'circusvote',
  'circusparty',
  'end-the-use-of-exotic-animals-in-the-circus',
  'action',
  'endorsements',
);
$show = ! ( is_category() || is_single() || (is_page() && in_array( get_post()->post_name, $suppress )) );
if ( $show && ( ! isset( $_COOKIE['splash'] ) || isset( $_GET['splash'] ) ) ) {
  $className = ' auto-modal';
}
?>
<div class="modal splash-modal<?php echo $className ?>">
  <div class="splash-wrapper">
    <span class="modal-close">
      <img src="/wp-content/themes/eshv/images/modal-close.png" />
    </span>
    <section>
      <h3>Stand Up for Animals!</h3>
      <p>Be part of the movement.</p>
    </section>
    <div id="modal-dynamic-section">
      <h3 class="eshv-join-header">Join Our Pack of Political Animals</h3>
      <script src="https://actionnetwork.org/widgets/v2/form/get-updates-from-empire-state-humane-voters?format=js&source=widget&can_widget_id=modal-form-id"></script>
      <div id="modal-form-id"></div>
    </div>
  </div>
</div>
<div class="modal animated-modal" id="bio-modal">
  <div class="modal-wrapper">
    <div class="modal-header-bar">
      <h4>Team Member Bio</h4>
    </div>
    <span class="modal-close">
      <img src="/wp-content/themes/eshv/images/modal-close.png" />
    </span>
    <section>
      <h3>Stand Up for Animals!</h3>
      <p>Be part of the movement.</p>
    </section>
  </div>
</div>
<div class="modal animated-modal" id="agenda-modal">
  <div class="modal-wrapper">
    <div class="modal-header-bar">
      <h4>Current Agenda Issue</h4>
    </div>
    <span class="modal-close">
      <img src="/wp-content/themes/eshv/images/modal-close.png" />
    </span>
    <section>
      <h3>Stand Up for Animals!</h3>
      <p>Be part of the movement.</p>
    </section>
  </div>
</div>
