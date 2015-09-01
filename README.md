<h1>Simple Calendar / DatePicker </h1>

Example at <a href="http://hgsweb.de/calendarium/html">http://hgsweb.de/calendarium/html</a>

<h2>Usage</h2>
    
    have a look at the core of the HTML for the demo
```javascript
        <script src="../js/calendarium.js"></script>
        <script src="../js/myBackend.js"></script>
        <script>
            function addEvent(obj, ev, fu) {
                if (obj.addEventListener) {
                    obj.addEventListener(ev, fu, false);
                } else {
                    var eev = "on" + ev;
                    obj.attachEvent(eev, fu);
                }
            }
            function cal(t) {
                calendar.closeCalendar();
                calendar.fetchCalendar(0, 0, t.id);
            }
            addEvent(window, 'load', function () {
                calendar = hgsCalendar();
            });
        </script>
```
We are adding an anonymous  function to the window onload event, that gives us a pointer to the
calendar funtionality in js/calendarium.js
The code in js/myBackend.js is used inside calendarium.js to manage the trafic to and 
from the backend script php/calendarBackend.php that actually constructs the HTML for 
the calendar to show up on the client side. 