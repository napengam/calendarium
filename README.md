<h1>Simple Calendar / DatePicker </h1>

Example at <a href="http://hgsweb.de/calendarium/html">http://hgsweb.de/calendarium/html</a>

<h2>Usage</h2>
    
    have a look at the core of the HTML fo the demo:
<pre>
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
</pre>
We are adding a fucntion to window onload event that gives us a pointer to the
calendar funtionality in calendarium.js
The code in myBackend.js is used inside calendarium.js to manage the trafic to and 
from the backend script calendarBackend.php that actually constructs the HTNL for 
the calenar to show up on the cleint side. 