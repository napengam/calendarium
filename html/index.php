<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <title>Calendar Test Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href = "../css/calendar.css" type = "text/css" rel = "stylesheet" >
    </head>
    <body>
        <div>
            <b>Ceck in </b>  <input type="text" name="i1" id="ii1" data-type='d' size="10" value="1.12.2015" onclick='cal(this);'>
             <b>Ceck out </b><input type="text" name="i2" id="ii2" data-type='d' size="10" value="1.10.2015" onclick='cal(this);'>
        </div>
        <script src="../js/calendarium.js"></script>
        <script src="../js/myBackend.js"></script>
        <script>
                var calendar = hgsCalendar();
                function cal(t) {
                    calendar.closeCalendar();
                    calendar.fetchCalendar(0, 0, t.id);
                }
        </script>
    </body>
</html>
