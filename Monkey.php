<?php

interface Animal
{
	public function makeNoise() : string;
	public function eat(int $amountOfFood);
}

interface Picky
{

	public function setFavoriteFood(string $food);

}

class Monkey implements Animal
{

	protected $foodEaten = 0;
	public function makeNoise() : String
	{
		return 'Eeee Eeee Eee';
	}

	public function eat(int $amountOfFood)
	{
		$this->foodEaten += $amountOfFood;
	}
}

class HungryMonkey extends Monkey implements Picky
{

	protected $favFood;

	public function setFavoriteFood(String $food)
	{
		$this->favFood = $food;
	}

	public function makeNoise() : string
	{
		return  parent::makeNoise() . ' I want ' . rand($this->foodEaten,20) . ' more ' . $this->favFood;
	}

}

?>
