<h1>Сomputer store</h1>
<?php Message::get() ?>

<form action="index.php" method="POST">

    <label for="name">Имя:</label>
    <input type="text" id="name" name="name" value="<?= OldInputs::get('name') ?>"><br>

    <label for="password">Пароль:</label>
    <input type="password" id="password" name="password"><br>

    <label>Выберите диск:</label><br>
    <input type="radio" id="cd" name="select_disk" value="CD">
    <label for="cd">CD</label><br>
    <input type="radio" id="dvd" name="select_disk" value="DVD">
    <label for="dvd">DVD</label><br>

    <label>Обучающие курсы:</label><br>
    <input type="checkbox" id="course1" name="select_course[]" value="Фотошоп">
    <label for="course1"> Фотошоп</label><br>
    <input type="checkbox" id="course2" name="select_course[]" value="Adobe Dreamweaver">
    <label for="course2"> Adobe Dreamweaver</label><br>


    <label for="delivery">Выберите способ доставки:</label>
    <select id="delivery" name="delivery_method">
        <option value="Самовывоз">Самовывоз</option>
        <option value="Курьерская доставка">Курьерская доставка</option>
    </select><br>

    <label for="address">Адрес доставки:</label>
    <input type="text" id="address" name="delivery_address"><br>

    <button type="submit" class="btn btn-primary" name="action" value="sendEmailCourse">Submit</button>
</form>
