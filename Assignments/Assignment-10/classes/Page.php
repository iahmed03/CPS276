<?php
class Page {
	private $base = "https://russet-v8.wccnet.edu/~iahmed3/cps276/Assignments/Assignment-10/pages/index.php?file=";

  public function nav(){
		$nav = <<<NAV
      <nav style="background: #eee; height: 30px; border-radius: 5px; margin-bottom: 15px;">
        <ul style="list-style: none">
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}home">Home</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}addContact">Add Contact</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}deleteContacts">Delete Contacts</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}addAdmin">Add Admin</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}deleteAdmins">Delete Admins</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}login">Login</a></li>
          <li style="display: inline; line-height: 30px; margin: 0 20px"><a href="{$this->base}logout">Logout</a></li>
        </ul>
      </nav>
NAV;
		return $nav;
  }
 

}