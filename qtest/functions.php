<?php

function validateQueueSession()
{
	$knowUserSecretKey = '';
	$userID = '';
	$eventID = '';

	if (!class_exists('\QueueIT\Security\KnownUserFactory'))
		require_once __DIR__  . '/../QueueIT.Security/KnownUserFactory.php';
	if (!class_exists('\QueueIT\Security\SessionValidationController'))
		require_once __DIR__  . '/../QueueIT.Security/SessionValidationController.php';

	\QueueIT\Security\KnownUserFactory::configure($knowUserSecretKey);

	return \QueueIT\Security\SessionValidationController::validateRequest($userID, $eventID, true);
}

function redirectToQueueIfNoSession() {
	$result = validateQueueSession();
	if ($result instanceof \QueueIT\Security\EnqueueResult) {// Check if user must be enqueued
		header('Location: '.$result->getRedirectUrl());
		exit();
	}
}

function cancelSession() {
	$result = validateQueueSession();
	if ($result instanceof \QueueIT\Security\AcceptedConfirmedResult) {
		$result->setExpiration(time() + 15);
	} else {
		echo "Session is invalid " . get_class($result);
	}
}
