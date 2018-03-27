<?php

use PHPUnit\Framework\TestCase;
use HangmanSolver\HiddenWord;

class HiddenWordTest extends TestCase
{
	public function testGuessAndShow()
	{
		// test data
		$cases = array(
			[
				'initial' => 'Exemption',
				'guesses' => ['e', 'i', 'o', 'm'],
				'expected' => 'E?em??io?'
			]
		);

		foreach ($cases as $case) {
			$hidden_word = new HiddenWord($case['initial']);
			foreach ($case['guesses'] as $guess) {
				$hidden_word->guess($guess);
			}

			$this->assertEquals($case['expected'], $hidden_word->show());
		}
	}

	public function testMultipleGuessesAtOnce()
	{
		$cases = array(
			[
				'initial' => 'Exemption',
				'guesses' => ['ep', 'iom'],
				'expected' => 'E?emp?io?'
			]
		);

		foreach ($cases as $case) {
			$hidden_word = new HiddenWord($case['initial']);
			foreach ($case['guesses'] as $guess) {
				$hidden_word->guess($guess);
			}
			// TODO: test that it throws exception
		}
	}
}