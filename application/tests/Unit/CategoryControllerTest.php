<?php

namespace Tests\Unit;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test__categories__ok()
    {
        $response = $this->get('/api/categories');

        $response->assertOK();
    }



    public function test__addCategory__created()
    {
        $response = $this->post('/api/categories/add', [
            'name' => 'new'
        ]);

        $response->assertCreated();
    }

    public function test__addCategory__badRequest()
    {
        $response = $this->post('/api/categories/add', []);

        $response->assertStatus(400);
    }

    public function test__editCategory__ok()
    {
        $response = $this->put('/api/categories/' . rand(1, 25) . '/edit', [
            'name' => 'test'
        ]);

        $response->assertOK();
    }

    public function test__editCategory__badRequest()
    {
        $response = $this->put('/api/categories/' . rand(1, 25) . '/edit', []);

        $response->assertStatus(400);
    }

    public function test__deleteCategory__noContent()
    {
        $response = $this->delete('/api/categories/' . rand(1, 25) . '/delete');

        $response->assertNoContent();
    }



    public function test__addCategoryProperty__created()
    {
        $response = $this->post('/api/categories/' . rand(1, 25) . '/property/add', [
            'property' => 'new'
        ]);

        $response->assertCreated();
    }

    public function test__addCategoryProperty__badRequest()
    {
        $response = $this->post('/api/categories/' . rand(1, 25) . '/property/add', []);

        $response->assertStatus(400);
    }

    public function test__editCategoryProperty__ok()
    {
        $response = $this->put('/api/categories/' . rand(1, 25) . '/property/edit', [
            'property' => 'edit'
        ]);

        $response->assertOK();
    }

    public function test__editCategoryProperty__badRequest()
    {
        $response = $this->put('/api/categories/' . rand(1, 25) . '/property/edit', []);

        $response->assertStatus(400);
    }

    public function test__deleteCategoryProperty__noContent()
    {
        $response = $this->delete('/api/categories/' . rand(1, 25) . '/property/delete');

        $response->assertNoContent();
    }
}
