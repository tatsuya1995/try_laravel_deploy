<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Test extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndexStatus()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
                ->assertViewIs('index') ;
    }







    // public function testRequest()
    // {
    //    // $response = $this->get('/');

    // }






}
