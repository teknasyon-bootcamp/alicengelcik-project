<?php
namespace App\Model;

use App\Model\BaseModel;

class AccountModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "user_delete";
    }
}