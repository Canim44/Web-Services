<?php
function validateLogin($results) {
	$authenticated = "[{\"COUNT(*)\":\"1\"}]";
	
	if ($results == $authenticated) {
		return 1;
	}	
	else {
		return 0;
	}
}
?>
