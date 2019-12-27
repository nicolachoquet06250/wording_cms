<?php


namespace App\Domain\Project;


use App\Domain\DomainException\DomainRecordNotFoundException;

class ProjectNotFoundException extends DomainRecordNotFoundException {
    public $message = 'The project you requested does not exist.';
}