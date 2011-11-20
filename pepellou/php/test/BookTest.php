<?php

include_once 'src/Book.php';

class BookTest extends PHPUnit_Framework_TestCase {
	
	public function test_there_are_five_different_books(
	) {
		$book1 = new Book(FIRST_BOOK);
		$book2 = new Book(SECOND_BOOK);
		$book3 = new Book(THIRD_BOOK);
		$book4 = new Book(FOURTH_BOOK);
		$book5 = new Book(FIFTH_BOOK);
		$this->assertNotEquals($book1, $book2);
		$this->assertNotEquals($book3, $book4);
		$this->assertNotEquals($book5, $book2);
		$this->assertEquals(new Book(SECOND_BOOK), $book2);
	}

	/**
	 * @expectedException NoSuchBook
	 */
	public function test_there_are_only_those_books(
	) {
		$unexisting_title = "Harry Potter finally dies";
		new Book($unexisting_title);
	}

	/**
	 * @dataProvider all_valid_books
	 */
	public function test_one_book_costs_eight_euro(
		$bookName
	) {
		$aBook = new Book($bookName);
		$this->assertEquals(8, $aBook->price());
	}

	public function simple_discounts_examples(
	) {
		return array(
			"empty pack" => array(
				new Pack(), 
				0
			),
			"one single book" => array(
				new Pack(
					new Book(FIRST_BOOK)
				), 
				8
			),
			"two books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(SECOND_BOOK)
				), 
				8 * 2 * 0.95
			),
			"three books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(SECOND_BOOK),
					new Book(THIRD_BOOK)
				), 
				8 * 3 * 0.9
			),
			"four books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(SECOND_BOOK),
					new Book(THIRD_BOOK),
					new Book(FOURTH_BOOK)
				), 
				8 * 4 * 0.8
			),
			"five books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(SECOND_BOOK),
					new Book(THIRD_BOOK),
					new Book(FOURTH_BOOK),
					new Book(FIFTH_BOOK)
				), 
				8 * 5 * 0.75
			),
		);
	}

	/**
	 * @dataProvider simple_discounts_examples
	*/
	public function test_simple_cases(
		$pack,
		$expectedPrice
	) {
		$this->assertEquals($expectedPrice, $pack->price());
	}

	public function no_discounts_examples(
	) {
		return array(
			"one single book" => array(
				new Pack(
					new Book(FIRST_BOOK)
				), 
				8
			),
			"two books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(FIRST_BOOK)
				), 
				8 * 2
			),
			"three books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK)
				), 
				8 * 3
			),
			"four books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK)
				), 
				8 * 4
			),
			"five books" => array(
				new Pack(
					new Book(FIRST_BOOK), 
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK)
				), 
				8 * 5
			)
		);
	}

	/**
	 * @dataProvider no_discounts_examples
	*/
	public function test_just_repeated_books(
		$pack,
		$expectedPrice
	) {
		$this->assertEquals($expectedPrice, $pack->price());
	}

	public function mixed_examples(
	) {
		return array(
			"case 1" => array(
				new Pack(
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(SECOND_BOOK)
				), 
				8 + (8 * 2 * 0.95)
			),
			"case 2" => array(
				new Pack(
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(SECOND_BOOK),
					new Book(SECOND_BOOK)
				), 
				2 * (8 * 2 * 0.95)
			),
			"case 3" => array(
				new Pack(
					new Book(FIRST_BOOK),
					new Book(FIRST_BOOK),
					new Book(SECOND_BOOK),
					new Book(THIRD_BOOK),
					new Book(THIRD_BOOK),
					new Book(FOURTH_BOOK)
				), 
				(8 * 4 * 0.8) + (8 * 2 * 0.95)
			),
			"case 4" => array(
				new Pack(
					new Book(FIRST_BOOK),
					new Book(SECOND_BOOK),
					new Book(SECOND_BOOK),
					new Book(THIRD_BOOK),
					new Book(FOURTH_BOOK),
					new Book(FIFTH_BOOK)
				), 
				8 + (8 * 5 * 0.75)
			)
		);
	}

	/**
	 * @dataProvider mixed_examples
	*/
	public function test_mixed_cases(
		$pack,
		$expectedPrice
	) {
		$this->assertEquals($expectedPrice, $pack->price());
	}

	public function all_valid_books(
	) {
		return array(
			"first book"  => array(FIRST_BOOK),
			"second book" => array(SECOND_BOOK),
			"third book"  => array(THIRD_BOOK),
			"fourth book" => array(FOURTH_BOOK),
			"fifth book"  => array(FIFTH_BOOK)
		);
	}

}

