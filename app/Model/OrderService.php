<?php

declare(strict_types=1);

namespace App\Model;

use Latte;
use Nette\Bridges\ApplicationLatte\LatteFactory;
use Nette\Mail\Mailer;
use Nette\Mail\Message;
use Nette\Mail\SendException;
use Nette\Utils\FileSystem;
use Nette\Utils\Finder;
use Tracy\Debugger;
use Tracy\ILogger;


final class OrderService
{
	public const array Labels = [
		'amount' => 'Kusů',
		'name' => 'Jméno',
		'surname' => 'Příjmení',
		'street' => 'Ulice',
		'streetNo' => 'Číslo popisné',
		'city' => 'Město',
		'zip' => 'PSČ',
		'country' => 'Země',
		'phone' => 'Telefon',
		'email' => 'Email',
	];

	private const string FilePattern = '~^\d{4}-\d{2}-\d{2}_\d{2}:\d{2}:\d{2}\.txt$~';


	/** @param array{priceBook: int, pricePost: int, fromEmail: string, fromName: string, notificationEmail: string, contactEmail: string, contactPhone: string} $config */
	public function __construct(
		private readonly string $ordersDir,
		private readonly array $config,
		private readonly Mailer $mailer,
		private readonly LatteFactory $latteFactory,
	) {
	}


	public function getPriceBook(): int
	{
		return $this->config['priceBook'];
	}


	public function getPricePost(): int
	{
		return $this->config['pricePost'];
	}


	public function getTotalPrice(int $amount): int
	{
		return $this->getPricePost() + $this->getPriceBook() * $amount;
	}


	/** @param array<string, scalar> $values */
	public function place(array $values): void
	{
		$items = [];
		foreach (self::Labels as $key => $label) {
			$value = trim((string) ($values[$key] ?? ''));
			if ($value !== '') {
				$items[$label] = $value;
			}
		}

		$totalPrice = $this->getTotalPrice((int) $values['amount']);
		$this->saveToFile($items, $totalPrice);

		$params = [
			'items' => $items,
			'totalPrice' => $totalPrice,
			'contactEmail' => $this->config['contactEmail'],
			'contactPhone' => $this->config['contactPhone'],
		];
		$this->send((string) $values['email'], 'Vaše objednávka z dvojcatanauteku.cz', ['forCustomer' => true] + $params);
		$this->send($this->config['notificationEmail'], 'Nová objednávka z dvojcatanauteku.cz', ['forCustomer' => false] + $params);
	}


	/** @return list<string> */
	public function listOrders(int $limit): array
	{
		if (!is_dir($this->ordersDir)) {
			return [];
		}

		$names = [];
		foreach (Finder::findFiles('*.txt')->in($this->ordersDir) as $file) {
			$names[] = $file->getFilename();
		}

		rsort($names);
		return array_slice($names, 0, $limit);
	}


	public function readOrder(string $name): ?string
	{
		if (!preg_match(self::FilePattern, $name) || !is_file($this->ordersDir . '/' . $name)) {
			return null;
		}

		return FileSystem::read($this->ordersDir . '/' . $name);
	}


	/** @param array<string, string> $items */
	private function saveToFile(array $items, int $totalPrice): void
	{
		$lines = [];
		foreach ($items as $label => $value) {
			$lines[] = $label . ': ' . $value;
		}

		$file = $this->ordersDir . '/' . date('Y-m-d_H:i:s') . '.txt';
		FileSystem::write($file, "\xEF\xBB\xBF" . implode("\n", $lines) . "\n\n Cena: " . $totalPrice . ' Kč', 0664);
	}


	/** @param array<string, mixed> $params */
	private function send(string $to, string $subject, array $params): void
	{
		$latte = $this->latteFactory->create();
		$latte->setLoader(new Latte\Loaders\FileLoader(__DIR__ . '/templates'));

		$mail = new Message;
		$mail->setFrom($this->config['fromEmail'], $this->config['fromName'])
			->addTo($to)
			->setSubject($subject)
			->setHtmlBody($latte->renderToString('orderEmail.latte', $params));

		try {
			$this->mailer->send($mail);
		} catch (SendException $e) {
			Debugger::log($e, ILogger::EXCEPTION);
		}
	}
}
