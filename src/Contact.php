<?php
  //declaring the Contact class
    class Contact
    {
      //creating properties for the Contact class and setting them to private
      private $name;
      private $number;
      private $address;

      //creating a constructor for the properties of the Contact class
      function __construct($contact_name, $contact_number, $contact_address)
      {
          $this->name = $contact_name;
          $this->number = $contact_number;
          $this->address = $contact_address;
      }
      //getters and setters for each private property of the Contact class
      function getContactName()
      {
          return $this->name;
      }

      function setContactName($contact_name)
      {
          $this->name = $contact_name;
      }

      function getContactNumber()
      {
          return $this->number;
      }

      function setContactNumber($contact_number)
      {
          $this->number = $contact_number;
      }

      function getContactAddress()
      {
          return $this->address;
      }

      function setContactAddress()
      {
          $this->address = $contact_address;
      }

      //creating a save function by pushing the current object ($this) to the end of the list of contacts array
      //note: $_SESSION is a superglobal which means it is availble in all scopes throughout the script
      function save()
      {
          array_push($_SESSION['list_of_contacts'], $this);
      }

      //creates a delete function by setting $_SESSION['list_of_contacts'] equal to an empty array
      //note: a static method is one that works on the whole class
      static function deleteAll()
      {
          $_SESSION['list_of_contacts'] = array();
      }
      //creates a method for returning our entire list of contacts 
      static function getAll()
      {
          return $_SESSION['list_of_contacts'];
      }

    }
?>
