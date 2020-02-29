<?php
/**
 * Created by PhpStorm.
 * User: mohammadmira
 * Date: 2/29/20
 * Time: 1:36 PM
 */

namespace App\Services\EventService\CreateEvent\ValueObjects;

use App\User;

class EventValueObjects
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $due_date;
    /**
     * @var User
     */
    protected $owner;
    /**
     * @var array
     */
    protected $invited_usernames;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDueDate(): string
    {
        return $this->due_date;
    }

    /**
     * @param string $due_date
     */
    public function setDueDate(string $due_date): self
    {
        $this->due_date = $due_date;
        return $this;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * @return array
     */
    public function getInvitedUsernames(): array
    {
        return $this->invited_usernames;
    }

    /**
     * @param array $invited_usernames
     */
    public function setInvitedUsernames(array $invited_usernames): self
    {
        $this->invited_usernames = $invited_usernames;
        return $this;
    }

    
}