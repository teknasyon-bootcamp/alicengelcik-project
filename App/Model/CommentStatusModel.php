<?php
namespace App\Model;

use App\Model\BaseModel;

class CommentStatusModel extends BaseModel{
    public function __construct()
    {
        loginControl();
    }
    protected static function getTable(): string
    {
        return "comment_status";
    }
}