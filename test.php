<form  method="post" enctype="multipart/form-data">
    <input type="file" name="resume">
    <input type="submit" value="submit">
</form>
<?php
if(isset($_POST)){
    print_r($_POST);
    print_r($_FILES);
}
    
?>