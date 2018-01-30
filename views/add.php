<?php
$query=null;
$message=null;

if(!empty($_POST['subject']) && !empty($_POST['link'])) {
    $subject=$_POST['subject'];
    $link=$_POST['link'];
    $query = mysqli_query($con, "INSERT INTO content(subject, text) VALUES ('$subject','$link')");
    if ($query === false) $message = mysqli_error($con);
}

include_once ("header.php");?>
    <h3>Add New Material</h3>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>
            </div>
            <div class="form-group">
                <label for="link">Link of information</label>
                <input type="text" class="form-control" id="link" placeholder="Link of information" name="link" required>
            </div>
            <div class="form-group">
                <input class="btn btn-lg btn-success btn-block" type="submit" value="Submit">
            </div>
        </form>
    </div>
<?php
if(!empty($message)):?>
    <div class="alert alert-danger" role="alert">
        <?=$message;?>
    </div>
<?php elseif(!empty($query)):?>
    <div class="alert alert-success" role="alert">
        Success!
    </div>
<?php endif;
include_once ("footer.php");
?>