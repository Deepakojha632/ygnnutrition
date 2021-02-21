<?php
include('connection.php');

if (isset($_POST['key'])) {
    $key = $_POST['key'];
    $sql = mysqli_query($conn, "select * from products where pname LIKE '%$key%' ") or die(mysqli_error($conn));

    if (mysqli_num_rows($sql)) {
        while ($row = mysqli_fetch_array($sql)) {
            if ($row['flavour'] != 'NA') { ?>
                <a href="single-product.php?pid=<?php echo $row['pid']; ?>">
                    <li id="<?php echo $row['pid']; ?>"><?php echo $row['pname'] . ' ' . $row['flavour'] . ' ' . $row['weight'] . ' ' . $row['unit']; ?></li>
                </a>
            <?php   } else { ?>
                <a href="single-product.php?pid=<?php echo $row['pid']; ?>">
                    <li id="<?php echo $row['pid']; ?>"><?php echo $row['pname'] . ' ' . $row['weight'] . ' ' . $row['unit']; ?></li>
                </a>
        <?php    }
        }
    } else { ?>
        <li>
            <p>Try a Valid Keyword</p>
        </li>
<?php }
}
?>