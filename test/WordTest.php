<?php

use PHPUnit\Framework\TestCase;
use HangmanSolver\Word;

class WordTest extends TestCase
{
	/**
	 * Tests that partially-revealed Words function correctly.
	 * 
	 * @dataProvider guessAndShowProvider
	 */
	public function testGuessAndShow(
		string $answer,
		array $guesses,
		string $expected
	) {
		$hidden_word = new Word($answer);
		foreach ($guesses as $guess) {
			$hidden_word->guess($guess);
		}

		$this->assertEquals($expected, $hidden_word->showProgress());
	}

	/**
	 * Test cases for testGuessAndShow()
	 */
	public function guessAndShowProvider() : array {
		return [
			[
				'Exemption',
				['e', 'i', 'o', 'm'],
				'E?em??io?'
			],
		];
	}

	/**
	 * Tests that multi-character guesses work.
	 * 
	 * @dataProvider multiGuessProvider
	 */
	public function testMultipleGuessesAtOnce(
		string $answer,
		string $expected,
		string ...$guess
	) {
		$hidden_word = new Word($answer);
		$hidden_word->guess(...$guess);
		$this->assertEquals($expected, $hidden_word->showProgress());
	}

	public function multiGuessProvider() {
		return [
			[
				'Exemption',
				'E?e?p????',
				'e', 'p'
			],
		];
	}
}