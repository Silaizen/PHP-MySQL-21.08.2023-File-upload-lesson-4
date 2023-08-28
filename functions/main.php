<?php
require_once './functions/helper.php';
require_once './functions/Message.php';
require_once './functions/OldInputs.php';

session_start();




$action = $_POST['action'] ?? null;

if (!empty($action)) {
    $action();
}

function sendEmail()
{
    $name = clear($_POST['name'] ?? '');
    $phone = clear($_POST['phone'] ?? '');
    $message = clear($_POST['message'] ?? '');


    if (empty($name)) {
        Message::set('Name is required', 'danger');
        OldInputs::set($_POST);
        redirect('contacts');
    }
    if (empty($phone)) {
        Message::set('phone is required', 'danger');
        OldInputs::set($_POST);
        redirect('contacts');
    }
    if (empty($message)) {
        Message::set('message is required', 'danger');
        OldInputs::set($_POST);
        redirect('contacts');
    }


    mail('hidclift@gmailcom', 'Mail from site', "$name,$phone, $message");
    Message::set('Thank!');
    redirect('contacts');
}

function sendEmailCourse()
{
    $name = clear($_POST['name'] ?? '');
    $password = clear($_POST['password'] ?? '');
    $select_disk = clear($_POST['select_disk'] ?? '');

    // Получаем выбранные курсы из POST-запроса
    // Если ни один курс не выбран, создаем пустой массив
    $select_course = isset($_POST['select_course']) ? $_POST['select_course'] : [];

    $select_course_str = ''; // Переменная для хранения строкового представления выбранных курсов
    if (is_array($select_course)) { // Проверяем, что выбранные курсы действительно являются массивом
        $select_course = array_map('clear', $select_course); // Очищаем каждый выбранный курс
        $select_course_str = implode(', ', $select_course); // Создаем строку из выбранных курсов, разделенных запятыми и пробелами
    }

    $delivery_method = clear($_POST['delivery_method'] ?? '');
    $delivery_address = clear($_POST['delivery_address'] ?? '');

    // Проверяем, что все необходимые поля заполнены
    if (empty($name) || empty($password) || empty($select_disk) || empty($select_course) || empty($delivery_method) || empty($delivery_address)) {
        Message::set('All fields are required', 'danger');
        OldInputs::set($_POST);
        redirect('Course_purchase'); // Перенаправляем 

    } else {
        // Формируем сообщение для отправки по электронной почте
        $message = "Имя: $name\n";
        $message .= "Пароль: $password\n";
        $message .= "Диск: $select_disk\n";
        $message .= "Курс: $select_course_str\n";
        $message .= "Способ доставки: $delivery_method\n";
        $message .= "Адрес: $delivery_address\n";

        mail('hidclift@gmail.com', 'Mail from site', $message);
        Message::set('Thank!');
        redirect('Course_purchase');
    }
}

function sendFile()
{
    // dump($_FILES['file']);
    extract($_FILES['file']); // деструктуризация ассоциативного массив

    if ($error === 4) {
        Message::set('File is required', 'danger');
        redirect('uploads');
    }
    if ($error != 0) {
        Message::set('File is not uploaded', 'danger');
        redirect('uploads');
    }

    $allowedFiles = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
    if (!in_array($type, $allowedFiles)) {

        Message::set('File is not image', 'danger');
        redirect('uploads');
    }

    $ext = end(explode('.', $name));
    $fName = md5(time() . uniqid() . session_id()) . '.' . $ext;

    if (!file_exists('upload'))
        mkdir('upload');

    move_uploaded_file($tmp_name, './upload/' . $fName);
    Message::set('File is uploaded!');
    redirect('uploads');
}


function Register()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_confirm = $_POST["password_confirm"];

        $errors = array();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email address";
        }

        if (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 characters long";
        }

        if ($password !== $password_confirm) {
            $errors[] = "Passwords do not match";
        }

        if (empty($errors)) {
            Message::setUserEmail($email);
            Message::set("Registration successful", 'success');
            $_SESSION['user'] = true; 
            header("Location: index.php?page=home");
            exit();
        } else {
            Message::set("Registration failed. Please check the form for errors.", 'danger');
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }


        return $errors;
    }
}


function exitUser()
{
    unset($_SESSION['user']);
    header("Location: index.php?page=home");
    exit();
}

function validateLoginForm() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $errors = array();

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Message::set("Invalid email address", 'danger');
            $errors['email'] = "Invalid email address";
        }

        if (strlen($password) < 6) {
            Message::set("Password must be at least 6 characters long", 'danger');
            $errors['password'] = "Password must be at least 6 characters long";
        }
     if (empty($errors)){

         Message::set("You logged in successfully", 'success');
      }
     }
        
    

        return $errors;
    }

    return [];






