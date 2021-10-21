<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthIDLibraryModels extends Model
{
    protected $table      = 'authidlib';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';

    protected $allowedFields = ['idAdmin'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}