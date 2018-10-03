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
			throw new AlreadyGuessedException("Already guessed character {$guess}");
		}

		if ($this->mb_strcasecmp($guess, $this->char) === 0) {
			$this->status = self::REVEALED;
			return true;
		}

		return false;
	}

	/**
	 * Multibyte strcasecmp(). No guarantees this will work perfectly.
	 * 
	 * http://php.net/manual/en/function.strcasecmp.php#107016
	 *
	 * @param string $a
	 * @param string $b
	 * @param string $encoding
	 * @return integer
	 */
	private function mb_strcasecmp(
		string $a, 
		string $b, 
		string $encoding = null
	) : int {
		if (null === $encoding) { $encoding = mb_internal_encoding(); }
    return strcmp(mb_strtoupper($a, $encoding), mb_strtoupper($b, $encoding));
	}

	public function peek() : string {
		return $this->char;
	}
}