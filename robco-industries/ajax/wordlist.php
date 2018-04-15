<?
$words = @file_get_contents('wordlist.txt');

if ($words === FALSE || !isset($_GET['length']) || !isset($_GET['count'])) {
	echo "{}";
	exit();
}

if (!is_numeric($_GET['count']) || !is_numeric($_GET['length'])) {
	echo "{}";
	exit();
}

$words = explode(" ", $words);
$retwords="{\"words\":[";$i=0;$index=0;$wordlen=0;$length = $_GET['length'];$count = $_GET['count'];$failsafe=0;
do {
	$index = rand(0,count($words));
	$wordlen = strlen($words[$index]);
	if ($wordlen == $length) {
		$retwords .= "\"".strtolower($words[$index]."\",");
		$i++;
	} else {
		$failsafe++;
	}
	if ($failsafe > 1000) $i = $failsafe;
} while ($i < $count);

$retwords = substr($retwords,0,strlen($retwords)-1) . "]}";
echo $retwords;
?>