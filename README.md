# CustomFields Plugin for CakePHP

A custom fields plugin for CakePHP 2.x. Now you can add custom fields to your CakePHP app and individual models/controllers without having to worry about database changes.

## How to Use

### Download or checkout

You can either download the ZIP file:
https://github.com/srs81/CakePHP-CustomFields/zipball/master

or checkout the code (leave the Password field blank):

```
git clone https://srs81@github.com/srs81/CakePHP-CustomFields.git
```

### Put it in the Plugin/ directory

Unzip or move the contents of this to "Plugin/CustomFields" under
the app root.

### Add to bootstrap.php load

Open Config/bootstrap.php and add this line:

```php
CakePlugin::load('CustomFields');
```

This will allow the plugin to load all the files that it needs.

### Add the custom fields for the models

Add the custom fields for the model(s) that you want to add. For instance, say you want to add the fields "author" and "publish_at" to your "Blog" model and a "date_of_birth" to a "User" model, you would add this:

```php
Configure::write('CustomFields', array(
	'Blog' => 'author, publish_at',
	'User' => 'date_of_birth'
));
```
You can add this to either APP/Config/bootstrap.php or APP/Plugin/CustomFields/Config/bootstrap.php .

### Create file directory

Make sure to create the correct files upload directory if it doesn't
exist already:
<pre>
cd cake-app-root
mkdir webroot/files/custom_fields
chmod -R 777 webroot/files/custom_fields
</pre>

The default upload directory is "files/custom_fields" under /webroot - but this can be changed (see FAQ below.) 

You don't have to give it a 777 permission - just make sure the web 
server user can write to this directory.

### Add to controller 

Add to Controller/AppController.php for use in all controllers, or 
in just your specific controller where you will use it as below:

```php
var $helpers = array('CustomFields.Field');
var $components = array('CustomFields.Field');
```

And to your add() / edit() functions, just after the ->save() function:

```php
$this->Field->save("Blog", $this->request->data);
```

### Add to views

Let's say you had a "blogs" table with a "id" primary key.

Add this to your View/Blogs/view.ctp:

```php
echo $this->Field->view('Blog', $blog['Blog']['id']);
```

and this to your View/Blogs/edit.ctp:

```php
echo $this->Field->edit('Blog', $this->Form->fields['Blog.id']);
```

## FAQ

#### Dude! No database/table schema changes?

Nope. :) Just drop this plugin in the right Plugin/ directory and add 
the code to the controller and views. Make sure the "files/custom_fields" 
directory under webroot is created and writable, otherwise custom fields 
won't save.

No tables/database changes are needed since the plugin uses a directory
structure based on the model name and id to save the appropriate files
 for the model.

#### Change directory

Are you stuck to the "files/custom_fields" directory under webroot? Nope.

Open up Config/bootstrap.php under the Plugin/CustomFields directory and change the "CF.directory" setting.

## ChangeLog

Version 1.0.0: April 10, 2012

## Future Work

I would like to eventually store the custom data into the database instead of a file, but that would involve more CakePHP complexity, as well as an initiliaztion script from the developer to set up the plugin-specific DB table. But it would help with analytics/reporting and pulling bulk custom data easily (for reporting, etc.)
 
## Support

If you find this plugin useful, please consider a [donation to Shen
Yun Performing Arts](https://www.shenyunperformingarts.org/support)
to support traditional and historic Chinese culture.


