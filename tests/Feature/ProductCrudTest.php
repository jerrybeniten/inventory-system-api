<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ProductCrudTest extends TestCase
{

    /**
     * test_return_negative_no_name_create_response
     *
     * @return void
     */
    public function test_return_negative_no_name_create_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $productData = [
            'description' => 'This is a sample product description.',
            'type_id' => 1,
            'quantity' => 10,
            'unit_price' => 99.99,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/product', $productData);
        $response->assertStatus(422);
    }

    /**
     * test_return_negative_no_description_create_response
     *
     * @return void
     */
    public function test_return_negative_no_description_create_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $productData = [
            'name' => 'Sample Product',
            'type_id' => 1,
            'quantity' => 10,
            'unit_price' => 99.99,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/product', $productData);
        $response->assertStatus(422);
    }

    /**
     * test_return_negative_no_type_id_create_response
     *
     * @return void
     */
    public function test_return_negative_no_type_id_create_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $productData = [
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'quantity' => 10,
            'unit_price' => 99.99,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/product', $productData);
        $response->assertStatus(422);
    }

    /**
     * test_return_negative_quantity_create_response
     *
     * @return void
     */
    public function test_return_negative_quantity_create_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $productData = [
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'type_id' => 1,
            'quantity' => -10,
            'unit_price' => 99.99,
        ];

        $response = $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/product', $productData);
        $response->assertStatus(500);
    }

    /**
     * test_return_successful_create_response
     *
     * @return void
     */
    public function test_return_successful_create_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $productData = [
            'name' => 'Sample Product',
            'description' => 'This is a sample product description.',
            'type_id' => 1,
            'quantity' => 10,
            'unit_price' => 99.99,
        ];

        $response = $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->post('/api/v1/product', $productData);
        $response->assertStatus(201);
    }

    /**
     * test_return_successful_read_response
     *
     * @return void
     */
    public function test_return_successful_read_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->get('/api/v1/product');
        $response->assertStatus(200);
    }

    /**
     * test_return_successful_read_page_one_response
     *
     * @return void
     */
    public function test_return_successful_read_page_one_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->get('/api/v1/product?page=1');
        $response->assertStatus(200);
    }

    /**
     * test_return_successful_read_page_not_exist_response
     *
     * @return void
     */
    public function test_return_successful_read_page_not_exist_response(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $response = $this->get('/api/v1/product?page=1000000');
        $response->assertStatus(200);
    }

    public function test_return_successful_product_update(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $product = Product::factory()->create([
            'name' => 'Old Product Name',
            'description' => 'Old description',
            'type_id' => 1,
            'quantity' => 10,
            'unit_price' => 99.99,
        ]);

        $updatedData = [
            'name' => 'Updated Product Name',
            'description' => 'Updated description',
            'type_id' => 2,
            'quantity' => 20,
            'unit_price' => 199.99,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/v1/product/{$product->id}", $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
            'description' => 'Updated description',
            'type_id' => 2,
            'quantity' => 20,
            'unit_price' => 199.99,
        ]);
    }

    public function test_product_update_fails_when_not_authenticated(): void
    {
        $product = Product::factory()->create();

        $updatedData = [
            'name' => 'Updated Product Name',
            'description' => 'Updated description',
            'type_id' => 2,
            'quantity' => 20,
            'unit_price' => 199.99,
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->put("/api/v1/product/{$product->id}", $updatedData);

        $response->assertStatus(401);
    }
    
    /**
     * test_product_deletion_fails_when_not_authenticated
     *
     * @return void
     */
    public function test_product_deletion_fails_when_not_authenticated(): void
    {
        $product = Product::factory()->create();
        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/v1/product/{$product->id}");
        $response->assertStatus(401);
    }
    
    /**
     * test_product_can_be_deleted
     *
     * @return void
     */
    public function test_product_can_be_deleted(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
        $product = Product::factory()->create();
        $response = $this->actingAs($user)->withHeaders([
            'Accept' => 'application/json',
        ])->delete("/api/v1/product/{$product->id}");
        $response->assertStatus(204);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }
}
