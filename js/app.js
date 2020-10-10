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
        let toDoList = document.getElementsByClassName('todo-list')[0].children;
        for (let i = toDoList.length - 1; i >= 0; i--) {
            if (!toDoList[i].classList.contains('completed')) {
                changeCounter('-');
            }
            toDoList[i].remove();
            // func - ajax DELETE REST request to db
        }
        return;
    }

    function addToDoToDOM(text) {
        let li = document.createElement('li');
        let div = document.createElement('div');
        div.classList.add('view');
        let inputToggle = document.createElement('input');
        inputToggle.classList.add('toggle');
        inputToggle.type = 'checkbox';
        let label = document.createElement('label');
        label.textContent = text;
        let button = document.createElement('button');
        button.classList.add('destroy');
        let inputEdit = document.createElement('input');
        inputEdit.classList.add('edit');
        inputEdit.value = text;
        div.append(inputToggle);
        div.append(label);
        div.append(button);
        li.append(div);
        li.append(inputEdit);
        changeCounter('+');
        return document.getElementsByClassName('todo-list')[0].append(li);
    }

    document.getElementsByClassName('header')[0].addEventListener('keydown', function (event) {
        if (event.key == 'Enter' && document.getElementsByClassName('new-todo')[0].value != "") {
            let newToDo = document.getElementsByClassName('new-todo')[0];
            addToDoToDOM(newToDo.value)
            newToDo.value = "";
            // func - ajax INPUT REST request to api db
        }
        return;
    });

    document.getElementsByClassName('todoapp')[0].addEventListener('click', function (event) {
        let target = event.target;
        if (target.classList.contains('destroy')) {
            let todo = target.offsetParent;
            if (!todo.classList.contains('completed')) {
                changeCounter('-');
            }
            todo.remove();
            // func - ajax DELETE REST request to db
        }
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
        if (target.classList.contains('toggle')) {
            let todo = target.offsetParent;
            if (todo.classList.contains('completed')) {
                todo.classList.remove('completed');
                changeCounter('+');
                // func - ajax PUT REST request to db
            } else {
                todo.classList.add('completed');
                changeCounter('-');
                // func - ajax PUT REST request to db
            }
        }
        if (target.previousElementSibling.classList.contains('toggle-all')) {
            let toDoList = document.getElementsByClassName('todo-list')[0].children;
            //let click = new MouseEvent('click');
            if (!target.previousElementSibling.checked) {
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
        if (target.classList.contains('clear-completed')) {
            //func - ajax DELETE completed REST request to db
            destroyAll();
            //func - ajax GET all REST request to db
        }
        return;
    });

    document.getElementsByClassName('main')[0].addEventListener('dblclick', function (event) {
        let target = event.target;
        if (target.localName == 'label' && target.nextElementSibling.classList.contains('destroy')) {
            let input = target.offsetParent.children[1];
            input.classList.add('new-todo');
            input.classList.remove('edit');
            input.autofocus = true;
            input.style.display = 'inline';
            target.style.display = 'none';
            input.addEventListener('keydown', function (keyDown) {
                if (keyDown.key == 'Enter' && document.getElementsByClassName('new-todo')[1].value != "") {
                    // func - ajax PUT REST request to db
                    let label = this.previousElementSibling.children[1];
                    label.style.display = 'block';
                    label.textContent = this.value;
                    this.style.display = 'none';
                    this.classList.remove('new-todo');
                    this.classList.add('edit');
                }
            })
        }
        return;
    });

})
(window);
