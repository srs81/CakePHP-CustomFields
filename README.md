# CustomFields Plugin for CakePHP

A custom fields plugin for CakePHP 2.x. Now you can add custom fields to your CakePHP app and individual models/controllers.

## How to Use

### Download or checkout

You can either download the ZIP file:
https://github.com/srs81/CakePHP-CustomFields/zipball/master

or checkout the code (leave the Password field blank):

```
git clone https://srs81@github.com/srs81/CakePHP-CustomFields.git
```

### Put it in the Plugin/ directory

Unzip or move the contents of the plugin to "Plugin/CustomFields" under
the app root.

### Add to bootstrap.php load

Open Config/bootstrap.php and add this line:

```php
CakePlugin::load('CustomFields');
```

This will allow the plugin to load all the files that it needs.

### Create two tables in your database

This plugin now uses database tables to read list of custom fields, and to store them. Create these two tables, using 
the MySQL commands below.

```sql
--
-- Table structure for table `custom_fields`
--
CREATE TABLE IF NOT EXISTS `custom_fields` (
`id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `field_name` varchar(255) NOT NULL
);
ALTER TABLE `custom_fields` ADD PRIMARY KEY (`id`), ADD KEY `model_name` (`model_name`);
ALTER TABLE `custom_fields` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Table structure for table `custom_field_values`
--
CREATE TABLE IF NOT EXISTS `custom_field_values` (
`id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL
);
ALTER TABLE `custom_field_values` 
  ADD PRIMARY KEY (`id`), ADD KEY `model_name` (`model_name`), 
  ADD KEY `model_id` (`model_id`), ADD KEY `field_name` (`field_name`);
ALTER TABLE `custom_field_values` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```

### Add the custom fields for the models

Add the custom fields for the model(s) that you want to add in the database table. For instance, say you want to add the fields "Author" and "Publish_At" to your "Blog" model, run this SQL on your database table:

```sql
INSERT INTO `custom_fields` (`id`, `model_name`, `field_name`) VALUES (NULL, 'Blog', 'Author');
INSERT INTO `custom_fields` (`id`, `model_name`, `field_name`) VALUES (NULL, 'Blog', 'Publish_At');
```

### Add to controller 

Add to Controller/AppController.php for use in all controllers, or 
in just your specific controller where you will use it as below:

```php
var $helpers = array('CustomFields.Field');
var $components = array('CustomFields.Field');
```

And to your add() / edit() functions, as the first sentence under the ->save() function:

```php
$this->Field->save("Blog", $this->request->data);
```

### Add to views

Let's say you had a "blogs" table with a "id" primary key.

Add this to your View/Blogs/view.ctp, in the dl:

```php
echo $this->Field->view('Blog', $blog['Blog']['id']);
```

and this to your View/Blogs/edit.ctp, within the fieldset tag:

```php
echo $this->Field->edit('Blog', $this->Form->fields['Blog.id']);
```

## FAQ

#### I need a database table?

Two database tables actually, "custom_fields" for the list of custom fields corresponding to the model, and
"custom_field_values" for the list of actual values that are saved and loaded.

## ChangeLog

Version 1.1.0: August 4, 2015, now loads and saves from database
Version 1.0.0: April 10, 2012, initial launch


## Support

If you find this plugin useful, please consider a [donation to Shen
Yun Performing Arts](https://www.shenyunperformingarts.org/support)
to support traditional and historic Chinese culture.


