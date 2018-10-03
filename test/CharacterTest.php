<?php

use PHPUnit\Framework\TestCase;
use HangmanSolver\Character;

class CharacterTest extends TestCase
{
	/**
	 * Tests that the status of the Character is Character::HIDDEN when it hasn't
	 * been successfully guessed.
	 *
	 * @dataProvider hiddenProvider
	 * @param string $answer
	 * @return void
	 */
	public function testCharacterIsHidden(string $answer) {
		$char = new Character($answer);
		$this->assertTrue($char->isHidden());
	}

	public function hiddenProvider() {
		return [
			['a'],
		];
	}

	/**
	 * Tests that correctly guessing the character returns true.
	 *
	 * @dataProvider correctGuessProvider
	 * @param string $answer
	 * @param string $guess
	 * @return void
	 */
	public function testCorrectGuess(string $answer, string $guess) {
		$char = new Character($answer);
		$this->assertTrue($char->guess($guess));
	}

	public function correctGuessProvider() {
		return [
			['a', 'a'],
		];
	}

	/**
	 * Tests that incorrectly guessing the character returns false.
	 *
	 * @dataProvider incorrectGuessProvider
	 * @param string $answer
	 * @param string $guess
	 * @return void
	 */
	public function testIncorrectGuess(string $answer, string $guess) {
		$char = new Character($answer);
		$this->assertFalse($char->guess($guess));
	}

	
	public function incorrectGuessProvider() {
		return [
			['a', 'b'],
		];
	}

	/**
	 * Tests that you can peek the answer to a character without guessing it.
	 *
	 * @dataProvider peekProvider
	 * @param string $answer The hidden character
	 * @return void
	 */
	public function testPeek(string $answer) {
		$char = new Character($answer);
		$this->assertEquals($answer, $char->peek());
	}

	public function peekProvider() {
		return [
			['a'],
		];
	}
}