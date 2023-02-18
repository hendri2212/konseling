<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AngketAttempt extends Model
{
    use HasFactory;

    protected $table = "angket_attempts";
    protected $keyType = 'string';
    public $incrementing = false;

    /** @var string to identify the in progress state. */
    const IN_PROGRESS = 'inprogress';
    /** @var string to identify the finished state. */
    const FINISHED    = 'finished';
    /** @var string to identify the abandoned state. */
    // const ABANDONED   = 'abandoned';

}
