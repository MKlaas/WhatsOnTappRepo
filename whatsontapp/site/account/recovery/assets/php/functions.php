<?php
error_reporting(E_ERROR | E_PARSE);
define(PW_SALT,'(+3%_');

function checkUNEmail($uname,$email)
{
	global $connection;
	$error = array('status'=>false,'userID'=>0);
	if (isset($email) && trim($email) != '') {
		//email was entered
		if ($SQL = $connection->prepare("SELECT `AccountID` FROM `dbtableuser` WHERE `Email` = ? LIMIT 1"))
		{
			$SQL->bind_param('s',trim($email));
			$SQL->execute();
			$SQL->store_result();
			$numRows = $SQL->num_rows();
			$SQL->bind_result($userID);
			$SQL->fetch();
			$SQL->close();
			if ($numRows >= 1) return array('status'=>true,'userID'=>$userID);
		} else { return $error; }
	} elseif (isset($uname) && trim($uname) != '') {
		//username was entered
		if ($SQL = $connection->prepare("SELECT `AccountID` FROM `dbtableuser` WHERE Username = ? LIMIT 1"))
		{
			$SQL->bind_param('s',trim($uname));
			$SQL->execute();
			$SQL->store_result();
			$numRows = $SQL->num_rows();
			$SQL->bind_result($userID);
			$SQL->fetch();
			$SQL->close();
			if ($numRows >= 1) return array('status'=>true,'userID'=>$userID);
		} else { return $error; }
	} else {
		//nothing was entered;
		return $error;
	}
}
function getSecurityQuestion($userID)
{
	global $connection;
	$questions = array();
	$questions[0] = "What is your mother's maiden name?";
	$questions[1] = "What city were you born in?";
	$questions[2] = "What is your favorite color?";
	$questions[3] = "What year did you graduate from High School?";
	$questions[4] = "Who is the coolest guy you know?";
	$questions[5] = "What is your favorite model of car?";
	if ($SQL = $connection->prepare("SELECT `secQ` FROM `dbtableuser` WHERE `AccountID` = ? LIMIT 1"))
	{
		$SQL->bind_param('i',$userID);
		$SQL->execute();
		$SQL->store_result();
		$SQL->bind_result($secQ);
		$SQL->fetch();
		$SQL->close();
		return $questions[$secQ];
	} else {
		return false;
	}
}

function checkSecAnswer($userID,$answer)
{
	global $connection;
	if ($SQL = $connection->prepare("SELECT `Username` FROM `dbtableuser` WHERE `AccountID` = ? AND LOWER(`secA`) = ? LIMIT 1"))
	{
		$answer = strtolower($answer);
		$SQL->bind_param('is',$userID,$answer);
		$SQL->execute();
		$SQL->store_result();
		$numRows = $SQL->num_rows();
		$SQL->close();
		if ($numRows >= 1) { return true; }
	} else {
		return false;
	}
}

function sendPasswordEmail($userID)
{
	global $connection;
	if ($SQL = $connection->prepare("SELECT `Username`,`Email`,`Password` FROM `dbtableuser` WHERE `AccountID` = ? LIMIT 1"))
	{
		$SQL->bind_param('i',$userID);
		$SQL->execute();
		$SQL->store_result();
		$SQL->bind_result($uname,$email,$pword);
		$SQL->fetch();
		$SQL->close();
		$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+3, date("Y"));
		$expDate = date("Y-m-d H:i:s",$expFormat);
		$key = sha1($uname . '_' . $email . rand(0,10000) .$expDate . PW_SALT);
		if ($SQL = $connection->prepare("INSERT INTO `recoveryemails_enc` (`UserID`,`Key`,`expDate`) VALUES (?,?,?)"))
		{
			$SQL->bind_param('iss',$userID,$key,$expDate);
			$SQL->execute();
			$SQL->close();
			$passwordLink = "<a href=\"?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "\">http://whats-on-tapp.com/site/account/recovery/forgotPass.php?a=recover&email=" . $key . "&u=" . urlencode(base64_encode($userID)) . "</a>";
			$message = "Hello $uname,\r\n";
			$message .= "Please visit the following link to reset your password:\r\n";
			$message .= "-----------------------\r\n";
			$message .= "$passwordLink\r\n";
			$message .= "-----------------------\r\n";
			$message .= "Please be sure to copy the entire link into your browser. The link will expire after 3 days for security reasons.\r\n\r\n";
			$message .= "If you did not request this forgotten password email, no action is needed, your password will not be reset as long as the link above is not visited. However, you may want to log into your account and change your security password and answer, as someone may have guessed it.\r\n\r\n";
			$message .= "Thanks,\r\n";
			$message .= "-- whats-on-tapp team";
			$headers .= "From: Whats-On-Tapp <whatsontapp@whats-on-tapp.com> \n";
			$headers .= "To-Sender: \n";
			$headers .= "X-Mailer: PHP\n"; // mailer
			$headers .= "Reply-To: webmaster@whats-on-tapp.com\n"; // Reply address
			$headers .= "Return-Path: webmaster@whats-on-tapp.com\n"; //Return Path for errors
			$headers .= "Content-Type: text/html; charset=iso-8859-1"; //Enc-type
			$subject = "Password Reset";
			@mail($email,$subject,$message,$headers);
			return str_replace("\r\n","<br/ >",$message);
		}
	}
}

function checkEmailKey($key,$userID)
{
	global $connection;
	$curDate = date("Y-m-d H:i:s");
	if ($SQL = $connection->prepare("SELECT `UserID` FROM `recoveryemails_enc` WHERE `Key` = ? AND `UserID` = ? AND `expDate` >= ?"))
	{
		$SQL->bind_param('sis',$key,$userID,$curDate);
		$SQL->execute();
		$SQL->execute();
		$SQL->store_result();
		$numRows = $SQL->num_rows();
		$SQL->bind_result($userID);
		$SQL->fetch();
		$SQL->close();
		if ($numRows > 0 && $userID != '')
		{
			return array('status'=>true,'userID'=>$userID);
		}
	}
	return false;
}

function updateUserPassword($userID,$password,$key)
{
	global $connection;
	if (checkEmailKey($key,$userID) === false) return false;
    //UPDATE `dbtableuser` SET `Password`=sha1('$password') WHERE `UserName` = '$username' AND `Email` = '$email
	if ($SQL = $connection->prepare("UPDATE `dbtableuser` SET `Password` = ? WHERE `AccountID` = ?"))
	{
		$password = sha1($password);
		$SQL->bind_param('si',$password,$userID);
		$SQL->execute();
		$SQL->close();
		$SQL = $connection->prepare("DELETE FROM `recoveryemails_enc` WHERE `Key` = ?");
		$SQL->bind_param('s',$key);
		$SQL->execute();
	}
}

function getUserName($userID)
{
	global $connection;
	if ($SQL = $connection->prepare("SELECT `Username` FROM `dbtableuser` WHERE `AccountID` = ?"))
	{
		$SQL->bind_param('i',$userID);
		$SQL->execute();
		$SQL->store_result();
		$SQL->bind_result($uname);
		$SQL->fetch();
		$SQL->close();
	}
	return $uname;
}
