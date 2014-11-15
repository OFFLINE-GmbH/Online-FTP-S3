jQueryFileTree
==============

jQuery File Tree is a configurable, AJAX file browser plugin for jQuery. This repo is a continuation of unmaintained jQuery File Tree (12 April 2008) by Cory S.N. LaViska at ABeautifulSite.net

jQuery File Tree requires at least jQuery 1.2

FEATURES
========
* Produces valid, semantic XHTML
* Fully customizable via CSS
* Ability to style icons based on file extension
* Uses AJAX to fetch file information on the fly
* Easy to configure and implement
* Includes connector scripts for PHP and ASP.NET (C#)
* Supports custom connector scripts for extended functionality
* Customizable expand/collapse event
* Customizable expand/collapse speeds
* Supports jQuery easing functions
* Single- and multi-folder views
* Configurable load message
* Multi-select select with checkboxes
* Supports event listening for callback hooks

CREATING A FILE TREE
====================

In it’s simplest form, you can create a file tree using the following code:

	$(document).ready( function() {
		$('.class').fileTree({ root: '/some/folder/' }, function(file) {
			alert(file);
		});
	});

Where .class is the class of an empty DIV element that exists on your page. The file tree will automatically load when your page loads. Any DIV elements with this class will share the same file tree.

CONFIGURING THE FILE TREE
=========================
Parameters are passed as an object to the fileTree()function. Valid options include:

<table>
	<tr>
		<th>Parameter</th><th>Description</th><th>Default Value</th>
	</tr>
	<tr> <td>root</td><td>root folder to display</td><td>/</td> </tr>
	<tr> <td>script</td> <td>location of the serverside AJAX file to use</td> <td>jqueryFileTree.php</td> </tr>
	<tr> <td>folderEvent</td> <td>event to trigger expand/collapse</td> <td>click</td> </tr>
	<tr> <td>expandSpeed</td> <td>Speed to expand branches (in ms); use -1 for no animation</td> <td>500</td> </tr>
	<tr> <td>collapseSpeed</td> <td>Speed to collapse branches (in ms); use -1 for no animatio</td> <td>500</td> </tr>
	<tr> <td>expandEasing</td> <td>Easing function to use on expand</td> <td>None</td> </tr>
	<tr> <td>collapseEasing</td> <td>Easing function to use on collapse</td> <td>None</td> </tr>
	<tr> <td>multiFolder</td> <td>Whether or not to limit the browser to one subfolder at a time</td> <td>true</td> </tr>
	<tr> <td>loadMessage</td> <td>Message to display while initial tree loads (can be HTML)</td> <td>"Loading..."</td> </tr>
	<tr> <td>multiSelect</td> <td>Append checkbox to each line item to select more than one</td> <td>false</td> </tr>

</table>

There are many options available, which would look something like this:

	$(document).ready( function() {
		$('.class').fileTree({
			root: '/some/folder/',
			script: 'jqueryFileTree.php',
			expandSpeed: 1000,
			collapseSpeed: 1000,
			multiFolder: false
		}, function(file) {
			alert(file);
		});
	});


STYLING THE FILE TREE
=====================
The file tree relies 100% on CSS for styling. Refer to jqueryFileTree.css to make any changes to the default styling.


CONNECTOR SCRIPTS
=================
jQuery File Tree comes with a handful of serverside connector scripts that are used to read the file system on your server and return data to the clientside script via AJAX. The default connector script is jqueryFileTree.php. You can use a connector script for another language by setting the script parameter to the location of the script you want to use (see Configuring the File Tree). Alternatively, you can build a custom connector script to extend the functionality of jQuery File Tree to better suit your needs (see Custom Connector Scripts).

Connector scripts for the following languages are provided:

* PHP by Cory LaViska (originally)
* ASP (VBS) by Chazzuka
* ASP.NET (C#) by Andrew Sweeny
* ColdFusion by Tjarko Rikkerink
* JSP by Joshua Gould
* Lasso by Marc Sabourdin
* Lasso by Jason Huck
* Perl by Oleg Burlaca
* Python/Django by Martin Skou
* Ruby by Erik Lax

(DAVE)
Note that all of the connector scripts have been left unmaintained outside of the PHP one in which I have updated (and will continue to do so). If you've improved or created a connector, feel free to add it to this repo.


CUSTOM CONNECTOR SCRIPTS
========================
You can create a custom connector script to extend the functionality of the file tree. The easiest way to do this is probably by modifying one of the scripts supplied in the download. If you want to start from scratch, your script should accept one POST variable (dir) and output an unsorted list in the following format:

	<ul class="jqueryFileTree">
		<li class="directory collapsed"><a href="#" rel="/this/folder/">Folder Name</a></li>
		(additional folders here)
		<li class="file ext_txt"><a href="#" rel="/this/folder/filename.txt">filename.txt</a></li>
		(additional files here)
	</ul>

Note that the corresponding file extension should be written as a class of the li element, prefixed with ext_. (The prefix is used to prevent invalid class names for file extensions that begin with non-alpha characters.)

Additionally you may choose to enable multi-select, which appends a checkbox to each item. Visible child elements will automatically be checked/unchecked along with the parent. Currently this is only supported in PHP; feel free to update other connectors to reflect the following format:

	<ul class="jqueryFileTree">
		<li class="directory collapsed"><input type='checkbox' /><a href="#" rel="/this/folder/">Folder Name</a></li>
		(additional folders here)
		<li class="file ext_txt"><input type='checkbox' /><a href="#" rel="/this/folder/filename.txt">filename.txt</a></li>
		(additional files here)
	</ul>


CALLBACK HOOKS
=========================
jQuery File Tree now supports binding event listeners to the file tree element

```javascript
$('.filetree')
	.on('filetreeexpand', function (e, data)	{ console.log(data); })
	.on('filetreeexpanded', function (e, data)	{ console.log(data); })
	.on('filetreecollapsed', function (e, data)	{ console.log(data); })
	.on('filetreecollapse', function (e, data)	{ console.log(data); })
	.on('filetreechecked', function (e, data)	{ console.log(data); })
	.on('filetreeunchecked', function (e, data)	{ console.log(data); })
	.on('filetreeclicked', function(e, data)	{ console.log(data); });
```

All return the data object with the following properties

<table>
<tr>
	<th>Property</th><th>Value</th>
</tr>
<tr> <th>li</th><th>LI jQuery object</th> </tr>
<tr> <th>type</th><th>file | directory</th> </tr>
<tr> <th>value</th><th>name of the file or directory</th> </tr>
<tr> <th>rel</th><th>relative path to file or directory</th> </tr>
<tr> <th>trigger</th><th>type of trigger called</th> </tr>
</table>

Pretty much has the information you need, but I included the LI object anyways so you can easily get any other data you want with something like ``` data.li.prop('class') ```

LICENSING & TERMS OF USE
========================
This plugin is dual-licensed under the GNU General Public License and the MIT License and is copyright 2008 A Beautiful Site, LLC.


SPECIAL THANKS
==============
A special thanks goes out to [FAMFAMFAM](http://www.famfamfam.com/) for their excellent Silk Icon Set.
