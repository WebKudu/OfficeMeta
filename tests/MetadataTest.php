<?php

namespace Webkudu\OfficeMeta;


class MetadataTest extends \PHPUnit\Framework\TestCase
{
    private $metadata;
    
    public function setUp(): void
    {
        $this->metadata = new Metadata();
    }
    
    public function testSetGetTitle()
    {
        $this->metadata->setTitle('test');
        $this->assertEquals('test', $this->metadata->getTitle());
    }

    public function testSetGetSubject()
    {
        $this->metadata->setSubject('test');
        $this->assertEquals('test', $this->metadata->getSubject());
    }

    public function testSetGetCreator()
    {
        $this->metadata->setCreator('test');
        $this->assertEquals('test', $this->metadata->getCreator());
    }

    public function testSetGetKeywords()
    {
        $this->metadata->setKeywords('test');
        $this->assertEquals('test', $this->metadata->getKeywords());
    }

    public function testSetGetDescription()
    {
        $this->metadata->setDescription('test');
        $this->assertEquals('test', $this->metadata->getDescription());
    }

    public function testSetGetLastModifiedBy()
    {
        $this->metadata->setLastModifiedBy('test');
        $this->assertEquals('test', $this->metadata->getLastModifiedBy());
    }

    public function testSetGetRevision()
    {
        $this->metadata->setRevision(100);
        $this->assertEquals(100, $this->metadata->getRevision());
    }

    public function testSetGetCategory()
    {
        $this->metadata->setCategory('test');
        $this->assertEquals('test', $this->metadata->getCategory());
    }

    public function testSetGetManager()
    {
        $this->metadata->setManager('test');
        $this->assertEquals('test', $this->metadata->getManager());
    }

    public function testSetGetCompany()
    {
        $this->metadata->setCompany('test');
        $this->assertEquals('test', $this->metadata->getCompany());
    }

    public function testGetAllAttributes()
    {
        $this->assertIsArray($this->metadata->getAllAttributes());
    }
}
