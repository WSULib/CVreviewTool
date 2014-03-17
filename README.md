CVreviewTool
============

<p>A tool designed to help librarians research self-archiving policies around faculty publications, and aggregate those results in a tidy, edit-able PDF or HTML report that can be sent directly to faculty.  For institutions conducting "CV reviews", this workflow likely sounds familiar.   The tool is web-based, with a MySQL backend, and pulling in publisher policies via the SHERPA/RoMEO freely available API.</p>

<h1>Installation Instructutions:</h1>

<h3>Edit configuration files</h3>
<ul>
	<li>rename config/app_config.php.example to app_config.php, changing values where desired</li>
	<li>rename config/db_config.php.example to db_config.php, reflecting the database, username, and password created in MySQL</li>
</ul>

<h3>Prepare MySQL</h3>
<ul>
	<li>Log into mysql with as root or with administrator privileges.</li>
	<li>Create database:
		<ul>			
			<li><em>CREATE DATABASE CVreviewTool;</em></li>
		</ul>
	</li>
	<li>Create user:
		<ul>
			<li><em>GRANT ALL PRIVILEGES ON CVreviewTool.* TO CVreviewTool@localhost IDENTIFIED BY '[PASSWORD FROM config/db_config.php]';</em></li>
		</ul>
	</li>
</ul>


