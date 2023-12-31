<?php

use Werify\IdLaravel\Http\Controllers\Api\V1\AuthController;

return
	[
		'version' => 'v1',
		'app_key' => 'not_set',
		'routes' =>
		[
			'group' => 'v1/oauth',
			'request-otp' => '/request-otp',
			'verify-otp' => '/verify-otp',
			'qr' => 'qr',
			'qr-image' => 'qr-image',
			'qr-claim' => 'qr-claim'
		],
		'controllers' =>
		[
			'AuthController' =>
			[
				'class' => AuthController::class,
				'request-otp' => 'requestOTP',
				'verify-otp' => 'verifyOTP',
				'qr' => 'qr',
				'qr-image' => 'qrImage',
				'qr-claim' => 'qrClaim'
			],

		],
		'api' =>
		[
			'base_path' => 'https://id.werify.net',
			'base_api_path' => 'https://id.werify.net/api',
			'request-otp' => 'request-otp',
			'verify-otp' => 'verify-otp',
			'profile' => 'user/profile',
			'profile-mobile-numbers' => 'user/profile/mobile-numbers',
			'profile-metas' => 'user/profile/metas',
			'profile-education' => 'user/profile/education',
			'profile-financial-information' => 'user/profile/financial-information',
			'qr' => 'qr',
			'qr-image' => 'qr',
			'qr-claim' => 'user/qr/'
		]
	];
