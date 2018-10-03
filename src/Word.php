<?php

namespace HangmanSolver;

/**
 * Represents a word at varying stages of obfuscation/hidden-ness.
 */
class Word
{
	/** @var Character[] $word */
	private $word = [];

	private const STATUS = 0;
	private const CHAR   = 1;

	private const HIDDEN   = 0;
	private const REVEALED = 1;

	public function __construct(string $word) 
	{
		foreach (str_split($word) as $character) {
			$this->word[] = new Character($character);
		}
	}


	/**
	 * Makes a guess. A variadic number of  chars is considered multiple guesses 
	 * at once. All of them have to be correct or it returns false.
	 *
	 * @param string ...$guesses
	 * @return boolean
	 */
	public function guess(string ...$guesses) : bool {
		$correct_guesses = [];
		foreach ($guesses as $guess) {
			$any_correct = false;
			foreach ($this->word as $index => $char) {
				if ($char->isHidden()) {
					if ($char->guess($guess)) {
						$correct_guesses[$index] = $guess;
						$any_correct = true;
					}
				}
			}

			if (!$any_correct) { return false; }
		}

		// Make our correct guesses to mark them unhidden
		foreach ($correct_guesses as $index => $guess) {
			if (!$this->word[$index]->peek() === $guess) {
				throw new \LogicException("Guess should always be correct here.");
			}
		}

		return true;
	}

	/**
	 * Returns the word with hidden characters replaced by '?'.
	 *
	 * @return string
	 */
	public function showProgress() : string {
		$full_word = '';
		foreach ($this->word as $char) {
			$full_word .= !$char->isHidden() ? $char->peek() : '?';
		}

		return $full_word;
	}

	/**
	 * Returns true if all the letters are revealed.
	 *
	 * @return boolean
	 */
	public function solved() : bool {
		foreach ($this->words as $char) {
			if ($char->isHidden()) {
				return false;
			}
		}

		return true;
	}
}