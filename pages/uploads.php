<h1>Uploads</h1>

<?php Message::get() ?>
<form action="index.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" id=""> <br>
    <button class="btn btn-primary" name="action" value="sendFile">Send</button>
</form>

<?php
$files = scandir('./upload');
$files = array_diff($files, ['.', '..']);
dump($files);

foreach ($files as $file) {
    if(!is_dir("upload/$file"))
    echo "<img src='upload/$file'>";
}
?>