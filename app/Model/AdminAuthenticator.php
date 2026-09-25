<?php

declare(strict_types=1);

namespace App\Model;

use Nette\Security\AuthenticationException;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;
use Nette\Security\Passwords;
use Nette\Security\SimpleIdentity;


final class AdminAuthenticator implements Authenticator
{
	/** @param list<string> $passwordHashes */
	public function __construct(
		private readonly array $passwordHashes,
		private readonly Passwords $passwords,
	) {
	}


	public function authenticate(string $user, string $password): IIdentity
	{
		foreach ($this->passwordHashes as $hash) {
			if ($this->passwords->verify($password, $hash)) {
				return new SimpleIdentity('admin', ['admin']);
			}
		}

		throw new AuthenticationException('Nesprávné heslo.');
	}
}
