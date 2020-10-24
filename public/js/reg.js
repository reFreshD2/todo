(function (window) {
    'use strict';

    function addUser(log, pass) {
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://157.230.106.225:8888/api/user', true);
        xhr.setRequestHeader("Content-Type", "application/json");
        let data = JSON.stringify({login: log, password: pass});
        xhr.addEventListener('readystatechange', function () {
            if (xhr.readyState == 4) {
                if (xhr.status != 200) {
                    let message = JSON.parse(xhr.responseText);
                    alert(message['message']);
                } else {
                    document.location.href = 'http://157.230.106.225:8888';
                }
            }
        });
        xhr.send(data);
    }

    document.getElementsByName('signup')[0].addEventListener('click', function (event) {
        let log = document.getElementsByName('login')[0].value;
        let pass = document.getElementsByName('password')[0].value;
        if (log == "" || pass == "") {
            alert("No log or pass!");
            return;
        } else {
            addUser(log, pass);
        }
    })
})
(window);