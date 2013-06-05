blockinfo
=========

Block info plugin for dokuwiki

Installation
=========

You can install this plugin by pasting this URL into dokuwiki's plugin manager:

<a href="https://github.com/Onyx47/blockinfo/archive/master.zip">https://github.com/Onyx47/blockinfo/archive/master.zip</a>

You can also manually copy all the files to:

<strong>DOKUWIKI_ROOT/lib/plugins/blockinfo</strong>

Usage
=========

Use the following syntax on your page:

&lt;blockinfo&gt;<br>
[&lt;_option_name: option_value&gt;]<br>
[&lt;name: Block name&gt;]<br>
[&lt;image: {{ :namespace:image }} or url&gt;]<br>
[&lt;attribute: value&gt;]<br>
&lt;/blockinfo&gt;<br>

Only use one attribute: value pair per line.

No attributes are required, but it is recommended to use at least &lt;name&gt; attribute to set the proper header for the box.

You can use as many custom attributes as you want. You can also use dokuwiki syntax for any value or attribute if syntax parsing is enabled in config.

Configuration
=========

See <strong>DOKUWIKI_ROOT/lib/plugins/blockinfo/config/default.php</strong> for configuration options.

Note that options will not come into effect until you edit and save an article. This has to be done for each article separately.

It's strongly advised that you tweak the options to your liking BEFORE adding lots of contents.

Option overrides
=========

You can override options set in <strong>DOKUWIKI_ROOT/lib/plugins/blockinfo/conf/default.php</strong> by using following syntax:

<strong>&lt;_option_name: option_value&gt;</strong>

For example, to override default attribute uppercase rule and set it to all caps:

<strong>&lt;_attr_uppercase: all&gt;</strong>

For the list of supported options refer to file <strong>DOKUWIKI_ROOT/lib/plugins/blockinfo/conf/default.php</strong>

Custom CSS
========

You can set custom CSS styles in following files:

<strong>DOKUWIKI_ROOT/lib/plugins/blockinfo/screen.css</strong> for regular website display<br>
<strong>DOKUWIKI_ROOT/lib/plugins/blockinfo/style.css</strong> for other uses

