blockinfo
=========

Block info plugin for dokuwiki

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

See config/default.php for configuration options.

Note that options will not come into effect until you edit and save an article. This has to be done for each article separately.

It's strongly advised that you tweak the options to your liking BEFORE adding lots of contents.

Option overrides
=========

You can override options set in conf/default.php by using following syntax:

&lt;_option_name: option_value&gt;

For example, to override default attribute uppercase rule and set it to all caps:

&lt;_attr_uppercase: all&gt;

For the list of supported options refer to file conf/default.php



