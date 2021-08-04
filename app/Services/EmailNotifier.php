<?php

namespace App\Services;

use Config\Services;
use Exception;

class EmailNotifier
{
	public static function providerDeploymentSuccess(array $application)
	{
		$parser = Services::parser();

		$fullName = $application['contact_prefix'] ? "{$application['contact_prefix']} " : "";
		$fullName .= $application['contact_firstname'] ? "{$application['contact_firstname']} " : "";
		$fullName .= $application['contact_middlename'] ? "{$application['contact_middlename']} " : "";
		$fullName .= $application['contact_lastname'] ? "{$application['contact_lastname']} " : "";
		$fullName .= $application['contact_suffix'] ? "{$application['contact_suffix']}" : "";

		$message = $parser
			->setVar('firstName', $application['contact_firstname'])
			->setVar('fullName', trim($fullName))
			->setVar('username', $application['username'])
			->setVar('practiceId', $application['PracticeCode'])
			->setVar('loginUrl', 'http://dev-practice.automedsys.net/')
			->render('emails/provider_practice_deployed');

		$email = Services::email();
		$email->setFrom('support@automedsys.com', 'AutoMedSys Support');
		$email->setTo($application['contact_email']);
		$email->setSubject('Congratulations and Welcome to autoMedsys');
		$email->setMessage($message);
		$email->send();
	}
}
