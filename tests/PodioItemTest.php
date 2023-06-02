<?php

namespace Podio\Tests;

require __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use PodioApp;
use PodioItem;
use PodioItemFieldCollection;
use PodioTextItemField;

class PodioItemTest extends TestCase
{
    private $mockClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockClient = $this->createMock(\PodioClient::class);
    }
    public function test_create_item(): void
    {
        $item = new PodioItem($this->mockClient, [
            'app' => new PodioApp($this->mockClient, 1234),
            'fields' => new PodioItemFieldCollection($this->mockClient, [
                new PodioTextItemField($this->mockClient, ["external_id" => "title", "values" => "TEST"]),
            ])
        ]);

        $this->assertEquals(1234, $item->app->id);
    }


    public function test_save_should_throw_error_if_app_id_missing(): void
    {
        $this->expectException('PodioMissingRelationshipError');
        $item = new PodioItem($this->mockClient, [
            'fields' => new PodioItemFieldCollection($this->mockClient, [
                new PodioTextItemField($this->mockClient, ["external_id" => "title", "values" => "TEST"]),
            ])
        ]);
        $item->save();
    }
}
