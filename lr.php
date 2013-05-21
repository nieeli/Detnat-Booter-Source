<?PHP
if(isset($_GET['id']) && Is_Numeric($_GET['id']))
{
session_start();
require_once("includes/db.php");
require_once("includes/init.php");
$id = (int)$_GET['id'];
$paypalemail = $odb -> query("SELECT `email` FROM `gateway` LIMIT 1") -> fetchColumn(0);
$plansql = $odb -> prepare("SELECT * FROM `plans` WHERE `ID` = :id");
$plansql -> execute(array(":id" => $id));
$row = $plansql -> fetch();
if($row === NULL) { die("Bad ID"); }
$lrurl = "https://sci.libertyreserve.com/en?lr_acc=".$lrid."&lr_store=".$storename."&lr_amnt=".urlencode($row['price'])."&lr_currency=LRUSD&usrid=".urlencode($row['ID']."_".$_SESSION['ID'])."&lr_merchant_ref=".urlencode($row['name']);
header("Location: ".$lrurl);
}
?>
