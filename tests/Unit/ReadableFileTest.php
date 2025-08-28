<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Rules\ReadableFile;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReadableFileTest extends TestCase
{
    #[Test]
    public function accepts_existing_readable_file(): void
    {
        $path = tempnam(sys_get_temp_dir(), 'csv');
        $validator = Validator::make(['input' => $path], ['input' => [new ReadableFile]]);
        $this->assertTrue($validator->passes());
    }

    #[Test]
    public function rejects_non_existing_file(): void
    {
        $validator = Validator::make(['input' => 'non-existing-file.csv'], ['input' => [new ReadableFile]]);
        $this->assertFalse($validator->passes());
    }
}
