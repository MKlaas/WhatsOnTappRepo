<?php
session_start();
/**
 * jQuery Voting System
 * @link http://www.w3bees.com/2013/09/voting-system-with-jquery-php-and-mysql.html
 */

include('core/init_connect.php');
# start new session


if ($_SERVER['HTTP_X_REQUESTED_WITH']) {
	if (isset($_POST['postid']) AND isset($_POST['action'])) {
		$postId = (int) mysqli_real_escape_string($connection, $_POST['postid']);
		# check if already voted, if found voted then return
		if (isset($_SESSION['vote'][$postId])) return;

		# query into db table to know current voting score 
		$query = mysqli_query($connection, "
			SELECT vote
			from dbtablebarbeer
			WHERE id = '{$postId}' 
			LIMIT 1" );

		# increase or dicrease voting score
		if ($data = mysqli_fetch_array($query)) {
			if ($_POST['action'] === 'up'){
				$vote = ++$data['vote'];
			} else {
				$vote = --$data['vote'];
			}
			# update new voting score
			mysqli_query($connection,"
				UPDATE dbtablebarbeer
				SET vote = '{$vote}'
				WHERE id = '{$postId}' ");

			# set session with post id as true
			$_SESSION['vote'][$postId] = true;
			# close db connection
			mysqli_close($connection); 
		}
	}
}
?>