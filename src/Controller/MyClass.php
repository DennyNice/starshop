<?php

namespace App\Controller;

class MyClass
{
    public string $title;
    public string $color;
    public string $season;

    public function __construct()
    {
        $this->title = 'My Title'; // Устанавливаем значение для свойства $title
        $this->color = 'Red'; // Устанавливаем значение для свойства $color
        $this->season = 'Summer'; // Устанавливаем значение для свойства $season
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

}

class DenMain extends MyClass
{
}

$dennyName = new DenMain(); // Создаем экземпляр класса DenMain

 $dennyName->setTitle('Denny');

echo $dennyName->getTitle();
