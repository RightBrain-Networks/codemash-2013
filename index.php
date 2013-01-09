<?
    if($_GET['delete_session'])
        session_destroy();
    session_start();
    $_SESSION['count'] += 1;
?>
<html><head></head><body>
HELLO WORLD
<br /><br /><br />

<script src="//ajax.googleapis.com/ajax/libs/jquery/<?=$_SERVER['JQUERY_VERSION']?>/jquery.min.js"></script>
<?
    echo htmlentities(sprintf('<script src="//ajax.googleapis.com/ajax/libs/jquery/%s/jquery.min.js"></script>', $_SERVER['JQUERY_VERSION']));
?>
<br />
PARAM1=<?=$_SERVER['PARAM1']?>
<br />
PARAM4=<?=$_SERVER['PARAM4']?>
<br />
JQUERY_VER=<?=$_SERVER['JQUERY_VER']?>
<br />
JQUERY_VERSION=<?=$_SERVER['JQUERY_VERSION']?>
<br />
JQV=<?=$_SERVER['JQV']?>

<br /><br /><br />

<?
    $db = mysqli_connect($_SERVER['RDS_HOSTNAME'], $_SERVER['RDS_USERNAME'], $_SERVER['RDS_PASSWORD'], $_SERVER['RDS_DB_NAME'], $_SERVER['RDS_PORT']);
    if($db->connect_errno)
    {
        echo sprintf('Failed to connect to MySQL: %s', $db->connect_error);
    }
    $sql = 'SELECT * FROM users WHERE id = ?';
    $dbh = $db->prepare($sql);
    $id = (int)$_GET['id'];
    $dbh->bind_param('i', $id);
    $dbh->execute();
    $row = $dbh->get_result()->fetch_assoc();
?>
first_name: <?=$row['first_name']?>
<br />
last_name: <?=$row['last_name']?>

<br /><br /><br />

session variable count = <?=$_SESSION['count']?>

<br /><br /><br />
</body></html>
