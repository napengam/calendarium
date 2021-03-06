<h1>Simple Calendar / DatePicker </h1>

Example at <a href="http://hgsweb.de/calendarium/html">http://hgsweb.de/calendarium/html</a>

<h2>Usage</h2>
    
Have a look at the core of the HTML/index.html for the demo

```javascript
        <script src="../js/calendarium.js"></script>
        <script src="../js/myBackend.js"></script>
        <script>
            function cal(t) {
                    calendar.closeCalendar();
                    calendar.fetchCalendar(0, 0, t.id);
                }
            window.addEventListener('load', function () {
                calendar = hgsCalendar();
            });
        </script>
```
We are adding an anonymous  function to the window onload event, that gives us a pointer to the
calendar funtionality in js/calendarium.js
The code in js/myBackend.js is used inside calendarium.js to manage the trafic to and 
from the backend script php/calendarBackend.php that actually constructs the HTML for 
the calendar to show up on the client side. 

Next we find an input field like:
    
        <input type="text" name="i1" id="ii1" size="10" value="1.12.2015" onclick='cal(this);'>
    
When we click into this input field, the onclick function <i>cal</i> will be called with
<i>this</i> as a parameter that at runtime will point to the input field from wich the
function is called. This way we can access the actual <i>id</i> of the field that will
receive the date we pick from our calendar and pass this id on into 
<i>calendar.fetchCalendar</i>.

<h2>Inside calendar.fetchCalendar()</h2>

 calling our php back end 

```javascript
        jsonPost = {
            'y': y,
            'm': m,
            'target': target
        };
        callPHP.callDirect(backEnd, jsonPost, readResponse);
```

We just send the year and month we wnat to see a calendar, and the id of our target
that will receive the date that we will eventualy select from the calendar.

<h2>Inside our php backe end </h2>

constructing the HTML for the calendar and 
sending it back to the client.

<h2>Back inside calendar.js in readResponse(recPkg)</h2>
    
Here the calendar will be placed into a div

    calendar.innerHTML = recPkg.result;

and will be positioned below the input field with the id===target