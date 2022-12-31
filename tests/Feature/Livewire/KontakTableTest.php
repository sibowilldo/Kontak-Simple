<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\KontakTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class KontakTableTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(KontakTable::class);

        $component->assertStatus(200);
    }
}
