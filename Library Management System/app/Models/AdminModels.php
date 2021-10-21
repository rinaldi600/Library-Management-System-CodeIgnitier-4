<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModels extends Model
{
    protected $table      = 'admin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['idAdmin', 'nama', 'email', 'username', 'password', 'picture'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}
