<?php

namespace HangmanSolver;

use HangmanSolver\Exception\AlreadyGuessedException;

class Character
{
	protected const HIDDEN   = 1;
	protected const REVEALED = 2;

	/** @var string */
	protected $char = '';

	/** @var int */
	protected $status = self::HIDDEN;
	
	public function __construct(string $character) {
		if (mb_strlen($character) !== 1)	{
			throw new \InvalidArgumentException(
				"Argument '{$character}' must be one character."
			);
		}

		$this->char = $character;
	}

	public function isHidden() : bool {
		return $this->status === self::HIDDEN;
	}

	public function guess(string $guess) : bool {
		if ($this->status === self::REVEALED) {
			throw new AlreadyGuessedException();
		}

		if ($guess === $this->char) {
			$this->status = self::REVEALED;
			return true;
		}

		return false;
	}

	public function peek() : string {
		return $this->char;
	}
}