<?php

class hgsCalendar {

    function normDate($d, $m, $y) {
// german date
        return sprintf('%02s', $d) . '.' . sprintf('%02s', $m) . '.' . sprintf('%02s', $y);
//     usa date
//    return sprintf('%02s', $m) . '/' . sprintf('%02s', $d) . '/' . sprintf('%02s', $y);
//    mysql date
//    return sprintf('%02s', $y) . '-' . sprintf('%02s', $m) . '-' . sprintf('%02s', $d);
//   
    }

    function make_calendar($m, $y, $target) {
        /*
         * for number of days, months
         */
        $days_per_month = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $month = ['', 'Januar', 'Februar', 'M&auml;rz', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
        /*
         * set month and year to current date if not given;
         */
        $to = getdate();
        if ($m < 1 || $m > 12) {
            $m = $to["mon"];
        }
        if ($y <= 0) {
            $y = $to["year"];
        }
//
//                                    0 1 2 3 4 5 6 7                          
        $dstring = explode(" ", date("D d n Y W L w M", mktime(0, 0, 0, $m, 1, $y)));
        $days_per_month[2] += $dstring[5];

        $mp = $m - 1;
        $yp = $y;
        $yn = $y;
        if ($mp <= 0) { // previous month
            $mp = 12;
            $yp--;
        }
        $mn = $m + 1;
        if ($mn > 12) { // next month
            $mn = 1;
            $yn++;
        }
        /*
         * pointers to fetch previous month and next month
         * Will be augmented with onclick function by javaScript on the client side
         * see calendarium.js
         */
        $onclp = "<a href=# data-myv='$mp|$yp|$target' title='previous month' style='text-decoration:none;' >&lt;&lt;</a>";
        $oncln = "<a href=# data-myv='$mn|$yn|$target' title='next month' style='text-decoration:none;' >&gt;&gt;</a>";

        /*
         * here comes the header 
         */
        $calendar = [];
        $calendar[] = implode('',
                ["<table id=hgs_calendar style='background:white;font-size:0.8em;border: 1px solid black'>"
                    , "<tr style='background:silver'>"
                    , "<th>$onclp</th>"
                    , "<th colspan=4 align=center>" . $month[$dstring[2]] . " $y</th>"
                    , "<th>$oncln</th>"
                    , "<th style='cursor:pointer;color:white;background:darkred;' title=close><b id=close>X</th>"
                    , "</tr>"
                    , "<tr>"
                    , "<th>Mo</th><th>Di</th><th>Mi</th><th>Do</th><th>Fr</th><th>Sa</th><th>So</th>"
                    , "</tr>"
        ]);
        /*
         * dw= Numeric representation of the day of the week
         *  0 (for Sunday) through 6 (for Saturday)
         */
        $dw = $dstring[6];
        if ($dw == 0) {
            $dw = 7;
        }
        /*
         * leading days from previous month;
         */
        $npm = $days_per_month[$mp] - $dw + 2;
        $calendar[] = "<tr>";
        for ($j = 1; $j < $dw; $j++) {
            $d = $this->normDate($npm, $mp, $yp);
            $d = $calendar[] = "<td data-thedate=" . $d . " class=hgspcc>" . ($npm++) . "</td>";
        }
        /*
         * now comes the current month;
         */
        $n = $days_per_month[$m + 0];
        $br = $j;
        for ($j = 0; $j < $n; $j++) {
            $jj = $j + 1;
            $d = $this->normDate($jj, $m, $y);
            $calendar[] = "<td data-thedate=" . $d . " class=hgsacc >" . ($j + 1) . "</td>";
            $br++;
            $br = $br % 7;
            if ($br == 1) {
                $calendar[] = "</tr><tr>";
            }
        }
        /*
         *  trailing days into next month
         */
        for ($i = 1; $br > 1 && $br < 8; $br++) {
            $d = $this->normDate($i, $mn, $yn);
            $calendar[] = "<td data-thedate=" . $d . "  class=hgspcc>" . ($i++) . "</td>";
        }
        /*
         * close calendar table
         */
        $calendar[] = '</tr></table>';

        return implode('', $calendar);
    }

}
