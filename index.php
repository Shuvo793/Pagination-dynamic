<?php
require_once "connection.php";

$page=1;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}
$limit=5;
$offset=$page * $limit -$limit;
//focus algorithm
/*1 5 0
2 5 5
3 5 10*/

//page calculation algorithm
 /*
  * page = data ase (50) / proti page ee data(5) = tahole page (10)
jodi amon hoe ->page = data ase (49) / proti page ee data(5) = tahole page (9.8) url kokhono emon data jabe na
tai cail() function and floor() function use kora hoe
cail () ex: 8.8 data ke 9 kore dae
floor() ex: 8.8 data ke 8 kore dae
 */

$stmt=$connection->prepare("SELECT * FROM people limit $limit offset $offset");
$stmt->execute();
$people = $stmt->fetchAll(PDO::FETCH_OBJ);
$stmt2=$connection->prepare("SELECT * FROM people");
$stmt2->execute();
$total_row= $stmt2->rowCount();
$total_page= ceil($total_row/$limit);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>all people</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-success">

<div class="container ">
    <div class="card" style="margin-top: 70px;">
        <div class="card-header">
            <h2>All people</h2>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($people as $person):?>
                    <tr>
                        <td><?php echo $person->id?></td>
                        <td><?php echo $person->name?></td>
                        <td><?php echo  $person->email?></td>
                    </tr>
                <?php endforeach; ?>
            </table>


            <!--pagination from bootstrap-->


            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item <?php echo $page <= 1 ? 'disabled': '' ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1 ?>" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <?php for($i=1;$i<=$total_page;$i++): ?>
                    <li class="page-item <?php echo $i == $page?'active': ''?> "><a class="page-link" href="/?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php endfor ;?>
                    <li class="page-item <?php echo $page >= $total_page ? 'disabled': '' ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1 ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

</body>
</html>