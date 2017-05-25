<?php
$className = '';
$suppress = array(
  'may2circus',
  'launch',
  'donate',
  'launch-party-waiting-list',
  'volunteer',
  'action',
);
$show = ! ( is_category() || is_single() || (is_page() && in_array( get_post()->post_name, $suppress )) );
if ( $show && ( ! isset( $_COOKIE['splash'] ) || isset( $_GET['splash'] ) ) ) {
  $className = ' auto-modal';
}
?>
<div class="modal<?php echo $className ?>">
  <div class="modal-wrapper">
    <span class="modal-close">
      <img src="/wp-content/themes/eshv/images/modal-close.png" />
    </span>
    <section>
      <h3>Stand Up for Animals!</h3>
      <p>Be part of the movement.</p>
      <p>Pledge your vote<br/>for humane candidates.</p>
    </section>
    <div id="modal-dynamic-section">
      <h3 class="eshv-join-header">Join Our Pack of Political Animals</h3>
      <script src="https://actionnetwork.org/widgets/v2/form/get-updates-from-empire-state-humane-voters?format=js&source=widget&can_widget_id=modal-form-id"></script>
      <div id="modal-form-id"></div>
    </div>
  </div>
</div>
