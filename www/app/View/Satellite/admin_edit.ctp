<?php
$this->extend('/Common/admin_panel');

$this->start('panel_content');
?>
<h3>Editing the '<?php echo $satellite['Satellite']['name']; ?>' Satellite</h3>
Use the form below to edit the satellite.
<div style="width: 70%; margin-top: 10px;">
    <form action="<?php echo $this->webroot; ?>admin/satellite/<?php echo $satellite['Satellite']['id']; ?>/edit" method="POST" class="form-horizontal">
        <div class="control-group">
            <label class="control-label" for="satellite_name">Satellite Name</label>
            <div class="controls">
                <?php echo $satellite['Satellite']['name']; ?>
                <p class="help-block">The name can not be changed because it is tied to a TLE entry. To change this, re-create the satellite.</p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="satellite_description">Satellite Description</label>
            <div class="controls">
                <textarea name="satellite_description"><?php echo $satellite['Satellite']['description']; ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="show_on_home">Show on Homepage</label>
            <div class="controls">
                <input type="checkbox" name="show_on_home" <?php if ($satellite['Satellite']['show_on_home']){echo "checked='checked'";} ?>/>
                <p class="help-block">If this is checked, the satellite will be displayed on the main homepage tracker. Note the satellite will also be shown if any of its groups are on the homepage.</p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="default_on_home">Default on Homepage</label>
            <div class="controls">
                <input type="checkbox" name="default_on_home" <?php if ($satellite['Satellite']['default_on_home']){echo "checked='checked'";} ?>/>
                <p class="help-block">If this is checked, the satellite will be active (i.e. selected by default) on the homepage. Note this only takes effect if the satellite is visible on the homepage (via the setting above or the satellite's groups).</p>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Static Link</label>
            <div class="controls">
                <?php echo $this->Html->link('View Satellite', array('controller' => 'display', 'action' => 'satellite_display', urlencode($satellite['Satellite']['name']), 'admin' => false), array('class'=>'link', 'target'=>'_blank')); ?>
                <p class="help-block">Use this to link directly to the tracker for this satellite.</p>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Edit Satellite</button>
        <a href="<?php echo $this->webroot; ?>admin/satellite/<?php echo $satellite['Satellite']['id']; ?>/delete" class="btn btn-danger">Delete Satellite</a>
    </form>
</div>
<?php
$this->end();
?>

