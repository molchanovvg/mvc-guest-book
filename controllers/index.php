<?php
// контролер
Class Controller_Index Extends Controller_Base {
	
	// шаблон
	public $layouts = "main";
	
	// экшен
	function index() {
		if (isset($_POST) && (!empty($_POST['name']))) {
			$this->create();
			$this->template->vars('messageOk', true);
		}
		if (isset($_GET) && ((!empty($_GET['name']) OR (!empty($_GET['email'])) OR (!empty($_GET['date']))))) {
			// сортировка по имени
			if (($_GET['name']) == 'asc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'name ASC'
				);
			} elseif (($_GET['name']) == 'desc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'name DESC'
				);
			}
			// сортировка по email
			if (($_GET['email']) == 'asc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'email ASC'
				);
			} elseif (($_GET['email']) == 'desc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'email DESC'
				);
			}
			// сортировка по дате
			if (($_GET['date']) == 'asc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'date ASC'
				);
			} elseif (($_GET['date']) == 'desc') {
				$select = array(
					'where' => "status = 'approved'",
					'order' => 'date DESC'
				);
			}

		} else {
			// сортировка по умолчанию по дате
			$select = array(
				'where' => "status = 'approved'",
				'order' => 'date DESC'  // сортируем по дате
			);
		}

		$model = new Model_Comments($select);
		$comments = $model->getAllRows();
		$this->template->vars('comments', $comments);
		$this->template->view('index');
	}
	// Создание новой записи
	function create() {

		if (isset($_POST) && (!empty($_POST['name']) && (!empty($_POST['email'])) && (!empty($_POST['comment'])))) {
			$model = New Model_Comments();
			$model->name=$_POST['name'];
			$model->email=$_POST['email'];
			$model->comment=$_POST['comment'];
			if ((!empty($_FILES['userfile']['name'])) &&
				($_FILES['userfile']['type'] == "image/jpeg") |
				($_FILES['userfile']['type'] == "image/png") |
				($_FILES['userfile']['type'] == "image/gif")) {

				$file_type = substr($_FILES['userfile']['name'], strrpos($_FILES['userfile']['name'], '.')+1);
				$newFileName = md5($_FILES['userfile']['name'] . time());
				$uploadFile = SITE_PATH .'uploads_pic'. DS . basename($newFileName) . '.' . $file_type;
				if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadFile)) {
					throw new Exception ('Could not load file: `' . $_FILES['userfile']['name'] . '`');
				}

				$width = 320;
				$height = 240;
				// Get new dimensions
				list($width_orig, $height_orig) = getimagesize($uploadFile);
				if ($width && ($width_orig < $height_orig)) {
					$width = ($height / $height_orig) * $width_orig;
				} else {
					$height = ($width / $width_orig) * $height_orig;
				}
				$image_p = imagecreatetruecolor($width, $height);
				$image = imagecreatefromjpeg($uploadFile);
				imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
				imagejpeg($image_p, $uploadFile, 100);
				$model->pic=$newFileName . '.' . $file_type;
			}
			$model->save();
		}
	}
	
}