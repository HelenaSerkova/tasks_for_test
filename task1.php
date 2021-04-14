<?php

/*
 1.	Создать класс Item, который не наследуется. В конструктор класса передается ID объекта.
 2.	Описать свойства (int) id, (string) name, (int) status, (bool) changed.
 Свойства доступны только внутри класса.
 3.	Создать метод init(). Предусмотреть одноразовый вызов метода.
 4.	Метод доступен только внутри класса.
 5.	Метод получает из таблицы objects данные name и status и заполняет их в свойства
 экземпляра (реализация работы с базой не требуется, представим что класс уже работает с бд).
 Эти данные также необходимо хранить в сыром виде внутри объекта, до сохранения.
 6.	Сделать возможным получение свойств объекта, используя magic methods.
 7.	Сделать возможным задание свойств объекта, используя magic methods с проверкой
 вводимого значения на заполненность и тип значения. Свойство ID не поддается записи.
 8.	Создать метод save().
 9.	Метод публичный.
 10.	Метод сохраняет установленные значения name и status в случае, если свойства объекта
 были изменены извне.
 11.	Класс должен быть задокументирован в стиле PHPDocumentor.
*/

/**
* @author SerkovaElena <serkovaau@gmail.com>
*
*/

final class Item {

  private int $id;
  private string $name;
  private int $status;
  private bool $isChanged;
  private bool $isExternallySet;

  public function __construct($id)
  {
    $this ->id = $id;
    $this->Init();
  }

  /**
  * @access private
  * @param $name_init
  * @param $status_init
  * @var bool isChanged флаг для одноразового вызова
  */

  private function init($name_init, $status_init) {
    if ($this->isChanged) {
      //@todo throw warning!
      print_r("Properties was already changed!\n");
      return;
    }
    $this->name_init = $name;
    $this->status_init = $status;
    $this->isChanged = true;

  }

  /**
  * @access public
  * @param $property
  *
  */

  public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
    //@todo throw warning!
    print_r("Property does not exists: $property\n");
    return null;
  }

  /**
  * @access public
  * @param $property
  * @param $value
  * @var bool isExternallySet флаг для обнаружения изменений свойств
  */

  public function __set($propertyName, $value) {
    if (!in_array($propertyName, ['name', 'status'])) {
        //@todo throw warning!
        print_r("Property: $propertyName is not available for change!\n");
        return;
    }
    if (!$this->IsValid($propertyName, $value)) {
        //@todo throw warning!
        print_r("Property: $propertyName value is not not valid!\n");
        return;
    }
    $this->$propertyName = $value;
    $this->isExternallySet = true;
    print_r("Property: $propertyName value set to: $value\n");
  }
  private function IsValid($propertyName, $propertyValue) : bool {
    if (($propertyName == 'name') && is_string($propertyValue) && !(empty($propertyValue))) {
      return true;
    }
    if ($propertyName == 'status' && is_int($propertyValue) && !(empty($propertyValue))) {
      return true;
    }

  }

  /**
  * @access public
  * @param $name_save
  * @param $status_save
  * @return void
  */

  public function save($name_save, $status_save) {
    if (!$this->isExternallySet) {
      //@todo throw warning!
      print_r("Can't save item: properties doesn't changed!\n");
      return;
    }
    $this->name = $name_save;
    $this->status = $status_save;
  }
}
