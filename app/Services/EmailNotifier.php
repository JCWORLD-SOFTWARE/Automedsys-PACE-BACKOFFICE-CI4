<?php

namespace App\Services;

use Config\Services;

class EmailNotifier
{
	public static function providerDeploymentSuccess(array $application)
	{

		$apiEndpointsConfig = config('ApiEndpoints');

		$loginUrl = $apiEndpointsConfig->loginUrl;
		$fromUrl = $apiEndpointsConfig->fromUrl;

		$parser = Services::parser();

		$message = $parser
			->setVar('firstName', $application['contact_firstname'])
			->setVar('fullName', static::getFullName($application))
			->setVar('username', $application['username'])
			->setVar('practiceId', $application['PracticeCode'])
			->setVar('loginUrl', '{$loginUrl}')
			->render('emails/provider_practice_deployed');

		$email = Services::email();
		$email->setFrom('{$fromUrl}', 'AutoMedSys Support');
		$email->setTo($application['contact_email']);
		$email->setSubject('Congratulations and Welcome to autoMedsys');
		$email->setMessage($message);
		$email->send();
	}

	public static function providerDeploymentReminder(array $practice)
	{

		$apiEndpointsConfig = config('ApiEndpoints');

		$loginUrl = $apiEndpointsConfig->loginUrl;
		$fromUrl = $apiEndpointsConfig->fromUrl;
		
		$parser = Services::parser();

		$message = $parser
			->setVar('firstName', $practice['contact_firstname'])
			->setVar('fullName', static::getFullName($practice))
			->setVar('username', $practice['contact_email'])
			->setVar('practiceId', $practice['PracticeCode'])
			->setVar('loginUrl', '{$loginUrl}')
			->render('emails/provider_practice_deployed');

		$email = Services::email();
		$email->setFrom('{$fromUrl}', 'AutoMedSys Support');
		$email->setTo($practice['contact_email']);
		$email->setSubject('Congratulations and Welcome to autoMedsys');
		$email->setMessage($message);
		$email->send();
	}

	public static function getFullName(array $practice): string
	{
		$fullName = $practice['contact_prefix'] ? "{$practice['contact_prefix']} " : "";
		$fullName .= $practice['contact_firstname'] ? "{$practice['contact_firstname']} " : "";
		$fullName .= $practice['contact_middlename'] ? "{$practice['contact_middlename']} " : "";
		$fullName .= $practice['contact_lastname'] ? "{$practice['contact_lastname']} " : "";
		$fullName .= $practice['contact_suffix'] ? "{$practice['contact_suffix']}" : "";

		return trim($fullName);
	}
}
