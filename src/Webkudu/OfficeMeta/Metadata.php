<?php

namespace Webkudu\OfficeMeta;

class Metadata
{
    private $coreMeta = array(  'dc:title'          => '',
                                'dc:subject'        => '',
                                'dc:creator'        => '',
                                'cp:keywords'       => '',
                                'dc:description'    => '',
                                'cp:lastModifiedBy' => '',
                                'cp:revision'       => '',
                                'cp:category'       => ''
    );

    private $appMeta = array(   'Manager'   => '',
                                'Company'    => ''
    );

    public function getAllAttributes(): array
    {
        $tidiedCoreMeta = array();
        foreach ($this->coreMeta as $field => $value) {
            $tidiedCoreMeta[ucfirst(substr($field, strpos($field, ':') + 1))] = $value;
        }
        return array_merge($tidiedCoreMeta, $this->appMeta);
    }

    public function getTitle(): string
    {
        return $this->coreMeta['dc:title'];
    }
    public function setTitle(string $title): void
    {
        $this->coreMeta['dc:title'] = $title;
    }
    public function getSubject(): string
    {
        return $this->coreMeta['dc:subject'];
    }
    public function setSubject(string $subject): void
    {
        $this->coreMeta['dc:subject'] = $subject;
    }
    public function getCreator(): string
    {
        return $this->coreMeta['dc:creator'];
    }
    public function setCreator(string $creator): void
    {
        $this->coreMeta['dc:creator'] = $creator;
    }
    public function getKeywords(): string
    {
        return $this->coreMeta['cp:keywords'];
    }
    public function setKeywords(string $keywords): void
    {
        $this->coreMeta['cp:keywords'] = $keywords;
    }
    public function getDescription(): string
    {
        return $this->coreMeta['dc:description'];
    }
    public function setDescription(string $description): void
    {
        $this->coreMeta['dc:description'] = $description;
    }
    public function getLastModifiedBy(): string
    {
        return $this->coreMeta['cp:lastModifiedBy'];
    }
    public function setLastModifiedBy(string $lastModifiedBy): void
    {
        $this->coreMeta['cp:lastModifiedBy'] = $lastModifiedBy;
    }
    public function getRevision(): string
    {
        return $this->coreMeta['cp:revision'];
    }
    public function setRevision(string $revision): void
    {
        $this->coreMeta['cp:revision'] = $revision;
    }
    public function getCategory(): string
    {
        return $this->coreMeta['cp:category'];
    }
    public function setCategory(string $category): void
    {
        $this->coreMeta['cp:category'] = $category;
    }
    public function getManager(): string
    {
        return $this->appMeta['Manager'];
    }
    public function setManager(string $manager): void
    {
        $this->appMeta['Manager'] = $manager;
    }
    public function getCompany(): string
    {
        return $this->appMeta['Company'];
    }
    public function setCompany(string $company): void
    {
        $this->appMeta['Company'] = $company;
    }

    public function setCore(string $xml): void
    {
        $this->setMeta($xml, 'coreMeta');
    }

    public function setApp(string $xml): void
    {
        $this->setMeta($xml, 'appMeta');
    }

    public function clean(): void
    {
        foreach (['coreMeta', 'appMeta'] as $property) {
            foreach ($this->$property as $field => $value) {
                $this->$property[$field] = '';
            }
        }
    }

    /*
     * $property should be either coreMeta or appMeta
     */
    private function setMeta(string $xml, $property): void
    {
        foreach ($this->$property as $field => $value) {
            $startPos = stripos($xml, "<$field>") + strlen($field) + 2;
            $endPos = stripos($xml, "</$field>");

            if ($startPos == 2 || !$endPos) {
                $this->$property[$field] = '';
                continue;
            }

            $dataLength = $endPos -  $startPos;
            $data = substr($xml, $startPos, $dataLength);

            $this->$property[$field] = $data;
        }
    }
}
