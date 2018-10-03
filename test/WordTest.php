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

		$this->assertEquals($expected, $hidden_word->show());
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
	 * Tests that multi-character guesses throw exceptions.
	 * 
	 * @dataProvider multiGuessProvider
	 */
	public function testMultipleGuessesAtOnce(
		string $answer,
		string $guess,
		string $exception_class
	) {
		$hidden_word = new Word($answer);
		$this->expectException($exception_class);
		$hidden_word->guess($guess);
	}

	public function multiGuessProvider() {
		return [
			[
				'Exemption',
				'ep',
				\UnexpectedValueException::class
			],
		];
	}
}