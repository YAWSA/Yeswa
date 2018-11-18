<?php

class Swift_Mime_EmbeddedFileTest extends Swift_Mime_AttachmentTest
{

    public function testNestingLevelIsAttachment()
    {
        // previous loop would fail if there is an issue
        $this->addToAssertionCount(1);
    }

    public function testNestingLevelIsEmbedded()
    {
        $file = $this->createEmbeddedFile($this->createHeaderSet(), $this->createEncoder(), $this->createCache());
        $this->assertEquals(Swift_Mime_SimpleMimeEntity::LEVEL_RELATED, $file->getNestingLevel());
    }

    public function testIdIsAutoGenerated()
    {
        $headers = $this->createHeaderSet(array(), false);
        $headers->shouldReceive('addIdHeader')
            ->once()
            ->with('Content-ID', '/^.*?@.*?$/D');
        
        $file = $this->createEmbeddedFile($headers, $this->createEncoder(), $this->createCache());
    }

    public function testDefaultDispositionIsInline()
    {
        $headers = $this->createHeaderSet(array(), false);
        $headers->shouldReceive('addParameterizedHeader')
            ->once()
            ->with('Content-Disposition', 'inline');
        $headers->shouldReceive('addParameterizedHeader')->zeroOrMoreTimes();
        
        $file = $this->createEmbeddedFile($headers, $this->createEncoder(), $this->createCache());
    }

    protected function createAttachment($headers, $encoder, $cache, $mimeTypes = array())
    {
        return $this->createEmbeddedFile($headers, $encoder, $cache, $mimeTypes);
    }

    private function createEmbeddedFile($headers, $encoder, $cache)
    {
        $idGenerator = new Swift_Mime_IdGenerator('example.com');
        
        return new Swift_Mime_EmbeddedFile($headers, $encoder, $cache, $idGenerator);
    }
}
