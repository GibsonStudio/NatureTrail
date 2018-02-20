

<div class="content_box" style="background:#b8e2f6;">
	<h2>Change Log</h2>
	<p>This is a list of any changes to the source code. If you have any other change requests / bugs to report, 
	please use the <?php echo anchor('bug_tracker/add', 'Bug Tracker'); ?></p>
</div>

<div class="content_box">
	<h3>10<sup>th</sup> March 2015</h3>
	<ul>
		<li>Fixed user search in IE8 (var prefix needed in usersearch.js).</li>
	</ul>
</div>

<div class="content_box">
	<h3>5<sup>th</sup> November 2014</h3>
	<ul>
		<li>style.css: big update to blue theme.</li>
		<li>Change view: block/viewall</li>
		<li>Added $this->data_model->get_position_string()</li>
	</ul>
</div>

<div class="content_box">
	<h3>8<sup>th</sup> October 2014</h3>
	<ul>
		<li>Added $this->require_login() to $this->user_model->require_permission().</li>
		<li>Added cs_config MVC</li>
	</ul>
</div>


<div class="content_box">
	<h3>7<sup>th</sup> October 2014</h3>
	<ul>
		<li>Permanently deleting a user account now removes any group memberships for that userid.</li>
		<li>Deleting a group now also deletes any group memberships.</li>
	</ul>
</div>


<div class="content_box">
	<h3>24<sup>th</sup> September 2014</h3>
	<ul>
		<li>Added group list back to user profile page - lists all groups user is a member of.</li>
	</ul>
</div>


<div class="content_box">
	<h3>23<sup>rd</sup> September 2014</h3>
	<ul>
		<li>Added this changelog (how meta)</li>
		<li>Fixed language issue when assigning permissions.</li>
		<li>Added log purge.</li>
		<li>Started re-working groups. {pre}user.groupid will no longer be used. Group membership is to be stored in the {pre}group_membership.</li>
	</ul>
</div>