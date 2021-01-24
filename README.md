# MFSG_CMS
Content management system created for the subject of laboratories "Content management systems".

<b>Instalacja systemu</b>
<ol>
    <li>Clone project repository to the XAMPP htdocs folder</li>
    <li>You must have composer installed, if not, download it from here: <a href="https://getcomposer.org/">https://getcomposer.org/</a></li>
    <li>
        Downloading packages using composer
        <ul>
            <li>The first download of packages for a project is done by entering the command:
                 <pre>composer install</pre>
            </li>
            <li>If we only update packages (i.e. each not the first Composer call in a given project), then the command should be executed:
                 <pre>composer update</pre>
            </li>
        </ul>
    </li>
    <li>
        After downloading the packages with Composer, we can set the local configuration of the project. We execute the command:
        <pre>./init</pre>
        or just:
        <pre>init</pre>
        working on Windows. Next we select the "Development" option.
    </li>
    <li>Create your local database `mfsg_cms` with `utf8_general_ci` encoding</li>
    <li>Edit your database setup in `/common/config/main-local.php`</li>
    <li>Execute initial migrations typing:
        <pre>./yii migrate</pre>
    </li>
</ol>

<b>Additional informations:</b><br/><br/>
<b>Migrations</b> allow you to control the structure and content of the database with the cooperation of several people on the project.
<br/> Migrations are in `/console/migrations` folder
<br/>Creating a migration:
<pre> ./yii migrate/create migration_name </pre>
Running the migration:
<pre> ./yii migrate </pre>
Reverting Migrations:
<pre> ./yii migrate/down 1 </pre>

