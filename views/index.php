<?php
//$query =mysqli_query($con,"SELECT subject,text FROM content");
$query=mysqli_query($con,"select count(id) from `content`");

//$content=mysqli_fetch_all($query,MYSQLI_ASSOC);

$row = mysqli_fetch_row($query);

$rows = $row[0];

$page_rows = 10;

$last = ceil($rows/$page_rows);

if($last < 1){
    $last = 1;
}

$pagenum = 1;

if(isset($_GET['page'])){
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['page']);
}

if ($pagenum < 1) {
    $pagenum = 1;
}
else if ($pagenum > $last) {
    $pagenum = $last;
}

$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

$nquery=mysqli_query($con,"select subject,text from `content` $limit");

$paginationCtrls = '';


if($last != 1){

    if ($pagenum > 1) {
        $previous = $pagenum - 1;
        $paginationCtrls .= '<li class="page-item"><a href="index/'.$previous.'" class="page-link">Previous</a></li>';

        for($i = $pagenum-4; $i < $pagenum; $i++){
            if($i > 0){
                $paginationCtrls .= '<li class="page-item"><a href="index/'.$i.'" class="page-link">'.$i.'</a></li>';
            }
        }
    }

    $paginationCtrls .= ''.$pagenum;

    for($i = $pagenum+1; $i <= $last; $i++){
        $paginationCtrls .= '<li class="page-item"><a href="index/'.$i.'" class="page-link">'.$i.'</a></li>';
        if($i >= $pagenum+4){
            break;
        }
    }

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= '<li class="page-item"><a href="index/'.$next.'" class="page-link">Next</a></li>';
    }
}


include_once ("header.php");

?>
<div class="container">
<?php
while($item = mysqli_fetch_array($nquery)):
?>
<div>
    <p class="font-weight-bold"><?=$item["subject"];?></p>

    <p><?=$item["text"];?></p>
</div>
<?php endwhile;?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?=$paginationCtrls;?>
        </ul>
    </nav>
<?if(empty($item)):?>
    <h2 class="my-5 text-center">Materials not found..</h2>
<?php endif;?>
</div>
<?php include_once ("footer.php");?>