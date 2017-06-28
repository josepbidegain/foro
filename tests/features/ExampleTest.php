<?php

class ExampleTest extends FeatureTestCase
{

    /**
     * A basic functional test example.
     *
     * @return void
     */
    function test_basic_example()
    {
        $user = factory(App\User::class)->create([
            'name' => 'Jose Bidegain',
            'email'=> 'josepbidegain@gmail.com'
            ]);
        $this->actingAs($user,'api')
        ->visit('api/user')
        ->see('Jose Bidegain')
        ->see('josepbidegain@gmail.com');
    }
}
