<?php echo $this->Html->script('jquery-ui-1.9.1.custom.min.js'); ?>
<?php echo $this->Html->script('chosen.jquery.min.js'); ?>
<?php echo $this->Html->script('modernizr.custom.js'); ?>
<?php echo $this->Html->css('chosen.css'); ?>
<?php echo $this->Html->css('jquery-ui-1.9.1.custom.min.css'); ?>
<?php echo $this->Html->css('retrotrack_display.css'); ?>
<script type="text/javascript">
<?php 
// Include the retroTrack display javascript
$default_elements = (isset($default_elements))?$default_elements:'';
echo $this->element('retrotrack_javascript');
?>

$().ready(function(){
  // Configure retroTrack
  retroTrack_interface.setupConfiguration('<?php echo $satellite_json; ?>', '<?php echo $group_json; ?>', '<?php echo $station_json; ?>', '<?php echo $default_elements; ?>', '<?php echo $tle_json; ?>', '<?php echo $configuration_json; ?>', '<?php echo Router::url('/', true); ?>');
  
  // Start retroTrack
  retroTrack_interface.startTracker();
  
  // Toggle the embed code display
  $("#embed_link").click(function(){
    $("#embed_form").toggle(200);
  });
});
</script>

<div style="width: 860px; margin: 0px auto 0px auto;">
  <?php if(!empty($page_title)): ?>
      <div class="page_title"><?php echo $page_title; ?></div>
  <?php endif; ?>
  <!-- START retroTrack Display -->
  <div id="rt_tracker_container">
      <!-- START top menu bar -->
      <div id="rt_top_menu">
          <div style="float: left;">
              <ul id="rt_top_controls">
                  <li><a id="rt_show_menu_satellites" rel="rt_menu_satellites">Satellites</a></li>
                  <li><a id="rt_show_menu_groups" rel="rt_menu_groups">Satellite Groups</a></li>
                  <li><a id="rt_show_menu_options" rel="rt_menu_options">Options</a></li>
              </ul>
          </div>
          <div style="float: right;">
            <ol id="rt_satellite_parameters"></ol>
          </div>
          <div style="clear: both;"></div>
      </div>
      <div id="rt_menu_satellites" class="rt_menu_pane">
          <div class="rt_menu_pane_header">Select the satellites you would like to display.</div>
          <select name="rt_satellite_list" multiple="multiple" id="rt_satellite_list" data-placeholder="Select some satellites" style="width: 835px;"></select>
          <div style="clear:both;"></div>
      </div>
      <div id="rt_menu_groups" class="rt_menu_pane">
          <div class="rt_menu_pane_header">Select the groups you would like to display.</div>
          <select name="rt_group_list" multiple="multiple" id="rt_group_list" data-placeholder="Select some satellite groups" style="width: 835px;"></select>
          <div style="clear:both;"></div>
      </div>
      <div id="rt_menu_options" class="rt_menu_pane">
          <div class="rt_menu_pane_header">Click on any of the options below to toggle them.</div>
          <ol id="rt_option_list" class="rt_menu_list">
              <li id="rt_show_sun">Disable Sun</li>
              <li id="rt_show_grid">Disable Grid</li>
              <li id="rt_show_satellite_names">Hide Satellite Names</li>
              <li id="rt_show_path">Hide Satellite Path</li>
              <li id="rt_show_satellite_footprint">Hide Satellite Footprint</li>
              <li id="rt_show_station_footprint">Hide Station Footprint</li>
              <li id="rt_show_station_names">Hide Station Names</li>
          </ol>
          <div style="clear:both;"></div>
      </div>
      <!-- END top menu bar -->
      
      <!-- START primary display canvas -->
      <canvas id="rt_tracker_canvas" width="860px" height="430px" style="border: 1px solid #071831;border-width: 0px 1px 0px 1px;display: block;"></canvas>
      <!-- END primary display canvas -->
      
      <!-- START bottom menu bar -->
      <div id="rt_menu_stations" class="rt_menu_pane">
          <div class="rt_menu_pane_header">Select the ground stations you would like to display.</div>
          <select name="rt_station_list" multiple="multiple" id="rt_station_list" data-placeholder="Select some ground stations" style="width: 835px;"></select>
          <div style="clear:both;"></div>
      </div>
      <div id="rt_bottom_menu">
          <div style="float: left;">
              <ul id="rt_bottom_controls">
                  <li><a id="rt_show_menu_stations" rel="rt_menu_stations">Ground Stations</a></li>
              </ul>
          </div>
          <div style="float: left; margin-left: 20px;">
              <ol id="rt_station_parameters"></ol>
          </div>
          <div style="float: right;">
            <div id="rt_top_clock">-</div>
          </div>
          <div style="clear: both;"></div>
      </div>
      <!-- END bottom menu bar -->
  </div>
  <!-- END retroTrack Display -->
  
  <!-- Display the embed link -->
  <div style="margin-top: 6px;">
    <a id="embed_link" class="embed_link">[Embed This <?php echo Configure::read('Website.name'); ?> Display]</a>
    <div id="embed_form" class="embed_form">
      <?php
      // Generate a URL string for the satellites and groups
      $satellites = json_decode(str_replace("\'", "'", $satellite_json), true);
      $satellite_names = array();
      foreach ($satellites as $satellite){
        array_push($satellite_names, rawurlencode($satellite['name']));
      }
      $satellite_string = join('_', $satellite_names);
      
      $groups = json_decode(str_replace("\'", "'", $group_json), true);
      $group_names = array();
      foreach ($groups as $group){
        array_push($group_names, rawurlencode($group['name']));
      }
      $group_string = join('_', $group_names);
      ?>
      To embed this retroTrack display on your website, copy the HTML below and paste it where you want the tracker to appear.
      <textarea rows="3">&lt;script src="<?php echo Router::url('/', true); ?>embed.js?satellites=<?php echo $satellite_string; ?>&groups=<?php echo $group_string; ?>" type="text/javascript"&gt;&lt;/script&gt;&lt;div id="retroTrack_embed"&gt;&lt;/div&gt;</textarea>
    </div>
  </div>
</div>

<!-- START Loading Modal -->
<div id="rt_load_modal" title="Initializing <?php echo Configure::read('Website.name'); ?>">
    <p>
      <?php echo Configure::read('Website.name'); ?> is currently being initialized. Please stand by.<br /><br />
      <div style="padding: 10px 0px 10px 0px;">
        <span style="font-style: italic;">Progress: </span> <span id="rt_load_progress_message"></span>
      </div>
      <div id="rt_load_bar"></div>
    </p>
</div>
<!-- END Loading Modal -->

<!-- START Canvas Support Modal -->
<div id="rt_canvas_modal" title="Your browser does not support HTML5 canvas.">
    <p>The browser you are currently using does not appear to support HTML5 canvas, which is required to render <?php echo Configure::read('Website.name'); ?>. You may continue anyway, but be aware retroTrack may not behave as intended. We recommend switching to a more modern browser.</p>
    <center>
        <div class="rt_browser_warning_box">
            <a href="https://www.google.com/intl/en/chrome/browser/" style="color: #666666;">
                <?php echo $this->Html->image('browser_chrome.gif'); ?><br />Google Chrome 4.0+
            </a>
        </div>
        <div class="rt_browser_warning_box">
            <a href="http://www.mozilla.org/en-US/firefox/new/" style="color: #666666;">
                <?php echo $this->Html->image('browser_firefox.gif'); ?><br />Mozilla Firefox 2.0+
            </a>
        </div>
    </center>
</div>
<!-- END Canvas Support Modal -->
