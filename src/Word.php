<?php

namespace HangmanSolver;

/**
 * Represents a word at varying stages of obfuscation/hidden-ness.
 */
class Word
{
	/**
	 * Hidden word with internal structure like so:
	 * 
	 * [
	 * 	0 => [
	 * 		0 => 0 or 1 (hidden/revealed)
	 * 		1 => char
	 * 	],
	 * ... 
	 * ]
	 * 
	 * @var Character[] $word
	 */
	private $word;

	private const STATUS = 0;
	private const CHAR   = 1;

	private const HIDDEN   = 0;
	private const REVEALED = 1;

	public function __construct(string $word) 
	{
		$this->word = array();
		foreach (str_split($word) as $character) {
			$this->word[] = [self::HIDDEN, $character];
		}
	}

	public function guess(string $guess) : bool
	{
		// TODO: allow for multiple guesses by casting $guess to array
		if (strlen($guess) > 1) {
			throw new \UnexpectedValueException("$guess must be one character");
		}

		$any_correct = false;
		foreach ($this->word as $index => $char) {
			if ($char[self::STATUS] == self::HIDDEN && !strcasecmp($char[self::CHAR], $guess)) {
				$this->word[$index][self::STATUS] = self::REVEALED;
				$any_correct = true;
			}
		}

		return $any_correct;
	}

	public function show() : string
	{
		$full_word = '';
		foreach ($this->word as $hidden_character) {
			$full_word .= $hidden_character[self::STATUS] == self::REVEALED ? $hidden_character[1] : '?';
		}

		return $full_word;
	}

	public function solved() : bool
	{
		// TODO: true if all are revealed
	}
}