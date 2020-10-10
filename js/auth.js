(function (window) {
    'use strict';

    document.getElementsByName('signin')[0].addEventListener('click', function (event) {
        let log = document.getElementsByName('login')[0].value;
        let pass = document.getElementsByName('password')[0].value;
        if (log == "" || pass == "") {
            alert("No log or pass!");
            return;
        } else {
            // func - ajax GET security REST request to db
        }
    })
})
(window);