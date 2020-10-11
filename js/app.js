(function (window) {
    'use strict';

    function unselect() {
        return document.getElementsByClassName('selected')[0].classList.remove('selected');
    }

    function changeCounter(sign) {
        if (sign == '+') {
            return document.getElementsByClassName('todo-count')[0].firstChild.textContent++;
        } else {
            return document.getElementsByClassName('todo-count')[0].firstChild.textContent--;
        }
    }

    function destroyAll() {
        let toDoList = getChildren('todo-list', -1);
        for (let i = toDoList.length - 1; i >= 0; i--) {
            if (!toDoList[i].classList.contains('completed')) {
                changeCounter('-');
            }
            toDoList[i].remove();
            // func - ajax DELETE REST request to db
        }
        return;
    }

    function addToDoToDOM(text, completed) {
        let li = document.createElement('li');
        let div = document.createElement('div');
        div.classList.add('view');
        let inputToggle = document.createElement('input');
        inputToggle.classList.add('toggle');
        inputToggle.type = 'checkbox';
        inputToggle.addEventListener('click', function (event) {
            let todo = this.offsetParent;
            if (todo.classList.contains('completed')) {
                todo.classList.remove('completed');
                changeCounter('+');
                // func - ajax PUT REST request to db
            } else {
                todo.classList.add('completed');
                changeCounter('-');
                // func - ajax PUT REST request to db
            }
            return;
        });
        let label = document.createElement('label');
        label.textContent = text;
        label.addEventListener('dblclick', function (event) {
            let input = this.offsetParent.children[1];
            input.classList.add('new-todo');
            input.classList.remove('edit');
            input.autofocus = true;
            input.style.display = 'inline';
            this.style.display = 'none';
            input.addEventListener('keydown', function (keyDown) {
                if (keyDown.key == 'Enter' && document.getElementsByClassName('new-todo')[1].value != "") {
                    // func - ajax PUT REST request to db
                    let label = this.previousElementSibling.children[1];
                    label.style.display = 'block';
                    label.textContent = this.value;
                    this.style.display = 'none';
                    this.classList.remove('new-todo');
                    this.classList.add('edit');
                    return;
                }
            });
            return;
        })
        let button = document.createElement('button');
        button.classList.add('destroy');
        button.addEventListener('click', function (event) {
            let todo = this.offsetParent;
            if (!todo.classList.contains('completed')) {
                changeCounter('-');
            }
            todo.remove();
            // func - ajax DELETE REST request to db
            return;
        });
        let inputEdit = document.createElement('input');
        inputEdit.classList.add('edit');
        inputEdit.value = text;
        div.append(inputToggle);
        div.append(label);
        div.append(button);
        li.append(div);
        li.append(inputEdit);
        if (!completed) {
            changeCounter('+');
        }
        document.getElementsByClassName('todo-list')[0].append(li);
        return;
    }

    function getChildren(className, pos) {
        if (pos != -1) {
            return document.getElementsByClassName(className)[0].children[pos];
        } else {
            return document.getElementsByClassName(className)[0].children;
        }
    }

    document.getElementsByClassName('header')[0].addEventListener('keydown', function (event) {
        let newToDo = document.getElementsByClassName('new-todo')[0];
        if (event.key == 'Enter' && newToDo.value != "") {
            addToDoToDOM(newToDo.value, false);
            newToDo.value = "";
            // func - ajax INPUT REST request to api db
        }
        return;
    });

    document.getElementsByClassName('main')[0].addEventListener('click', function (event) {
        let target = event.target;
        if (target.classList.contains('toggle-all')) {
            let toDoList = getChildren('todo-list', -1);
            //let click = new MouseEvent('click');
            if (target.checked) {
                for (let i = 0; i < toDoList.length; i++) {
                    if (!toDoList[i].classList.contains('completed')) {
                        //toDoList[i].children[0].children[0].dispatchEvent(click);
                        toDoList[i].classList.add('completed');
                        toDoList[i].children[0].children[0].checked = true;
                        changeCounter('-');
                        // func - ajax PUT REST request to db
                    }
                }
            } else {
                for (let i = 0; i < toDoList.length; i++) {
                    if (toDoList[i].classList.contains('completed')) {
                        //toDoList[i].children[0].children[0].dispatchEvent(click);
                        toDoList[i].classList.remove('completed');
                        toDoList[i].children[0].children[0].checked = false;
                        changeCounter('+');
                        // func - ajax PUT REST request to db
                    }
                }
            }
        }
        return;
    });

    document.getElementsByClassName('footer')[0].addEventListener('click', function (event) {
        let target = event.target;
        if (target.localName == 'a' && document.location.hash != "") {
            unselect();
            destroyAll();
            target.classList.add('selected');
            if (target.hash == "#/") {
                // func - ajax GET all REST request to db
            }
            if (target.hash == "#/active") {
                // func - ajax GET active REST request to db
            }
            if (target.hash == "#/completed") {
                //func - ajax GET completed REST request to db
            }
        }
        if (target.classList.contains('clear-completed')) {
            //func - ajax DELETE completed REST request to db
            destroyAll();
            //func - ajax GET all REST request to db
        }
        return;
    });

})
(window);
