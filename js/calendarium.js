/* 
 * ************************************************************************
 calendarium 2.0 Copyright (c) 2012-2015 Heinrich Schweitzer
 Contact me at hgs@hgsweb.de
 This copyright notice MUST stay intact for use.
 
 Permission is hereby granted, free of charge, to any person obtaining
 a copy of this software and associated documentation files (the
 'Software'), to deal in the Software without restriction, including
 without limitation the rights to use, copy, modify, merge, publish,
 distribute, sublicense, and/or sell copies of the Software, and to
 permit persons to whom the Software is furnished to do so, subject to
 the following conditions:
 
 The above copyright notice and this permission notice shall be
 included in all copies or substantial portions of the Software.
 
 THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
 EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *************************************************************************
 ** */

function hgsCalendar() {
    'use strict';
    var
            calendar = document.body.appendChild(document.createElement('div')),
            backEnd = '../php/calendarBackend.php',
            callPHP = new myBackend(),
            gtarget;

    //////////////////////

    function gebi(id) {
        return document.getElementById(id);
    }
    function fetchCalendar(m, y, target) {
        /////////////////////////////////////////////////////////
        // m=month
        // y=year
        // target= id of input field to place selected date
        /////////////////////////////////////////////////////////
        var jsonPost, vv, avv, v;

        gtarget = target;
        if (m === 0 || y === 0) {
            v = gebi(target);
            vv = v.value;
            if (vv.length > 0) {
                avv = vv.split('.');
                m = avv[1];
                y = avv[2];
            }
        }
        jsonPost = {
            'y': y,
            'm': m,
            'target': target
        };
        callPHP.callDirect(backEnd, jsonPost, readResponse);
        return false;
    }
    function closeCalendar() {
        if (calendar) {
            calendar.style.display = 'none';
        }
    }

    function readResponse(recPkg)
    {
        var obj, alist, absOffset = {};

        calendar.style.position = 'absolute';
        calendar.style.display = 'block';
        calendar.innerHTML = recPkg.result; // render calendar
        calendar.style.left = '0px'; // move
        calendar.style.top = '0px'; // move
        calendar.style.width = 'auto'; // shrink to fit 
        calendar.style.width = calendar.clientWidth + 'px'; // freeze size, now we can move it anywhere;
        // get position of input box              
        obj = gebi(gtarget);
        absOffset = getAbsOff(obj);
        // move calendar below input box
        calendar.style.left = absOffset.x + 'px';
        calendar.style.top = absOffset.y + obj.clientHeight + 'px';
        calendar.onclick = table_callback;
        /*
         * provide previous and next link with onclick function
         * to fetch the related calendar from backend.
         */
        alist = calendar.getElementsByTagName('a'); // we only deal with the first two

        alist[0].onclick = function () {
            var myv = this.getAttribute('data-myv').split('|');
            fetchCalendar(myv[0], myv[1], myv[2]);
        };
        alist[1].onclick = function () {
            var myv = this.getAttribute('data-myv').split('|');
            fetchCalendar(myv[0], myv[1], myv[2]);
        };
    }
    function table_callback(e) {

        var obj, theDate;
        if (!e) {
            e = window.event;
        }
        obj = (e.target) ? e.target : e.srcElement;
        if (obj.id === 'close') {
            closeCalendar();
            return;
        }
        theDate = obj.getAttribute('data-thedate');
        if (theDate === null) {
            return;
        }
        gebi(gtarget).value = theDate;
        calendar.style.display = 'none';
        if (typeof gebi(gtarget).onchange === 'function') {
            gebi(gtarget).onchange();
        }
    }
    function getAbsOff(obj) {// return absolute x,y position of obj
        var ob, x = obj.offsetLeft, y = obj.offsetTop;
        ob = obj.offsetParent;
        while (ob !== null && ob.tagName !== 'BODY') {
            x += ob.offsetLeft;
            y += ob.offsetTop;
            ob = ob.offsetParent;
        }
        return {'x': x, 'y': y};
    }

    function setBackEnd(path) {
        backEnd = path;
    }
    return {
        fetchCalendar: fetchCalendar, //(month, yeaer, valueTarget)
        closeCalendar: closeCalendar,
        backEnd: setBackEnd // path to php script to emit calendar
    };
}
var HGS_CALENDAR = hgsCalendar();