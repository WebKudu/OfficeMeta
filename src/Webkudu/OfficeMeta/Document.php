<?php

namespace Webkudu\OfficeMeta;

class Document
{
    private $filename = null;
    private $archive = null;
    private $metadata = null;
    private $pendingChanges = false;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->archive = new \ZipArchive;
        $this->openArchive();
    }

    public function __destruct()
    {
        $this->flush();
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    private function openArchive(): void
    {
        if ($response = $this->archive->open($this->filename) !== true) {
            throw new \Exception("Could not open {$this->filename}: $response");
        }
    }

    public function getMetadata(): MetaData
    {
        if (is_null($this->metadata)) {
            $this->metadata = $this->generateMetadata();
        }

        return $this->metadata;
    }

    public function setMetadata(Metadata $metadata): void
    {
        $this->metadata = $metadata;
        $this->pendingChanges = true;
    }

    public function flush(): bool
    {
        if (is_null($this->archive)) {
            return false;
        }

        if ($this->archive->getStatusString() != \ZipArchive::ER_OK) {
            return false;
        }

        if ($this->pendingChanges) {
            // TODO save changes
        }

        if (!$this->archive->close()) {
            throw new \Exception("Error closing {$this->filename}");
        }

        $this->pendingChanges = false;
        $this->archive = null;

        return true;
    }

    public function clean(): void
    {
        $this->setMetadata(new Metadata());
    }

    private function generateMetadata(): Metadata
    {
        $metadata = new Metadata();
        $metadata->setCore($this->archive->getFromName('docProps/core.xml'));
        $metadata->setApp($this->archive->getFromName('docProps/app.xml'));

        return $metadata;
    }
}
