<?php

namespace Tests\Feature\Charts;

use Tests\TestCase;
use Livewire\Livewire;

class LatestTransactionsTest extends TestCase
{
    /** @test */
    public function it_renders_the_component()
    {
        $this->get(route('welcome'))->assertSeeLivewire('charts.latest-transactions');
    }

    /** @test */
    public function assert_it_returns_the_labels_and_values_for_a_day_week()
    {
        $now = now()->setTime(10, 30);
        
        $this->travelTo($now);

        $hoursToCheck = collect(range(0, 11))->map(function ($index) use ($now) {
            return $now->copy()->startOfHour()->subHour($index*2);
        })->reverse()->values();

        $exceptectLabels = $hoursToCheck->map(function ($hour) {
            return $hour->format('H:i');
        })->toArray();

        $this->assertEquals('12:00', $exceptectLabels[0]);
        
        $this->assertEquals('10:00', $exceptectLabels[11]);
        
        $this->assertCount(12, $exceptectLabels);

        Livewire::test('charts.latest-transactions', ['view' => 'day'])
            ->assertSet('view', 'day')
            ->assertSet('labels', $exceptectLabels);

        
        // // Test the "foo" component with "bar" set as a parameter.

        // ->set('foo', 'bar');
        // // Set the "foo" property (`public $foo`) to the value: "bar"

        // ->call('foo');
        // // Call the "foo" method

        // ->call('foo', 'bar', 'baz');
        // // Call the "foo" method, and pass the "bar" and "baz" parameters

        // ->emit('foo');
        // // Fire the "foo" event

        // ->emit('foo', 'bar', 'baz');
        // // Fire the "foo" event, and pass the "bar" and "baz" parameters

            
        // // Asserts that the "foo" property is set to the value "bar" (Includes computed properties)

        // ->assertNotSet('foo', 'bar');
        // // Asserts that the "foo" property is NOT set to the value "bar" (Includes computed properties)

        // ->assertPayloadSet('foo', 'bar');
        // // Asserts that the "foo" property from the JavaScript payload that Livewire returns is set to the value "bar"

        // ->assertPayloadNotSet('foo', 'bar');
        // // Asserts that the "foo" property in the JavaScript payload that Livewire returns is NOT set to the value "bar"

        // ->assertSee('foo');
        // // Assert that the string "foo" exists in the currently rendered content of the component

        // ->assertDontSee('foo');
        // // Assert that the string "foo" DOES NOT exist in the currently rendered content of the component

        // ->assertSeeHtml('<h1>foo</h1>');
        // // Assert that the string "<h1>foo</h1>" exists in the currently rendered HTML of the component

        // ->assertDontSeeHtml('<h1>foo</h1>');
        // // Assert that the string "<h1>foo</h1>" DOES NOT exist in the currently rendered HTML of the component

        // ->assertEmitted('foo');
        // // Assert that the "foo" event was emitted

        // ->assertEmitted('foo', 'bar', 'baz');
        // // Assert that the "foo" event was emitted with the "bar" and "baz" parameters

        // ->assertNotEmitted('foo');
        // // Assert that the "foo" event was NOT emitted

        // ->assertHasErrors('foo');
        // // Assert that the "foo" property has validation errors

        // ->assertHasErrors(['foo', 'bar']);
        // // Assert that the "foo" AND "bar" properties have validation errors

        // ->assertHasErrors(['foo' => 'required']);
        // // Assert that the "foo" property has a "required" validation rule error

        // ->assertHasErrors(['foo' => ['required', 'min']]);
        // // Assert that the "foo" property has a "required" AND "min" validation rule error

        // ->assertHasNoErrors('foo');
        // // Assert that the "foo" property has no validation errors

        // ->assertHasNoErrors(['foo', 'bar']);
        // // Assert that the "foo" AND "bar" properties have no validation errors

        // ->assertNotFound();
        // // Assert that an error within the component caused an error with the status code: 404

        // ->assertRedirect('/some-path');
        // // Assert that a redirect was triggered from the component

        // ->assertUnauthorized();
        // // Assert that an error within the component caused an error with the status code: 401

        // ->assertForbidden();
        // // Assert that an error within the component caused an error with the status code: 403

        // ->assertStatus(500);
        // // Assert that an error within the component caused an error with the status code: 500

        // ->assertDispatchedBrowserEvent('event', $data);
    }
}
