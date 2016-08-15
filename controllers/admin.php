<?php
// контролер
Class Controller_Admin Extends Controller_Base {

    public $layouts = "main";

    function index() {
        if ($this->validate()) {
            // сортировка по умолчанию по дате

            if (isset($_GET) && ((!empty($_GET['status']) OR (!empty($_GET['date']))))) {
                // сортировка по имени
                if (($_GET['status']) == 'asc') {
                    $select = array(
                        'order' => 'status ASC'  // сортируем по имени
                    );
                } elseif (($_GET['status']) == 'desc') {
                    $select = array(
                        'order' => 'status DESC'  // сортируем по имени
                    );
                }
                // сортировка по дате
                if (($_GET['date']) == 'asc') {
                    $select = array(
                        'order' => 'date ASC'  // сортируем по date
                    );
                } elseif (($_GET['date']) == 'desc') {
                    $select = array(
                        'order' => 'date DESC'  // сортируем по date
                    );
                }

            } else {
                // сортировка по умолчанию по дате
                $select = array(
                    'order' => 'date DESC'  // сортируем по дате
                );
            }
            $model = new Model_Comments($select);
            $comments = $model->getAllRows();
            $this->template->vars('comments', $comments);
            $this->template->view('index');
        }

    }

    function edit() {
        if ($this->validate()) {
            if (isset($_GET) && (!empty($_GET['id']))) {
                $select = array(
                    'where' => 'id =' . $_GET['id']
                );
                $model = new Model_Comments($select);
                $comment = $model->getAllRows();
                $this->template->vars('comment', $comment);
                $this->template->view('edit');
            }
            if (isset($_POST)) {
                $select = array(
                    'where' => 'id =' . $_POST['id']
                );
                $model = new Model_Comments($select);
                $model->updateComment($_POST['comment'], $_POST['id']);
                header('Location: /admin');
            }
        }

    }

    function changeStatus() {
        if ($this->validate()) {
            $select = array(
                'where' => 'id =' . $_GET['id']
            );
            $model = new Model_Comments($select);
            $model->updateStatus($_GET['status'], $_GET['id']);

            header('Location: /admin');
        }
    }

    function login()
    {

        if(isset($_POST['login']) && isset($_POST['password']))
        {
            $login = $_POST['login'];
            $password =$_POST['password'];

            if($login=="admin" && $password=="123")
            {
                $data["login_status"] = "access_granted";

                session_start(); echo $_SESSION['admin'];
                $_SESSION['admin'] = $password;
                header( 'Location: /admin' );
            }
            else
            {
                $data["login_status"] = "access_denied";
            }
        }
        else
        {
            $data["login_status"] = "";
        }
        $this->template->vars('data', $data);
        $this->template->view('login');
    }

    function validate()
    {
        session_start();

        if ( $_SESSION['admin'] == "123" )
        {
            return true;
        }
        else
        {
            session_destroy();
            header('Location:/');
        }
    }

    // Действие для разлогинивания администратора
    function logout()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }

}