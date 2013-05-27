blockinfo
=========

Block info plugin for dokuwiki

Usage
=========

Use the following synatx on your page:

&lt;blockinfo&gt;<br>
&lt;name: Block name&gt;<br>
&lt;image: [{{ :namespace:image }} or url]&gt;<br>
[&lt;attribute: value&gt;]<br>
&lt;/blockinfo&gt;<br>

Only use one attribute: value pair per line.

No attributes are required, but it is recommended to use at least &lt;name&gt; attribute to set the proper header for the box.

You can use as many custom attributes as you want. You can also use dokuwiki syntax for any value.
