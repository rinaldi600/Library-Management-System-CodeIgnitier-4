<?php

namespace App\Models;

use CodeIgniter\Model;

class rentModel extends Model
{
    protected $table      = 'rent';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = ['idRent', 'idUser', 'idBook', 'usernameAdmin', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
