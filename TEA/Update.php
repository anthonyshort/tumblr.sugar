#!/usr/bin/php
<?php

// Borrowed from the Markdown sugar

$xml = file_get_contents($_ENV['E_SUGARPATH'] . "/Languages.xml");
preg_match("/<version status=\"(\w+)\">([0-9\.]+)<\/version>/", $xml, $data);
$version = $data[2];

$github = curl_init();

curl_setopt($github, CURLOPT_URL, "http://github.com/anthonyshort/tumblr.sugar/raw/master/Languages.xml");
curl_setopt($github, CURLOPT_RETURNTRANSFER, true);
curl_setopt($github, CURLOPT_HEADER, false);

$remote_xml = curl_exec($github);

curl_close($github);
preg_match("/<version status=\"(\w+)\">([0-9\.]+)<\/version>/", $remote_xml, $data);
$remote_version = $data[2];

if ($version == $remote_version):
	echo "\nYou're up-to-date, {$version} is the newest version available.\n\n";
else:
	echo "\Tumblr Sugar {$remote_version} is available, you have {$version}.\nDownload it here: http://github.com/anthonyshort/tumblr.sugar\n\n";
endif;

?>