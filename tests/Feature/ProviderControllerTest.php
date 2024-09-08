<?php

namespace Tests\Feature;

use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProviderControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test the index method to list all providers.
     *
     * @return void
     */
    public function test_index()
    {
        // Create some providers
        $providers = Provider::factory()->count(3)->create();

        // Make a GET request to the index endpoint
        $response = $this->get('/api/providers');

        // Assert response status and content
        $response->assertStatus(200)
                 ->assertJson([
                     'providers' => $providers->toArray()
                 ]);
    }

    /**
     * Test the store method to create a new provider.
     *
     * @return void
     */
    public function test_store()
    {
        // Create a valid payload
        $payload = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->numerify(str_repeat('#', 12)),
            'address' => $this->faker->address,
        ];

        // Make a POST request to the store endpoint
        $response = $this->post('/api/providers', $payload);

        // Assert response status and content
        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'Nhà cung cấp đã được tạo thành công!',
                     'provider' => $payload
                 ]);

        // Assert the provider was created in the database
        $this->assertDatabaseHas('providers', $payload);
    }

    /**
     * Test the show method to display a specific provider.
     *
     * @return void
     */
    public function test_show()
    {
        // Create a provider
        $provider = Provider::factory()->create();

        // Make a GET request to the show endpoint
        $response = $this->get('/api/providers/' . $provider->id);

        // Assert response status and content
        $response->assertStatus(200)
                 ->assertJson([
                     'provider' => $provider->toArray()
                 ]);
    }

    /**
     * Test the update method to update a specific provider.
     *
     * @return void
     */
    public function test_update()
    {
        // Create a provider
        $provider = Provider::factory()->create();

        // Create a valid payload
        $payload = [
            'name' => 'Updated Name',
            'email' => 'updatedemail@example.com',
            'phone_number' => '1234567890',
            'address' => 'Updated Address',
        ];

        // Make a PUT request to the update endpoint
        $response = $this->put('/api/providers/' . $provider->id, $payload);

        // Assert response status and content
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Nhà cung cấp đã được cập nhật thành công!',
                     'provider' => $payload
                 ]);

        // Assert the provider was updated in the database
        $this->assertDatabaseHas('providers', $payload);
    }

    /**
     * Test the destroy method to delete a provider.
     *
     * @return void
     */
    public function test_destroy()
    {
        // Create a provider
        $provider = Provider::factory()->create();

        // Make a DELETE request to the destroy endpoint
        $response = $this->delete('/api/providers/' . $provider->id);

        // Assert response status and content
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Nhà cung cấp đã được xóa thành công!'
                 ]);

        // Assert the provider was deleted from the database
        $this->assertDatabaseMissing('providers', ['id' => $provider->id]);
    }
}
