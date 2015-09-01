vertical
========

rotate table header cell 90 degree 

As of 12 March 2015 this is working with IE11, Opera 28, FF 36 and Chrome 41.

A demo is located at <a href="http://hgsweb.de/vertical">hgsweb.de/vertical</a>

How to instrument your table:
<ul>
<li>Give your tabel an ID like &lt;table id=tab1>
<li>Add 'data-rotate' as an attribute to cells you want to rotate<br>
like &lt;th data-rotate>rotate &lt;/th>
<li>include the given CSS class .hgs_rotate
<li> Add an event handler for the load event. Inside this handler<br>
call  <code> rotateHeadCell('tab1');  </code>
</ul>

Logic
=====

The table is located using the given id.
If the first cell of a row is of type TH the 
iteration looks for cells with a data attribute of <code>data-rotate</code>.
The content of these cells is wrapped within a DIV that has the
class <code>.hgs_rotate</code> assigned. This performs the rotation.
<p>
When rotating the content, the current  width of the above DIV will become the new cell height.
The cell height for all cells will be set to the highest value found during iteration.
Using <code> whitespace:nowrap</code> allows to set the width of the enclosing div to the
original height of the content. This way the table cell will shrink down to this new width
if possible.
