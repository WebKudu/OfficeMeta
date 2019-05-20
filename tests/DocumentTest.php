<?php

namespace Webkudu\OfficeMeta;

class DocumentTest extends \PHPUnit\Framework\TestCase
{
    const ASSET_DIRECTORY = __DIR__.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR;
    private $document = null;

    public function setUp(): void
    {
        $this->document = new Document(self::ASSET_DIRECTORY.'test.xlsx');
    }

    public function test__construct()
    {
        $this->assertInstanceOf(Document::class, $this->document);
    }

    public function test__destruct()
    {
        unset($this->document);
        $this->assertTrue(true);
    }

    public function testGetFileName()
    {
        $this->assertEquals(self::ASSET_DIRECTORY.'test.xlsx', $this->document->getFileName());
    }

    public function testFlush()
    {
        $this->assertTrue($this->document->flush());
    }

    public function testGetMetadata()
    {
        $this->assertInstanceOf(Metadata::class, $this->document->getMetadata());
    }

    public function testSetMetadata()
    {
        $this->document->setMetadata(new Metadata());
        $this->assertInstanceOf(Metadata::class, $this->document->getMetadata());
    }

    public function tesClean()
    {
        $this->document->clean();
        $this->assertInstanceOf(Metadata::class, $this->document->getMetadata());
    }
}
