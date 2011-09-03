<?php
include ("includes/config.php");
?>

<html>
    <head>
        <title>The Amp Hour Bingo</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
 <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $("#bingoTable td").click(function () {
            $(this).toggleClass("clicked");
        });
    });
    </script>
    </head>
<body>
    <h1><img width="40px" height="40px" src='img/TheAmpHourLogo_40.png'>The Amp Hour Bingo<img  width="40px" height="40px" src='img/TheAmpHourLogo_40.png'></h1>
<p>Click on the cell to toggle background colour.</p>

<?php
$width = $config['bingoGridsize'];
$height = $config['bingoGridsize'];
if ($config['bingoGridsize'] % 2) {
    $numberOfCells = ($width * $height)-1;
} else {
    $numberOfCells = ($width * $height);
}

$centerCell = abs($numberOfCells/2);
// Get the data!
$sql = "SELECT itm_text FROM items_itm WHERE itm_isEnabled = 1 ORDER by rand() LIMIT $numberOfCells ";
$result = mysql_query($sql) or die("<b>A fatal MySQL error occured</b>.\n<br />Query: " . $sql . "<br />\nError: (" . mysql_errno() . ") " . mysql_error());
$numRows = mysql_num_rows($result);
if ($numRows < $numberOfCells) {
    echo 'Not enough items!<BR>';
    echo "Found $numRows , need $numberOfCells!";
    die;
}

echo "<table id='bingoTable'>\n<tr>";
$counter = 0;
while ($row = mysql_fetch_assoc($result)) {
    if (($counter % $config['bingoGridsize']) == 0) {
        echo "</tr>\n<tr>";
    }
    // Center image?
    if ((($config['bingoGridsize'] % 2)==1) && $counter == $centerCell) {
        echo "<td><img width='100px' height='100px' src='img/TheAmpHourLogo_100.png'></td>\n";
        $counter++;
    }
    echo "<td>".$row['itm_text']."</td>\n";
    $counter++;

}
mysql_free_result($result);

echo "</table>";

?>
  </table>
  <div id="footer">
    The Amp Hour logo is &copy; by <a href="http://www.TheAmpHour.com" target="_new">TheAmpHour.com</a><BR>
    Idea by <a  target="_new" href="http://fakeeequips.wordpress.com/">FakeEEQuips</a> - Code by <a  target="_new" href="http://twitter.com/RoelAdriaans">Roel Adriaans</a> - Code available on <a target="_new" href="https://github.com/RoelAdriaans/The-Amp-Hour-Bingo">Github</a>
    Suggestions, questions or new quotes? <a href="mailto:roel@adriaans.org">roel@adriaans.org</a>
  </div>

</body>
