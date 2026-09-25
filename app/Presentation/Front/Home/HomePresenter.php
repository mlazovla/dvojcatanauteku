<?php

declare(strict_types=1);

namespace App\Presentation\Front\Home;

use App\Model\PostRepository;
use App\Model\StringRepository;
use Nette\Application\UI\Presenter;


final class HomePresenter extends Presenter
{
	private const int DefaultSlidesCount = 3;
	private const int PostsLimit = 50;


	public function __construct(
		private readonly StringRepository $strings,
		private readonly PostRepository $posts,
	) {
		parent::__construct();
	}


	public function renderDefault(): void
	{
		$strings = $this->strings->getValues();
		$slidesCount = $strings['slides_count'] ?? '';

		$this->template->strings = $strings;
		$this->template->slidesCount = ctype_digit($slidesCount) && $slidesCount !== '0'
			? (int) $slidesCount
			: self::DefaultSlidesCount;
		$this->template->posts = $this->posts->findLatest(self::PostsLimit);
	}
}
