<?php


namespace App\Ship\Traits\Accessors;


use Illuminate\Support\Str;

trait FullNameAccessor
{


    /**
     * @return string
     */
    public function getShortName(): string
    {
        $result = '';

        $firstName = Str::ucfirst($this->getFirstName());
        $result .= !empty($firstName) ? $firstName . ' ' : '';

        $lastName = Str::substr($this->getLastName(), 0, 1);
        $result .= !empty($lastName) ? Str::upper($lastName) . '. ' : '';

        $middleName = Str::substr($this->getMiddleName(), 0, 1);
        $result .= !empty($middleName) ? Str::upper($middleName) . '. ' : '';

        return $result;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        $result = '';

        $lastName = Str::ucfirst($this->getLastName());
        $result .= !empty($lastName) ? $lastName . ' ' : '';

        $firstName = Str::ucfirst($this->getFirstName());
        $result .= !empty($firstName) ? $firstName . ' ' : '';

        $middleName = Str::ucfirst($this->getMiddleName());
        $result .= !empty($middleName) ? $middleName . ' ' : '';

        return $result;
    }


    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->f_name;
    }

    /**
     * @param string|null $f_name
     */
    public function setFirstName(?string $f_name): void
    {
        $this->f_name = $f_name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->l_name;
    }

    /**
     * @param string|null $l_name
     */
    public function setLastName(?string $l_name): void
    {
        $this->l_name = $l_name;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->m_name;
    }

    /**
     * @param string|null $m_name
     */
    public function setMiddleName(?string $m_name): void
    {
        $this->m_name = $m_name;
    }

}
